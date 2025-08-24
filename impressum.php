<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Impressum – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head>
<body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">
<h1 class="mb-4">Impressum</h1>
<p><strong>PROPERTEE Real Estate GmbH</strong><br>Bombardierstraße 7, 82031 Grünwald<br>Telefon: +49 (0) 89 945 089 56-0<br>E-Mail: info@propertee.de</p>
<p>Geschäftsführer: Michael Schmidt<br>Registergericht: Amtsgericht München<br>HRB: 123456<br>USt-IdNr.: DE123456789</p>
<p><a href="index.php" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Zurück</a></p>
</div>
<?php include 'includes/footer.php'; ?>
</body></html>