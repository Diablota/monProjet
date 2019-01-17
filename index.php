<?php

include_once('modele/modeleMonProjet.php');

// INIT TWIG
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader);

// INIT MODEL
if(!isset($_GET['idArticle'])) {
    $_POST['controllerAction'] = "descriptifArticle";
}

if(!isset($_POST['controllerAction'])) {
    $_POST['controllerAction'] = "index";
}

switch ($_POST['controllerAction']) {
    case 'inscription':
        insertUser();
        //inscription grace au model
        echo $twig->render('monprojet_acceuil.html.twig', array(
            'name' => 'Fabien'
        ));
        break;

//chargement de la page acceuil
    case 'index':
        $articles = getArticles();
        
        echo $twig->render('monprojet_acceuil.html.twig', array(
            'name' => 'Fabien'
        ));
        break;
    case 'descriptifArticle':
        if(isset($_GET['idArticle'])) {
            $article = getArticle($_GET['idArticle']);
            echo 'dazdzdza';
            echo $twig->render('descriptifArticles.html.twig', array(
                'article' => $article,
            ));
        } else {
            echo $twig->render('monprojet_acceuil.html.twig', array(
                'name' => 'Fabien'
            ));
        }
        break;

//chargement de la page articles
    case 'Pantalons':
    case 'Robes':
    case 'Tee-shirt':
    case 'Boutons':
    case 'Ceintures':
    case 'Bijoux':
    case 'Autres':
        $articles = getArticles();
        
        echo $twig->render('listArticle.html.twig', array(
            'articles' => $articles
        ));
    break;

//chargement de la page panier
    case 'panier':
        echo $twig->render('monprojet_monpanier.html.twig', array(
            'name' => 'Fabien'
        ));
    break;
    
}