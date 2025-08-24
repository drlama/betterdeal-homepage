<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Datenschutz – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head>
<body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">

<h1 class="mb-4">Datenschutzerklärung</h1>
<p>Wir nehmen den Schutz Ihrer personenbezogenen Daten sehr ernst. Diese Seite ist ein Platzhalter
und kann jederzeit durch Ihre finale Datenschutzerklärung ersetzt werden.</p>
<ul>
  <li>Verantwortlicher: PROPERTEE Real Estate GmbH, Bombardierstraße 7, 82031 Grünwald</li>
  <li>E-Mail: info@propertee.de, Telefon: +49 (0) 89 945 089 56-0</li>
  <li>Zwecke der Verarbeitung: Bearbeitung von Anfragen, Durchführung des BetterDeal-Services</li>
  <li>Rechtsgrundlagen: Art. 6 Abs. 1 lit. a, b, f DSGVO</li>
</ul>

</div>
<?php include 'includes/footer.php'; ?>
</body></html>