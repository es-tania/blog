<?php 
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="styles_connexion.css">
</head>

<body>

    <?php	if (isset($_SESSION["login"]))
{ 
echo "Bonjour {$_SESSION["login"]}<BR>"; 
}


?>

    <form action="traite_login.php">

        <fieldset>
            <legend>Connexion</legend>

            <p>Les champs marqués de l'astérisque rouge sont obligatoires.</p>
            <p>
                <label class="label" for="pseudo">Pseudo<span class="obligatoire">*</span></label>
                <input type="text" id="pseudo" name="login" required>
            </p>
            <?php 
	            if (isset($_GET["err"]) && $_GET["err"]=="login") { echo "ATTENTION MAUVAIS LOGIN";}
		    ?>
            <p>
                <label class="label" for="pwd">Mot de passe<span class="obligatoire">*</span></label>
                <input type="password" id="pwd" name="pwd" required>
            </p>
            <?php 
	            if (isset($_GET["err"]) && $_GET["err"]=="mdp") { echo "ATTENTION MAUVAIS MOT DE PASSE";}
		    ?>
            <p class="center">
                <input type="submit" value="Se connecter">
            </p>
            <p>Je n'ai pas de compte - <a href="../page_inscription/inscription.php">M'inscrire</a></p>
        </fieldset>
    </form>

</body>

</html>