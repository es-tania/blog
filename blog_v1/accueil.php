<?php 
session_start(); ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="styles_admin.css">
    <title>Accueil</title>
</head>

<body>
    <div class="entete">
    <h1>Blog</h1>
        <?php
        if(!isset($_SESSION["login"])){
            echo '<a href="connexion.php">Me connecter </a>';
        };?>
        <?php
        if(isset($_SESSION["login"])){
            echo '<a href="logout.php">
            Déconnexion</a>';
        };
        ?>
        
    </div>

    <h2>Les 3 derniers articles </h2>
    <section>
        <?php $db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', ''); ?>
        <?php 
            $stmt = $db->query("SELECT * FROM billet ORDER BY id_billet DESC LIMIT 3;");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div class="billets">
            <h3 class="titre">'.$row['titre'].'</h3>
            <p>'.$row['contenu_billet'].'</p>
            <span class="date">'.$row['date_billet'].'</span><br>
            <form action="page_article/article.php">
                <input name="billet" style="display:none;" value='.$row["id_billet"].'>
                <input type="submit" value="Voir le billet">
            </form>
            </div>
            ';
        }
        ?>
    </section>    

    <p class="archive">
        <a href="page_article/archives.php"> Archives </a>
    </p>

    <?php 
    if(isset($_SESSION["login"]) && $_SESSION["login"]=="Admin"){
        echo '<form action="traite_billet.php" method="GET">

        <fieldset>
            <legend>Ajouter un billet</legend>

            <p>
                <label class="label" for="Titre">Titre</label>
                <input type="text" id="titre" name="titre">
            </p>

            <legend>Contenu</legend>

            <textarea rows="5" cols="60" placeholder="De quoi voulez vous parler? " name="contenu"></textarea>

            <p class="center">
                <input type="submit" value="Ajouter">
            </p>
        </fieldset>
    </form>';
    }?>
    
</body>

</html>