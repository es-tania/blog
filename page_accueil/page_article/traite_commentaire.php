<?php
session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$stmt = $db->prepare("INSERT INTO commentaire VALUES (NULL,:date,:contenu,:utilisateur,:idbillet)");

$stmt->bindParam(':date', $_GET["date"] , PDO::PARAM_STR); 
$stmt->bindParam(':contenu', $_GET["contenu"] , PDO::PARAM_STR); 
$stmt->bindParam(':utilisateur', $_GET["utilisateur"] , PDO::PARAM_STR);
$stmt->bindParam(':idbillet"', $_GET["idbillet"] , PDO::PARAM_STR);

$stmt->execute();

// header ('Location:../accueil.php');

?>