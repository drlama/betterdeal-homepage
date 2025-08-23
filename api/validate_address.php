<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();

$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) {
  echo json_encode(['ok' => false, 'error' => 'Ungültiges Token']); exit;
}

$raw = trim((string)($_POST['adresse'] ?? ''));
if ($raw === '') { echo json_encode(['ok'=>false, 'error'=>'Adresse fehlt']); exit; }

// Call OpenPLZ API FullTextSearch (DE) with the whole input
$endpoint = 'https://openplzapi.org/de/FullTextSearch?searchTerm='.urlencode($raw);

$ch = curl_init();
curl_setopt_array($ch, [
  CURLOPT_URL => $endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_TIMEOUT => 8,
  CURLOPT_HTTPHEADER => ['Accept: application/json']
]);
$resp = curl_exec($ch);
$err  = curl_error($ch);
$code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($resp === false || $code !== 200) {
  echo json_encode(['ok'=>false, 'error'=>'OpenPLZ nicht erreichbar']); exit;
}

$data = json_decode($resp, true);
if (!is_array($data) || empty($data['items'])) {
  echo json_encode(['ok'=>false, 'error'=>'Keine passende Adresse gefunden']); exit;
}

// Take the best hit
$item = $data['items'][0];

$street  = $item['name']         ?? null;
$plz     = $item['postalcode']   ?? null;
$local   = $item['locality']     ?? null;

if (!$street || !$plz || !$local) {
  echo json_encode(['ok'=>false, 'error'=>'Unvollständige Daten von OpenPLZ']); exit;
}

$normalized = $street.', '.$plz.' '.$local;
echo json_encode(['ok'=>true, 'normalized'=>$normalized, 'parts'=>['street'=>$street, 'plz'=>$plz, 'city'=>$local]]);
