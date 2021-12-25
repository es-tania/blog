<?php session_start();
include('../secret.php');

// On insère dans la table billet les infos récupérer du formulaire d'ajout d'article
$requete = "INSERT INTO billet VALUES (NULL,:titre,:contenu,NOW(),:idlogin)";

$stmt = $db->prepare($requete);
$stmt->bindParam(':titre',$_GET["titre"] , PDO::PARAM_STR);
$stmt->bindParam(':contenu',$_GET["contenu"] , PDO::PARAM_STR);
$stmt->bindParam(':idlogin',$_SESSION["idlogin"] , PDO::PARAM_STR);

$stmt->execute();

header ('location: archives.php')
?>

