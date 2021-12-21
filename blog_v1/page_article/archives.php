<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles_archives.css">
    <title>Articles</title>
</head>

<body>
    <h1>Tous les articles</h1>
    <section>
        <?php $db=new PDO('mysql:host=localhost;dbname=prjt_blog;port=3306;charset=utf8', 'root', ''); ?>
        <?php 
            $stmt = $db->query("SELECT * FROM billet;");
            $result = $stmt->fetchall();
            while($row = array_shift($result)){
            echo '
            <div class="billets">
            <h3 class="titre">'.$row['titre'].'</h3>
            <p>'.$row['contenu_billet'].'</p>
            
            <span class="date">'.$row['date_billet'].'</span><br>
            <form action="article.php">
                <input name="billet" style="display:none;" value='.$row["id_billet"].'>
                <input type="submit" value="Voir le billet">
            </form>
            
            </div>
            ';
        }
        ?>
    </section>
    <p class="bouton"><a href="../accueil.php">Revenir à l'accueil</a></p>

    <!-- <p><a href="article.php">Voir le billet</a></p> -->
</body>

</html>