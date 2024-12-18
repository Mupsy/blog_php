<?php

    print_r("Page register ! ");

?>

<form action="RegisterUser.php" method="POST">
            <label for="username">Username</label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <label for="email">Email</label>
            <input type="text" placeholder="Enter ur email" name="email" required>
            <label for="confirm_email">Confirmez Email</label>
            <input type="text" placeholder="Enter ur email" name="confirm_email" required>
            <label for="password">Password</label>
            <input type="password" placeholder="Enter ur Password" name="password" required>
            <label for="confirm_password">Confirmez Password</label>
            <input type="password" placeholder="Enter ur Password" name="confirm_password" required>
            <button type="submit">S'enregistrer ! </button>
        </form>