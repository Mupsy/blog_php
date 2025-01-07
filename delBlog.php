<?php

    require("ConnectToBDD.php");
    $id = $_GET["id"];


    $sqlCom ="DELETE FROM commentaire WHERE blogID = ? ";
    $stmt = $pdo ->prepare($sqlCom);
    $stmt->execute([$id]);

    $sql = "DELETE FROM topic WHERE id =?";
    $stmt = $pdo ->prepare($sql);
    $stmt->execute([$id]);
    header("Location:adminPage.php");

?>
