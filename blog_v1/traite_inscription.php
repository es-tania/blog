<?php 
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete="SELECT * FROM users WHERE login = '{$_GET["login"]}';";
$stmt=$db -> query($requete);

$requete2 = "SELECT * FROM users WHERE mail = '{$_GET["mail"]}';";
$stmt2=$db -> query($requete2);

if ($stmt->rowcount()==1){
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
	header ('Location:inscription.php?err=login');
}elseif($stmt2->rowcount()==1){
    $result=$stmt2->fetch(PDO::FETCH_ASSOC);
    header ('Location:inscription.php?err=mail');
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
    session_start();
    $_SESSION["login"]=$_GET["login"];
	$_SESSION["idlogin"] = $result["id_utilisateur"];
    header ('Location:accueil.php');
    exit();
}
?>