<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BetterDeal – Wir renovieren. Sie profitieren.</title>
  <meta name="description" content="BetterDeal renoviert Ihre Immobilie ohne Kostenrisiko – Sie profitieren vom höheren Verkaufserlös. Jetzt BetterDeal-Preis berechnen.">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php include 'includes/header.php'; ?>

<header class="hero">
  <div class="container">
    <div class="row align-items-center g-4">
      <div class="col-lg-6 order-1 order-lg-1">
        <div class="hero-badge mb-3"><i class="bi bi-magic"></i> Verkaufen trotz Sanierungsstau</div>
        <h1 class="display-5 fw-bold mb-3">Ihre Immobilie verkauft sich nicht?<br><span class="text-bd">Wir haben die Lösung.</span><br><span class="text-dark">Und den Käufer!</span></h1>
        <p class="lead text-muted">BetterDeal ist der Service für Eigentümer und Makler: Wir renovieren Ihr Objekt auf unsere Kosten, garantieren Ihnen einen Verkaufspreis – und Sie profitieren zusätzlich vom Mehrerlös.</p>
        <div class="d-flex gap-2 mt-3">
          <button id="btnPreisrechnerHero2" class="btn btn-primary btn-lg"><i class="bi bi-calculator me-1"></i> Meinen Verkaufspreis ermitteln</button>
        </div>
      </div>
      <div class="col-lg-6 order-2 order-lg-2">
        <div class="ratio ratio-16x9 rounded-4 border img-fluid">
          <!-- YouTube-Video hier einbetten -->
          <div class="d-flex align-items-center justify-content-center text-muted">Video</div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="py-5" id="warum">
  <div class="container">
    <div class="text-center section-kicker mb-1">Warum</div>
    <h2 class="text-center section-title mb-2">Warum <span class="brand-underline">BetterDeal</span>?</h2>
    <p class="text-center text-muted mb-4">Maximaler Verkaufserlös ohne Aufwand für Sie</p>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-shield-check fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Garantierter Verkaufspreis</h5>
            <p class="mb-0">Mit unserem Preisrechner ermitteln Sie sofort einen garantierten Verkaufspreis. Den Preis haben Sie sicher.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-hammer fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Renovierung auf unsere Kosten</h5>
            <p class="mb-0">Wir modernisieren das Objekt komplett auf unsere Kosten und bieten Ihr Objekt topmodern und saniert an.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-graph-up-arrow fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Verkauf mit Bonus</h5>
            <p class="mb-0">Im neuen Glanz verkaufen wir Ihr Objekt zu einem höheren Preis als ursprünglich geplant. Je nach Mehrerlös erhalten Sie einen zusätzlichen Bonus von uns (abhängig von den Sanierungskosten).</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- NEW: BetterDeal – nur mit Makler -->
<section class="py-5" id="funktioniert">
  <div class="container">
    <div class="text-center section-kicker mb-1">Ablauf</div>
    <h2 class="text-center section-title mb-2">So funktioniert <span class="brand-underline">BetterDeal</span></h2>
    <p class="text-center text-muted mb-4">Schnell erklärt in drei Schritten</p>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body">
          <div class="mb-2"><i class="bi bi-1-circle fs-3 text-bd"></i></div>
          <h5 class="card-title mb-2">1) Garantierter Verkaufspreis</h5>
          <p class="mb-0">Im Preisrechner Daten eingeben – Sie erhalten sofort Ihren garantierten Verkaufspreis.</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body">
          <div class="mb-2"><i class="bi bi-2-circle fs-3 text-bd"></i></div>
          <h5 class="card-title mb-2">2) Renovierung</h5>
          <p class="mb-0">Wir modernisieren das Objekt und bereiten den Verkauf topmodern auf – transparent und effizient.</p>
        </div></div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body">
          <div class="mb-2"><i class="bi bi-3-circle fs-3 text-bd"></i></div>
          <h5 class="card-title mb-2">3) Verkauf & Bonus</h5>
          <p class="mb-0">Verkauf zum bestmöglichen Preis – vom Mehrerlös erhalten Sie zusätzlich einen Bonus.</p>
        </div></div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" id="nur-mit-makler">
  <div class="container">
    <h2 class="text-center section-title mb-2"><span class="brand-underline">BetterDeal</span> – nur mit Makler</h2>
    <p class="text-center text-muted mb-4">Um Ihre Immobilie mit BetterDeal zu verkaufen benötigen Sie einen Makler, dem Sie vertrauen. Haben Sie keinen, empfehlen wir Ihnen gern einen.</p>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-people fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Verständlich erklärt</h5>
            <p class="mb-0">Ihr Makler Ihres Vertrauens erklärt unser BetterDeal‑Konzept und ist Ihr fester Ansprechpartner.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-file-earmark-text fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Verträge & Begleitung</h5>
            <p class="mb-0">Der Makler bespricht unsere Verträge mit Ihnen und begleitet Sie sicher durch den Prozess.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-tools fs-3 text-bd"></i></div>
            <h5 class="card-title mb-2">Vor Ort & Umsetzung</h5>
            <p class="mb-0">Der Makler führt Besichtigungen vor Ort durch und hilft bei der Koordination der Handwerker.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" id="kontakt">
  <div class="container">
    <h2 class="text-center fw-bold mb-4">Kontakt aufnehmen</h2>
    <div class="row g-4">
      <div class="col-lg-7">
        <form id="contactForm" class="card border-0 shadow-sm p-3 p-md-4">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Vorname</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nachname</label>
              <input type="text" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">E-Mail</label>
              <input type="email" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Nachricht</label>
              <textarea class="form-control" rows="5"></textarea>
            </div>
            <div class="col-12">
              <button class="btn btn-primary">Nachricht senden</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm p-3 p-md-4 h-100">
          <h5 class="mb-3">PROPERTEE Real Estate GmbH</h5>
          <p class="mb-1">Bombardierstraße 7, 82031 Grünwald</p>
          <p class="mb-1"><i class="bi bi-telephone me-1"></i> +49 (0) 89 945 089 56-0</p>
          <p class="mb-0"><i class="bi bi-envelope me-1"></i> info@propertee.de</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
<?php include 'wizard-modal.php'; ?>

<script>
const CSRF_TOKEN = "<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
