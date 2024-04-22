<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    // Démarrer la session
    session_start();
    ?>
    <nav>
        <div class="logo">
            <a href="Accueil.php">VoteMyMusic</a>
        </div>
        <ul class="nav-links">
            <li><a href="Accueil.php">Accueil</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
        <!-- Si l'utilisateur est connecté, afficher le bouton de déconnexion -->
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a class="btn" href="deconnexion.php">Déconnexion</a>
        <?php else : ?>
            <!-- Sinon, afficher le lien de connexion -->
            <a class="btn" href="connexion.php">Connexion</a>
        <?php endif; ?>
    </nav>
    <header>
        <h1>Bienvenue</h1>
    </header>
    <main class="main">
        <div class="message-box">
            <p>Bienvenue sur VoteMyMusic ! Ce site est fier d'être en partenariat avec CVVEN.
                Ici, vous avez la possibilité de voter, proposer et soutenir des musiques lors des spectacles organisés sur le site de vacances.
                Nous sommes ravis de vous accueillir dans notre communauté passionnée de musique, où votre voix compte et contribue à façonner les expériences musicales inoubliables.
                Que la musique vous accompagne dans chaque moment de votre séjour avec nous !</p>
        </div>
        <a href="musique.php" class="btn2">Poursuivre</a>
    </main>
    <footer>
        <ul class="footer-links">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">À propos</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </footer>
</body>
</html>