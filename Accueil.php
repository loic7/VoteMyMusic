<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['connected'])) {
    $musiqueLink = 'musique.php';
} else {
    $musiqueLink = 'connexion.php';
}
?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VoteMyMusic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="Accueil.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $musiqueLink; ?>">Ajouter & Voter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Doc.php">Doc</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ml-auto"> <!-- Utilisation de ml-auto pour aligner à droite -->
                <li class="nav-item">
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <a  href="deconnexion.php" type="button" class="btn btn-warning">Déconnexion</a>
                    <?php else : ?>
                        <!-- Sinon, afficher le lien de connexion -->
                        <a href="connexion.php" type="button" class="btn btn-warning">Connexion</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="jumbotron text-center">
            <h1 class="display-4">Bienvenue sur VoteMyMusic</h1>
            <p class="lead">Nous sommes ravis de vous annoncer notre partenariat avec CVVEN. VoteMyMusic vous offre désormais la possibilité d'ajouter et de voter pour vos musiques préférées.
                Ces dernières seront diffusées sur leur site de vacances pendant les activités, les concerts et bien plus encore.
                Rejoignez-nous dans cette expérience musicale unique et contribuez à créer une ambiance personnalisée pour vos vacances idéales. Vos choix musicaux comptent, alors n'hésitez pas à participer !</p>
            <hr class="my-4">
            <p>Cliquez sur le bouton ci-dessous pour en savoir plus.</p>
            <a class="btn btn-warning btn-lg d-inline-block mx-auto" href="<?php echo $musiqueLink; ?>" role="button">En savoir plus</a>
        </div>
    </div>
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 VoteMyMusic. Tous droits réservés.</span>
        </div>
    </footer>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>