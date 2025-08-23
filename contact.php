<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    $vorname = isset($input['vorname']) ? trim($input['vorname']) : '';
    $nachname = isset($input['nachname']) ? trim($input['nachname']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';
    $nachricht = isset($input['nachricht']) ? trim($input['nachricht']) : '';
    
    // Validierung
    $errors = [];
    
    if (empty($vorname)) {
        $errors[] = 'Vorname ist erforderlich';
    }
    
    if (empty($nachname)) {
        $errors[] = 'Nachname ist erforderlich';
    }
    
    if (empty($email)) {
        $errors[] = 'E-Mail ist erforderlich';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Ungültige E-Mail-Adresse';
    }
    
    if (empty($nachricht)) {
        $errors[] = 'Nachricht ist erforderlich';
    }
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }
    
    // E-Mail senden (hier würde normalerweise eine echte E-Mail-Funktion stehen)
    $to = 'info@propertee.de';
    $subject = 'Neue Kontaktanfrage von BetterDeal Website';
    $message = "Neue Kontaktanfrage:\n\n";
    $message .= "Vorname: " . $vorname . "\n";
    $message .= "Nachname: " . $nachname . "\n";
    $message .= "E-Mail: " . $email . "\n";
    $message .= "Nachricht: " . $nachricht . "\n";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Für Demo-Zwecke loggen wir die Anfrage in eine Datei
    $log_entry = date('Y-m-d H:i:s') . " - Kontaktanfrage von: $vorname $nachname ($email)\n";
    file_put_contents('contact_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
    
    // Simuliere erfolgreiche E-Mail-Sendung
    $mail_sent = true; // In echter Anwendung: mail($to, $subject, $message, $headers);
    
    if ($mail_sent) {
        echo json_encode(['success' => true, 'message' => 'Ihre Nachricht wurde erfolgreich gesendet!']);
    } else {
        echo json_encode(['success' => false, 'errors' => ['Fehler beim Senden der E-Mail']]);
    }
} else {
    echo json_encode(['success' => false, 'errors' => ['Nur POST-Anfragen erlaubt']]);
}
?>

