<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles_accueil.css">
    <link rel="stylesheet" href="assets/styles_inscription.css">
    <style>
        .message_erreur_pseudo,
        .message_erreur_mdp {
            margin: 0;
            color: red;
            font-size: 0.8rem;
            grid-column: 1 / 3;
            text-align: center;
        }
    </style>
    <title>Inscription</title>
</head>

<body>
    <!-- Menu -->
    <nav>
        <div class="nav-left">
            <a href="index.php" style="margin-right: 40px;">Accueil</a>
            <a href="page_articles/archives.php">Articles</a>
        </div>
        <div class="nav-right">
            <strong><a href="#">Inscription</a></strong>
            <a href="connexion.php" class="connexion">Connexion</a>
        </div>
    </nav>

    <!-- Formulaire d'inscription -->
    <main>
        <h1>Inscription</h1>
        <p>Veuillez remplir les champs ci-dessous</p>
        <form action="traite_inscription.php">
            <div class="champs">
                <input type="text" name="nom" id="nom" placeholder="Nom *" required>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom *" required>
                <input type="text" name="login" id="pseudo" placeholder="Pseudo *" required>
                <?php 
                // Un message d'erreur apparaît si le pseudo existe déjà dans la BDD
                if (isset($_GET["err"]) && $_GET["err"]=="login") { 
                    echo '<p class="message_erreur_pseudo">Pseudo déjà utilisé, veuillez en sélectionner un autre</p>';
                }?>
                <input type="email" name="mail" id="email" placeholder="Email *" required>
                <?php 
                // Un message apparaît si l'émail existe déjà dans la BDD
                if (isset($_GET["err"]) && $_GET["err"]=="mail") { 
                    echo '<p class="message_erreur_pseudo">Email déjà utilisé, veuillez en sélectionner un autre</p>';
                }?>
                <input type="password" name="pwd" id="mdp" placeholder="Mot de passe *" required>
            </div>
            <p  style="font-size: 12px;">* Les champs marqués d'un astérisque sont obligatoires</p>
            <div class="finform">
                <p>J'ai déjà un compte - <a href="connexion.php">Me connecter</a></p>
                <input type="submit" value="S'inscrire" class="voirplus">
            </div>
        </form>
    </main>
</body>

</html>