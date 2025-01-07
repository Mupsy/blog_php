<?php
    
    session_start();
    if(!isset($_SESSION['usr_id'])){
        header('Location: login.php');
    }

    // Inclusion de la connexion à la base de données
    include("ConnectToBDD.php");

    $query = "SELECT * FROM topic where id=?";
    $stmt = $pdo->prepare($query); 
    $stmt->execute([$_GET["id"]]);

    $article = $stmt->fetch();

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
        <h1>Modif blog <?= htmlspecialchars($article["Titre"]) ?></h1>
        <div class="night">
            
<!-- Génération des étoiles -->
            <?php for ($i = 0; $i < 20; $i++): ?>
                <div class="shooting_star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5) ?>s;"></div>
            <?php endfor; ?>
        </div>
        <div>
            <form action="modifBlogC.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($article['id']) ?>">
                <p>Modification du titre</p>
                <input name="titre" type="text" value="<?= htmlspecialchars($article["Titre"]) ?>"></input><br>
                <p>Modification du contenu</p>
                <textarea name="contenu" style="height:200px; width:70%;"><?= htmlspecialchars($article["Contenu"]) ?></textarea>
                <button type="submit">Modifier</button>
            </form>
        

    </div>
    </header>

    
    <footer>
        <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
    </footer>

    </body>

</html>
