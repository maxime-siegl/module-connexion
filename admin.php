<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
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
        $bddadmin = mysqli_connect("localhost" , "root" , "" , "moduleconnexion");
        $requeteall = "SELECT * FROM utilisateurs";
        $query = mysqli_query($bddadmin , $requeteall);
        $infoadmin = mysqli_fetch_all($query , MYSQLI_ASSOC);
        
        if(isset($_SESSION['login']))
        {
            if($_SESSION['login'] == 'admin')
            {
        ?>
                <h1>Données des utilisateurs du site</h1>
                <table id="tab">
                    <thead>
                        <?php
                            foreach($infoadmin[0] as $clé => $info)
                            {
                                echo '<th>';
                                echo $clé;
                                echo '</th>';
                            }
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            foreach($infoadmin as $admin)
                            {
                        ?>
                        <tr>
                            <?php
                                foreach($admin as $clé => $info)
                                {
                                    echo '<td>';
                                    echo $info;
                                    echo '</td>';
                                }
                            ?>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
            </table>
        <?php
            }
            else
            {
        ?>
                <span>Vous n'êtes pas admin, retournez à l'accueil</span><br>
                <span>Coin reservé au admin du site</span>
        <?php
            }
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