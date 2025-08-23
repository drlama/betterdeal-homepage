<?php
session_start();
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); }
$csrf = $_SESSION['csrf_token'];
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>BetterDeal – Wir renovieren. Sie profitieren.</title>
    <meta name="description" content="BetterDeal renoviert Ihre Immobilie auf eigene Kosten, garantiert Ihnen einen Verkaufspreis und zahlt Ihnen zusätzlich einen Bonus aus dem Mehrerlös. Jetzt BetterDeal-Preis berechnen." />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/favicon-192.png">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/" aria-label="BetterDeal">
          <img src="assets/img/logo.png" alt="BetterDeal">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav ms-auto align-items-lg-center">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#how">So funktioniert’s</a></li>
            <li class="nav-item"><a class="nav-link" href="#why">Warum BetterDeal</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <header id="home" class="hero-bg py-5">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <div class="badge-soft mb-3"><i class="bi bi-stars me-1"></i> Verkaufen trotz Sanierungsstau</div>
            <h1 class="display-5 fw-bold mb-3">Ihre Immobilie verkauft sich nicht?<br><span class="text-bd">Wir haben die Lösung.</span></h1>
            <p class="lead mb-4">BetterDeal ist der Service für Eigentümer und Makler: Wir renovieren Ihr Objekt auf unsere Kosten, garantieren Ihnen einen Verkaufspreis – und zahlen Ihnen zusätzlich einen Bonus, wenn wir durch die Renovierung einen höheren Erlös erzielen.</p>
            <div class="d-flex gap-3">
              <button id="btnPreisrechnerHero" class="btn btn-primary btn-lg"><i class="bi bi-calculator me-2"></i> Jetzt Preis berechnen</button>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="border rounded-4 shadow-sm p-3 bg-white">
              <div class="small text-muted mb-2">Video</div>
              <div class="ratio ratio-16x9 rounded-3 overflow-hidden">
                <iframe src="about:blank" title="BetterDeal Video" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section id="how" class="py-5">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="fw-bold">So funktioniert <span class="text-bd">BetterDeal</span></h2>
          <div class="text-muted">Schnell erklärt in drei Schritten</div>
        </div>
        <div class="row g-4">
          <div class="col-md-4"><div class="card p-4 h-100"><div class="text-bd mb-2"><i class="bi bi-shield-lock fs-4"></i></div><h6 class="fw-semibold">1) Preisgarantie</h6><p class="small text-muted mb-0">Mit unserem Preisrechner ermitteln Sie sofort einen garantierten Verkaufspreis – Sicherheit ohne Risiko.</p></div></div>
          <div class="col-md-4"><div class="card p-4 h-100"><div class="text-bd mb-2"><i class="bi bi-tools fs-4"></i></div><h6 class="fw-semibold">2) Renovierung auf unsere Kosten</h6><p class="small text-muted mb-0">Wir modernisieren das Objekt komplett – Planung und Umsetzung aus einer Hand.</p></div></div>
          <div class="col-md-4"><div class="card p-4 h-100"><div class="text-bd mb-2"><i class="bi bi-graph-up-arrow fs-4"></i></div><h6 class="fw-semibold">3) Verkauf mit Bonus</h6><p class="small text-muted mb-0">Erzielen wir durch die Renovierung einen höheren Erlös, erhalten Sie den Bonus aus dem Mehrerlös zusätzlich.</p></div></div>
        </div>
      </div>
    </section>

    <section id="why" class="py-5">
      <div class="container">
        <div class="text-center mb-4"><h2 class="fw-bold">Warum <span class="text-bd">BetterDeal?</span></h2><div class="text-muted">Für Eigentümer & Makler – wenn eine Immobilie im unsanierten Zustand nicht verkäuflich ist</div></div>
        <div class="row g-3 usp">
          <div class="col-md-3"><div class="card p-4 h-100"><div class="text-bd mb-1"><i class="bi bi-house-gear fs-4"></i></div><div class="fw-semibold">Komplette Renovierung</div><div class="small text-muted">Planung bis Fertigstellung aus einer Hand</div></div></div>
          <div class="col-md-3"><div class="card p-4 h-100"><div class="text-bd mb-1"><i class="bi bi-shield-check fs-4"></i></div><div class="fw-semibold">Garantierter Verkaufspreis</div><div class="small text-muted">Sicherheit durch Preisgarantie</div></div></div>
          <div class="col-md-3"><div class="card p-4 h-100"><div class="text-bd mb-1"><i class="bi bi-people fs-4"></i></div><div class="fw-semibold">Bonus aus Mehrerlös</div><div class="small text-muted">Sie profitieren doppelt: Preis + Bonus</div></div></div>
          <div class="col-md-3"><div class="card p-4 h-100"><div class="text-bd mb-1"><i class="bi bi-lightning-charge fs-4"></i></div><div class="fw-semibold">Rundum-Service</div><div class="small text-muted">Wir kümmern uns um alles – bis zum Notartermin</div></div></div>
        </div>
      </div>
    </section>

    <section id="contact" class="py-5">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Jetzt unverbindlich Kontakt aufnehmen</h2>
          <div class="text-muted">Wir melden uns innerhalb von 24 Stunden</div>
        </div>
        <div class="row g-4">
          <div class="col-lg-7">
            <form id="contactForm" class="card p-4">
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
              <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Vorname</label><div class="input-icon"><i class="bi bi-person"></i><input class="form-control" name="vorname" required></div></div>
                <div class="col-md-6"><label class="form-label">Nachname</label><div class="input-icon"><i class="bi bi-person"></i><input class="form-control" name="nachname" required></div></div>
                <div class="col-md-12"><label class="form-label">E-Mail</label><div class="input-icon"><i class="bi bi-envelope"></i><input type="email" class="form-control" name="email" required></div></div>
                <div class="col-md-12"><label class="form-label">Nachricht</label><div class="input-icon"><i class="bi bi-chat-dots"></i><textarea class="form-control" name="nachricht" rows="4" required></textarea></div></div>
              </div>
              <div class="d-grid mt-3"><button class="btn btn-primary btn-lg" type="submit">Nachricht senden</button></div>
            </form>
          </div>
          <div class="col-lg-5">
            <div class="card p-4 h-100">
              <h6 class="fw-semibold mb-2">PROPERTEE Real Estate GmbH</h6>
              <div class="text-muted small mb-3">Bomhardstraße 7, 82031 Grünwald</div>
              <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-telephone text-muted"></i><span>+49 (0)89 / 945 089 56-0</span></div>
              <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-envelope text-muted"></i><a href="mailto:info@propertee.de">info@propertee.de</a></div>
              <div class="text-muted small">Antwort innerhalb von 24 Stunden</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer-dark py-5">
      <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <div class="small">© <?php echo date('Y'); ?> BetterDeal – Wir renovieren. Sie profitieren.</div>
        <ul class="list-inline m-0 small">
          <li class="list-inline-item"><a href="impressum.php">Impressum</a></li>
          <li class="list-inline-item">·</li>
          <li class="list-inline-item"><a href="agb.php">AGB</a></li>
          <li class="list-inline-item">·</li>
          <li class="list-inline-item"><a href="widerruf.php">Widerruf</a></li>
        </ul>
      </div>
    </footer>

    <?php include 'wizard-modal.php'; ?>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index:1200;">
      <div id="toastSuccess" class="toast text-bg-success border-0"><div class="toast-body"><i class="bi bi-check2-circle me-2"></i>Vielen Dank! Wir haben Ihre Angaben erhalten.</div></div>
      <div id="toastContact" class="toast text-bg-primary border-0 mt-2"><div class="toast-body"><i class="bi bi-send-check me-2"></i>Nachricht gesendet – wir melden uns!</div></div>
    </div>

    <script>const CSRF_TOKEN = "<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>";</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>