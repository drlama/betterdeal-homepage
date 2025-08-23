<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf = $_SESSION['csrf_token'];
?>
<!doctype html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BetterDeal – Wir renovieren. Sie profitieren.</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>
  <!-- NAV -->
  <nav class="navbar navbar-expand-lg py-3">
    <div class="container">
      <a class="navbar-brand fw-semibold d-flex align-items-center" href="#">
        <img src="assets/img/logo.png" height="30" class="me-2" alt="BetterDeal"> BetterDeal
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
          <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#how">Wie es funktioniert</a></li>
          <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
          <li class="nav-item ms-lg-3">
            <button id="btnPreisrechner" class="btn btn-primary"><i class="bi bi-calculator me-1"></i> Preisrechner</button>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header id="home" class="hero py-5">
    <div class="container">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <span class="badge-soft px-3 py-2 small mb-3 d-inline-block">
            <i class="bi bi-stars me-1"></i> Renovieren & verkaufen – ohne Risiko
          </span>
          <h1 class="display-4 mb-3">Wir renovieren.<br><span style="color:var(--bd-primary)">Sie profitieren.</span></h1>
          <p class="lead mb-4">Ihre Immobilie lässt sich im unsanierten Zustand nur schwer verkaufen? Wir übernehmen die komplette Renovierung – Sie ohne Kostenrisiko – und erzielen so einen deutlich höheren Verkaufserlös.</p>
          <div class="d-flex gap-3 align-items-center">
            <button id="btnPreisrechnerHero" class="btn btn-primary btn-lg"><i class="bi bi-cash-stack me-2"></i> BetterDeal-Preis errechnen</button>
            <a href="#how" class="btn btn-outline-primary btn-lg">Wie wir arbeiten</a>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="mockup">
            <div class="d-flex align-items-center gap-2 pb-2">
              <img src="assets/img/logo.png" height="20" alt="">
              <div class="small text-muted">Vorschau</div>
            </div>
            <div class="screen">
              <img src="assets/img/hero-mock.jpg" alt="Vorschau">
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- WHY / USP -->
  <section id="how" class="py-5">
    <div class="container">
      <div class="section-title text-center mb-4">
        <h2>Warum <span style="color:var(--bd-primary)">BetterDeal?</span></h2>
        <p>Maximaler Verkaufserlös – ohne Aufwand für Sie</p>
      </div>
      <div class="row usp g-4">
        <div class="col-md-3">
          <div class="card p-4 h-100">
            <div class="icon"><i class="bi bi-house-gear"></i></div>
            <h6 class="fw-semibold mb-1">Komplette Renovierung</h6>
            <div class="text-muted small">Planung bis Fertigstellung aus einer Hand</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-4 h-100">
            <div class="icon"><i class="bi bi-shield-check"></i></div>
            <h6 class="fw-semibold mb-1">Kein Kostenrisiko</h6>
            <div class="text-muted small">Wir finanzieren die Renovierung vor</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-4 h-100">
            <div class="icon"><i class="bi bi-people"></i></div>
            <h6 class="fw-semibold mb-1">Maklerprovision inklusive</h6>
            <div class="text-muted small">Besonders attraktiv für Verkäufer</div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-4 h-100">
            <div class="icon"><i class="bi bi-lightning-charge"></i></div>
            <h6 class="fw-semibold mb-1">Schnelle Abwicklung</h6>
            <div class="text-muted small">Bewertung bis Verkauf – effizient</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="py-5">
    <div class="container">
      <div class="section-title text-center mb-4">
        <h2>Kontakt aufnehmen</h2>
        <p>Kostenlos & unverbindlich</p>
      </div>
      <div class="row g-4">
        <div class="col-lg-7">
          <form id="contactForm" class="card p-4">
            <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Vorname</label>
                <div class="input-icon">
                  <i class="bi bi-person"></i>
                  <input class="form-control" name="vorname" required>
                </div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Nachname</label>
                <div class="input-icon">
                  <i class="bi bi-person"></i>
                  <input class="form-control" name="nachname" required>
                </div>
              </div>
              <div class="col-md-12">
                <label class="form-label">E-Mail</label>
                <div class="input-icon">
                  <i class="bi bi-envelope"></i>
                  <input type="email" class="form-control" name="email" required>
                </div>
              </div>
              <div class="col-md-12">
                <label class="form-label">Nachricht</label>
                <div class="input-icon">
                  <i class="bi bi-chat-dots"></i>
                  <textarea class="form-control" name="nachricht" rows="4" required></textarea>
                </div>
              </div>
            </div>
            <div class="d-grid mt-3">
              <button class="btn btn-primary btn-lg" type="submit">Nachricht senden</button>
            </div>
          </form>
        </div>
        <div class="col-lg-5">
          <div class="card p-4 h-100">
            <h6 class="fw-semibold mb-2">PROPERTEE Real Estate GmbH</h6>
            <div class="text-muted small mb-3">Bornbardstraße 7, 82031 Grünwald</div>
            <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-telephone text-muted"></i> <span>+49 (0)89 / 945 089 56-0</span></div>
            <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-envelope text-muted"></i> <a href="mailto:info@propertee.de">info@propertee.de</a></div>
            <div class="text-muted small">Antwort innerhalb von 24 Stunden</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer py-4 text-center text-muted small">
    <div class="container">© <?php echo date('Y'); ?> BetterDeal – Wir renovieren. Sie profitieren.</div>
  </footer>

  <?php include 'wizard-modal.php'; ?>

  <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1200">
    <div id="toastSuccess" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body"><i class="bi bi-check2-circle me-2"></i>Vielen Dank! Wir haben Ihre Angaben erhalten.</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
    <div id="toastContact" class="toast align-items-center text-bg-primary border-0 mt-2" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body"><i class="bi bi-send-check me-2"></i>Nachricht gesendet – wir melden uns!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>

  <script>const CSRF_TOKEN = "<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>";</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>
