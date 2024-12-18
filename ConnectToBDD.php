<?php
// Configuration de la connexion avec PDO
try {
    global $pdo; // Déclare la variable globale pour l'utiliser dans d'autres fichiers
    $pdo = new PDO(
        "mysql:host=localhost;dbname=blog;charset=UTF8", // Chaîne de connexion
        "root", // Nom d'utilisateur
        "", // Mot de passe
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Gestion des erreurs
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Mode de fetch par défaut
        ]
    );
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
