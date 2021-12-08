<?php
session_start();

$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');
$db->query('SET NAMES utf8');

// requete non préparée :
//$requete="SELECT * FROM users WHERE login='".$_GET["login"]."'";
//$stmt=$db->query($requete);

// requete préparée :
$requete="SELECT * FROM users WHERE login=:login";
$stmt=$db->prepare($requete);
$stmt->bindParam(':login',$_GET["login"], PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowcount()==1){
	$result=$stmt->fetch(PDO::FETCH_ASSOC);
	if (password_verify($_GET["pwd"],$result["passwd"])){
		// echo "SUPER !!! vous etes connecté";
		$_SESSION["login"]=$_GET["login"];
		// echo '<br><a href="../page_accueil/index.html">Aller à la page d`accueil</a>';
		header ('Location:../page_accueil/index.html');
	} else {
		// echo $_GET["pwd"];
		header ('Location:connexion.php?err=mdp');
	}

} else {
	header ('Location:connexion.php?err=login');
}