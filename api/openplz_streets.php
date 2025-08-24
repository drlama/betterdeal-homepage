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
function items($data) {
  if (!$data) return [];
  if (isset($data['items']) && is_array($data['items'])) return $data['items'];
  if (isset($data['hydra:member']) && is_array($data['hydra:member'])) return $data['hydra:member'];
  if (is_array($data) && array_values($data) === $data) return $data;
  return [];
}
function add_street(&$arr, $val) { $v = trim((string)$val); if ($v !== '') $arr[$v] = true; }

$streets = [];
$base = 'https://openplzapi.org/de/';

function fetch_series(&$streets, $query) {
  global $base;
  $page = 1; $limitPages = 10;
  do {
    $url = $base.$query.(strpos($query,'?')!==false? '&':'?')."page=$page";
    $data = call_api($url);
    $its = items($data);
    foreach ($its as $it) {
      foreach (['name','streetname','street','value','label'] as $k) {
        if (!empty($it[$k])) { add_street($streets, $it[$k]); break; }
      }
    }
    $page++;
  } while (!empty($its) && $page <= $limitPages);
}

$letters = array_merge(range('a','z'), ['ä','ö','ü','ß', '0','1','2','3','4','5','6','7','8','9']);
if ($locId !== '') {
  foreach ($letters as $ch) {
    $q = "Streets?localityId=".urlencode($locId)."&name=%5E".urlencode($ch).".*";
    fetch_series($streets, $q);
  }
}
if (empty($streets)) {
  foreach ($letters as $ch) {
    $q = "Streets?locality=".urlencode($city)."&postalCode=".urlencode($plz)."&name=%5E".urlencode($ch).".*";
    fetch_series($streets, $q);
  }
}
if (empty($streets) && $locId !== '') {
  foreach ($letters as $ch) {
    $q = "StreetNames?localityId=".urlencode($locId)."&name=%5E".urlencode($ch).".*";
    fetch_series($streets, $q);
  }
}
if (empty($streets)) {
  $fts = items(call_api($base."FullTextSearch?searchTerm=".urlencode("$plz $city")));
  foreach ($fts as $it) { foreach (['street','name','label','value'] as $k) if (!empty($it[$k])) add_street($streets, $it[$k]); }
}

$out = array_keys($streets); sort($out, SORT_NATURAL | SORT_FLAG_CASE);
if (empty($out)) { echo json_encode(['ok'=>false,'error'=>'Keine Straßen gefunden']); exit; }
echo json_encode(['ok'=>true, 'streets'=>$out, 'count'=>count($out)]);
