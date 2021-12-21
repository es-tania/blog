<?php
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');
$db->query('SET NAMES utf8');

$requete="SELECT * FROM users WHERE login=:login";
$stmt=$db->prepare($requete);
$stmt->bindParam(':login',$_GET["login"], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowcount()==1){
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	if (password_verify($_GET["pwd"],$result["passwd"])){
		session_start();
		$_SESSION["login"]=$_GET["login"];
		$_SESSION["idlogin"] = $result["id_utilisateur"];
		header ('location:accueil.php');
		// header ('Location:page_article/article.php?billet=1');
	} else {
		// echo $_GET["pwd"];
		header ('location:connexion.php?err=mdp');
	}

} else {
	header ('location:connexion.php?err=login');
}
?>