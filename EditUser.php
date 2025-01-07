<?php

    session_start();
    print_r($_POST);

    require("ConnectToBDD.php");
    $new_usrname = $_POST['username'];
    $new_usrpwdconf = $_POST['password_confirm'];
    $new_usrmail = $_POST['email'];
    $new_usrpwd = $_POST['password'];
    $id_usr = $_SESSION["usr_id"];

    if (empty($new_usrname) || empty($new_usrpwd) || empty($new_usrmail) || empty($new_usrpwdconf)) {
        die("All fields are required.");
    }
    if($new_usrpwd === $new_usrpwdconf) {
        $sql = "UPDATE utilisateurs SET Name = ?,Email = ?,Password= ? WHERE id = ? ";
        $stmt = $pdo ->prepare($sql);
        $stmt->execute([$new_usrname,$new_usrmail,md5($new_usrpwd),$id_usr]);

        session_destroy();
        header("Location: login.php");
    }else{
        die("Les mots de passes sont différents !");
    }

    
?>