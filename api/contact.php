<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();

$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) {
  echo json_encode(['ok' => false, 'error' => 'Ungültiges Token']); exit;
}

function clean($v){ return str_replace(["\r","\n"], ' ', trim((string)$v)); }
$data = [
  'vorname' => clean($_POST['vorname'] ?? ''),
  'nachname' => clean($_POST['nachname'] ?? ''),
  'email' => clean($_POST['email'] ?? ''),
  'nachricht' => clean($_POST['nachricht'] ?? ''),
  'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
  'ua' => $_SERVER['HTTP_USER_AGENT'] ?? '',
  'time' => date('c'),
];

foreach (['vorname','nachname','email','nachricht'] as $k) {
  if ($data[$k] === '') { echo json_encode(['ok'=>false,'error'=>'Bitte alle Felder ausfüllen.']); exit; }
}

$storageDir = dirname(__DIR__) . '/storage';
if (!is_dir($storageDir)) mkdir($storageDir, 0775, true);
$file = $storageDir.'/contact.csv';
$writeHeader = !file_exists($file);
$f = fopen($file,'a');
if ($writeHeader) fputcsv($f, array_keys($data), ';');
fputcsv($f, array_values($data), ';');
fclose($f);

// Optional: Mail
// @mail('info@propertee.de','Neue Kontaktanfrage', print_r($data, true));

echo json_encode(['ok'=>true]);
