<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $mdp = $_POST['mdp'];

    try {
        $stmt = $conn->prepare("SELECT id, nom, mot_de_passe FROM utilisateur WHERE nom = :nom AND mot_de_passe = :mdp");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->execute();

        // Vérification si l'utilisateur existe dans la base de données
        if ($stmt->rowCount() > 0) {
            // L'utilisateur existe, récupération de ses informations
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Démarrage de la session et enregistrement des informations de l'utilisateur
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nom'] = $user['nom'];

            // Redirection vers une page de succès ou d'accueil
            header('Location: accueil.php');
            exit();
        } else {
            // L'utilisateur n'existe pas ou les informations de connexion sont incorrectes
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $erreur) {
        // En cas d'erreur lors de l'exécution de la requête
        echo "Erreur : " . $erreur->getMessage();
    }
}
?>
