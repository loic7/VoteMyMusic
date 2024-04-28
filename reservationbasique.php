<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation - Places Basiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    session_start();
    include 'conn.php';
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





    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="card-title text-center">Réservation de places basiques</h1>
                                <?php
                                try {
                                    // Requête SQL pour récupérer le nombre de places disponibles pour les places basiques
                                    $sql = "SELECT nombre_places_disponibles FROM place_disponible WHERE type_place = 'basique'";
                                    $stmt = $conn->query($sql);
                                    $result = $stmt->fetchColumn();

                                    // Afficher le nombre de places disponibles
                                    echo "<div style='text-align:center;'><p>Nombre de places disponibles pour les places basiques : $result</p></div>";
                                } catch (PDOException $e) {
                                    echo "Une erreur s'est produite lors de la récupération du nombre de places disponibles : " . $e->getMessage();
                                }


                                ?>
                                <div class="text-center mb-4">
                                    <img src="theatre1.jpg" class="img-fluid" alt="...">
                                </div>
                                <!-- Formulaire de réservation pour les places basiques -->
                                <form action="traitement_reservation_basique.php" method="post">
                                    <!-- Champs de formulaire pour le nom, prénom, email, etc. -->
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nom" placeholder="Nom" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="prenom" placeholder="Prénom" required><br>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" name="email" placeholder="Email" required><br>
                                    </div>
                                    <!-- Autres champs et bouton de soumission -->
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block">Réserver</button>
                                    </div>
                                </form>

                            </div>
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