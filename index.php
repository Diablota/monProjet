<?php

include_once('modele/modeleMonProjet.php');

// Init Twig
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, [
    'debug' => true,
]);
$twig->addExtension(new Twig_Extension_Debug());

if(!isset($_POST['controllerAction'])) $_POST['controllerAction'] = "index";

if(isset($_GET['idArticle'])) {
    $_POST['controllerAction'] = 'articleDetails';
}

if(isset($_GET['subcat'])) {
    $_POST['controllerAction'] = 'subcat';
}

// 
switch ($_POST['controllerAction']) {
    case 'connection':
        $reponse = userConnection();
        while ($donnees = $reponse->fetch())
        {
            if($donnees['mail'] == $_POST['emailConnection'] && $donnees['mdp'] == $_POST['mdpConnection']){
                $_SESSION['idUtilisateur'] = $donnees['id'];
                $_SESSION['pseudo'] = $donnees['pseudo'];
                $_SESSION['prenom'] = $donnees['prenom'];
            }
        }

        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
        ));
        break;
        
//
    case 'inscription':
        insertUser();
        //inscription grace au model
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
        ));
        break;

//chargement de la page acceuil
    case 'index':
        $categories = getCategories();

        $tabCategorie = array();

        $i = 0;
        while ($cat = $categories->fetch())
        {
            $tabCategorie[$i] = $cat;
            
            $subcats = getSousCategories($cat['id']);
            while ($subcat = $subcats->fetch()) 
            {
                $tabCategorie[$i]['subcat'][] = $subcat;
            }
            $i++;
        }
        
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
            'categories' => $tabCategorie,
        ));
        break;
//
case 'recherche':

    $recherche = htmlspecialchars($_POST['recherche']);
    $recherche =strtolower($recherche);
$idRecherche=0;
$cat1=["ceinture", "ceintures"];
$cat2=["bouton", "boutons", ];
$cat3=["robe", "robes", "raube"];
$cat4=["pantalon", "pantalons"];
$cat5=["tee-shirt", "tee-shirts"];
$cat6=["bijou", "bijoux"];
$cat7=["autre", "autres"];
for ($i=0; $i < count($cat1) ; $i++) { 
    if($recherche==$cat1[$i]){
        $idRecherche=1;
    }
    if($recherche==$cat2[$i]){
        $idRecherche=2;
    }
    if($recherche==$cat3[$i]){
        $idRecherche=3;
    }
    if($recherche==$cat4[$i]){
        $idRecherche=4;
    }
    if($recherche==$cat5[$i]){
        $idRecherche=5;
    }
    if($recherche==$cat6[$i]){
        $idRecherche=6;
    }
    if($recherche==$cat7[$i]){
        $idRecherche=7;
    }
}

    $rechercheArticles = rechercheArticles($idRecherche);

        $tabRecherche = array();

        $i = 0;
        while ($rechercheArticle = $rechercheArticles->fetch())
        {
            $tabRecherche[$i] = $rechercheArticle;

            $i++;
        }
        echo $twig->render('pages/recherche.html.twig', array(
            'session' => $_SESSION,
            'recherches' => $tabRecherche,
            'articleRechercher' => $_POST['recherche'],
        ));
        break;



    case 'descriptifArticle':
        if(isset($_GET['idArticle'])) {
            $article = getArticle($_GET['idArticle']);

            echo $twig->render('descriptifArticles.html.twig', array(
                'article' => $article,
            ));
        } else {
            echo $twig->render('pages/monprojet_acceuil.html.twig', array(
                'session' => $_SESSION,
            ));
        }
        break;

    //chargement des pages articles ( par sous_catégorie Bdd)
    case 'subcat':
        $articles = getArticles($_GET['subcat']);
                
        echo $twig->render('pages/listArticle.html.twig', array(
            'articles' => $articles,
            'session' => $_SESSION,
        ));
        break;

    //chargement de la page panier
    case 'panier':
        echo $twig->render('pages/monprojet_monpanier.html.twig', array(
            'session' => $_SESSION,
        ));
        break;

    case 'logout':
        session_unset();
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
        ));
        break;

    case 'articleDetails':
        $monArticle = getArticle($_GET['idArticle']);

        /*Chargement BDD des couleurs*/
        $couleurs=getCouleur($_GET['idArticle']);

        /*Chargement BDD des tailles*/
        $tailles=getTaille($_GET['idArticle']);

        echo $twig->render('pages/descriptifArticle.html.twig', array(
            'article' => $monArticle[0],
            'session' => $_SESSION,
            'articleCouleur' =>$couleurs,
            'articleTaille' =>$tailles,
        ));
        break;

    //renvoi sur la page d'acceuil si pas d'article correspondant dans la BDD
    default:
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
        ));
        break;
}

// barre de recherche
