<?php
    // Inclusion de la connexion à la base de données
    include("ConnectToBDD.php");

    // Requête SQL pour récupérer les articles
    $query = "SELECT id, Titre, Contenu, DatePubli FROM topic";
    $stmt = $pdo->query($query); // Exécution de la requête avec PDO
    $articles = $stmt->fetchAll(); // Récupération des résultats sous forme de tableau associatif
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Articles</title>
    </head>
    <body>

        <h1>Liste des Articles</h1>

        <?php
if (count($articles) > 0) {
    echo "<ul>";
    foreach ($articles as $article) {
        // Limiter le contenu à 100 caractères
        $contenu = htmlspecialchars($article['Contenu']);
        if (mb_strlen($contenu) > 100) {
            $contenu = mb_strimwidth($contenu, 0, 100, "[...]");
        }

        echo "<li>";
        echo "<h2><a href='detail.php?id=" . htmlspecialchars($article['id']) . "'>" . htmlspecialchars($article['Titre']) . "</a></h2>";
        echo "<p>" . nl2br($contenu) . "</p>";
        echo "<small>Publié le : " . htmlspecialchars($article['DatePubli']) . "</small>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Aucun article trouvé.</p>";
}
?>
    </body>
</html>
