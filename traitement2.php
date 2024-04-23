<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];

    try {
        $stmt = $conn->prepare("SELECT id, nom, mot_de_passe FROM utilisateur WHERE nom = :nom");
        $stmt->bindParam(':nom', $nom);
        $stmt->execute();

        // Vérification si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // L'utilisateur existe, récupération de ses informations
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérification du mot de passe
            if ($mdp === $user['mot_de_passe']) {
                // Démarrage de la session et enregistrement des informations de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nom'] = $user['nom'];
                $_SESSION['connected'] = true;

                // Redirection vers une page de succès ou d'accueil
                header('Location: Accueil.php');
                exit();
            } else {
                // Mot de passe incorrect
                echo "Mot de passe incorrect.";
            }
        } else {
            // L'utilisateur n'existe pas
            echo "Nom d'utilisateur incorrect.";
        }
    } catch (PDOException $erreur) {
        // En cas d'erreur lors de l'exécution de la requête
        echo "Erreur : " . $erreur->getMessage();
    }
}
?>
<a href="Accueil.php" class="btn">retour</a>

