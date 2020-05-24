  
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
    <title>Profil</title>
    <link rel="stylesheet" href="moduleconnexion.css">
</head>
<body>
    <header>
        <?php
            include('include/header.php');
        ?>
    </header>
    <main>
    <?php                    
        if(isset($_SESSION['login']))
        {                       
            $bdd = mysqli_connect("localhost" , "root" , "" , "moduleconnexion");
            $infodulog = "SELECT * FROM utilisateurs WHERE login = '$_SESSION[login]'";
            $recupinfo = mysqli_query($bdd , $infodulog);
            $utilisateurinfo = mysqli_fetch_all($recupinfo, MYSQLI_ASSOC);

            if(isset($_POST['modifier']) AND !empty($_POST['login']) AND !empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['mdpactuel']))
            {  
                if(password_verify($_POST['mdpactuel'], $_SESSION['password']))
                {
                    $login = $_POST['login'];
                    $prenom = $_POST['prenom'];
                    $nom = $_POST['nom'];
                    $id = $_SESSION['id'];
                    $logverif ="SELECT COUNT(*) AS num FROM utilisateurs WHERE login='$login'";
                    $queryverif = mysqli_query($bdd , $logverif);
                    $loginfo = mysqli_fetch_all($queryverif, MYSQLI_ASSOC);
                    
                    if($loginfo[0]['num'] == 0 OR $login == $_SESSION['login'])                        
                    {
                        $update = "UPDATE utilisateurs SET login='$login' , prenom='$prenom' , nom='$nom' WHERE id='$id'";
                        $query = mysqli_query($bdd , $update); 
                        $_SESSION['login'] = $_POST['login'];
                        $_SESSION['message'] = 'Modif acceptée(s).';
                    }
                    else
                    {
                        $_SESSION['message'] =  "Login existant";
                    }        
                    
                    if(isset($_POST["mdpnouveau"]) AND !empty($_POST["mdpnouveau"]))
                    {
                        if($_POST["mdpnouveau"] == $_POST["confmdp"])
                        {   
                            $mdpupdate = password_hash($_POST["mdpnouveau"], PASSWORD_DEFAULT);
                            $reqmdpup = "UPDATE utilisateurs SET password = '$mdpupdate' WHERE id = '$id'";
                            $querymdp = mysqli_query($bdd , $reqmdpup);
                        }
                        else
                        {
                            $_SESSION["message"] = "Les mots de passes ne correspondent pas.";
                        }                   
                    }     
                    header("Location:profil.php");                           
                }
                else    
                {
                    $_SESSION["message"] = "Erreur mot de passe.";
                }
            }
            if($_SESSION["login"] == "admin")
            {
    ?>

    <h2><a href="admin.php">Admin</a></h2>
    
    <?php
            }
    ?>
    <h1>Modification de vos informations</h1>
    <form action="profil.php" method="POST" class="formulaire">
        <p>
            <label for="login">Votre Login:</label>
            <input type="text" name="login" id="login" value="<?php echo $utilisateurinfo[0]['login'] ?>" required>
        </p>
        <p>
            <label for="prenom">Votre Prénom:</label>
            <input type="text" name="prenom" id="prenom" value="<?php echo $utilisateurinfo[0]['prenom'] ?>" required>
        </p>
        <p>
            <label for="nom">Votre Nom:</label>
            <input type="text" name="nom" id="nom" value="<?php echo $utilisateurinfo[0]['nom'] ?>" required>
        </p>
            <p>
            <label for="mdpactuel">Mot de Passe actuel:</label>
            <input type="password" name="mdpactuel" id="mdpactuel" required>
        </p>
        <p>
            <label for="mdpnouveau">Nouveau Mot de Passe:</label>
            <input type="password" name="mdpnouveau" id="mdpnouveau">
        </p>
        <p>
            <label for="confmdp">Confirmation du Nouveau Mot de Passe:</label>
            <input type="password" name="confmdp" id="confmdp">
        </p>
        <p>
            <input type="submit" name="modifier" value="Modifier">
        </p>
    </form>
    <?php 
        }
        if(isset($_SESSION["message"]))
        {
            echo $_SESSION['message'];
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