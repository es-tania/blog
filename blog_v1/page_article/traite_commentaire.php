<?php session_start();
$db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', '');

$requete = "INSERT INTO commentaire VALUES (NULL,NOW(),:contenu,:utilisateur,:idbillet)";

$stmt = $db->prepare($requete);
$stmt->bindParam(':contenu',$_GET["contenu"] , PDO::PARAM_STR);
$stmt->bindParam(':utilisateur', $_SESSION["idlogin"] , PDO::PARAM_STR);
$stmt->bindParam(':idbillet',$_GET["idbillet"] , PDO::PARAM_STR);

$stmt->execute();

header ('Location:article.php?billet='.$_GET['idbillet'].' ');
exit();
?>
