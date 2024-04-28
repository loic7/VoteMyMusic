<?php
session_start(); // Démarre la session
include 'conn.php'; // Inclure le fichier de connexion à la base de données

if (isset($_SESSION['connected'])) { // Vérifie si l'utilisateur est connecté
    $nom = $_POST['nom']; // Utiliser la valeur du champ 'nom' du formulaire
    $prenom = $_POST['prenom']; // Utiliser la valeur du champ 'prenom' du formulaire
    $email = $_POST['email']; // Utiliser la valeur du champ 'email' du formulaire

    try {
        // Requête SQL pour insérer les données dans la table de réservation basique
        $sql = "INSERT INTO reservation (type_place, nom, prenom, email) VALUES ('handicape', :nom, :prenom, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        // Mettre à jour le nombre de places disponibles dans la table place_disponible
        $sql = "UPDATE place_disponible SET nombre_places_disponibles = nombre_places_disponibles - 1 WHERE type_place = 'handicape'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        echo "<div class='centered-message'style='text-align: center; font-size: 24px;'>Merci!Votre reservation a bien été effectué !</div>";
        header("Refresh:5; url=reservation.php"); // Rediriger vers reussi.php après 2 secondes
        exit();
    } catch (PDOException $e) {
        echo "Une erreur s'est produite lors de la réservation: " . $e->getMessage();
    }
} else {
    echo "Vous devez être connecté pour effectuer une réservation.";
}
