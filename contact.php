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



    <div class="container d-flex justify-content-center align-items-center" style="height: 50vh;">
        <div class="container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Contactez-vous</h5>
                            <form class="inscription-form" action="traitement3.php" method="post">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="nom" placeholder="Nom">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="prenom" placeholder="Prénom">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="message" placeholder="message"></textarea>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary w-100">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 VoteMyMusic. Tous droits réservés.</span>
        </div>
    </footer>


</body>

</html>