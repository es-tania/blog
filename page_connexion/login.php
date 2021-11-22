<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="traitelogin.php" method="GET">
        <input type="texte" placeholder="Pseudo" name="pseudo">
        <?php 
        if (isset($_GET["err"]) && $_GET["err"]=="pseudo"){
            echo "ATTENTION MAUVAIS PSEUDO";
        }
        ?>
        <input type="text" placeholder="Mot de passe" name="mot_de_passe">
        <?php 
        if (isset($_GET["err"]) && $_GET["err"]=="mot_de_passe"){
            echo "ATTENTION MAUVAIS MOT DE PASSE";
        }
        ?>
        <input type="submit" placeholder="Valider">
    </form>
</body>
</html>