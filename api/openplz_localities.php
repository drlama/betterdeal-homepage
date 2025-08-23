<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token']); exit; }
$plz = preg_replace('/\D+/', '', $_GET['postalcode'] ?? '');
if (strlen($plz) !== 5) { echo json_encode(['ok'=>false,'error'=>'PLZ ungültig']); exit; }

function call_api(string $url) {
  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL=>$url, CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>12,
    CURLOPT_HTTPHEADER=>['Accept: application/json']
  ]);
  $resp = curl_exec($ch);
  $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if ($resp === false || $code !== 200) return null;
  $data = json_decode($resp, true);
  if (!is_array($data)) return null;
  return $data;
}

$localities = [];
$data = call_api('https://openplzapi.org/de/Localities?postalCode='.$plz);
if (isset($data['items']) && is_array($data['items'])) {
  foreach ($data['items'] as $it) { if (!empty($it['name'])) $localities[] = $it['name']; }
}
if (empty($localities)) {
  $data = call_api('https://openplzapi.org/de/PostalCodes?postalcode='.$plz);
  if (isset($data['items']) && is_array($data['items'])) {
    foreach ($data['items'] as $it) {
      if (!empty($it['locality'])) $localities[] = $it['locality'];
      elseif (!empty($it['name'])) $localities[] = $it['name'];
    }
  }
}
if (empty($localities)) {
  $data = call_api('https://openplzapi.org/de/FullTextSearch?searchTerm='.$plz);
  if (isset($data['items']) && is_array($data['items'])) {
    foreach ($data['items'] as $it) {
      if (!empty($it['postalcode']) && $it['postalcode'] === $plz) {
        if (!empty($it['locality'])) $localities[] = $it['locality'];
        elseif (!empty($it['name'])) $localities[] = $it['name'];
      }
    }
  }
}
$localities = array_values(array_unique($localities));
if (empty($localities)) { echo json_encode(['ok'=>false,'error'=>'Keine Orte zur PLZ gefunden.']); exit; }
echo json_encode(['ok'=>true, 'postalcode'=>$plz, 'localities'=>$localities]);
