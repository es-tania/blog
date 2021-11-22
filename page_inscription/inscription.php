<?php session_start();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="styles-inscription.css">
</head>

<body>

    <?php   if (isset($_SESSION["login"])) {
            echo "Bonjour {$_SESSION["login"]}<BR>";
        }

?>

    <form action="traite_inscription.php">
        <fieldset>
            <legend>Formulaire d'inscription</legend>

            <p>Les champs marqués de l'astérisque rouge sont obligatoires.</p>
            <p>
                <label class="label" for="pseudo">Pseudo<span class="obligatoire">*</span>
                </label>
                <input type="text" id="pseudo" name="login" required>
            </p>
            <p>
                <label class="label" for="contact_nom">Nom<span class="obligatoire">*</span>
                </label>
                <input id="contact_nom" type="text" name="nom" required>
            </p>
            <p>
                <label class="label" for="contact_prenom">Prénom<span class="obligatoire">*</span>
                </label>
                <input id="contact_prenom" type="text" name="prenom" required>
            </p>
            <p>
                <label class="label" for="email">Email<span class="obligatoire">*</span>
                </label>
                <input id="email" type="email" name="mail" required>
            </p>
            <p>
                <input type="text" name="admin" required style="display: none;" value="non">
            </p>
            <p>
                <label class="label" for="pwd">Mot de passe<span class="obligatoire">*</span>
                </label>
                <input type="password" id="pwd" name="pwd" required>
            </p>
            <p class="center">
                <input type="submit" value="S'inscrire">
            </p>
        </fieldset>
    </form>
</body>

</html>