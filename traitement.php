<?php
include 'conn.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    try {
        $stmt = $conn->prepare("INSERT INTO utilisateur (nom, prenom, email, mot_de_passe) 
                                VALUES (:nom, :prenom, :email, :mdp)");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mdp', $mdp);

        // Exécution de la requête
        $stmt->execute();
        
        echo "Enregistrement réussi dans la base de données";
    } catch (PDOException $erreur) {
        echo "Erreur d'insertion : " . $erreur->getMessage();
    }
}
?>
<a href="connexion.php" class="btn">Connexion</a>
