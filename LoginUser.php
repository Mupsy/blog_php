<?php

include("ConnectToBDD.php");

if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
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
        echo "Utilisateur connecté !";
        header("Location : index.php");
    } else {
        echo "Identifiants incorrects.";
    }
}
?>
