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
    <title>Connexion</title>
    <link rel="stylesheet" href="moduleconnexion.css">
</head>
<body>
    <header>
        <?php
            include('include/header.php');
        ?>
    </header>
    <main>
        <form action="connexion.php" method="POST" class="formulaire">
            <p>
                <label for="login">Login:</label>
                <input type="text" name="login" id="login" required>
            </p>
            <p>
                <label for="password">Mot de Passe:</label>
                <input type="password" name="password" id="password" required>
            </p>
            <p>
                <button type="submit" name="connexion" id="connexion">Connexion</button>
            </p>
        </form>
        <?php
            if (isset($_POST['connexion']))
            {
                $login = $_POST['login'];
                $mdp = $_POST['password'];

                $bddco = mysqli_connect("localhost", "root", "", "moduleconnexion"); //connexion a la bdd via connexion
                $mdpdulog = "SELECT * FROM utilisateurs WHERE login = '$login'";
                $recupmdp = mysqli_query($bddco , $mdpdulog);
                $resultat_mdp = mysqli_fetch_all($recupmdp, MYSQLI_ASSOC);

                $var = $resultat_mdp[0]['password'];
                echo $var;
                if (!empty($resultat_mdp))
                {
                    if (password_verify($mdp, $var))
                    {
                        session_start();
                        $_SESSION['login'] = $resultat_mdp[0]['login'];
                        $_SESSION['password'] = $resultat_mdp[0]['password'];
                        $_SESSION['id'] = $resultat_mdp[0]['id'];
                        header('location:index.php');
                    }
                    else
                    {
        ?>
                        <span>Le mot de passe ne corespond pas au login rentré</span>
        <?php
                    }
                }
                else
                {
        ?>
                    <span>Login innexistant</span>
        <?php
                }
                mysqli_close($bddco);
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