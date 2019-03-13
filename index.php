<?php

include_once('modele/modeleMonProjet.php');

// Initialisation Twig
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader, [
    'debug' => true,
]);
$twig->addExtension(new Twig_Extension_Debug());

// Controler les adresses envoyer par les routes
if(!isset($_POST['controllerAction'])) $_POST['controllerAction'] = "index";

if(isset($_GET['idArticle'])) {
    $_POST['controllerAction'] = 'articleDetails';
}
if(isset($_GET['idPanierArticle'])) {
    $_POST['controllerAction'] = 'insertionPanier';
}
if(isset($_GET['subcat'])) {
    $_POST['controllerAction'] = 'subcat';
}


switch ($_POST['controllerAction']) {

    
    // connexion et renvoi des information des pages de l'acceuil et creation de la facturation pour la relier a l'utilisateur
    case 'connection':
        $news=getNews();
        $newsCategorie = array();
        $i = 0;
        while ($new = $news->fetch())
        {
            $newsCategorie[$i] = $new;
            $i++;
        }
        $reponse = userConnection();
        while ($donnees = $reponse->fetch()) //fetch pour resultat ligne par ligne
        {
            if($donnees['mail'] == $_POST['emailConnection'] && $donnees['mdp'] == $_POST['mdpConnection']){
                $_SESSION['idUtilisateur'] = $donnees['id'];
                $_SESSION['pseudo'] = $donnees['pseudo'];
                $_SESSION['prenom'] = $donnees['prenom'];
                $mesFacturations = getFacturation($_SESSION['idUtilisateur']);
                $monFacturation="";
                while ($unFacturation = $mesFacturations->fetch())
                {
                    $monFacturation=$unFacturation['id'];
                }
                if( $monFacturation==""){
                    insertFacturation("", "", "");
                    $mesFacturations = getFacturation2($_SESSION['idUtilisateur']);
                    while ($unFacturation = $mesFacturations->fetch())
                    {
                        $monFacturation=$unFacturation['id'];
                    }
                    updateUserFacturation($monFacturation);
                }
            }
        }
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
        $imagesDir = 'src/img/articlesImage/';
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);  
        $randomImage = $images[array_rand($images)];
        $randomImage1 = $images[array_rand($images)];
        $randomImage2 = $images[array_rand($images)];
        $randomImage3 = $images[array_rand($images)];
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
            'categories' => $tabCategorie,
            'news' => $newsCategorie[0],
            'randomImage' => $randomImage,
            'randomImage1' => $randomImage1,
            'randomImage2' => $randomImage2,
            'randomImage3' => $randomImage3,
        ));
    break;
            
    // inscription et renvoi des information des pages de l'acceuil
    case 'inscription':
        insertUser();
        $news=getNews();
        $newsCategorie = array();
        $i = 0;
        while ($new = $news->fetch())
        {
            $newsCategorie[$i] = $new;
            $i++;
        }
        $imagesDir = 'src/img/articlesImage/';
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        $randomImage = $images[array_rand($images)];
        $randomImage1 = $images[array_rand($images)];
        $randomImage2 = $images[array_rand($images)];
        $randomImage3 = $images[array_rand($images)];
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
            'news' => $newsCategorie[0],
            'randomImage' => $randomImage,
            'randomImage1' => $randomImage1,
            'randomImage2' => $randomImage2,
            'randomImage3' => $randomImage3,
        ));
    break;

    //chargement de la page acceuil
    case 'index':
        $news=getNews();
        $newsCategorie = array();
        $i = 0;
        while ($new = $news->fetch())
        {
            $newsCategorie[$i] = $new;
            $i++;
        }
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
        $imagesDir = 'src/img/articlesImage/';
        $images = glob($imagesDir . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);
        $randomImage = $images[array_rand($images)];
        $randomImage1 = $images[array_rand($images)];
        $randomImage2 = $images[array_rand($images)];
        $randomImage3 = $images[array_rand($images)];
        echo $twig->render('pages/monprojet_acceuil.html.twig', array(
            'session' => $_SESSION,
            'categories' => $tabCategorie,
            'news' => $newsCategorie[0],
            'randomImage' => $randomImage,
            'randomImage1' => $randomImage1,
            'randomImage2' => $randomImage2,
            'randomImage3' => $randomImage3,
        ));
    break;

    // Recherche
    case 'recherche':
        $recherche = htmlspecialchars($_POST['recherche']);
        $recherche =strtolower($recherche); //strtolower pour accepter les majuscules dans la recherche
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
        //insertion du menu deroulant des categories sur la page recherche
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
        echo $twig->render('pages/recherche.html.twig', array(
            'session' => $_SESSION,
            'recherches' => $tabRecherche,
            'articleRechercher' => $_POST['recherche'],
            'categories' => $tabCategorie,
        ));
    break;

    //descriptif articles
    case 'descriptifArticle':
        //insertion du menu deroulant des categories sur la page descriptif article
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
        if(isset($_GET['idArticle'])) {
            $article = getArticle($_GET['idArticle']);
            echo $twig->render('descriptifArticles.html.twig', array(
                'article' => $article,
                'categories' => $tabCategorie,
            ));
        } else {
            echo $twig->render('pages/monprojet_acceuil.html.twig', array(
                'session' => $_SESSION,
            ));
        }
    break;

    //chargement des pages articles ( par sous_catégorie Bdd)
    case 'subcat':
    //insertion du menu deroulant des categories sur la page list article
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
        $articles = getArticles($_GET['subcat']);         
        echo $twig->render('pages/listArticle.html.twig', array(
            'articles' => $articles,
            'session' => $_SESSION,
            'categories' => $tabCategorie,
        ));
        break;

    //chargement de la page panier
    case 'panier':
    if( !isset($_SESSION['idUtilisateur'])){
        header('Location: index.php');
    }
    //insertion du menu deroulant des categories sur la page panier
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
        $mesPaniers = getPanier($_SESSION['idUtilisateur']);
        $monPanier="";
        while ($unPanier = $mesPaniers->fetch()) 
        {
            $monPanier=$unPanier['id'];
        }
        if( $monPanier==""){
            insertPanier("", "", "");
            $mesPaniers = getPanier($_SESSION['idUtilisateur']);
            while ($unPanier = $mesPaniers->fetch())
            {
                $monPanier=$unPanier['id'];
            }
        }
        $articlesPaniers = getArticlePanier($monPanier);
        $articlesPaniers = $articlesPaniers->fetchall(); //fetchall renvoi toute les lignes du tableau
        foreach ($articlesPaniers as &$unArticle) { //verifie un par un les articles
        }
        $couleurs = getCouleurss();
        $tailles = getTailless();
        $articles = getArticless();
        foreach ($couleurs as &$uneCouleur) {
        }
        echo $twig->render('pages/monprojet_monpanier.html.twig', array(
            'session' => $_SESSION,
            'articlesPaniers' => $articlesPaniers,
            'couleurs' => $couleurs,
            'tailles' => $tailles,
            'articles' => $articles,
            'categories' => $tabCategorie,
        ));
    break;

    //chargement de la page mon compte
    case 'compte': 
        if( !isset($_SESSION['idUtilisateur'])){
            header('Location: index.php');
        }
        $reponse = getUser();
        $tabUser = array();
        $i = 0;
        $adresse;
        $adresseFacturation;
        while ($rep = $reponse->fetch())
        {
            $tabUser[$i] = $rep;
            $adresse=$rep['id_adresse'];
            $adresseFacturation=$rep['id_facturation'];
            $i++;
        }
        $reponse = getAdresse($adresse);
        while ($rep = $reponse->fetch())
        {
            $tabAdresse[$i] = $rep;
            $i++;
        }
        $reponse = getAdresseFact($adresseFacturation);
        while ($rep = $reponse->fetch())
        {
            $tabFacturation[$i] = $rep;
            $i++;
        }
        echo $twig->render('pages/monprojet_moncompte.html.twig', array(
        'session' => $_SESSION,
        'tabUser' => $tabUser,
        'tabAdresse' => $tabAdresse,
        'tabFacturation' => $tabFacturation,
        ));
    break;

    //deconnexion
    case 'logout':
        session_unset();
        header('Location: index.php');
    break;

    // pour la page descriptif article
    case 'articleDetails':
        //insertion du menu deroulant des categories sur la page panier
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
            'categories' => $tabCategorie,
        ));
    break;

    //renvoi sur la page d'acceuil si pas d'article correspondant dans la BDD
    default:
    echo $twig->render('pages/monprojet_acceuil.html.twig', array(
        'session' => $_SESSION,
    ));
    break;

    // code pour inserer les articles dans le panier
    case 'insertionPanier':

        if( !isset($_SESSION['idUtilisateur'])){
            header('Location: index.php?idArticle='.$_POST['idPanierArticle']);
        }

        $mesPaniers = getPanier($_SESSION['idUtilisateur']);
        $monPanier = "";
        while ($unPanier = $mesPaniers->fetch())
        {
            $monPanier=$unPanier['id'];
        }
        if( $monPanier==""){
            insertPanier("", "", "");
            $mesPaniers = getPanier($_SESSION['idUtilisateur']);
            while ($unPanier = $mesPaniers->fetch())
            {
                $monPanier=$unPanier['id'];
            }
        }

        $articlesPaniers = getArticlePanier($monPanier);

        $_SESSION["idPanier"] = $monPanier;
        
        $articlesPaniers = $articlesPaniers->fetchAll();

        if (count($articlesPaniers) == 0) {
            insertArticlePanier($monPanier);
        } else {  
            foreach($articlesPaniers as $articlesPanier)
            {
                if($_POST['couleurs']==$articlesPanier['id_couleur'] &&
                    $_POST['tailles']==$articlesPanier['id_taille'] &&
                    $_POST['idPanierArticle']==$articlesPanier['id_article']) {
                        
                    $quantite= $_POST['quantite'] + $articlesPanier['quantite'];
                    
                    updateArticlePanier($monPanier, $quantite);
                }else{
                    insertArticlePanier($monPanier);
                }
            }
        }
        header('Location: index.php?idArticle='.$_POST['idPanierArticle']);
    break;

    // page paiement
    case 'paiement':
        $reponse = getUser();
        $tabUser = array();
        $i = 0;
        $adresse;
        while ($rep = $reponse->fetch())
        {
            $tabUser[$i] = $rep;
            $adresse=$rep['id_adresse'];
            $i++;
        }
        $reponse = getAdresse($adresse);
        while ($rep = $reponse->fetch())
        {
            $tabAdresse[$i] = $rep;
            $i++;
        }
        echo $twig->render('pages/monprojet_paiement.html.twig', array(
            'session' => $_SESSION,
            'tabUser' => $tabUser,
            'tabAdresse' => $tabAdresse,
        ));
    break;

    // fin du paiement 
    case 'paiementF':
        $fin=true;

        deleteArticlePanier($_SESSION['idPanier']);

        PanierIsPaid($_SESSION['idPanier']);

        echo $twig->render('pages/monprojet_paiement.html.twig', array(
            'session' => $_SESSION,
            'fin' => $fin,
        ));
    break;


    /* case 'modifProfil':
        echo $_POST['lastName'];
        echo $_POST["firstName"];
        echo 'sdfghjdfg';
        // updateUser();
        $reponse = getUser();
        $tabUser = array();
        $i = 0;
        $adresse;
        $adresseFacturation;
        while ($rep = $reponse->fetch())
        {
            $tabUser[$i] = $rep;
            $adresse=$rep['id_adresse'];
            $adresseFacturation=$rep['id_facturation'];
            $i++;
        }
        $reponse = getAdresse($adresse);
        while ($rep = $reponse->fetch())
        {
            $tabAdresse[$i] = $rep;
            $i++;
        }
        $reponse = getAdresseFact($adresseFacturation);
        while ($rep = $reponse->fetch())
        {
            $tabFacturation[$i] = $rep;
            $i++;
        }
        echo $twig->render('pages/monprojet_moncompte.html.twig', array(
            'session' => $_SESSION,
            'tabUser' => $tabUser,
            'tabAdresse' => $tabAdresse,
            'tabFacturation' => $tabFacturation,
        ));
    break;*/

}

