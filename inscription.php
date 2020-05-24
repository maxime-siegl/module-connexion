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
    <title>Inscription</title>
    <link rel="stylesheet" href="moduleconnexion.css">
</head>
<body>
    <header>
        <?php
            include('include/header.php');
        ?>
    </header>
    <main>
        <form action="inscription.php" method="POST" class="formulaire">
            <p>
                <label for="login">Votre Login</label>
                <input type="text" name="login" id="login" required>
            </p>
            <p>
                <label for="prenom">Votre Prénom</label>
                <input type="text" name="prenom" id="prenom" required>
            </p>
            <p>
                <label for="nom">Votre Nom</label>
                <input type="text" name="nom" id="nom" required>
            </p>
            <p>
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <label for="confmdp">Confirmation de Mot de Passe:</label>
                <input type="password" name="confmdp" id="confmdp" required>
            </p>
            <p>
                <button type="submit" name="connexion">Se Connecter</button>
            </p>
        </form>
        <?php
            $bdd = mysqli_connect("localhost", "root", "", "moduleconnexion"); // connexion bdd
            
            if (isset($_POST['connexion']))
            {
                $login = $_POST['login'];
                $prenom = $_POST['prenom'];
                $nom = $_POST['nom'];
                $mdp = $_POST['password'];

                $logincheck = "SELECT login FROM utilisateurs WHERE login = '$login'";
                $check = mysqli_query($bdd , $logincheck);
                $verificationlogin = mysqli_fetch_all($check);

                if (empty($verificationlogin))
                {
                    if ($_POST['password'] == $_POST['confmdp'])
                    {
                        $mdpcrypt = password_hash($mdp, PASSWORD_BCRYPT);
                        $requete = 'INSERT INTO utilisateurs VALUES (null, "'.$login.'", "'.$prenom.'", "'.$nom.'", "'.$mdpcrypt.'")';
                        $ajout = mysqli_query($bdd, $requete);
                        header('location:connexion.php');
                    }
                    else
                    {
                        echo 'La confirmation du mot de passe est differente du mot de passe que vous avez rentré.';
                    }
                }
                else
                {
                    echo 'Login pas disponible pour le moment, changez de login';
                }
            }
            mysqli_close($bdd);
        ?>
    </main>
    <footer>
        <?php
            include('include/footer.php');
        ?>
    </footer>
</body>
</html>