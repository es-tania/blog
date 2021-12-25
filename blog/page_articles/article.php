<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles_archives.css">
    <link rel="stylesheet" href="assets/styles_articles.css">
    <!-- On récupère le titre de l'article pour l'afficher en titre -->
    <title><?php echo $_GET["titre_billet"];?></title>
</head>

<body>
    <!-- Menu -->
    <nav>
        <div class="nav-left">
            <a href="../index.php" style="margin-right: 40px;">Accueil</a>
            <strong><a href="archives.php">Articles</a></strong>
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
        <?php include('../secret.php');
        // On récupère l'article dans la table billet où l'id de celui-ci est égale à l'id récupéré lors du clique sur le 'voir plus' de l'article sélectionné. Puis on affiche les infos
        $requete = "SELECT *, DATE_FORMAT(date_billet, '%d %b %Y') FROM billet WHERE id_billet = :id";
        $stmt = $db->prepare($requete);
        $stmt->bindValue(':id', $_GET["billet"], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        echo '
        <h1>'.$result["titre"].'</h1>

        <p style="text-indent: 50px;">'.$result["contenu_billet"].'</p>

        <p class="date">Publié le '.$result["DATE_FORMAT(date_billet, '%d %b %Y')"].'</p>
        ';
        ?>

        <div href="" class="affichecom">
            <p>Afficher les commentaires</p>
            <img src="assets/image/down-arrow.png" alt="">
        </div>

        <div class="commentaires">
            <div class="ligne_titre">
                <h2>Commentaires</h2>
            </div>
            <!-- On affiche tout les commentaires relier à l'article sélectionner -->
            <?php 
            $stmt = $db->query("SELECT *, DATE_FORMAT(date_commentaire, '%d %b %Y') FROM commentaire, billet, users WHERE commentaire.ext_billet = billet.id_billet AND users.id_utilisateur = commentaire.ext_utilisateur AND id_billet = ".$_GET["billet"]."");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div class="com">
            <p><strong>'.$row['login'].'</strong> - <span style="font-size:0.8rem">'.$row["DATE_FORMAT(date_commentaire, '%d %b %Y')"].'</span></p>
            <p style="font-size:0.8rem">'.$row['contenu_commentaire'].'</p>
            </div>
            ';
            };
            ?>
            <!-- S'il y a une session on affiche le formulaire pour ajouter un commentaire -->
            <?php 
                if(isset($_SESSION["login"])){
                echo '
                <h4>Ajouter un commentaire</h4>
                <form action="traite_commentaire.php" class="ajoutarticle" method="GET">
                    <input type="text" style="display:none;" value="'.$_GET['billet'].'" name="idbillet">
                    <input type="text" style="display:none;" value="'.$_GET['titre_billet'].'" name="titre_billet">
                    <textarea name="contenu" cols="30" rows="5" placeholder="Exprimé votre pensé"></textarea><br>
                    <input type="submit" value="Publier" class="voirplus">
                </form>
                ';
                };
            ?>

            <!-- S'il n'y a pas de session on affiche un message pour s'inscrire si on veut poster un commentaire -->
            <?php 
                if(!isset($_SESSION["login"])){
                echo '
                <h4>Inscrivez ou connectez-vous pour laisser un commentaire.</h4>
                ';
                };
            ?>

            
        </div>
    </main>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Au clique sur le bouton 'afficher les commentaires', ils s'affichent. Si on reclique ils se cachent -->
    <script>
        $('.commentaires').hide();
        $('.affichecom').click(function () {
            $('.commentaires').toggle();
        });
    </script>
</body>

</html>