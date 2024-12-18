<?php

    global $PDO;

    $pdo = new PDO("mysql:host=localhost;dbname=blog;charset=UTF8","root","",[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

?>