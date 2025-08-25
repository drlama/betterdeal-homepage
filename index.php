<?php session_start(); if(empty($_SESSION['csrf_token'])){$_SESSION['csrf_token']=bin2hex(random_bytes(16));} ?>
<!doctype html><html lang="de"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>BetterDeal – Wir renovieren. Sie profitieren.</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/styles.css"></head><body class="bg-white">
<?php include 'includes/header.php'; ?>
<section class="hero py-5"><div class="container"><div class="row g-4 align-items-center">
<div class="col-lg-6">
  <span class="badge text-bg-light rounded-pill mb-3"><i class="bi bi-stars me-1"></i> Verkaufen trotz Sanierungsstau</span>
  <h1 class="display-5 fw-bold mb-3">Ihre Immobilie verkauft sich nicht?<br><span class="text-bd">Wir haben die Lösung.</span><br><span class="text-dark">Und den Käufer!</span></h1>
  <p class="lead text-muted">BetterDeal: Wir renovieren auf unsere Kosten, garantieren einen Verkaufspreis – und Sie profitieren zusätzlich vom Mehrerlös.</p>
  <button id="btnPreisrechnerHero2" type="button" class="btn btn-primary btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#preisrechnerModal"><i class="bi bi-calculator me-1"></i> Meinen Verkaufspreis ermitteln</button>
</div>
<div class="col-lg-6"><div class="ratio ratio-16x9 rounded-4 border d-flex align-items-center justify-content-center text-muted"><span>Video</span></div></div>
</div></div></section>
<section id="warum" class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-light text-primary border border-primary mb-3">WARUM</span>
                <h2 class="display-5 fw-bold mb-4">
                    Warum <span class="text-primary">BetterDeal</span>?
                </h2>
                <p class="lead text-muted">Maximaler Verkaufserlös ohne Aufwand</p>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon mx-auto mb-4">
                                <i class="fas fa-shield-alt text-white"></i>
                            </div>
                            <h3 class="h4 fw-semibold mb-3">Garantierter Verkaufspreis</h3>
                            <p class="text-muted">
                                Preisrechner → garantierter Verkaufspreis. Sicher – ohne Risiko.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon mx-auto mb-4">
                                <i class="fas fa-home text-white"></i>
                            </div>
                            <h3 class="h4 fw-semibold mb-3">Renovierung auf unsere Kosten</h3>
                            <p class="text-muted">
                                Wir modernisieren komplett auf unsere Kosten. Vermarktung topmodern.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm feature-card">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon mx-auto mb-4">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <h3 class="h4 fw-semibold mb-3">Verkauf mit Bonus</h3>
                            <p class="text-muted">
                                Mehrerlös durch Sanierung → zusätzlicher Bonus (abhängig von Kosten).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="funktioniert" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <span class="badge bg-white text-primary border border-primary mb-3">ABLAUF</span>
                <h2 class="display-5 fw-bold mb-4">
                    So funktioniert <span class="text-primary">BetterDeal</span>
                </h2>
                <p class="lead text-muted">In drei Schritten</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm step-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="step-number me-3">1</div>
                                <h3 class="h5 fw-semibold mb-0">Garantierter Verkaufspreis</h3>
                            </div>
                            <p class="text-muted">
                                Daten eingeben → sofortiger garantierter Verkaufspreis.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm step-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="step-number me-3">2</div>
                                <h3 class="h5 fw-semibold mb-0">Renovierung</h3>
                            </div>
                            <p class="text-muted">
                                Wir bereiten den Verkauf transparent & effizient vor.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="card h-100 border-0 shadow-sm step-card">
                        <div class="card-body p-5">
                            <div class="d-flex align-items-center mb-4">
                                <div class="step-number me-3">3</div>
                                <h3 class="h5 fw-semibold mb-0">Verkauf & Bonus</h3>
                            </div>
                            <p class="text-muted">
                                Bestmöglicher Preis – Bonus aus dem Mehrerlös.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php include __DIR__.'/sections/kalkulation.php'; ?>
<section id="nur-mit-makler" class="py-5"><div class="container text-center">
  <h2 class="section-title"><span class="brand-underline">BetterDeal</span> – nur mit Makler</h2>
  <p class="text-muted mb-4">Für BetterDeal benötigen Sie einen Makler Ihres Vertrauens. Gern empfehlen wir einen.</p>
  <div class="row g-4 section-cards text-start">
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-people fs-3 text-bd mb-2 d-block"></i><h5>Verständlich erklärt</h5><p>Der Makler erklärt unser Konzept und ist Ihr Ansprechpartner.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-file-earmark-text fs-3 text-bd mb-2 d-block"></i><h5>Verträge & Begleitung</h5><p>Der Makler bespricht Verträge und begleitet Sie sicher.</p></div></div></div>
    <div class="col-md-4"><div class="card h-100 border-0 shadow-sm card-hover"><div class="card-body"><i class="bi bi-tools fs-3 text-bd mb-2 d-block"></i><h5>Vor Ort & Umsetzung</h5><p>Besichtigungen & Koordination der Handwerker vor Ort.</p></div></div></div>
  </div></div></section>
<section class="bd-bottom-band"></section>
<?php include 'includes/footer.php'; ?></body></html>
