<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token ungültig']); exit; }

$name = trim($_POST['name'] ?? '');
$adresse = trim($_POST['adresse'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefon = trim($_POST['telefon'] ?? '');
if ($name==='' || $adresse==='' || $email==='') { echo json_encode(['ok'=>false,'error'=>'Bitte alle Pflichtfelder ausfüllen.']); exit; }

// Save CSV
$fields = ['ts'=>date('c'),'name'=>$name,'adresse'=>$adresse,'email'=>$email,'telefon'=>$telefon,'ip'=>($_SERVER['REMOTE_ADDR'] ?? '')];
$path = __DIR__ . '/../storage/makler_registrierungen.csv';
$isNew = !file_exists($path);
$fh = fopen($path, 'a'); if ($isNew) { fputcsv($fh, array_keys($fields)); } fputcsv($fh, array_values($fields)); fclose($fh);

// Try to send an email (adjust recipient as needed)
$to = 'info@propertee.de';
$subject = 'Neue Makler-Registrierung (BetterDeal)';
$body = "Neue Registrierung:\n\nName/Firma: $name\nAdresse: $adresse\nE-Mail: $email\nTelefon: $telefon\n";
$headers = "From: no-reply@betterdeal.local\r\nReply-To: $email\r\n";
@mail($to, $subject, $body, $headers);

echo json_encode(['ok'=>true]);
