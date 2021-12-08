<?php
session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete="SELECT * FROM users WHERE login = '{$_GET["login"]}';";
$stmt=$db -> query($requete);

if ($stmt->rowcount()==1){
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
	echo "Ce pseudo existe déjà";
	echo '<br><a href="inscription.php">Revenir à la page d`inscription</a>';

}else{
    $requete = "INSERT INTO users VALUES (NULL,:login,:nom,:prenom,:mail,:mdp,:admin)";

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
    echo '<br><a href="../page_accueil/index.html">afficher les utilisateurs</a>';
}
?>