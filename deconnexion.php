<?php
// Démarrez la session
session_start();

// Détruisez toutes les variables de session
$_SESSION = array();

// Supprimez le cookie de session
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Détruisez la session
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: connexion.php");
exit;
?>
