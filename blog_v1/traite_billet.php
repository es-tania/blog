<?php session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete = "INSERT INTO billet VALUES (NULL,:titre,:contenu,NOW(),:idlogin)";

$stmt = $db->prepare($requete);
$stmt->bindParam(':titre',$_GET["titre"] , PDO::PARAM_STR);
$stmt->bindParam(':contenu',$_GET["contenu"] , PDO::PARAM_STR);
$stmt->bindParam(':idlogin',$_SESSION["idlogin"] , PDO::PARAM_STR);

$stmt->execute();

header ('location: accueil.php')
?>

