<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        .message_erreur_pseudo,
        .message_erreur_mdp {
            margin: 0;
            color: red;
            font-size: 0.8rem;
            /* width:100%; */
            grid-column: 1 / 3;
            text-align: center;
        }
    </style>
    <link rel="stylesheet" href="styles-inscription.css">
</head>

<body>

    <form action="traite_inscription.php">
        <fieldset>
            <legend>Formulaire d'inscription</legend>

            <p>Les champs marqués de l'astérisque rouge sont obligatoires.</p>
            <p>
                <label class="label" for="pseudo">Pseudo<span class="obligatoire">*</span>
                </label>
                <input type="text" id="pseudo" name="login" required>
                <?php if (isset($_GET["err"]) && $_GET["err"]=="login") { echo '<p class="message_erreur_pseudo">Pseudo déjà utilisé, veuillez en sélectionner un autre</p>';} ?>
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
                <?php if (isset($_GET["err"]) && $_GET["err"]=="mail") { echo '<p class="message_erreur_pseudo">Email déjà utilisé, veuillez en sélectionner un autre</p>';} ?>
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
            <p>J'ai déjà un compte - <a href="connexion.php">M'inscrire</a></p>
        </fieldset>
    </form>
</body>

</html>