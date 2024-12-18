<?php

    include("ConnectToBDD.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="Author" value="Mupsy">
    </head>
    <body>
        <form action="LoginUser.php" method="POST">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <label for="email">Email</label>
            <input type="text" placeholder="Enter ur email" name="email" required>
            <label for="username">Password</label>
            <input type="password" placeholder="Enter ur Password" name="password" required>
            <button type="submit">Login</button>
        </form>
    </body>
</html>
