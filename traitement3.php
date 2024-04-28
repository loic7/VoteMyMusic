<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    try {
        $stmt = $conn->prepare("INSERT INTO contact (nom, prenom, email, message) 
                                VALUES (:nom, :prenom, :email, :message)");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        // Exécution de la requête
        $stmt->execute();

        echo "<div class='centered-message'>Merci! Votre message a bien été reçu. Nous vous recontacterons au plus vite!</div>";
        header("Refresh:5; url=contact.php"); // Rediriger vers reussi.php après 2 secondes
    } catch (PDOException $erreur) {
        echo "Erreur d'insertion : " . $erreur->getMessage();
    }
    
}
?>
<style>
    .centered-message {
        text-align: center;
        font-size: 24px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
