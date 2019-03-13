<?php

session_start();
/////////////////////////////////////////////////////
////////////// FONCTION SQL POUR AJAX////////////////
/////////////////////////////////////////////////////

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
	$date = date('Y-m-d H:i:s');
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO chat (message, id_utilisateur, date) 
		VALUES (:message, :userId, :date)');
    $req->bindParam(':message', $msg);
    $req->bindParam(':userId', $userId);
    $req->bindParam(':date', $date);
    $req->execute();
}

// recuperer les couleurs d'un article pour l'image (a utiliser)
function getCouleurImg($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article_couleur
		WHERE id_couleur = '.$id.'
		AND id_article =1
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

// appel et lance le post message du chat
if(isset($_POST['postMsgLive'])) {
	if(isset($_SESSION['idUtilisateur'])){
	insererMessage($_POST['postMsgLive'],$_SESSION['idUtilisateur']);
	}else{
		insererMessage($_POST['postMsgLive'],105);
	}
}

// changer les images par couleur ( a utiliser)
if(isset($_POST['changeImage'])) {
	$reponse = getCouleurImg($_POST['changeImage']);
	while ($donnees = $reponse->fetch())
	{    echo '<img class="imgArticle" src="src/img/articlesImage/'.$donnees["image_src"].'.png" alt="" id="parametre" class="categImage"  />';
	}
}

// rafraichissement de la page de chat
if(isset($_POST['refresh'])) {
	$reponse = showMessage();
	$lastDateDay=0;
	echo "<table>";
    while ($donnees = $reponse->fetch())
	{
		$dateSeparate=explode(" ", $donnees["date"]);
		$dateDay=$dateSeparate[0];
		$dateTime=$dateSeparate[1];
		if($lastDateDay !=$dateDay){
			echo "<tr><td></td><td><b>".$dateDay."<hr></b></td></tr>";
			$lastDateDay =$dateDay;
		}
    	echo "<tr><td style = 'margin-bottom:10px'><u>".$donnees['pseudo'].": </u><div style = 'font-size:10px'>(".$dateTime.")</div><br/></td><td>".$donnees['message']."</td></tr>";
	}
	echo "</table>";
}
