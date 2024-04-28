<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();
    
    if (!isset($_SESSION['connected'])) {
        header('Location: connexion.php');
        exit();
    }

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
                        <a class="nav-link" href="reservation.php">Reserver</a>
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
                        <a href="deconnexion.php" type="button" class="btn btn-warning">Déconnexion</a>
                    <?php else : ?>
                        <!-- Sinon, afficher le lien de connexion -->
                        <a href="connexion.php" type="button" class="btn btn-warning">Connexion</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <div style="margin-top: 100px;"></div>

    <div class="d-flex justify-content-center">
    <div class="card mx-1" style="width: 18rem;">
        <img src="theatre1.jpg" class="card-img-top" alt="...">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">Place spectacle basique</h5>
            <p class="card-text">Place assise pour profiter pleinement du spectacle.</p>
            <div class="mt-auto">
                <a href="reservationbasique.php" class="btn btn-primary btn-block">Réserver</a>
            </div>
        </div>
    </div>

    <div class="card mx-1" style="width: 18rem;">
        <img src="theatre2.jpg" class="card-img-top" alt="...">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">Places pour personnes à mobilité réduite</h5>
            <p class="card-text">Places faciles d'accès réservées uniquement aux personnes munies d'une carte prouvant leur handicap.</p>
            <div class="mt-auto">
                <a href="reservationhandicape.php" class="btn btn-primary btn-block">Réserver</a>
            </div>
        </div>
    </div>

    <div class="card mx-1" style="width: 18rem;">
        <img src="theatre3.jpg" class="card-img-top" alt="...">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">Place VIP</h5>
            <p class="card-text">Les places les plus proches du spectacle pour une immersion à couper le souffle !</p>
            <div class="mt-auto">
                <a href="reservationvip.php" class="btn btn-primary btn-block">Réserver</a>
            </div>
        </div>
    </div>
</div>



</body>

</html>