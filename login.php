<?php

    include("ConnectToBDD.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Author" value="Mupsy">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./style/index.css">
        <link rel="stylesheet" href="./style/login.css">
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
            <div class="info-cards-login">
                <div class="info-card-login">
                    <form action="LoginUser.php" method="POST">
                        <label for="username">Pseudo :</label>
                        <input type="text" placeholder="Entrez votre pseudo" name="username" required>
                        <label for="email">Adresse mail :</label>
                        <input type="text" placeholder="Entrez votre adresse mail" name="email" required>
                        <label for="password">Mot de passe :</label>
                        <input type="password" placeholder="Entre votre mot de passe" name="password" required>
                        <span><a href="./register.php">Si vous n'avez pas de compte, enregistrez-vous ici ! </a></span>
                        <button class="login-button" type="submit">Login</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- FOOTER -->
        <footer>
            <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
        </footer>
    </body>
</html>
