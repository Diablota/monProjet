<?php

// INIT TWIG
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader);

// INIT MODEL

include_once('modele/modeleMonProjet.php');




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
        echo $twig->render('listArticle.html.twig', array(
            'name' => 'Fabien'
        ));
    break;
    //chargement de la page panier
    case 'panier':
        echo $twig->render('monprojet_monpanier.html.twig', array(
            'name' => 'Fabien'
        ));
    break;
}