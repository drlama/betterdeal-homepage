<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token']); exit; }
$plz = preg_replace('/\D+/', '', $_GET['postalcode'] ?? '');
$city = trim($_GET['locality'] ?? '');
if (strlen($plz)!==5 || $city==='') { echo json_encode(['ok'=>false,'error'=>'Parameter fehlen']); exit; }
$streets = [];
$page = 1; $pageSize = 250; $max = 3000;
do {
  $url = 'https://openplzapi.org/de/Streets?name=%5E.*%24&postalCode='.urlencode($plz).'&locality='.urlencode($city).'&page='.$page.'&pageSize='.$pageSize;
  $ch = curl_init();
  curl_setopt_array($ch, [CURLOPT_URL=>$url, CURLOPT_RETURNTRANSFER=>true, CURLOPT_TIMEOUT=>15, CURLOPT_HTTPHEADER=>['Accept: application/json']]);
  $resp = curl_exec($ch); $code=(int)curl_getinfo($ch, CURLINFO_HTTP_CODE); curl_close($ch);
  if ($resp===false || $code!==200) { break; }
  $data = json_decode($resp,true);
  $items = isset($data['items']) && is_array($data['items']) ? $data['items'] : [];
  foreach ($items as $it) {
    if (!empty($it['name'])) $streets[] = $it['name'];
    elseif (!empty($it['streetname'])) $streets[] = $it['streetname'];
  }
  $page++;
  if (count($streets) >= $max) break;
} while (!empty($items) && count($items) === $pageSize);
$streets = array_values(array_unique($streets));
if (empty($streets)) { echo json_encode(['ok'=>false,'error'=>'Keine Straßen gefunden']); exit; }
echo json_encode(['ok'=>true, 'streets'=>$streets]);
