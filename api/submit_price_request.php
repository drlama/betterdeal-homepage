<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) {
  echo json_encode(['ok'=>false,'error'=>'Ungültiges Token']); exit;
}
$dir = __DIR__.'/../storage'; if (!is_dir($dir)) mkdir($dir, 0775, true);
$file = $dir.'/requests.csv';
$fields = $_POST;
$line = [date('c')];
foreach ($fields as $k=>$v) { $line[] = str_replace(["
","",";"], [' ',' ',' '], (string)$v); }
$fp = fopen($file, file_exists($file)?'a':'w'); fputcsv($fp, $line, ';'); fclose($fp);
echo json_encode(['ok'=>true]);
