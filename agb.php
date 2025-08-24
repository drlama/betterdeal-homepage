<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>AGB – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head>
<body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">
<h1 class="mb-4">Allgemeine Geschäftsbedingungen</h1>
<p>Unsere AGB gelten für alle Leistungen im Rahmen des BetterDeal-Services der PROPERTEE Real Estate GmbH. 
Diese Seite dient als Platzhalter. Den finalen Text stellen wir Ihnen auf Wunsch zur Verfügung.</p>
<p><a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Zurück</a></p>
</div>
<?php include 'includes/footer.php'; ?>
</body></html>