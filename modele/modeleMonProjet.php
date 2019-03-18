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

// Récupère les coordonnées de l'utilisateur pour la page mon compte
function getUser() {
	$bdd = coBdd();
    $reponse = $bdd->prepare('
        SELECT * 
		FROM utilisateur 
		LEFT JOIN utilisateur_adresse
			ON utilisateur_adresse.id_utilisateur = utilisateur.id
        WHERE id = "' . $_SESSION['idUtilisateur'] . '"
    ');
    $reponse->execute();
    return $reponse;
}

//recuperer les adresses (livraison)
function getAdresse($id) {
	$bdd = coBdd();
    $reponse = $bdd->prepare('
        SELECT * 
        FROM adresse 
        WHERE id = "' . $id . '"
    ');
    $reponse->execute();
    return $reponse;
}

//recuperer les adresses facturation
function getAdresseFact($id) {
	$bdd = coBdd();
    $reponse = $bdd->prepare('
        SELECT * 
        FROM facturation 
        WHERE id = "' . $id . '"
    ');
    $reponse->execute();
    return $reponse;
}

// recuperer les news
function getNews() {
	$bdd = coBdd();
	$req = $bdd->prepare('
	    SELECT * 
		FROM news
	');
	$req->execute();
	return $req;
}

// recuperer tous les articles d'une sous categorie
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

// recuperer un article
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

// recuperer de tous les articles par toutes les catégorie
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

//recuper sous catégorie de la BDD
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

// recuperer une couleur d'un article
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

// recuperer toutes les couleurs
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

// recuperer toutes les tailles
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

// recuperer tout de la table article
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

// recuperer les couleurs pas id
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

// recuperer une taille d'un article

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

// recuperer les tailles pas id
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

// la recherche
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

// fonction a voir pour reutiliser a la creation de l'historique des commandes
// recuperer panier
function getPanier($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM panier
		WHERE id_utilisateur = '.$id.'
		AND is_deleted = 0
	');
	$req->execute();
	return $req;
}

//
function getAllPanierUser($user_id) {
	$bdd = coBdd();
	$req = $bdd->query('
		SELECT *
		FROM `panier`
		LEFT JOIN article_panier 
			ON article_panier.id_panier = panier.id
		LEFT JOIN article
			ON article.id = article_panier.id_article
		WHERE id_utilisateur = '.$user_id.'
		ORDER BY panier.id
	');
	$req->execute();
	$req = $req->fetchAll();
	return $req;
}

// recuperer article du panier
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
		INSERT INTO panier (date, id_utilisateur, id_adresse, id_facturation, is_deleted, is_paid)
		VALUES (:date, :id_utilisateur, :id_adresse, :id_facturation, 0, 0)
	');
    $req->bindParam(':date', $date, PDO::PARAM_STR);
	$req->bindParam(':id_utilisateur', $_SESSION['idUtilisateur'], PDO::PARAM_INT);
	$req->bindParam(':id_adresse', $idAdresse, PDO::PARAM_INT);
	$req->bindParam(':id_facturation', $idFacturation, PDO::PARAM_INT);
    $req->execute();
}

//Recuperation de la BDD table facturation (adresse facturation= adresse domicile)
function insertFacturation($adresseFacturation, $cpFacturation, $villeFacturation) {
	$bdd = coBdd();
	$req = $bdd->prepare('
		INSERT INTO facturation (adresse_facturation, cp_facturation, ville_facturation, id_user)
		VALUES (:adresse_facturation, :cp_facturation, :ville_facturation, :id_user)
	');
	$req->bindParam(':adresse_facturation', $adresseFacturation, PDO::PARAM_STR);
	$req->bindParam(':cp_facturation', $cpFacturation, PDO::PARAM_STR);
	$req->bindParam(':ville_facturation', $villeFacturation, PDO::PARAM_STR);
	$req->bindParam(':id_user',  $_SESSION['idUtilisateur'], PDO::PARAM_STR);
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

//fonction pour recuperer le dernier id de facturation
function get_last_id() {
	$bdd = coBdd();
	$req = $bdd->exec('
	SELECT id 
	FROM facturation
	WHERE LAST_INSERT_ID()
	');
	return $req;
}

// recuperer la facturation par son id
function getFacturation($id) {
	$bdd = coBdd();
	$req = $bdd->prepare('
	    SELECT * 
		FROM facturation
		WHERE id ='.$id.'
	');
	$req->execute();
	return $req;
}

// recuperer la facturation par l'utilisateur associé
function getFacturation2() {
	$bdd = coBdd();
	$req = $bdd->prepare('
	    SELECT * 
		FROM facturation
		WHERE id_user ='.$_SESSION['idUtilisateur'].'
	');
	$req->execute();
	return $req;
}

// mise à jour de la facturation
function updateUserFacturation($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		UPDATE utilisateur
		SET id_facturation='.$id.'
		WHERE id = '.$_SESSION['idUtilisateur']);
	$req->execute();
	return $req;
}

// mise à jour de l'utilisateur (a utiliser)
function updateUser() {
	$prenom = htmlspecialchars($_POST["lastName"]);
	$nom = htmlspecialchars($_POST["firstName"]);
	$date =$_POST["date_naiss"];
	$pseudo = htmlspecialchars($_POST["pseudo"]);
	$email = htmlspecialchars($_POST["login"]);
	$mdp = htmlspecialchars($_POST["pwd1"]);
	$bdd = coBdd();
	$req = $bdd->prepare('
		UPDATE utilisateur
		SET (nom ,prenom,date_naiss,pseudo,	mdp,mail)
		VALUES (:nom, :prenom, :date_naiss,:pseudo, :mdp, :mail)
		WHERE id = :id');
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
	$req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
	$req->bindParam(':date_naiss', $date, PDO::PARAM_INT);
	$req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
	$req->bindParam(':mdp', $mdp, PDO::PARAM_STR);
	$req->bindParam(':mail', $email, PDO::PARAM_STR);
	$req->bindParam(':id',  $_SESSION['idUtilisateur'], PDO::PARAM_STR);
	$req->execute();
}

// supprimer le panier
function deleteArticlePanier($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		UPDATE panier
		SET is_deleted = 1
		WHERE id = '.$id.'
	');
	$req->execute();
	return $req;
}

//  le panier
function PanierIsPaid($id) {
	$bdd = coBdd();
	$req = $bdd->query('
		UPDATE panier
		SET is_paid = 1
		WHERE id = ' . $id . '
	');
	$req->execute();
	return $req;
}

function getMdp($mailDemande) {
	$bdd = coBdd();
	$reponse = $bdd->prepare('
		SELECT mdp
		FROM utilisateur
		WHERE mail = ' . $mailDemande .'
	');
	$reponse->execute();
	return $reponse;
}