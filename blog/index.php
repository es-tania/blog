<?php session_start(); 
    // On initialise la bdd
    include('secret.php');
    // Code pour récupérer l'id de l'utilisateur est l'enregistrer dans une variable de session
    if(isset($_SESSION["login"])){
        $requete="SELECT * FROM users WHERE login = '".$_SESSION['login']."';";
        $stmt=$db->prepare($requete);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
	    $_SESSION["idlogin"] = $result["id_utilisateur"];
    };
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles_accueil.css">
    <link rel="stylesheet" href="assets/fonts.css">
    <title>Accueil</title>
</head>

<body>
    <!-- Menu -->
    <nav>
        <div class="nav-left">
            <strong><a href="#" style="margin-right: 40px;">Accueil</a></strong>
            <a href="page_articles/archives.php">Articles</a>
        </div>
        
        <div class="nav-right">
            <?php
                // S'il n'y a pas de session le bouton inscription est connexion apparaît
                if(!isset($_SESSION["login"])){
                    echo '<a href="inscription.php">Inscription</a>
                    <a href="connexion.php" class="connexion">Connexion</a>';
                };
            ?>
            <?php
                // S'il y a une session le bouton déconnexion apparaît
                if(isset($_SESSION["login"])){
                    echo '<a href="logout.php" class="connexion">Déconnexion</a>';
                };
            ?>
        </div>
    </nav>

    <main>
        <?php
            if(!isset($_SESSION["login"])){
                echo '<h1>Accueil</h1>';
            };
        ?>
        <!-- S'il y a une session un message pour l'utilisateur apparaît -->
        <?php
            if(isset($_SESSION["login"])){
                echo '<h1>Bonjour '.$_SESSION["login"].' !</h1>';
            };
        ?>

        <div class="ligne_titre">
            <h2>Derniers articles</h2>
        </div>

        <section>
            <?php 
            // Code pour récpérer les 3 derniers articles ajoutés à la BDD
            $stmt = $db->query("SELECT *, DATE_FORMAT(date_billet, '%d %b %Y') FROM billet ORDER BY id_billet DESC LIMIT 3;");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div>
                <h3>'.$row['titre'].'</h3>
                <div class="contenu_article">
                    <p>'.$row['contenu_billet'].'</p>
                </div>
                <p class="date">Publié le '.$row["DATE_FORMAT(date_billet, '%d %b %Y')"].'</p>
                <form action="page_articles/article.php">
                    <input type="text" style="display: none;" value="'.$row['titre'].'" name="titre_billet">
                    <input name="billet" style="display:none;" value="'.$row["id_billet"].'">
                    <input type="submit" value="Voir plus" class="voirplus">
                </form>
            </div>
            ';
            }
            ?>
        </section>
        <a href="page_articles/archives.php" class="decouvrirplus">Découvrir plus d'articles</a>
    </main>
</body>

</html>