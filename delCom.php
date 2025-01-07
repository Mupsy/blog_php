<?php

    require("ConnectToBDD.php");

    $id = $_GET["id"];

    $sql = "DELETE FROM commentaire where id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    header("Location: detail.php?id=" . $id);

    ?>