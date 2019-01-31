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
// affichage des messages
function showMessage(){
	$bdd = coBdd();
	$reponse = $bdd->query('
	    SELECT *
	    FROM chat 
	    LEFT JOIN utilisateur 
	        ON chat.id_utilisateur = utilisateur.id 
	    ORDER BY chat.id DESC LIMIT 20
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
if(isset($_POST['postMsgLive'])) {
    insererMessage($_POST['postMsgLive'],$_SESSION['idUtilisateur']);
}
if(isset($_POST['refresh'])) {
    $reponse = showMessage();
    while ($donnees = $reponse->fetch())
	{
    	echo $donnees['pseudo']."(".$donnees["date"]."): ".$donnees['message']."<br/>";
    }
}