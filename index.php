<?php
require_once 'vendor/autoload.php';

$loader = new Twig_Loader_Array(array(
    'index' => 'Hello {{ name }}!',
));
$loader = new Twig_Loader_Filesystem('view');
$twig = new Twig_Environment($loader);

echo $twig->render('monprojet_acceuil.twig.html', array(
    'name' => 'Fabien'
));