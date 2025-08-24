<?php declare(strict_types=1); header('Content-Type: application/json; charset=utf-8'); session_start();
$headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? ''; if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $headerToken)) { echo json_encode(['ok'=>false,'error'=>'Token ungültig']); exit; }
$name=trim($_POST['name']??''); $adresse=trim($_POST['adresse']??''); $email=trim($_POST['email']??''); $telefon=trim($_POST['telefon']??'');
if($name===''||$adresse===''||$email===''){ echo json_encode(['ok'=>false,'error'=>'Bitte alle Pflichtfelder ausfüllen.']); exit; }
$fields=['ts'=>date('c'),'name'=>$name,'adresse'=>$adresse,'email'=>$email,'telefon'=>$telefon,'ip'=>($_SERVER['REMOTE_ADDR']??'')];
$path=__DIR__.'/../storage/makler_registrierungen.csv'; $isNew=!file_exists($path); $fh=fopen($path,'a'); if($isNew){ fputcsv($fh,array_keys($fields)); } fputcsv($fh,array_values($fields)); fclose($fh);
@mail('info@propertee.de','Neue Makler-Registrierung (BetterDeal)',"Neue Registrierung:\n$name\n$adresse\n$email\n$telefon","From: no-reply@betterdeal.local\r\n"); echo json_encode(['ok'=>true]);