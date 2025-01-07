<?php

    session_start();
    require("ConnectToBDD.php");

    $new_title = $_POST["titre"];
    $new_content = $_POST["contenu"];
    $id = $_SESSION["usr_id"];
    $date = date("Y-m-d");

    $sql = "INSERT INTO topic (Titre,Contenu,userID,IsVisible,datePubli) values (?,?,?,1,?)  ";
    $result = $pdo->prepare($sql);
    $result->execute(array($new_title, $new_content, $id, $date));

    header("Location: index.php");

?>