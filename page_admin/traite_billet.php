<?php
session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete= "INSERT INTO billet VALUES (NULL,:titre,:contenu,:date,'1')";

$stmt= $db->prepare($requete);
$stmt->bindParam(':titre',$_GET["titre"] , PDO::PARAM_STR);
$stmt->bindParam(':contenu',$_GET["contenu"] , PDO::PARAM_STR);
$stmt->bindParam(':date',$_GET["date"] , PDO::PARAM_STR);

$stmt->execute();

echo "L'ajout du billet à bien eu lieu<br>";
echo '<br><a href="admin.php">Revenire à la page d`accueil</a>';
?>

