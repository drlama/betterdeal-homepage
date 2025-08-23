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
    <meta name="description" content="BetterDeal renoviert Ihre Immobilie ohne Kostenrisiko – Sie profitieren vom höheren Verkaufserlös. Jetzt BetterDeal-Preis berechnen." />
    <link rel="canonical" href="/" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body>

    <!-- NAV -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
          <img src="assets/img/logo.png" height="26" alt="BetterDeal"> <span class="fw-semibold">BetterDeal</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav ms-auto align-items-lg-center">
            <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#why">Wie es funktioniert</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Kontakt</a></li>
            <li class="nav-item ms-lg-2"><button id="btnPreisrechner" class="btn btn-primary">Preisrechner</button></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- HERO -->
    <header id="home" class="hero-bg py-5">
      <div class="container">
        <div class="row align-items-center g-5">
          <div class="col-lg-6">
            <div class="badge-soft mb-3"><i class="bi bi-stars me-1"></i> Renovieren & verkaufen – ohne Risiko</div>
            <h1 class="display-5 fw-bold mb-3">Wir renovieren.<br><span class="text-bd">Sie profitieren.</span></h1>
            <p class="lead mb-4">Ihre Immobilie lässt sich im unsanierten Zustand nur schwer verkaufen? Wir übernehmen die komplette Renovierung – Sie ohne Kostenrisiko – und erzielen so einen deutlich höheren Verkaufserlös.</p>
            <div class="d-flex gap-3">
              <button id="btnPreisrechnerHero" class="btn btn-primary btn-lg"><i class="bi bi-calculator me-2"></i> BetterDeal-Preis errechnen</button>
              <a class="btn btn-outline-primary btn-lg" href="#why">Wie wir arbeiten</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="border rounded-4 shadow-sm p-3 bg-white">
              <div class="small text-muted mb-2">Vorschau</div>
              <div class="ratio ratio-16x9 bg-dark rounded-3 position-relative">
                <img src="assets/img/hero-mock.jpg" alt="Mock" class="w-100 h-100" style="object-fit:cover;">
                <div class="position-absolute bottom-0 start-0 end-0 bg-bd" style="height:40px;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- WHY -->
    <section id="why" class="py-5">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Warum <span class="text-bd">BetterDeal?</span></h2>
          <div class="text-muted">Maximaler Verkaufserlös – ohne Aufwand für Sie</div>
        </div>
        <div class="row g-3 usp">
          <div class="col-md-3">
            <div class="card p-4 h-100">
              <div class="text-bd mb-1"><i class="bi bi-house-gear fs-4"></i></div>
              <div class="fw-semibold">Komplette Renovierung</div>
              <div class="small text-muted">Planung bis Fertigstellung aus einer Hand</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-4 h-100">
              <div class="text-bd mb-1"><i class="bi bi-shield-check fs-4"></i></div>
              <div class="fw-semibold">Kein Kostenrisiko</div>
              <div class="small text-muted">Wir finanzieren die Renovierung vor</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-4 h-100">
              <div class="text-bd mb-1"><i class="bi bi-people fs-4"></i></div>
              <div class="fw-semibold">Maklerprovision inklusive</div>
              <div class="small text-muted">Besonders attraktiv für Verkäufer</div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card p-4 h-100">
              <div class="text-bd mb-1"><i class="bi bi-lightning-charge fs-4"></i></div>
              <div class="fw-semibold">Schnelle Abwicklung</div>
              <div class="small text-muted">Bewertung bis Verkauf – effizient</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="py-5">
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="fw-bold">Kontakt aufnehmen</h2>
          <div class="text-muted">Kostenlos & unverbindlich</div>
        </div>
        <div class="row g-4">
          <div class="col-lg-7">
            <form id="contactForm" class="card p-4">
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Vorname</label>
                  <div class="input-icon"><i class="bi bi-person"></i><input class="form-control" name="vorname" required></div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nachname</label>
                  <div class="input-icon"><i class="bi bi-person"></i><input class="form-control" name="nachname" required></div>
                </div>
                <div class="col-md-12">
                  <label class="form-label">E-Mail</label>
                  <div class="input-icon"><i class="bi bi-envelope"></i><input type="email" class="form-control" name="email" required></div>
                </div>
                <div class="col-md-12">
                  <label class="form-label">Nachricht</label>
                  <div class="input-icon"><i class="bi bi-chat-dots"></i><textarea class="form-control" name="nachricht" rows="4" required></textarea></div>
                </div>
              </div>
              <div class="d-grid mt-3"><button class="btn btn-primary btn-lg" type="submit">Nachricht senden</button></div>
            </form>
          </div>
          <div class="col-lg-5">
            <div class="card p-4 h-100">
              <h6 class="fw-semibold mb-2">PROPERTEE Real Estate GmbH</h6>
              <div class="text-muted small mb-3">Bornbardstraße 7, 82031 Grünwald</div>
              <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-telephone text-muted"></i><span>+49 (0)89 / 945 089 56-0</span></div>
              <div class="d-flex align-items-center gap-2 mb-2"><i class="bi bi-envelope text-muted"></i><a href="mailto:info@propertee.de">info@propertee.de</a></div>
              <div class="text-muted small">Antwort innerhalb von 24 Stunden</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer class="py-4 text-center text-muted small">
      © <?php echo date('Y'); ?> BetterDeal – Wir renovieren. Sie profitieren.
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
