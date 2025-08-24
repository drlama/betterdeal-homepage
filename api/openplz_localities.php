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
  return $data;
}
function extract_items($data) {
  if (!$data) return [];
  if (isset($data['items']) && is_array($data['items'])) return $data['items'];
  if (isset($data['hydra:member']) && is_array($data['hydra:member'])) return $data['hydra:member'];
  if (is_array($data) && array_values($data) === $data) return $data;
  return [];
}
function val($rec, $keys) {
  foreach ($keys as $k) { if (isset($rec[$k]) && $rec[$k] !== '') return (string)$rec[$k]; }
  return '';
}

$localities = []; $records = [];
$base = 'https://openplzapi.org/de/';
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
  $items = extract_items(call_api($base.$u));
  foreach ($items as $it) {
    $name = val($it, ['locality','name','city','place','value','label']);
    $id   = val($it, ['id','localityId','identifier','@id']);
    if ($name !== '') { $localities[] = $name; $records[] = ['name'=>$name,'id'=>$id]; }
  }
  if (!empty($localities)) break;
}
$localities = array_values(array_unique($localities));
$map = []; foreach ($records as $r) { $map[$r['name']] = $r['id']; }
$records = []; foreach ($map as $n=>$i) { $records[] = ['name'=>$n,'id'=>$i]; }

if (empty($localities)) { echo json_encode(['ok'=>false,'error'=>'Keine Orte zur PLZ gefunden.']); exit; }
echo json_encode(['ok'=>true, 'postalcode'=>$plz, 'localities'=>$localities, 'records'=>$records]);
