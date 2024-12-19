<?php
    // Démarrer la session si elle n'est pas déjà démarrée
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Détruire la session
    session_unset(); // Supprime toutes les variables de session
    session_destroy(); // Détruit la session côté serveur

    // Rediriger vers la page d'accueil
    header("Location: index.php");
    exit(); // Toujours utiliser `exit()` après une redirection
?>
