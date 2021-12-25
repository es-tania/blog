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
        main{
            width: 30%;
        }

        main h1{
            margin-bottom: 20px;
        }

        form .voirplus{
            width: 55%;
        }

        .champs{
            margin-bottom: 10px;
        }

        .message_erreur_pseudo,
        .message_erreur_mdp {
            margin: 0;
            color: red;
            font-size: 0.8rem;
            grid-column: 1 / 3;
            text-align: center;
        }
    </style>
    <title>Connexion</title>
</head>

<body>
    <!-- Menu -->
    <nav>
        <div class="nav-left">
            <a href="index.php" style="margin-right: 40px;">Accueil</a>
            <a href="page_articles/archives.php">Articles</a>
        </div>
        <div class="nav-right">
            <a href="inscription.php">Inscription</a>
            <strong><a href="#" class="connexion">Connexion</a></strong>
        </div>
    </nav>

    <!-- Formulaire de connexion -->
    <main>
        <h1>Connexion</h1>
        <form action="traite_login.php">
            <div class="champs">
                <input type="text" name="login" id="pseudo" placeholder="Pseudo *">
                <?php 
	            if (isset($_GET["err"]) && $_GET["err"]=="login") { 
                    echo '<p class="message_erreur_pseudo">Pseudo incorrecte</p>';
                }
		        ?>
                <input type="password" name="pwd" id="mdp" placeholder="Mot de passe *">
                <?php 
	            if (isset($_GET["err"]) && $_GET["err"]=="mdp") { 
                    echo '<p class="message_erreur_pseudo">Mot de passe incorrecte</p>';
                }
		        ?>
            </div>
            <div class="finform">
                <p>Je n'ai pas de compte - <a href="inscription.php">M'inscrire</a></p>
                <input type="submit" value="Se connecter" class="voirplus">
            </div>
        </form>
    </main>
</body>

</html>