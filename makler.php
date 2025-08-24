<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html><html lang="de"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Informationen für Makler – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head><body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">

<section class="py-4">
  <div class="row g-5 align-items-start">
    <div class="col-lg-7">
      <div class="section-kicker mb-1">Partnerprogramm</div>
      <h1 class="fw-bold mb-3">Informationen für <span class="brand-underline">Makler</span></h1>
      <p class="lead text-muted">BetterDeal funktioniert ausschließlich über einen <strong>zugelassenen Makler (§34c GewO)</strong> – Vertrauen & Nähe vor Ort sind entscheidend.</p>
      <ul>
        <li>Handwerker-Teams bundesweit – ein Ansprechpartner vor Ort ist dennoch wichtig.</li>
        <li>Makler kennen Kunden, Markt & Gegebenheiten und schaffen Vertrauen.</li>
      </ul>
      <h5>Zertifizierung & Schulung</h5>
      <p>Kurze Online-Schulung (ca. 1 Stunde) zu Mehrerlösvereinbarung, Verträgen und Notarablauf. Danach erhalten Sie Zugang zu Schulungsvideos.</p>
    </div>
    <div class="col-lg-5">
      <div class="card border-0 shadow-sm p-3 p-md-4">
        <h5 class="mb-3"><i class="bi bi-person-badge me-2"></i>Registrierung als Partner-Makler</h5>
        <form id="maklerForm" class="needs-validation" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES); ?>">
          <div class="mb-3"><label class="form-label">Name / Firma</label><input class="form-control" name="name" required></div>
          <div class="mb-3"><label class="form-label">Adresse</label><input class="form-control" name="adresse" required></div>
          <div class="mb-3"><label class="form-label">E-Mail</label><input type="email" class="form-control" name="email" required></div>
          <div class="mb-3"><label class="form-label">Telefon (optional)</label><input class="form-control" name="telefon"></div>
          <div class="d-grid"><button class="btn btn-primary" type="submit"><i class="bi bi-send me-1"></i> Registrierung absenden</button></div>
        </form>
      </div>
    </div>
  </div>
</section>
<script>
document.getElementById('maklerForm').addEventListener('submit', async function(e){
  e.preventDefault();
  const form = e.target;
  if(!form.checkValidity()){ form.classList.add('was-validated'); return; }
  const fd = new FormData(form);
  try{
    const r = await fetch('api/submit_makler.php', { method:'POST', headers:{'X-CSRF-Token': '<?php echo $_SESSION['csrf_token']; ?>'}, body: fd });
    const data = await r.json();
    if(data.ok){ alert('Vielen Dank! Wir haben Ihre Registrierung erhalten.'); form.reset(); }
    else { alert('Fehler: ' + (data.error || 'Unbekannt')); }
  }catch(err){ alert('Netzwerkfehler: ' + err.message); }
});
</script>

</div>
<?php include 'includes/footer.php'; ?>
</body></html>