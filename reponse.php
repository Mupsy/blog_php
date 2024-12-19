<?php
header('Content-Type: application/json; charset=utf-8');

// Tableau des réponses prédéfinies
$reponses = [
    "mot de passe" => [
        "message" => "Vous avez perdu votre mot de passe ?",
        "options" => ["Oui", "Non"]
    ],
    "oui" => [
        "message" => "Veuillez entrer votre adresse e-mail."
    ],
    "non" => [
        "message" => "Avez-vous une autre question ?"
    ],
    "supprimer" => [
        "message" => "Pour supprimer votre compte, connectez-vous, allez dans 'Paramètres du compte' et cliquez sur 'Supprimer mon compte'."
    ],
    "modifier" => [
        "message" => "Pour modifier votre compte, connectez-vous, allez dans 'Paramètres du compte' et effectuez les modifications nécessaires."
    ]
];

// Récupérer le message envoyé depuis le frontend
$data = json_decode(file_get_contents("php://input"), true);
$userMessage = strtolower(trim($data['message'] ?? ''));

// Fonction pour valider une adresse e-mail
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Vérifier si une réponse existe dans le message de l'utilisateur (par mot-clé)
$responseFound = false;
foreach ($reponses as $keyword => $response) {
    if (strpos($userMessage, $keyword) !== false) {
        echo json_encode($response);
        $responseFound = true;
        break;
    }
}

// Si aucune réponse n'a été trouvée, vérifier si le message est une adresse e-mail valide
if (!$responseFound) {
    if (isValidEmail($userMessage)) {
        // Si l'utilisateur a entré une adresse e-mail valide
        echo json_encode([
            "message" => "Un email a été envoyé à l'adresse suivante : $userMessage pour réinitialiser votre mot de passe."
        ]);
    } else {
        // Réponse par défaut pour les messages inconnus
        echo json_encode([
            "message" => "Je ne comprends pas votre question. Pouvez-vous reformuler ?"
        ]);
    }
}
?>
