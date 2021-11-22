<?php
session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete= "INSERT INTO users VALUES (NULL,:login,:nom,:prenom,:mail,:mdp,:admin)";

$stmt= $db->prepare($requete);
$stmt->bindParam(':login',$_GET["login"] , PDO::PARAM_STR); 
$stmt->bindParam(':nom',$_GET["nom"] , PDO::PARAM_STR); 
$stmt->bindParam(':prenom',$_GET["prenom"] , PDO::PARAM_STR);
$stmt->bindParam(':mail',$_GET["mail"] , PDO::PARAM_STR);
$stmt->bindParam(':admin',$_GET["admin"] , PDO::PARAM_STR);

$hash= password_hash($_GET["pwd"],PASSWORD_DEFAULT);
$stmt->bindParam(':mdp',$hash , PDO::PARAM_STR); 
$stmt->execute();
echo "L inscription s'est bien deroulee<br>";
echo '<br><a href="affiche_utilisateurs.php">afficher les utilisateurs</a>';

?>