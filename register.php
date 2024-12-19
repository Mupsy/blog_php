<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Author" value="Mupsy">
        <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="./style/index.css">
        <link rel="stylesheet" href="./style/register.css">
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
    <div class="info-cards-register">
    <div class="info-card-register">
        <form action="RegisterUser.php" method="POST">
            <div class="form-container">
                <!-- Partie gauche -->
                <div class="form-left">
                    <label for="username">Pseudo :</label>
                    <input type="text" placeholder="Entrez votre pseudo" name="username" required>
                    <label for="email">Adresse mail :</label>
                    <input type="text" placeholder="Entrez votre adresse mail" name="email" required>
                    <label for="confirm_email">Confirmez votre adresse mail :</label>
                    <input type="text" placeholder="Entrez votre adresse mail" name="confirm_email" required>
                    <label for="password">Mot de passe :</label>
                    <input type="password" placeholder="Entrez votre mot de passe" name="password" required>
                    <label for="confirm_password">Confirmez votre mot de passe :</label>
                    <input type="password" placeholder="Entrez votre mot de passe" name="confirm_password" required>
                </div>
                <!-- Partie droite -->
                <div class="form-right">
                <label for="avatar">Choisir un avatar :</label>
    <div class="avatars">
   

        <div>
            <img class="avatar" src="./avatar/1.webp" alt="avatar1">
            <input type="radio" name="imgSelect" value="1" required>

                </div>
        <div>
            <img class="avatar" src="./avatar/2.webp" alt="avatar2">
            <input type="radio" name="imgSelect" value="2">

                </div>
        <div>
            <img class="avatar" src="./avatar/3.png" alt="avatar3">
            <input type="radio" name="imgSelect" value="3">

                </div>
        <div>
            <img class="avatar" src="./avatar/4.png" alt="avatar4">
            <input type="radio" name="imgSelect" value="4">

                </div>
        <div>
            <img class="avatar" src="./avatar/5.png" alt="avatar5">
            <input type="radio" name="imgSelect" value="5">

                </div>
        <div>
            
            <img class="avatar" src="./avatar/6.webp" alt="avatar6">
            <input type="radio" name="imgSelect" value="6">
                </div>
    </div>
    <button class="register-button" type="submit">Créer mon compte</button>
</div>

        </form>
    </div>
</div>


        </header>

        
                </div>
            </div>
        <!-- FOOTER -->
        <footer>
            <p class="footer">&copy; 2024 Murmures Ailleurs. Tous droits réservés.</p>
        </footer>
    </body>

</html>

