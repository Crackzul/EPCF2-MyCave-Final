<?php
require_once 'includes/session.php';

// Déconnexion complète (vide $_SESSION, supprime cookie, détruit session)
logout();

// Rediriger vers la page de connexion
header("Location: index.php");
exit();

?>

