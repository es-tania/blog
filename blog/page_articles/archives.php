<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles_archives.css">
    <title>Articles</title>
</head>

<body>
    <!-- Menu -->
    <nav>
        <div class="nav-left">
            <a href="../index.php" style="margin-right: 40px;">Accueil</a>
            <strong><a href="#">Articles</a></strong>
        </div>
        <div class="nav-right">
        <?php
                if(!isset($_SESSION["login"])){
                    echo '<a href="../inscription.php">Inscription</a>
                    <a href="../connexion.php" class="connexion">Connexion</a>';
                };
            ?>
            <?php
                if(isset($_SESSION["login"])){
                    echo '<a href="../logout.php" class="connexion">Déconnexion</a>';
                };
            ?>
        </div>
    </nav>

    <main>
        <h1>Articles</h1>

        <!-- Si la session connecter est l'admin, on affiche le formulaire pour ajouter des articles -->

        <?php 
        if(isset($_SESSION["login"]) && $_SESSION["login"]=="Admin"){
            echo '
            <div class="ligne_titre">
                <h2>Ajouter un article</h2>
            </div>

            <form action="traite_billet.php" class="ajoutarticle" method="GET">
                <input type="text" name="titre" id="" placeholder="Titre"><br>
                <textarea name="contenu" id="contenu" cols="30" rows="10" placeholder="Contenu de l`article"></textarea><br>
                <input type="submit" value="Ajouter" class="voirplus">
            </form>
            ';
        }?>

        <div class="ligne_titre">
            <h2>Tous les articles</h2>
        </div>
        <section>
            <!-- On récupère tout les articles qui existent dans la BDD -->
            <?php include('../secret.php');
            $stmt = $db->query("SELECT *, DATE_FORMAT(date_billet, '%d %b %Y') FROM billet ORDER BY id_billet DESC ;");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div>
                <h3>'.$row['titre'].'</h3>
                <div class="contenu_article">
                    <p>'.$row['contenu_billet'].'</p>
                </div>
                <p class="date">Publié le '.$row["DATE_FORMAT(date_billet, '%d %b %Y')"].'</p>
                <form action="article.php">
                    <input type="text" style="display: none;" value="'.$row['titre'].'" name="titre_billet">
                    <input name="billet" style="display:none;" value="'.$row["id_billet"].'">
                    <input type="submit" value="Voir plus" class="voirplus">
                </form>
            </div>
            ';
        }
        ?>
        </section>
    </main>
</body>

</html>