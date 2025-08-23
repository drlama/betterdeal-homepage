<?php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');
session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) {
  echo json_encode(['ok'=>false,'error'=>'Ungültiges Token']); exit;
}
$dir = __DIR__.'/../storage'; if (!is_dir($dir)) mkdir($dir, 0775, true);
$file = $dir.'/contact.csv';
$fields = ['vorname','nachname','email','nachricht'];
$line = [date('c')];
foreach ($fields as $k) { $line[] = str_replace(["\n","\r",";"], [' ',' ',' '], (string)($_POST[$k] ?? '')); }
$fp = fopen($file, file_exists($file)?'a':'w'); fputcsv($fp, $line, ';'); fclose($fp);
echo json_encode(['ok'=>true]);
