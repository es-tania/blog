<?php session_start()?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_article.css">
    <title>Article</title>
</head>

<body>

    <?php $db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', ''); ?>
    <?php 
        $requete = "SELECT * FROM billet WHERE id_billet = :id";
        $stmt = $db->prepare($requete);
        $stmt->bindValue(':id', $_GET["billet"], PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo ($result["id_billet"])
        echo '
        <div class="article">
            <h2>'.$result["titre"].' - '.$result["date_billet"].' </h2>
            <p>'.$result["contenu_billet"].'</p>
        </div>'
    ?>

    <p><a href="">Afficher commentaires</a></p>

    <?php 
            $stmt = $db->query("SELECT * FROM commentaire, billet, users WHERE commentaire.ext_billet = billet.id_billet AND users.id_utilisateur = commentaire.ext_utilisateur AND id_billet = ".$_GET["billet"]."");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div class="commentaire">
                <h3>'.$row['login'].' - '.$row['date_commentaire'].' </h3>
                <p>'.$row['contenu_commentaire'].'</p>
            </div>
            ';
        }
        ?>

    <?php 
    if(isset($_SESSION["login"])){
    ?>
        <form action="traite_commentaire.php" method="GET">

        <fieldset>
            <legend>Ajouter commentaire</legend>

            <p>
                <input type="text" style="display:none;" value="1" name="utilisateur">
            
                <input type="text" style="display:none;" value="$_GET['billet']" name="idbillet">
            </p>
            
            <p>
                <label class="label" for="date">Date</label>
                <input type="date" name="date" min="2021-01-01" max="2023-12-31">
            </p>
            <legend>Commentaire</legend>

            <textarea rows="5" cols="60" placeholder="De quoi voulez vous parler" name="contenu"></textarea>

            <p class="center">
                <input type="submit" value="Ajouter">
            </p>
        </fieldset>
    </form>
    <?php }?>

    

    

    <p class="bouton"><a href="../accueil.php">Revenir à l'accueil</a></p>



    <!-- <h1>Blog</h1> -->
    <!-- <div class="article">
        <h2>Titre - Date </h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident doloribus, minus ipsa nostrum rerum placeat quasi quod ad inventore suscipit ipsam, neque eius quo itaque beatae aliquid ea sit aliquam.</p>
    </div>
    <p><a href="">Afficher commentaires</a> </p>
    <h2>Commentaires</h2>
    <div class="commentaire">
        <h3>Pseudo - Date </h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident doloribus, minus ipsa nostrum rerum placeat quasi quod ad inventore suscipit ipsam, neque eius quo itaque beatae aliquid ea sit aliquam.</p>
    </div>
    <div class="commentaire">
        <h3>Pseudo - Date </h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident doloribus, minus ipsa nostrum rerum placeat quasi quod ad inventore suscipit ipsam, neque eius quo itaque beatae aliquid ea sit aliquam.</p>
    </div>
    
    <form action="#" method="">

        <fieldset>
            <legend>Ajouter commentaire</legend>
            <p>
                <label class="label" for="pseudo">Pseudo<span class="obligatoire">*</span></label>
                <input type="text" id="pseudo" required>
            </p>
            <p>
                <label class="label" for="date">Date</label>
                <input type="date" id="start" name="trip-start" value="2021-11-22" min="2021-01-01" max="2023-12-31">
            </p>
            <legend>Commentaire</legend>

            <textarea rows="5" cols="60" placeholder="De quoi voulez vous parler?"></textarea>

            <p class="center">
                <input type="submit" value="Ajouter">
            </p>
        </fieldset>
    </form> -->
</body>

</html>