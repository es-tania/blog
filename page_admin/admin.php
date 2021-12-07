<?php 
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout billet</title>
    <link rel="stylesheet" href="styles_admin.css">
</head>

<body>
    <form action="traite_billet.php" method="GET">

        <fieldset>
            <legend>Ajouter un billet</legend>

            <p>
                <label class="label" for="Titre">Titre</label>
                <input type="text" id="titre" name="titre">
            </p>
            <p>
                <label class="label" for="date">Date</label>
                <input type="date" id="start" name="date" value="2021-11-22" min="2021-01-01" max="2023-12-31">
            </p>
            <legend>Contenu</legend>

            <textarea rows="5" cols="60" placeholder="De quoi voulez vous parler? " name="contenu"></textarea>

            <p class="center">
                <input type="submit" value="Ajouter">
            </p>
        </fieldset>
    </form>
    <h2>Tous les billets</h2>

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
            <span class="date">'.$row['date_billet'].'</span>
            </div>
            ';
        }
        ?>
    </section>

</body>

</html>