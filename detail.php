<?php
include("ConnectToBDD.php");
session_start();
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "SELECT Titre, Contenu, DatePubli FROM topic WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $article = $stmt->fetch();

    if ($article) {
        $titre = htmlspecialchars($article['Titre']);
        $contenu = nl2br(htmlspecialchars($article['Contenu']));
        $date = htmlspecialchars($article['DatePubli']);
    } else {
        die("Article non trouvé.");
    }
} else {
    die("ID invalide.");
}

$query = '
        SELECT * FROM commentaire WHERE blogID = ?;
        ';

    $res = $pdo->prepare($query);
    $res->execute([$_GET['id']]);

    $datas = $res->fetchAll();
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
<body>
<!-- HEADER -->
    <header>
        <div class="top-bar">
            <a href="profile.php" class="user-info"><img src="./svg/user.svg" alt="User Icon"><?php echo $_SESSION['usr_name']; ?></a>
        </div>
        <h1>Topic <?= htmlspecialchars($article["Titre"]); ?></h1>
        <div class="night">
            
<!-- Génération des étoiles -->
            <?php for ($i = 0; $i < 20; $i++): ?>
                <div class="shooting_star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5) ?>s;"></div>
            <?php endfor; ?>
        </div>
        <?= htmlspecialchars($article["Contenu"]) ?>
    <div class="commentaries">
        <?php
        
        foreach ($datas as $row) {
            echo '<div class="commentary">';
            echo $row["userID"]; // faire un select pour get le user ID
            echo $row["Contenu"];
            echo $row["datePubli"];
            if($_SESSION["admin"]==1){echo "<a href='delCom.php?id=" . $row["id"]. "'>Supprimer</a>";}
            echo '</div>';
        }
        
        ?>
    </div>
    <a href="index.php">Retour à l'accueil</a>
    </header>
    
    

    <footer>
        <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
    </footer>

    </body>

</html>
