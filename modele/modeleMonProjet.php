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

// recuperations tout les articles Bdd
function getArticles($id) {
	$bdd = coBdd();
	$req = $bdd->prepare('
	    SELECT * 
		FROM article
		WHERE id_sous_categorie = ?
	');
	$req->execute([$id]);
	return $req;
}

// recuperations un article Bdd
function getArticle($id) {
	$bdd = coBdd();
	$req = $bdd->prepare('
	    SELECT * 
		FROM article 
		WHERE article.id = ' . $id .'
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

// recuperations articles par catégorie Bdd
function getArticleCategorie($id) {
	$bdd = coBdd();
	$req = $bdd->query('
	    SELECT * 
		FROM article 
		WHERE article.id_sous_categorie = ' . $id .'
	');
	$req->execute();
	return $req;
}

//recuper catégorie de la BDD
function getCategories() {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT * 
		FROM categorie
	');
	$req->execute();
	return $req;
}

function getSousCategories($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT * 
		FROM sous_categorie
		WHERE id_categorie = '.$id.'
	');
	$req->execute();
	return $req;
}

function getCouleur($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article_couleur
		LEFT JOIN couleur
		    ON couleur.id = article_couleur.id_couleur
		WHERE id_article = '.$id.'
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

function getCouleurss() {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM couleur
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

function getTailless() {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM taille
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

function getArticless() {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}
function getCouleurs($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM couleur
		WHERE id = '.$id.'
	');
	$req->execute();
	return $req;
}

function getTaille($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article_taille
		LEFT JOIN taille
		    ON taille.id = article_taille.id_taille
		WHERE id_article = '.$id.'
	');
	$req->execute();
	$req = $req->fetchall();
	return $req;
}

function getTailles($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM taille
		WHERE id = '.$id.'
	');
	$req->execute();
	return $req;
}

function rechercheArticles($id){
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article
		WHERE id_sous_categorie = '.$id.'
		ORDER BY id DESC
	');
	$req->execute();
	return $req;
}
function getPanier($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM panier
		WHERE id_utilisateur = '.$id.'
	');
	$req->execute();
	return $req;
}
function getArticlePanier($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM article_panier
		WHERE id_panier = '.$id.'
	');
	$req->execute();
	return $req;
}

//changement quantite dans le panier si l'article à deja ete ajouter
function updateArticlePanier($id, $quantite) {
	$bdd = coBdd();
	$req = $bdd->query('
		UPDATE article_panier
		SET quantite='.$quantite.'
		WHERE id_panier = '.$id.'
		AND id_article ='.$_POST['idPanierArticle'].'
		AND id_couleur ='.$_POST['couleurs'].'
		AND id_taille ='.$_POST['tailles'].'
	');
	$req->execute();
	return $req;
}
//Recuperation de la BDD table articlePanier
function insertArticlePanier($idPanier) {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO article_panier (id_article, id_panier, id_couleur, id_taille, quantite) 
		VALUES (:id_article, :id_panier, :id_couleur, :id_taille, :quantite)
	');
    $req->bindParam(':id_article', $_POST['idPanierArticle'], PDO::PARAM_INT);
	$req->bindParam(':id_panier', $idPanier, PDO::PARAM_INT);
	$req->bindParam(':id_couleur', $_POST['couleurs'], PDO::PARAM_INT);
	$req->bindParam(':id_taille', $_POST['tailles'], PDO::PARAM_INT);
	$req->bindParam(':quantite', $_POST['quantite'], PDO::PARAM_INT);
    $req->execute();
}

//Recuperation de la BDD table panier
function insertPanier($date, $idAdresse, $idFacturation) {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO panier (date, id_utilisateur, id_adresse, id_facturation)
		VALUES (:date, :id_utilisateur, :id_adresse, :id_facturation)
	');
    $req->bindParam(':date', $date, PDO::PARAM_STR);
	$req->bindParam(':id_utilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
	$req->bindParam(':id_adresse', $idAdresse, PDO::PARAM_INT);
	$req->bindParam(':id_facturation', $idFacturation, PDO::PARAM_INT);
    $req->execute();
}

//Recuperation de la BDD table facturation (adresse facturation= adresse domicile)
function insertFacturation() {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO facturation (adresse_facturation, cp_facturation, ville_facturation)
		VALUES (:adresse_facturation, :cp_facturation, :ville_facturation)
	');
	$req->bindParam(':adresse_facturation', $adresseFacturation, PDO::PARAM_STR);
	$req->bindParam(':cp_facturation', $cpFacturation, PDO::PARAM_STR);
	$req->bindParam(':ville_facturation', $villeFacturation, PDO::PARAM_STR);
    $req->execute();
}

//Recuperation de la BDD table adresse (adresse = adresse livraison)
function insertAdresse() {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO adresse (adresse_livraison, cp_livraison, ville_livraison)
		VALUES (:adresse_livraison, :cp_livraison, :ville_livraison)
	');
	$req->bindParam(':adresse_livraison', $adresseLivraison, PDO::PARAM_STR);
	$req->bindParam(':cp_livraison', $cpLivraison, PDO::PARAM_STR);
	$req->bindParam(':ville_livraison', $villeLivraison, PDO::PARAM_STR);
    $req->execute();
}

