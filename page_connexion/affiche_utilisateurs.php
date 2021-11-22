<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <table BORDER=1>
        <tr>
            <th>Id_personne</th>
            <th>Pseudo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mot de passe</th>
        </tr>

    <?php 
    $db= new PDO('mysql:host=localhost; dbname=prjt_blog; port=3306', 'root', '');

    $requete="SELECT * FROM utilisateur;";
    $stmt=$db->query($requete);
    $tab_utilisateurs=$stmt->fetchall(PDO::FETCH_ASSOC);
    foreach ($tab_utilisateurs as $data){
        echo "<tr>
                <td>{$data["id_utilisateur"]}</td>
                <td>{$data["pseudo"]}</td>
                <td>{$data["nom"]}</td>
                <td>{$data["prenom"]}</td>
                <td>{$data["mot_de_passe"]}</td>
              </tr>\n";
    }
    ?>
    </table>
    
</body>

</html>