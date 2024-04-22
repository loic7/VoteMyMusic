<?php
include 'conn.php';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
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
    } catch(PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}

// Traitement pour liker ou disliker une musique
if(isset($_POST['action']) && isset($_POST['music_id'])) {
    $action = $_POST['action'];
    $music_id = $_POST['music_id'];
    try {
        if($action == 'like') {
            $sql = "UPDATE Musiques SET likes = likes + 1 WHERE id = :id";
        } elseif($action == 'dislike') {
            $sql = "UPDATE Musiques SET dislikes = dislikes + 1 WHERE id = :id";
        }
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $music_id);
        $stmt->execute();
    } catch(PDOException $e) {
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
    <div class="container">
        <h2>Ajouter une musique</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Titre: <input type="text" name="titre"><br>
            Artiste: <input type="text" name="artiste"><br>
            Lien: <input type="text" name="lien"><br>
            <input type="submit" value="Ajouter">
        </form>

        <h2>Liste des musiques ajoutées</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Lien</th>
                <th>Action</th>
            </tr>
            <?php
            // Afficher les pistes de musique ajoutées dans un tableau
            if ($result->rowCount() > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row['titre']."</td>";
                    echo "<td>".$row['artiste']."</td>";
                    echo "<td><a href='".$row['lien']."' target='_blank'>Lien</a></td>";
                    echo "<td>";
                    echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                    echo "<input type='hidden' name='music_id' value='".$row['id']."'>";
                    echo "<button type='submit' name='action' value='like'>Like</button>";
                    echo "<button type='submit' name='action' value='dislike'>Dislike</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Aucune musique ajoutée pour le moment.</td></tr>";
            }
            ?>
        </table>

        <h2>Top trois des musiques aimées</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Likes</th>
            </tr>
            <?php
            // Récupérer les trois musiques les plus aimées
            $sql_likes = "SELECT * FROM Musiques ORDER BY likes DESC LIMIT 3";
            $result_likes = $conn->query($sql_likes);
            if ($result_likes->rowCount() > 0) {
                while($row_likes = $result_likes->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row_likes['titre']."</td>";
                    echo "<td>".$row_likes['artiste']."</td>";
                    echo "<td>".$row_likes['likes']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucune musique n'a encore été aimée.</td></tr>";
            }
            ?>
        </table>

        <h2>Top trois des musiques les moins aimées</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Artiste</th>
                <th>Dislikes</th>
            </tr>
            <?php
            // Récupérer les trois musiques les moins aimées
            $sql_dislikes = "SELECT * FROM Musiques ORDER BY dislikes DESC LIMIT 3";
            $result_dislikes = $conn->query($sql_dislikes);
            if ($result_dislikes->rowCount() > 0) {
                while($row_dislikes = $result_dislikes->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>".$row_dislikes['titre']."</td>";
                    echo "<td>".$row_dislikes['artiste']."</td>";
                    echo "<td>".$row_dislikes['dislikes']."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Aucune musique n'a encore été dislikée.</td></tr>";
            }
            ?>
        </table>
    </div>

</body>
*    <a class="btn" href="Accueil.php">Retour a l'accueil</a>
</html>
