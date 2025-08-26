<<<<<<< HEAD
<?php session_start(); if(empty($_SESSION['csrf_token'])){$_SESSION['csrf_token']=bin2hex(random_bytes(16));} ?>
<!doctype html><html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>BetterDeal – Wir renovieren. Sie profitieren.</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head><body class="bg-white">
<?php include 'includes/header.php'; ?>
<section class="hero py-5"><div class="container"><div class="row g-4 align-items-center">
<div class="col-lg-7">
  <span class="badge text-bg-light rounded-pill mb-3"><i class="bi bi-stars me-1"></i> Verkaufen trotz Sanierungsstau</span>
  <h1 class="display-5 fw-bold mb-3">Ihre Immobilie verkauft sich nicht?<br><span class="text-bd">Wir haben die Lösung.</span><br><span class="text-dark">Und den Käufer!</span></h1>
  <p class="lead text-muted">BetterDeal: Wir renovieren auf unsere Kosten, garantieren einen Verkaufspreis – und Sie profitieren zusätzlich vom Mehrerlös.</p>
  <button id="btnPreisrechnerHero2" type="button" class="btn btn-primary btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#preisrechnerModal"><i class="bi bi-calculator me-1"></i> Meinen Verkaufspreis ermitteln</button>
</div>
<div class="col-lg-5"><div class="ratio ratio-16x9 rounded-4 border d-flex align-items-center justify-content-center text-muted"><span>Video</span></div></div>
</div></div></section>
<section id="warum" class="py-4"><div class="container text-center">
  <div class="section-kicker">Warum</div><h2 class="section-title">Warum <span class="brand-underline">BetterDeal</span>?</h2><p class="text-muted mb-4">Maximaler Verkaufserlös ohne Aufwand</p>
  <div class="row g-4 section-cards text-start">
    <div class="col-md-4"><div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body"><i class="bi bi-shield-lock fs-3 text-bd mb-2 d-block"></i><h5>Garantierter Verkaufspreis</h5><p>Preisrechner → garantierter Verkaufspreis. Sicher – ohne Risiko.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body"><i class="bi bi-tools fs-3 text-bd mb-2 d-block"></i><h5>Renovierung auf unsere Kosten</h5><p>Wir modernisieren komplett auf unsere Kosten. Vermarktung topmodern.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 shadow-sm border-0 card-hover"><div class="card-body"><i class="bi bi-graph-up-arrow fs-3 text-bd mb-2 d-block"></i><h5>Verkauf mit Bonus</h5><p>Mehrerlös durch Sanierung → zusätzlicher Bonus (abhängig von Kosten).</p></div></div></div>
  </div></div></section>
<section id="funktioniert" class="py-5"><div class="container text-center">
  <div class="section-kicker">Ablauf</div><h2 class="section-title">So funktioniert <span class="brand-underline">BetterDeal</span></h2><p class="text-muted mb-4">In drei Schritten</p>
  <div class="row g-4 section-cards text-start">
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-shield fs-3 text-bd mb-2 d-block"></i><h5>1) Garantierter Verkaufspreis</h5><p>Daten eingeben → sofortiger garantierter Verkaufspreis.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-tools fs-3 text-bd mb-2 d-block"></i><h5>2) Renovierung</h5><p>Wir bereiten den Verkauf transparent & effizient vor.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-graph-up-arrow fs-3 text-bd mb-2 d-block"></i><h5>3) Verkauf & Bonus</h5><p>Bestmöglicher Preis – Bonus aus dem Mehrerlös.</p></div></div></div>
  </div></div></section>
<?php include __DIR__.'/sections/kalkulation.php'; ?>
<section id="nur-mit-makler" class="py-5"><div class="container text-center">
  <h2 class="section-title"><span class="brand-underline">BetterDeal</span> – nur mit Makler</h2>
  <p class="text-muted mb-4">Für BetterDeal benötigen Sie einen Makler Ihres Vertrauens. Gern empfehlen wir einen.</p>
  <div class="row g-4 section-cards text-start">
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-people fs-3 text-bd mb-2 d-block"></i><h5>Verständlich erklärt</h5><p>Der Makler erklärt unser Konzept und ist Ihr Ansprechpartner.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-file-earmark-text fs-3 text-bd mb-2 d-block"></i><h5>Verträge & Begleitung</h5><p>Der Makler bespricht Verträge und begleitet Sie sicher.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-tools fs-3 text-bd mb-2 d-block"></i><h5>Vor Ort & Umsetzung</h5><p>Besichtigungen & Koordination der Handwerker vor Ort.</p></div></div></div>
  </div></div></section>
<section id="kontakt" class="py-5"><div class="container"><h2 class="section-title mb-3">Kontakt aufnehmen</h2>
  <div class="row g-4"><div class="col-lg-7"><form class="row g-3">
    <div class="col-md-6"><label class="form-label">Vorname</label><input class="form-control"></div>
    <div class="col-md-6"><label class="form-label">Nachname</label><input class="form-control"></div>
    <div class="col-12"><label class="form-label">E-Mail</label><input type="email" class="form-control"></div>
    <div class="col-12"><label class="form-label">Nachricht</label><textarea class="form-control" rows="5"></textarea></div>
    <div class="col-12"><button class="btn btn-primary">Nachricht senden</button></div>
  </form></div><div class="col-lg-5"><div class="card border-0 shadow-sm"><div class="card-body">
    <h5 class="mb-2">PROPERTEE Real Estate GmbH</h5><div>Bombardierstraße 7, 82031 Grünwald</div>
    <div class="mt-2"><i class="bi bi-telephone me-2"></i>+49 (0) 89 945 089 56-0</div><div><i class="bi bi-envelope me-2"></i>info@propertee.de</div>
    <div class="text-muted small mt-2">Antwort innerhalb von 24 Stunden</div>
  </div></div></div></div>
</div></section>
<?php include 'includes/footer.php'; ?></body></html>
=======
<?php include __DIR__.'/includes/header.php'; ?>

<main>
  <!-- Hero -->
  <section class="container py-5">
    <div class="row align-items-center g-4">
      <div class="col-lg-6">
        <div class="badge-pill mb-3"><i class="bi bi-stars me-2"></i>Verkaufen trotz Sanierungsstau</div>
        <h1 class="display-6 fw-bold lh-tight mb-3">
          Ihre Immobilie verkauft sich nicht?<br>
          <span class="text-bd">Wir haben die Lösung.</span><br>
          <span class="hero-sub">Und den Käufer!</span>
        </h1>
        <p class="lead text-secondary">
          BetterDeal ist der Service für Eigentümer und Makler: Wir renovieren Ihr Objekt auf unsere Kosten,
          garantieren Ihnen einen Verkaufspreis – und Sie profitieren zusätzlich vom Mehrerlös.
        </p>
        <button class="btn btn-bd btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#preisrechnerModal">
          <i class="bi bi-calculator"></i> Meinen Verkaufspreis ermitteln
        </button>
      </div>
      <div class="col-lg-6">
        <div class="video-placeholder rounded-3 d-flex align-items-center justify-content-center">
          <span class="text-secondary">Video</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Warum -->
  <section id="warum" class="bd-section">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge-pill">Warum</span>
        <h2 class="mt-2">Warum <span class="text-bd">BetterDeal</span>?</h2>
        <p class="text-secondary small">Maximaler Verkaufserlös ohne Aufwand</p>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-soft text-center h-100">
            <div class="feature-icon mx-auto"><i class="fas fa-shield-alt"></i></div>
            <h5>Garantierter Verkaufspreis</h5>
            <p class="text-secondary small mb-0">Preisrechner → garantierter Verkaufspreis. Sicher – ohne Risiko.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft text-center h-100">
            <div class="feature-icon mx-auto"><i class="fas fa-home"></i></div>
            <h5>Renovierung auf unsere Kosten</h5>
            <p class="text-secondary small mb-0">Wir modernisieren komplett auf unsere Kosten. Vermarktung topmodern.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft text-center h-100">
            <div class="feature-icon mx-auto"><i class="fas fa-chart-line"></i></div>
            <h5>Verkauf mit Bonus</h5>
            <p class="text-secondary small mb-0">Mehrerlös durch Sanierung → zusätzlicher Bonus (abhängig von Kosten).</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Ablauf -->
  <section id="ablauf" class="bd-section bg-light">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge-pill">Ablauf</span>
        <h2 class="mt-2">So funktioniert <span class="text-bd">BetterDeal</span></h2>
        <p class="text-secondary small">In drei Schritten</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><div class="step-badge">1</div><strong>Garantierter Verkaufspreis</strong></div>
            <p class="text-secondary small mb-0">Daten eingeben → sofortiger garantierter Verkaufspreis.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><div class="step-badge">2</div><strong>Renovierung</strong></div>
            <p class="text-secondary small mb-0">Wir bereiten den Verkauf transparent & effizient vor.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><div class="step-badge">3</div><strong>Verkauf & Bonus</strong></div>
            <p class="text-secondary small mb-0">Bestmöglicher Preis – Bonus aus dem Mehrerlös.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Beispielkalkulation -->
  <section id="kalkulation" class="bd-section">
    <div class="container">
      <div class="text-center mb-4">
        <span class="badge-pill">Rechenbeispiel</span>
        <h2 class="mt-2">Beispielkalkulation – Mehrerlös durch sanierten Verkauf</h2>
        <p class="text-secondary small">Garantierter Preis als sichere Basis – Mehrerlös-Beteiligung on top.</p>
      </div>

      <div class="calc-table col-12 col-md-8 mx-auto">
        <div class="calc-row"><span class="label">Wunschpreis</span><span>300.000,00 € <small class="text-secondary">nicht realisierbar</small></span></div>
        <div class="calc-row"><span class="label">BetterDeal Ankaufspreis</span><span class="calc-accent-2">280.000,00 € <small class="text-secondary">Garantiert</small></span></div>
        <div class="calc-row"><span class="label">Sanierungskosten</span><span>30.000,00 € <small class="text-secondary">Zahlt BetterDeal</small></span></div>
        <div class="calc-row"><span class="label">Verkaufspreis</span><span class="calc-accent">420.000,00 € <small class="text-secondary">Objekt verkauft</small></span></div>
        <div class="calc-row"><span class="label">Mehrerlös</span><span>110.000,00 €</span></div>
        <div class="calc-cta">Sie erhalten <span class="ms-2">313.000,00 €</span></div>
      </div>
    </div>
  </section>

  <!-- Makler-Block -->
  <section id="makler" class="bd-section bg-light">
    <div class="container">
      <div class="text-center mb-4">
        <h3>BetterDeal – <span class="text-bd">nur mit Makler</span></h3>
        <p class="text-secondary small">Um Ihre Immobilie mit BetterDeal zu verkaufen benötigen Sie einen Makler, dem Sie vertrauen. Haben Sie keinen, empfehlen wir Ihnen gern einen.</p>
      </div>
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-megaphone-fill text-bd"></i><strong>Verständlich erklärt</strong></div>
            <p class="text-secondary small mb-0">Ihr Makler Ihres Vertrauens erklärt unser BetterDeal-Konzept und ist Ihr fester Ansprechpartner.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-file-earmark-text-fill text-bd"></i><strong>Verträge & Begleitung</strong></div>
            <p class="text-secondary small mb-0">Der Makler bespricht unsere Verträge mit Ihnen und begleitet Sie sicher durch den Prozess.</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-soft h-100">
            <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-geo-alt-fill text-bd"></i><strong>Vor Ort & Umsetzung</strong></div>
            <p class="text-secondary small mb-0">Der Makler führt Besichtigungen vor Ort durch und hilft bei der Koordination der Handwerker.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Preisrechner Modal (funktionierend) -->
<div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>
      <div class="modal-body">
        <div class="row g-4">
          <div class="col-lg-8">
            <!-- Wizard Step Placeholder -->
            <div class="wizard-step">
              <div class="mb-3 small text-secondary">Schritt 1 von 5: Adresse</div>
              <div class="row g-3">
                <div class="col-6">
                  <label class="form-label">PLZ</label>
                  <input type="text" class="form-control" placeholder="z. B. 80807">
                </div>
                <div class="col-6">
                  <label class="form-label">Ort</label>
                  <input type="text" class="form-control" placeholder="Ort wählen">
                </div>
                <div class="col-8">
                  <label class="form-label">Straße</label>
                  <input type="text" class="form-control" placeholder="Straße wählen">
                </div>
                <div class="col-4">
                  <label class="form-label">Hausnummer</label>
                  <input type="text" class="form-control" placeholder="z. B. 12A">
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="summary card-soft">
              <h6 class="mb-3"><i class="bi bi-clipboard2-check me-1"></i> Live‑Zusammenfassung</h6>
              <ul class="list-unstyled small">
                <li class="d-flex justify-content-between border-bottom py-2"><span class="text-secondary">Adresse</span><span>–</span></li>
                <li class="d-flex justify-content-between border-bottom py-2"><span class="text-secondary">Objektart</span><span>–</span></li>
                <li class="d-flex justify-content-between border-bottom py-2"><span class="text-secondary">Baujahr</span><span>–</span></li>
                <li class="d-flex justify-content-between border-bottom py-2"><span class="text-secondary">Fläche</span><span>–</span></li>
                <li class="d-flex justify-content-between py-2"><span class="text-secondary">Energie</span><span>–</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button class="btn btn-bd">Weiter</button>
      </div>
    </div>
  </div>
</div>

<?php include __DIR__.'/includes/footer.php'; ?>
>>>>>>> parent of 660f894 (a)
