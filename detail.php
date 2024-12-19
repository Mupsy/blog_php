<?php
include("ConnectToBDD.php");

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
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $titre; ?></title>
</head>
<body>
    <h1><?php echo $titre; ?></h1>
    <p><?php echo $contenu; ?></p>
    <small>Publié le : <?php echo $date; ?></small>
    <br>
    <div class="commentaries">
        <?php
        
        foreach ($datas as $row) {
            echo '<div class="commentary">';
            echo $row["userID"]; // faire un select pour get le user ID
            echo $row["Contenu"];
            echo $row["datePubli"];
            echo '</div>';
        }
        
        ?>
    </div>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>
