<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<!doctype html>
<html lang="de"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>BetterDeal – Wir renovieren. Sie profitieren.</title>
<meta name="description" content="BetterDeal renoviert Ihre Immobilie ohne Kostenrisiko – Sie profitieren vom höheren Verkaufserlös. Jetzt BetterDeal-Preis berechnen.">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css">
</head>
<body class="bg-white">

<?php include 'includes/header.php'; ?>

<!-- HERO -->
<section class="hero py-5">
  <div class="container">
    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <span class="badge text-bg-light rounded-pill mb-3"><i class="bi bi-stars me-1"></i> Verkaufen trotz Sanierungsstau</span>
        <h1 class="display-5 fw-bold mb-3">
          Ihre Immobilie verkauft sich nicht?<br>
          <span class="text-bd">Wir haben die Lösung.</span><br>
          <span class="text-dark">Und den Käufer!</span>
        </h1>
        <p class="lead text-muted">BetterDeal ist der Service für Eigentümer und Makler: Wir renovieren Ihr Objekt auf unsere Kosten, garantieren Ihnen einen Verkaufspreis – und Sie profitieren zusätzlich vom Mehrerlös.</p>
        <button id="btnPreisrechnerHero2" type="button" class="btn btn-primary btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#preisrechnerModal"><i class="bi bi-calculator me-1"></i> Meinen Verkaufspreis ermitteln</button>
      </div>
      <div class="col-lg-6">
        <div class="ratio ratio-16x9 rounded-4 border d-flex align-items-center justify-content-center text-muted">
          <span>Video</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Warum BetterDeal -->
<section id="warum" class="py-4">
  <div class="container">
    <div class="text-center section-kicker mb-1">Warum</div>
    <h2 class="text-center section-title mb-4">Warum <span class="brand-underline">BetterDeal</span>?</h2>
    <p class="text-center text-muted mb-5">Maximaler Verkaufserlös ohne Aufwand für Sie</p>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-shield-lock fs-3 text-bd"></i></div>
            <h5 class="card-title">Garantierter Verkaufspreis</h5>
            <p class="mb-0">Mit unserem Preisrechner ermitteln Sie sofort einen garantierten Verkaufspreis. Den Preis haben Sie sicher – ohne Risiko.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-tools fs-3 text-bd"></i></div>
            <h5 class="card-title">Renovierung auf unsere Kosten</h5>
            <p class="mb-0">Wir modernisieren das Objekt komplett auf unsere Kosten und bieten Ihr Objekt topmodern und saniert an.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 card-hover">
          <div class="card-body">
            <div class="mb-2"><i class="bi bi-graph-up-arrow fs-3 text-bd"></i></div>
            <h5 class="card-title">Verkauf mit Bonus</h5>
            <p class="mb-0">Im neuen Glanz verkaufen wir Ihr Objekte zu einem höheren Preis als ursprünglich geplant. Je nach Mehrerlös erhalten Sie einen zusätzlichen Bonus von uns (abhängig von den Sanierungskosten).</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- So funktioniert -->
<section id="funktioniert" class="py-5">
  <div class="container">
    <div class="text-center section-kicker mb-1">Ablauf</div>
    <h2 class="text-center section-title mb-2">So funktioniert <span class="brand-underline">BetterDeal</span></h2>
    <p class="text-center text-muted mb-4">Schnell erklärt in drei Schritten</p>
    <div class="row g-4">
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-shield fs-3 text-bd"></i></div>
        <h5>1) Garantierter Verkaufspreis</h5>
        <p>Mit unserem Preisrechner ermitteln Sie sofort einen garantierten Verkaufspreis. Den Preis haben Sie sicher.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-tools fs-3 text-bd"></i></div>
        <h5>2) Renovierung auf unsere Kosten</h5>
        <p>Wir modernisieren das Objekt komplett – Planung und Umsetzung aus einer Hand.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-graph-up-arrow fs-3 text-bd"></i></div>
        <h5>3) Verkauf mit Bonus</h5>
        <p>Im neuen Glanz verkaufen wir zu einem höheren Preis. Je nach Mehrerlös erhalten Sie einen Bonus.</p>
      </div></div></div>
    </div>
  </div>
</section>

<!-- Beispielkalkulation -->
<section id="kalkulation" class="py-5 bg-light">
  <div class="container">
    <div class="row g-4 align-items-start">
      <div class="col-lg-5">
        <div class="section-kicker mb-1">Rechenbeispiel</div>
        <h2 class="section-title mb-2">Beispielkalkulation – Mehrerlös durch sanierten Verkauf</h2>
        <p class="text-muted">So könnte es aussehen, wenn wir Ihr Objekt auf unsere Kosten modernisieren und anschließend verkaufen.
          Der garantierte Verkaufspreis ist Ihre sichere Basis – am Mehrerlös beteiligen wir Sie zusätzlich.</p>
      </div>
      <div class="col-lg-7">
        <div class="card calc-card">
          <div class="calc-head d-flex align-items-center justify-content-between">
            <div class="fw-semibold">Ihre Zahlen auf einen Blick</div>
            <span class="badge rounded-pill calc-badge">Beispiel</span>
          </div>
          <div class="table-responsive">
            <table class="calc-table table align-middle">
              <tbody>
                <tr><td>Wunschpreis</td><td>300.000,00&nbsp;€</td><td class="calc-note">nicht realisierbar</td></tr>
                <tr><td>BetterDeal Ankaufspreis</td><td>280.000,00&nbsp;€</td><td class="calc-note">Garantiert</td></tr>
                <tr><td>Sanierungskosten</td><td>30.000,00&nbsp;€</td><td class="calc-note">Zahlt BetterDeal</td></tr>
                <tr><td>Verkaufspreis</td><td>420.000,00&nbsp;€</td><td class="calc-note">Objekt verkauft</td></tr>
                <tr><td>Mehrerlös</td><td>110.000,00&nbsp;€</td><td></td></tr>
                <tr class="calc-emph"><td>Sie erhalten</td><td class="sum">313.000,00&nbsp;€</td><td class="calc-note">Wir sanieren. Sie profitieren.</td></tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="small text-muted mt-2">Diese Beispielrechnung dient der Illustration. Tatsächliche Werte hängen vom Objekt, Standort und Sanierungsumfang ab.</div>
      </div>
    </div>
  </div>
</section>

<!-- Nur mit Makler -->
<section id="nur-mit-makler" class="py-5">
  <div class="container">
    <h2 class="text-center section-title mb-2"><span class="brand-underline">BetterDeal</span> – nur mit Makler</h2>
    <p class="text-center text-muted mb-4">Um Ihre Immobilie mit BetterDeal zu verkaufen benötigen Sie einen Makler dem Sie vertrauen. Haben Sie keinen, wir empfehlen einen.</p>
    <div class="row g-4">
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-people fs-3 text-bd"></i></div>
        <h5>Verständlich erklärt</h5>
        <p>Ihr Makler Ihres Vertrauens erklärt unser BetterDeal‑Konzept und ist Ihr fester Ansprechpartner.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-file-earmark-text fs-3 text-bd"></i></div>
        <h5>Verträge & Begleitung</h5>
        <p>Der Makler bespricht unsere Verträge mit Ihnen und begleitet Sie sicher durch den Prozess.</p>
      </div></div></div>
      <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body">
        <div class="mb-2"><i class="bi bi-tools fs-3 text-bd"></i></div>
        <h5>Vor Ort & Umsetzung</h5>
        <p>Der Makler führt Besichtigungen vor Ort durch und hilft bei der Koordination der Handwerker.</p>
      </div></div></div>
    </div>
  </div>
</section>

<!-- Kontakt -->
<section id="kontakt" class="py-5">
  <div class="container">
    <h2 class="section-title mb-3">Kontakt aufnehmen</h2>
    <div class="row g-4">
      <div class="col-lg-7">
        <form class="row g-3">
          <div class="col-md-6"><label class="form-label">Vorname</label><input class="form-control"></div>
          <div class="col-md-6"><label class="form-label">Nachname</label><input class="form-control"></div>
          <div class="col-12"><label class="form-label">E-Mail</label><input type="email" class="form-control"></div>
          <div class="col-12"><label class="form-label">Nachricht</label><textarea class="form-control" rows="5"></textarea></div>
          <div class="col-12"><button class="btn btn-primary">Nachricht senden</button></div>
        </form>
      </div>
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm"><div class="card-body">
          <h5 class="mb-2">PROPERTEE Real Estate GmbH</h5>
          <div>Bombardierstraße 7, 82031 Grünwald</div>
          <div class="mt-2"><i class="bi bi-telephone me-2"></i>+49 (0) 89 945 089 56-0</div>
          <div><i class="bi bi-envelope me-2"></i>info@propertee.de</div>
          <div class="text-muted small mt-2">Antwort innerhalb von 24 Stunden</div>
        </div></div>
      </div>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>

</body></html>
