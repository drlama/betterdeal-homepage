<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $nachricht = htmlspecialchars($_POST['nachricht'] ?? '');

    // Hier könntest du die Daten in eine Datenbank speichern oder per Email versenden.

    echo json_encode([
        "message" => "Vielen Dank, $name! Ihre Nachricht wurde erfolgreich gesendet."
    ]);
} else {
    echo json_encode([
        "message" => "Ungültige Anfrage."
    ]);
}
?>