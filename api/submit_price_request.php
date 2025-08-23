<?php
// api/submit_price_request.php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();

// Basic CSRF check
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) {
  echo json_encode(['ok' => false, 'error' => 'Ungültiges Token']);
  exit;
}

// Sanitize all POST values
function clean($v) {
  if (is_array($v)) return array_map('clean', $v);
  $v = trim((string)$v);
  $v = str_replace(["\r","\n"], ' ', $v);
  return $v;
}

$data = [];
foreach ($_POST as $k => $v) {
  $data[$k] = clean($v);
}
$data['ip'] = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$data['ua'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
$data['time'] = date('c');

// Persist to CSV
$storageDir = dirname(__DIR__) . '/storage';
if (!is_dir($storageDir)) {
  mkdir($storageDir, 0775, true);
}
$csvFile = $storageDir . '/requests.csv';
$headers = array_keys($data);
$writeHeader = !file_exists($csvFile);

$fp = fopen($csvFile, 'a');
if ($writeHeader) {
  fputcsv($fp, $headers, ';');
}
// ensure order
$row = [];
foreach ($headers as $h) {
  $row[] = $data[$h] ?? '';
}
fputcsv($fp, $row, ';');
fclose($fp);

// Optionally: send an email (configure your mail() or SMTP)
// @mail('info@betterdeal.example', 'Neue Preisrechner-Anfrage', print_r($data,true));

echo json_encode(['ok' => true]);
