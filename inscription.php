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
    <h1>INSCRIVEZ-VOUS</h1>
    </div>
        <div class="page-connexion">
            <div class="formulaire">
                <form class="connexion-formulaire" action="traitement.php" method="post">
                    <input type="text" name="nom" placeholder="nom">
                    <input type="text" name="prenom" placeholder="prenom">
                    <input type="email" name="email" placeholder="email">
                    <input type="password" name="mdp" placeholder="mot de passe">
                    <button type="submit" name="submit">S'inscrire</button>
                    
                    <p class="message">déjà inscrit ? <a href="connexion.php">se connecter</a></p>
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

