<?php


session_start();
if(!isset($_SESSION['usr_id'])){
    header('Location: login.php');
}

// Inclusion de la connexion à la base de données
include("ConnectToBDD.php");

try {
    // Initialisation de la variable de recherche
    $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

    // Requête SQL pour récupérer les articles en fonction de la recherche
    if (!empty($searchQuery)) {
        $query = "SELECT * FROM topic WHERE Titre LIKE :search";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['search' => '%' . $searchQuery . '%']);
    } else {
        $query = "SELECT * FROM topic";
        $stmt = $pdo->query($query); // Exécution de la requête avec PDO
    }

    $articles = $stmt->fetchAll(); // Récupération des résultats sous forme de tableau associatif

    // Requête pour récupérer le nombre d'utilisateurs
    $queryUserCount = "SELECT COUNT(*) AS userCount FROM utilisateurs";
    $userStmt = $pdo->query($queryUserCount);
    $userCount = $userStmt->fetch()['userCount'];

    // Requête pour récupérer le nombre de topics
    $queryTopicCount = "SELECT COUNT(*) AS topicCount FROM topic";
    $topicStmt = $pdo->query($queryTopicCount);
    $topicCount = $topicStmt->fetch()['topicCount'];
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Murmures Ailleurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/profile.css">
    <script src="./js/index.js" defer></script>
    <script src="./js/chatbot.js" defer></script>
</head>
<div>
<!-- HEADER -->
    <header>
        <div class="top-bar">
            <a href="profile.php" class="user-info"><img src="./svg/user.svg" alt="User Icon"><?php echo $_SESSION['usr_name']; ?></a>
        </div>
        <h1>Page admin</h1>
        <div class="night">
            
<!-- Génération des étoiles -->
            <?php for ($i = 0; $i < 20; $i++): ?>
                <div class="shooting_star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5) ?>s;"></div>
            <?php endfor; ?>
        </div>
    </header>
    <div class="articles">
        <?php if (count($articles) > 0): ?>
            <?php foreach ($articles as $article): ?>
                <a href="detail.php?id=<?= htmlspecialchars($article['id']) ?>" class="article">
                    <h2><?= htmlspecialchars($article['Titre']) ?></h2>
                    <p>
                        <?= nl2br(mb_strlen($article['Contenu']) > 100 
                            ? mb_strimwidth(htmlspecialchars($article['Contenu']), 0, 100, "[...]") 
                            : htmlspecialchars($article['Contenu'])) ?>
                    </p>
                    <small>Publié le : <?= htmlspecialchars($article['DatePubli']); if(!is_null($article["DateModif"])){echo " - (Modifié le : " . $article["DateModif"] .").";} ?> </small>
                    <a href="modifBlog.php?id=<?= htmlspecialchars($article["id"]) ?>">Modifier</a>
                    <a href="delBlog.php?id=<?= htmlspecialchars($article["id"]) ?>">Supprimer</a>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun résultat trouvé. <a href="index.php">Démarrer une conversation</a></p>
        <?php endif; ?>
    </div>

    <input>
    </div>
    
    <footer>
        <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
    </footer>

    </body>

</html>