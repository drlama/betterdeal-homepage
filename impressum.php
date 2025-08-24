<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html><html lang="de"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Impressum – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head><body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">

<h1 class="mb-4">Impressum</h1>
<p><strong>PROPERTEE Real Estate GmbH</strong><br>
Bombardierstraße 7<br>82031 Grünwald</p>
<p><strong>Telefon:</strong> +49 (0) 89 945 089 56-0<br>
<strong>E‑Mail:</strong> info@propertee.de</p>

</div>
<?php include 'includes/footer.php'; ?>
</body></html>