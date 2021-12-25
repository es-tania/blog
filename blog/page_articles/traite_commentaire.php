<?php session_start();
include('../secret.php');

// On insère dans la table commentaire les infos récupérer du formulaire d'ajout de commentaire
$requete = "INSERT INTO commentaire VALUES (NULL,NOW(),:contenu,:utilisateur,:idbillet)";

$stmt = $db->prepare($requete);
$stmt->bindParam(':contenu',$_GET["contenu"] , PDO::PARAM_STR);
$stmt->bindParam(':utilisateur', $_SESSION["idlogin"] , PDO::PARAM_STR);
$stmt->bindParam(':idbillet',$_GET["idbillet"] , PDO::PARAM_STR);

$stmt->execute();

header ('Location:article.php?billet='.$_GET['idbillet'].'&titre_billet='.$_GET['titre_billet'].'');
exit();
?>
