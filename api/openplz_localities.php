<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token']); exit; }
$plz = preg_replace('/\D+/', '', $_GET['postalcode'] ?? '');
if (strlen($plz) !== 5) { echo json_encode(['ok'=>false,'error'=>'PLZ ungültig']); exit; }
$url = 'https://openplzapi.org/de/PostalCodes?postalcode='.$plz;
$ch = curl_init();
curl_setopt_array($ch, [CURLOPT_URL=>$url, CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>8, CURLOPT_HTTPHEADER=>['Accept: application/json']]);
$resp = curl_exec($ch); $code=(int)curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
if ($resp===false || $code!==200) { echo json_encode(['ok'=>false,'error'=>'OpenPLZ Fehler']); exit; }
$data = json_decode($resp,true);
$localities = [];
if (isset($data['items'])) {
  foreach ($data['items'] as $it) {
    if (isset($it['locality'])) $localities[] = $it['locality'];
  }
  $localities = array_values(array_unique($localities));
}
echo json_encode(['ok'=>true, 'postalcode'=>$plz, 'localities'=>$localities]);
