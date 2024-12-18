<?php

include("ConnectToBDD.php");

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    die("Tous les champs sont obligatoires !");
}

$username = $_POST['username'];

$password = md5($_POST['password']);
$confirmpassword = md5( $_POST['confirm_password']);
$email = $_POST['email'];
$confirmemail = $_POST['confirm_email'];

if($password != $confirmpassword){
    echo "Mot de passe différents ! ";
}
else if($email != $confirmemail){
    echo "Email différents ! ";
}else {
    $sql = 'INSERT INTO utilisateurs (Name,Email,Password,IsAdmin) VALUES (?,?,?,0)';
    $result = $pdo ->prepare($sql);
    $result -> execute([$username,$email,$password]);
    header('Location : login.php');
}

?>