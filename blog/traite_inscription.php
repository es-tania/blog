<?php 
include('secret.php');

// On récupère tout dans la table utilisateur où login = au login récupéré en GET du formulaire
$requete="SELECT * FROM users WHERE login = '{$_GET["login"]}';";
$stmt=$db -> query($requete);

// On récupère tout dans la table utilisateur où mail = le mail récupéré en GET du formulaire 
$requete2 = "SELECT * FROM users WHERE mail = '{$_GET["mail"]}';";
$stmt2=$db -> query($requete2);

if ($stmt->rowcount()==1){
    // S'il existe déjà un login similaire à celui entrée dans le formulaire on renvoie un message d'erreur à l'utilisateur
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
	header ('Location:inscription.php?err=login');
}elseif($stmt2->rowcount()==1){
    // S'il existe déjà un mail similaire à celui entrée dans le formulaire on renvoie un message d'erreur à l'utilisateur
    $result=$stmt2->fetch(PDO::FETCH_ASSOC);
    header ('Location:inscription.php?err=mail');
}else{
    // Si ni le pseudo ni le mail n'est déjà dans la BDD, on ajoute les infos du formulaire dans la table utilisateur
    $requete = "INSERT INTO users VALUES (NULL,:login,:nom,:prenom,:mail,:mdp)";
    $result=$stmt->fetch(PDO::FETCH_ASSOC);

    $stmt= $db->prepare($requete);
    $stmt->bindParam(':login',$_GET["login"] , PDO::PARAM_STR); 
    $stmt->bindParam(':nom',$_GET["nom"] , PDO::PARAM_STR); 
    $stmt->bindParam(':prenom',$_GET["prenom"] , PDO::PARAM_STR);
    $stmt->bindParam(':mail',$_GET["mail"] , PDO::PARAM_STR);
    
    // On hash le mot de passe
    $hash= password_hash($_GET["pwd"],PASSWORD_DEFAULT);
    $stmt->bindParam(':mdp',$hash , PDO::PARAM_STR); 
    $stmt->execute();
    session_start();
    $_SESSION["login"]=$_GET["login"];
    header ('Location:index.php');
    exit();
}
?>