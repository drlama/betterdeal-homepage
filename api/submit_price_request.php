<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token ungültig']); exit; }

$fields = $_POST; $fields['ip'] = $_SERVER['REMOTE_ADDR'] ?? ''; $fields['ua'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
$path = __DIR__ . '/../storage/requests.csv';
$isNew = !file_exists($path);
$fh = fopen($path, 'a');
if ($isNew) { fputcsv($fh, array_keys($fields)); }
fputcsv($fh, array_values($fields));
fclose($fh);
echo json_encode(['ok'=>true]);
