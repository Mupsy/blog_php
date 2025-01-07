<?php

include("ConnectToBDD.php");

session_start();

session_start();

if (empty($_POST['username']) || empty($_POST['password']) ||  empty($_POST['email'])) {
    die("Tous les champs sont obligatoires !");
}

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Requête préparée pour récupérer l'utilisateur
$sql = "SELECT * FROM utilisateurs WHERE Name = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$username]);
$data = $stmt->fetch();
print_r($username);
if (!$data) {
    echo "Identifiants incorrects. data vide";
} else {
    // Vérification des informations
    if ($email == $data['Email'] && md5($password) ==$data['Password']) {
        $_SESSION["usr_id"] = $data["id"];
        $_SESSION['usr_name'] = $data['Name'];
        $_SESSION["admin"] = $data["IsAdmin"];
        echo "Utilisateur connecté !";
        header("Location: index.php");
    } else {
        echo "Identifiants incorrects.";
    }
}
?>