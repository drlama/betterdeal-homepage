<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Informationen für Makler – BetterDeal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head>
<body class="bg-white">
<?php include 'includes/header.php'; ?>
<div class="container py-5">

<section class="py-5">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-7">
        <div class="section-kicker mb-1">Partnerprogramm</div>
        <h1 class="fw-bold mb-3">Informationen für <span class="brand-underline">Makler</span></h1>
        <p class="lead text-muted">BetterDeal funktioniert ausschließlich in Zusammenarbeit mit einem
        <strong>zugelassenen Immobilienmakler (GewO §34c)</strong>, denn Vertrauen und lokale Präsenz sind
        entscheidend für den Erfolg.</p>
        <ul class="mb-4">
          <li>Wir arbeiten bundesweit – unsere Handwerker-Teams sind in ganz Deutschland im Einsatz.</li>
          <li>Trotzdem braucht es einen <strong>Ansprechpartner vor Ort</strong>, der Käufer, Eigentümer und Standort kennt.</li>
          <li>Nur ein Makler schafft das nötige Vertrauen und die Marktkenntnis für unser Konzept.</li>
        </ul>
        <h5 class="mb-2">Zertifizierung & Schulung</h5>
        <p>Als Partner-Makler absolvieren Sie eine ca. einstündige Online-Schulung.
        Dabei erklären wir das Konzept der <em>Mehrerlösvereinbarung</em>, die Vertragswerke
        sowie die Abläufe beim Notar – praxisnah und verständlich.</p>
        <p class="mb-4">Nach erfolgreicher Registrierung erhalten Sie Zugang zu unseren Schulungsvideos und Unterlagen.</p>
      </div>
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-3 p-md-4">
          <h5 class="mb-3"><i class="bi bi-person-badge me-2"></i>Registrierung als Partner-Makler</h5>
          <form id="maklerForm" class="needs-validation" novalidate>
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES); ?>">
            <div class="mb-3">
              <label class="form-label">Name / Firma</label>
              <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Adresse</label>
              <input type="text" class="form-control" name="adresse" required>
            </div>
            <div class="mb-3">
              <label class="form-label">E-Mail</label>
              <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Telefon (optional)</label>
              <input type="text" class="form-control" name="telefon">
            </div>
            <div class="d-grid">
              <button class="btn btn-primary" type="submit"><i class="bi bi-send me-1"></i> Registrierung absenden</button>
            </div>
            <div class="form-text mt-2">Wir senden die Bestätigung an Ihre E‑Mail und melden uns zeitnah.</div>
          </form>
        </div>
      </div>
    </div>

    <hr class="my-5">

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm"><div class="card-body">
          <div class="mb-2"><i class="bi bi-people fs-3 text-bd"></i></div>
          <h5 class="card-title">Ihr Part vor Ort</h5>
          <p class="mb-0">Sie sind das Gesicht des Projekts: Kundenkontakt, Besichtigungen, Bewertung – wir liefern Renovierung & Vermarktungspower.</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm"><div class="card-body">
          <div class="mb-2"><i class="bi bi-tools fs-3 text-bd"></i></div>
          <h5 class="card-title">Sanierung aus einer Hand</h5>
          <p class="mb-0">Unsere Teams sanieren effizient und marktgerecht. Sie koordinieren Termine vor Ort und halten Eigentümer auf dem Laufenden.</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 border-0 shadow-sm"><div class="card-body">
          <div class="mb-2"><i class="bi bi-graph-up-arrow fs-3 text-bd"></i></div>
          <h5 class="card-title">Mehrwert für Ihre Kunden</h5>
          <p class="mb-0">Garantierter Verkaufspreis, professionelles Upgrade, Bonus bei Mehrerlös – ein starkes Akquise‑Argument für Makler.</p>
        </div></div>
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