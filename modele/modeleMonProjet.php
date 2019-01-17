<?php

session_start();

//connexion BDD
function coBdd(){
	try
	{
	    $bdd = new PDO('mysql:host=localhost;dbname=monprojet;charset=utf8', 'root', '');
	    return $bdd;
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
}

// insert un utilisateur dans la base de donnée (INSCRIPTION)
function insertUser() {
	$prenom = htmlspecialchars($_POST["lastName"]);
	$nom = htmlspecialchars($_POST["firstName"]);
	$pseudo = htmlspecialchars($_POST["pseudo"]);
	$email = htmlspecialchars($_POST["email"]);
	$mdp = htmlspecialchars($_POST["pwd1"]);

	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO utilisateur (nom, prenom, pseudo, mail, mdp) 
		VALUES (:nom, :prenom,  :pseudo, :mail, :mdp)
	');
    $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
	$req->bindParam(':mail', $email, PDO::PARAM_STR);
	$req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $req->execute();
}

// Vérifie les données utilisateur (CONNEXION)
function userConnection() {
	$bdd = coBdd();
    $reponse = $bdd->prepare('
        SELECT * 
        FROM utilisateur 
        WHERE mail = "' . $_POST["emailConnection"] . '"
    ');
    $reponse->execute();
    return $reponse;
}

// affichage des messages
function showMessage(){
	$bdd = coBdd();
	$reponse = $bdd->query('
	    SELECT *
	    FROM chat 
	    LEFT JOIN utilisateur 
	        ON chat.id_utilisateur = utilisateur.id 
	    ORDER BY chat.id DESC
	');
	return $reponse;
}

// insertion des messages
function insererMessage($msg, $userId) {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO chat (message, id_utilisateur) 
		VALUES (:message, :userId)');
    $req->bindParam(':message', $msg);
    $req->bindParam(':userId', $userId);
    $req->execute();
}

// recuperations articles Bdd
function getArticles() {
	$bdd = coBdd();
	$req = $bdd->query('
	    SELECT * 
		FROM article 
	');
	$req->execute();
	return $req;
}

// recuperations articles Bdd
function getArticle($id) {
	$bdd = coBdd();
	$req = $bdd->query('
	    SELECT * 
		FROM article 
		WHERE article.id = ' . $id .'
	');
	$req->execute();
	return $req;
}