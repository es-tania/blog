<?php
include('secret.php');
$db->query('SET NAMES utf8');

// On récupère tout de la table utilisateur où login = login récupéré en GET du formulaire
$requete="SELECT * FROM users WHERE login=:login";
$stmt=$db->prepare($requete);
$stmt->bindParam(':login',$_GET["login"], PDO::PARAM_STR);
$stmt->execute();

// Si le login de l'utilisateur est bien dans la BDD on vérifie le mot de passe
if ($stmt->rowcount()==1){
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	// S'il existe la connexion est réussis sinon on renvoi un message d'erreur
	if (password_verify($_GET["pwd"],$result["passwd"])){
		session_start();
		$_SESSION["login"]=$_GET["login"];
		$_SESSION["idlogin"] = $result["id_utilisateur"];
		header ('location:index.php');
	} else {
		header ('location:connexion.php?err=mdp');
	}

// Si le login de l'utilisateur n'existe pas on renvoie un message d'erreur
} else {
	header ('location:connexion.php?err=login');
}
?>