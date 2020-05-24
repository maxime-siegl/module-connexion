    <h1 class="titre">Bonjour 
        <?php 
            if (isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
            }
            else
            {
                echo 'bel(le) étranger(e)';
            }
        ?> !!
    </h1>
    <nav>
        <ul>
            <li><a href="inscription.php" id="inscription">Inscription</a></li>
            <li><a href="connexion.php" id="connexion">Connexion</a></li>
            <li><a href="profil.php" id="profil">Profil</a></li>
            <li><a href="admin.php" id="admin">Admin</a></li>
        </ul>
    </nav>
