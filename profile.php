<?php

    include("ConnectToBDD.php");
    session_start();

    $sql = "SELECT * from utilisateurs where Name = ?";
    $result = $pdo->prepare($sql);
    $result->execute([$_SESSION["usr_name"]]);
    $data = $result->fetch();

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
        <h1>Votre Profil</h1>
        <div class="night">
            
<!-- Génération des étoiles -->
            <?php for ($i = 0; $i < 20; $i++): ?>
                <div class="shooting_star" style="top: <?= rand(10, 90) ?>%; left: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5) ?>s;"></div>
            <?php endfor; ?>
        </div>

        <div class="info-cards-login">
            <div class="info-card-login">
                <img src="https://i.imgur.com/wvxPV9S.png" height="100" width="100" />
                <p class="name"><?php echo $_SESSION["usr_name"]; ?></p>
                <p class="mail"><?php echo $data["Email"]; ?></p>
                <a href="editProfile.php" class="edit">Modifier le Profil</a><br>
                <a href="disconnect.php" class="disconnect">Se Déconnecter</a>
            </div>
        </div>
    </header>
    
    

    <footer>
        <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
    </footer>

    </body>

</html>