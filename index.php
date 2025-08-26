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
