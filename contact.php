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
    
    // Check if this is a BetterDeal modal form or regular contact form
    $form_type = isset($input['form_type']) ? $input['form_type'] : 'contact';
    
    if ($form_type === 'betterdeal_modal') {
        // Handle BetterDeal modal form
        handleBetterDealForm($input);
    } else {
        // Handle regular contact form
        handleContactForm($input);
    }
} else {
    echo json_encode(['success' => false, 'errors' => ['Nur POST-Anfragen erlaubt']]);
}

function handleBetterDealForm($input) {
    // Extract and validate BetterDeal form data
    $objekttyp = isset($input['objekttyp']) ? trim($input['objekttyp']) : '';
    $strasse = isset($input['strasse']) ? trim($input['strasse']) : '';
    $plz = isset($input['plz']) ? trim($input['plz']) : '';
    $stadt = isset($input['stadt']) ? trim($input['stadt']) : '';
    $bundesland = isset($input['bundesland']) ? trim($input['bundesland']) : '';
    $vorname = isset($input['vorname']) ? trim($input['vorname']) : '';
    $nachname = isset($input['nachname']) ? trim($input['nachname']) : '';
    $email = isset($input['email']) ? trim($input['email']) : '';
    $telefon = isset($input['telefon']) ? trim($input['telefon']) : '';
    
    // Property specific fields
    $wohnflaeche = isset($input['wohnflaeche']) ? trim($input['wohnflaeche']) : '';
    $zimmer = isset($input['zimmer']) ? trim($input['zimmer']) : '';
    $baujahr = isset($input['baujahr']) ? trim($input['baujahr']) : '';
    
    // Additional fields based on objekttyp
    $grundstueck = isset($input['grundstueck']) ? trim($input['grundstueck']) : '';
    $etage = isset($input['etage']) ? trim($input['etage']) : '';
    $balkon = isset($input['balkon']) ? trim($input['balkon']) : '';
    $haustyp = isset($input['haustyp']) ? trim($input['haustyp']) : '';
    $garage = isset($input['garage']) ? trim($input['garage']) : '';
    $wohneinheiten = isset($input['wohneinheiten']) ? trim($input['wohneinheiten']) : '';
    $vermietungsgrad = isset($input['vermietungsgrad']) ? trim($input['vermietungsgrad']) : '';
    $mieteinnahmen = isset($input['mieteinnahmen']) ? trim($input['mieteinnahmen']) : '';
    
    // Validierung
    $errors = [];
    
    if (empty($objekttyp) || !in_array($objekttyp, ['wohnung', 'haus', 'mehrfamilienhaus'])) {
        $errors[] = 'Objekttyp ist erforderlich';
    }
    
    if (empty($strasse)) {
        $errors[] = 'Straße und Hausnummer ist erforderlich';
    }
    
    if (empty($plz) || !preg_match('/^[0-9]{5}$/', $plz)) {
        $errors[] = 'Gültige PLZ ist erforderlich';
    }
    
    if (empty($stadt)) {
        $errors[] = 'Stadt ist erforderlich';
    }
    
    if (empty($bundesland)) {
        $errors[] = 'Bundesland ist erforderlich';
    }
    
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
    
    if (empty($wohnflaeche) || !is_numeric($wohnflaeche) || $wohnflaeche <= 0) {
        $errors[] = 'Wohnfläche ist erforderlich';
    }
    
    if (empty($baujahr) || !is_numeric($baujahr) || $baujahr < 1800 || $baujahr > 2024) {
        $errors[] = 'Gültiges Baujahr ist erforderlich';
    }
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }
    
    // Database connection (example - adjust credentials as needed)
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=betterdeal;charset=utf8mb4', 'username', 'password');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create table if it doesn't exist (example)
        $createTable = "
            CREATE TABLE IF NOT EXISTS betterdeal_anfragen (
                id INT AUTO_INCREMENT PRIMARY KEY,
                objekttyp VARCHAR(50) NOT NULL,
                strasse VARCHAR(255) NOT NULL,
                plz VARCHAR(10) NOT NULL,
                stadt VARCHAR(100) NOT NULL,
                bundesland VARCHAR(100) NOT NULL,
                wohnflaeche DECIMAL(10,2),
                grundstueck DECIMAL(10,2),
                zimmer VARCHAR(10),
                etage VARCHAR(50),
                baujahr INT,
                balkon VARCHAR(50),
                haustyp VARCHAR(50),
                garage VARCHAR(50),
                wohneinheiten INT,
                vermietungsgrad INT,
                mieteinnahmen DECIMAL(12,2),
                vorname VARCHAR(100) NOT NULL,
                nachname VARCHAR(100) NOT NULL,
                email VARCHAR(255) NOT NULL,
                telefon VARCHAR(50),
                erstellt_am TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ";
        $pdo->exec($createTable);
        
        // Insert data
        $stmt = $pdo->prepare("
            INSERT INTO betterdeal_anfragen 
            (objekttyp, strasse, plz, stadt, bundesland, wohnflaeche, grundstueck, zimmer, etage, baujahr, 
             balkon, haustyp, garage, wohneinheiten, vermietungsgrad, mieteinnahmen, vorname, nachname, email, telefon)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $result = $stmt->execute([
            $objekttyp, $strasse, $plz, $stadt, $bundesland, 
            $wohnflaeche ?: null, $grundstueck ?: null, $zimmer ?: null, $etage ?: null, $baujahr,
            $balkon ?: null, $haustyp ?: null, $garage ?: null, 
            $wohneinheiten ?: null, $vermietungsgrad ?: null, $mieteinnahmen ?: null,
            $vorname, $nachname, $email, $telefon ?: null
        ]);
        
        if ($result) {
            $anfrage_id = $pdo->lastInsertId();
            
            // Log successful submission
            $log_entry = date('Y-m-d H:i:s') . " - BetterDeal Anfrage ID: $anfrage_id von: $vorname $nachname ($email) - $objekttyp in $plz $stadt\n";
            file_put_contents('betterdeal_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
            
            echo json_encode(['success' => true, 'message' => 'Vielen Dank! Ihre Anfrage wurde erfolgreich übermittelt. Wir melden uns zeitnah bei Ihnen mit einer kostenlosen Preiseinschätzung.']);
        } else {
            echo json_encode(['success' => false, 'errors' => ['Fehler beim Speichern der Daten']]);
        }
        
    } catch (PDOException $e) {
        // Fallback: Log to file if database is not available
        $log_entry = date('Y-m-d H:i:s') . " - BetterDeal Anfrage (DB-Fehler) von: $vorname $nachname ($email) - $objekttyp in $plz $stadt\n";
        $log_entry .= "Objektdetails: {$wohnflaeche}m², {$zimmer} Zimmer, Baujahr: {$baujahr}\n";
        if ($grundstueck) $log_entry .= "Grundstück: {$grundstueck}m²\n";
        $log_entry .= "Fehler: " . $e->getMessage() . "\n\n";
        file_put_contents('betterdeal_log.txt', $log_entry, FILE_APPEND | LOCK_EX);
        
        echo json_encode(['success' => true, 'message' => 'Vielen Dank! Ihre Anfrage wurde erfolgreich übermittelt. Wir melden uns zeitnah bei Ihnen mit einer kostenlosen Preiseinschätzung.']);
    }
}

function handleContactForm($input) {
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
}
?>

