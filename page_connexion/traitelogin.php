<?php 
$db= new PDO('mysql:host=localhost; dbname=prjt_blog; port=3306', 'root', '');
$db->query('SET NAMES utf8');

$requete="SELECT * FROM utilisateur WHERE pseudo=:pseudo";
$stmt=$db->prepare($requete);
$stmt->bindParam(':pseudo', $_GET["pseudo"], PDO::PARAM_STR);
$stmt->execute();

if($stmt->rowcount()==1){
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
    if(password_verify($_GET["mot_de_passe"], $utilisateur["mot_de_passe"])){
        // echo "super vous êtes connecté";
        echo "<table BORDER=1>
        <tr>
            <th>Id_personne</th>
            <th>Pseudo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mot de passe</th>
        </tr>
        <tr>
            <td>{$utilisateur["id_utilisateur"]}</td>
            <td>{$utilisateur["pseudo"]}</td>
            <td>{$utilisateur["nom"]}</td>
            <td>{$utilisateur["prenom"]}</td>
            <td>{$utilisateur["mot_de_passe"]}</td>
        </tr>\n
        </table>";
        $_SESSION["pseudo"] = $_GET["pseudo"];
        $_SESSION["nom"] = $utilisateur["nom"];
        echo '<br><a href="affiche_utilisateurs.php">Afficher les utilisateurs</a>';
    }else{
        $_SESSION=array();
        header('location:login.php?err=mdp');
        // echo "mauvais mot de passe";
    }
}
else{
    $_SESSION=array();
    header('location:pseudo.php?err=pseudo');
    // echo "erreur login";
}
?>