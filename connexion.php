<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav>
        <div class="logo">
            <a href="Accueil.php">VoteMyMusic</a>
        </div>
        <ul class="nav-links">
            <li><a href="Accueil.php">Accueil</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <div class="Titre">
        <h1>CONNECTEZ-VOUS</h1>
    </div>
    <div class="page-connexion">
        <div class="formulaire">
            <form class="login-form" action="traitement2.php" method="post">
                <input type="text" name="nom" placeholder="nom" />
                <input type="password" name="mdp" placeholder="mot de passe" />
                <button type="submit" name="submit">Se connecter</button>
                <p class="message">pas de compte ? <a href="inscription.php">s'inscrire</a></p>
            </form>
        </div>
    </div>
    <footer>
        <ul class="footer-links">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </footer>
</body>

</html>