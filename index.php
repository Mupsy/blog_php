<?php
// Inclusion de la connexion à la base de données
include("ConnectToBDD.php");

try {
    // Initialisation de la variable de recherche
    $searchQuery = isset($_GET['q']) ? trim($_GET['q']) : '';

    // Requête SQL pour récupérer les articles en fonction de la recherche
    if (!empty($searchQuery)) {
        $query = "SELECT id, Titre, Contenu, DatePubli FROM topic WHERE Titre LIKE :search";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['search' => '%' . $searchQuery . '%']);
    } else {
        $query = "SELECT id, Titre, Contenu, DatePubli FROM topic";
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
    <link rel="stylesheet" href="./style/index.css">
    <script src="./js/index.js" defer></script>
</head>
<body>
<!-- HEADER -->
    <header>
        <div class="top-bar">
            <a href="login.php"><img src="./svg/user.svg" alt="User Icon"></a>
        </div>
        <h1>Murmures Ailleurs</h1>
        <div class="night">
            
<!-- Génération des étoiles -->
            <?php for ($i = 0; $i < 20; $i++): ?>
                <div class="shooting_star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5) ?>s;"></div>
            <?php endfor; ?>
        </div>
        
<!-- Cases -->
        <div class="info-cards">
            <div class="info-card">
                <h3>Rejoignez notre communauté</h3>
                <p>Avec plus de <strong><?= $userCount ?></strong> membres actifs, partagez vos idées, vos expériences et vos passions.</p>
                <p>Que vous soyez amateur ou expert, chaque murmure compte ici !</p>
            </div>
            <div class="info-card">
                <h3>Découvrez nos sujets</h3>
                <p>Plongez dans un univers riche avec plus de <strong><?= $topicCount ?></strong> discussions captivantes.</p>
                <p>De l'actualité aux sujets de niche, explorez ce qui vous inspire.</p>
            </div>
            <div class="info-card">
                <h3>Inscrivez-vous gratuitement</h3>
                <p>Accédez à toutes les fonctionnalités, participez aux discussions et créez vos propres topics.</p>
                <a href="register.php" class="register-button">S'inscrire</a>
            </div>
        </div>

<!-- Flèche animée qui pointe vers le bas -->
        <div class="arrow arrow-first"></div>
        <div class="arrow arrow-second"></div>
    </header>

    <!-- ARTICLES -->
    <div class="container">
    <form action="" method="get">
        <div class="filter-container">
            <label for="filter">Filtré par :</label>
            <select id="filter" name="filter">
                <option value="recent">Les plus récents</option>
                <option value="ancien">Les plus anciens</option>
                <option value="like">Les mieux notés</option>
                <option value="dislike">Les moins bien notés</option>
            </select>
        </div>
        <div class="search-container">
            <input type="text" name="q" placeholder="Rechercher un article..." value="<?= htmlspecialchars($searchQuery) ?>">
            <button type="submit">Rechercher</button>
        </div>
        <div>
            <h2>Voici les 10 derniers articles</h2>
        </div>
    </form>
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
                    <small>Publié le : <?= htmlspecialchars($article['DatePubli']) ?></small>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun résultat trouvé. <a href="start-conversation.php">Démarrer une conversation</a></p>
        <?php endif; ?>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <p class="footer">&copy; 2023 Murmures Ailleurs. Tous droits réservés.</p>
</footer>
</body>
</html>
