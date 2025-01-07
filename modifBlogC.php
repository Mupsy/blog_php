<?php

    session_start();

    require("ConnectToBDD.php");

    $new_title = $_POST["titre"];
    $new_content = $_POST["contenu"];
    $id = $_POST["id"];

    $sql = "UPDATE topic set Titre= ?, Contenu = ? WHERE id = ?";    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array($new_title, $new_content, $id));

    header("Location: adminPage.php");

?>

