<?php
session_start();

include 'conn.php';

if (isset($_SESSION['connected'])) {
    $musiqueLink = 'musique.php';
} else {
    $musiqueLink = 'connexion.php';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ajouter et afficher des musiques</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
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
                        <a class="nav-link" href="doc.php">Doc</a>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2 class="text-center">Top trois des musiques les moins aimées</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered border-dark">
                            <thead>
                                <tr>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Artiste</th>
                                    <th scope="col">Likes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Récupérer les trois musiques les moins aimées
                                $sql_dislikes = "SELECT * FROM Musiques ORDER BY dislikes DESC LIMIT 3";
                                $result_dislikes = $conn->query($sql_dislikes);
                                if ($result_dislikes->rowCount() > 0) {
                                    // Parcourir les résultats et afficher chaque musique
                                    while ($row_dislikes = $result_dislikes->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>";
                                        echo "<td>" . $row_dislikes['titre'] . "</td>";
                                        echo "<td>" . $row_dislikes['artiste'] . "</td>";
                                        echo "<td>" . $row_dislikes['dislikes'] . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</table>";
                                } else {
                                    // Aucune musique n'a encore été dislikée
                                    echo "<h2>Aucune musique n'a encore été dislikée.</h2>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-1 d-md-flex justify-content-center">
        <div class="mx-md-2">
            <a class="btn btn-warning btn-lg d-inline-block" href="musiquelike.php" role="button">Les plus aimées</a>
        </div>
        <div class="mx-md-2 mb-4">
            <a class="btn btn-warning btn-lg d-inline-block" href="musique.php" role="button">Voter</a>
        </div>
    </div>


    <footer class="footer mt-auto py-4 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 VoteMyMusic. Tous droits réservés.</span>
        </div>
    </footer>
</body>

</html>