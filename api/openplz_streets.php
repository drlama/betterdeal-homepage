<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token']); exit; }
$plz = preg_replace('/\D+/', '', $_GET['postalcode'] ?? '');
$city = trim($_GET['locality'] ?? '');
$locId = trim($_GET['localityId'] ?? '');
if (strlen($plz)!==5 || ($city==='' && $locId==='')) { echo json_encode(['ok'=>false,'error'=>'Parameter fehlen']); exit; }

function call_api(string $url) {
  $ch = curl_init();
  curl_setopt_array($ch, [
    CURLOPT_URL=>$url, CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>20,
    CURLOPT_HTTPHEADER=>['Accept: application/json','User-Agent: BetterDeal-Server']
  ]);
  $resp = curl_exec($ch);
  $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if ($resp === false || $code < 200 || $code >= 300) return null;
  $data = json_decode($resp, true);
  return $data;
}
function extract_items($data) {
  if (!$data) return [];
  if (isset($data['items']) && is_array($data['items'])) return $data['items'];
  if (isset($data['hydra:member']) && is_array($data['hydra:member'])) return $data['hydra:member'];
  if (is_array($data) && array_values($data) === $data) return $data;
  return [];
}
function push_street(&$arr, $val) {
  $val = trim((string)$val);
  if ($val !== '') $arr[] = $val;
}

$streets = [];
$base = 'https://openplzapi.org/de/';
$try = [];

if ($locId !== '') {
  $try[] = "Streets?localityId=" . urlencode($locId);
  $try[] = "StreetNames?localityId=" . urlencode($locId);
  $try[] = "Streets?locality=" . urlencode($city) . "&postalCode=" . urlencode($plz);
} else {
  $try[] = "Streets?locality=" . urlencode($city) . "&postalCode=" . urlencode($plz);
  $try[] = "Streets?postalcode=" . urlencode($plz) . "&locality=" . urlencode($city);
}

foreach ($try as $u) {
  $page = 1; $pageSize = 250; $countAddedBefore = count($streets);
  do {
    $url = $base.$u . (strpos($u,'?')!==false ? '&' : '?') . "page=$page&pageSize=$pageSize";
    $items = extract_items(call_api($url));
    foreach ($items as $it) {
      foreach (['name','streetname','street','value','label'] as $k) {
        if (isset($it[$k]) && $it[$k] !== '') { push_street($streets, $it[$k]); break; }
      }
    }
    $page++;
  } while (!empty($items) && count($items) === $pageSize && $page <= 20);
  if (count($streets) > $countAddedBefore) break;
}

if (empty($streets)) {
  // Fallback: Volltextsuche auf PLZ + Ort, extrahiere erkennbare Straßennamen
  $ft = extract_items(call_api($base."FullTextSearch?searchTerm=".urlencode("$plz $city")));
  foreach ($ft as $it) {
    foreach (['street','name','label','value'] as $k) {
      if (isset($it[$k])) push_street($streets, $it[$k]);
    }
  }
}

$streets = array_values(array_unique($streets));
if (empty($streets)) { echo json_encode(['ok'=>false,'error'=>'Keine Straßen gefunden']); exit; }
echo json_encode(['ok'=>true, 'streets'=>$streets, 'count'=>count($streets)]);
