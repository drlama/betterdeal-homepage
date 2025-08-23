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
    CURLOPT_URL=>$url, CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>15,
    CURLOPT_HTTPHEADER=>['Accept: application/json','User-Agent: BetterDeal-Server']
  ]);
  $resp = curl_exec($ch);
  $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if ($resp === false || $code < 200 || $code >= 300) return null;
  $data = json_decode($resp, true);
  if ($data === null) return null;
  return $data;
}

function extract_items($data) {
  if (!$data) return [];
  if (isset($data['items']) && is_array($data['items'])) return $data['items'];
  if (isset($data['hydra:member']) && is_array($data['hydra:member'])) return $data['hydra:member'];
  if (is_array($data) && array_keys($data) === range(0, count($data)-1)) return $data; // plain list
  return [];
}

function push_locality(&$arr, $val) {
  $val = trim((string)$val);
  if ($val !== '') $arr[] = $val;
}

$localities = [];
$base = 'https://openplzapi.org/de/';

// Try many endpoint/param variants
$urls = [
  "Localities?postalCode=$plz",
  "Localities?postalcode=$plz",
  "Localities?code=$plz",
  "PostalCodes?postalCode=$plz",
  "PostalCodes?postalcode=$plz",
  "PostalCodes?code=$plz",
  "Places?postalCode=$plz",
  "FullTextSearch?searchTerm=$plz",
];
foreach ($urls as $u) {
  $data = call_api($base.$u);
  $items = extract_items($data);
  foreach ($items as $it) {
    foreach (['locality','name','city','place','value'] as $k) {
      if (isset($it[$k]) && $it[$k]) push_locality($localities, $it[$k]);
    }
  }
  if (!empty($localities)) break;
}

$localities = array_values(array_unique($localities));

if (empty($localities)) { echo json_encode(['ok'=>false,'error'=>'Keine Orte zur PLZ gefunden.']); exit; }
echo json_encode(['ok'=>true, 'postalcode'=>$plz, 'localities'=>$localities]);
