<?php
// Inclusion de la connexion à la base de données
include("ConnectToBDD.php");

// Requête SQL pour récupérer les articles
$query = "SELECT id, Titre, Contenu, DatePubli FROM topic";
$stmt = $pdo->query($query); // Exécution de la requête avec PDO
$articles = $stmt->fetchAll(); // Récupération des résultats sous forme de tableau associatif
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Murmures Ailleurs</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 40px 0;
            text-align: center;
            height: 800px;
        }

        header h1 {
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            font-size: 5em;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 20px;
        }

        .top-bar button {
            background-color: #3498db;
            border: none;
            padding: 10px 20px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }

        .top-bar button:hover {
            background-color: #2980b9;
        }

        .top-bar a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
        }

        .top-bar img {
            margin-right: 50px;
            width: 45px;
            height: 45px;
        }

        .articles {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .article {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .article:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .article h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        .article p {
            line-height: 1.6;
        }

        .article small {
            display: block;
            margin-top: 10px;
            color: #7f8c8d;
        }

        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
    <div class="top-bar">
        <a href="login.php"><img src="./svg/user.svg" alt="User Icon"></a>
    </div>
        <h1>Murmures Ailleurs</h1>
    </header>
    <div class="container">
        
        <div class="articles">
            <?php
            if (count($articles) > 0) {
                foreach ($articles as $article) {
                    $contenu = htmlspecialchars($article['Contenu']);
                    if (mb_strlen($contenu) > 100) {
                        $contenu = mb_strimwidth($contenu, 0, 100, "[...]");
                    }

                    echo "<a href='detail.php?id=" . htmlspecialchars($article['id']) . "' class='article'>";
                    echo "<h2>" . htmlspecialchars($article['Titre']) . "</h2>";
                    echo "<p>" . nl2br($contenu) . "</p>";
                    echo "<small>Publié le : " . htmlspecialchars($article['DatePubli']) . "</small>";
                    echo "</a>";
                }
            } else {
                echo "<p>Aucun article trouvé.</p>";
            }
            ?>
        </div>
    </div>
    <footer>
        <p>&copy; 2023 Murmures Ailleurs. Tous droits réservés.</p>
    </footer>
</body>
</html>
