<?php
session_start();

include 'conn.php';

if (isset($_SESSION['connected'])) {
    $musiqueLink = 'musique.php';
} else {
    $musiqueLink = 'connexion.php';
}

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $artiste = $_POST['artiste'];
    $lien = $_POST['lien'];

    try {
        // Préparer et exécuter la requête d'insertion
        $sql = "INSERT INTO Musiques (titre, artiste, lien) VALUES (:titre, :artiste, :lien)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':artiste', $artiste);
        $stmt->bindParam(':lien', $lien);
        $stmt->execute();
        echo "Nouvelle chanson ajoutée avec succès!";
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// Traitement pour liker ou disliker une musique
if (isset($_POST['action']) && isset($_POST['music_id'])) {
    $action = $_POST['action'];
    $music_id = $_POST['music_id'];
    try {
        if ($action == 'like') {
            $sql = "UPDATE Musiques SET likes = likes + 1 WHERE id = :id";
        } elseif ($action == 'dislike') {
            $sql = "UPDATE Musiques SET dislikes = dislikes + 1 WHERE id = :id";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $music_id);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// Récupérer les pistes de musique ajoutées depuis la base de données
$sql = "SELECT * FROM Musiques";
$result = $conn->query($sql);
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


    <div class="container d-flex align-items-center justify-content-center" style="min-height: 50vh;">
        <div class="row">
            <div class="col">
            <h2 class="text-center">Ajouter une musique</h2>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="row mb-3">
                        <label for="Titre" class="col-sm-2 col-form-label">Titre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="titre">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="Artiste" class="col-sm-2 col-form-label">Artiste</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" name="artiste">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Lien</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" name="lien">
                        </div>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                    <button type="submit" name="submit" value="Ajouter" class="btn btn-warning btn-SM d-inline-block mx-auto ">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="text-center">Liste des musiques ajoutées</h2>
            <div class="table-responsive">
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Artiste</th>
                            <th scope="col">Lien</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Afficher les pistes de musique ajoutées dans un tableau
                        if ($result->rowCount() > 0) {
                            $i = 1;
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $i . "</th>";
                                echo "<td>" . $row['titre'] . "</td>";
                                echo "<td>" . $row['artiste'] . "</td>";
                                echo "<td><a href='" . $row['lien'] . "' target='_blank'>Lien</a></td>";
                                echo "<td>";
                                echo "<div class='d-grid gap-2 d-md-block'>";
                                echo "<form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
                                echo "<input type='hidden' name='music_id' value='" . $row['id'] . "'>";
                                echo "<button type='submit' name='action' value='like' class='btn btn-success'>Like </button>";
                                echo "<button type='submit' name='action' value='dislike' class='btn btn-danger mx-2'> Dislike</button>";
                                echo "</form>";
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='5'>Aucune musique ajoutée pour le moment.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="d-grid gap-1 d-md-flex justify-content-center">
    <div class="mx-md-2">
        <a class="btn btn-warning btn-lg d-inline-block" href="musiquelike.php" role="button">Les plus aimées</a>
    </div>
    <div class="mx-md-2 mb-4">
        <a class="btn btn-warning btn-lg d-inline-block" href="musiquedislike.php" role="button">Les moins aimées</a>
    </div>
</div>


<footer class="footer mt-auto py-4 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 VoteMyMusic. Tous droits réservés.</span>
        </div>
    </footer>
</body>
</html>