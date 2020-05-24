<?php 
    session_start();
    if(isset($_POST["deco"]))
    {
        session_destroy();
        header('Location:index.php');
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="moduleconnexion.css">
</head>
<body>
    <header>
        <?php
            include('include/header.php');
        ?>
    </header>
    <main>
        <section class="main">
            <h1>Rejoignez-nous!</h1>
            <p><a href="inscription.php">Inscrivez-vous</a> si ce n'est pas déjà fait.
                <br> 
                Nous vous attendions.
                <br>
                Sinon <a href="connexion.php">connectez-vous</a> et on se fera un plaisir de partir avec vous.
            </p>
            </section>
            <?php
            if(isset($_SESSION['login']))
            {
            ?>
            <form action="index.php" method="POST"> 
            <input type="submit" value="Déconnexion" name="deco" id="deco">
            </form>
            <?php
            }
            ?>
    </main>
    <footer>
        <?php
            include('include/footer.php');
        ?>
    </footer>
</body>
</html>