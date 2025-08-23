<?php
// Simple session for CSRF token
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
    <title>BetterDeal – Preisrechner</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
      <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
          <img src="assets/img/logo.png" alt="BetterDeal" height="36" class="me-2">
          BetterDeal
        </a>
        <div class="ms-auto d-flex gap-2">
          <a href="#leistungen" class="btn btn-outline-secondary">Leistungen</a>
          <button id="btnPreisrechner" class="btn btn-primary">
            <i class="bi bi-calculator me-1"></i> Preisrechner
          </button>
        </div>
      </div>
    </nav>

    <header class="py-5 text-center bg-gradient">
      <div class="container">
        <h1 class="display-5 fw-semibold">Wir renovieren. Sie profitieren.</h1>
        <p class="lead text-muted">Realistische Immobilien‑Einschätzung in wenigen Schritten.</p>
        <button id="btnPreisrechnerHero" class="btn btn-lg btn-primary mt-3">
          <i class="bi bi-magic me-2"></i> BetterDeal Preisrechner starten
        </button>
      </div>
    </header>

    <main class="container my-5">
      <div class="row g-4">
        <div class="col-lg-6">
          <div class="card shadow-sm h-100">
            <div class="card-body p-4">
              <h2 class="h4">Warum BetterDeal?</h2>
              <p>Wir modernisieren Ihre Immobilie professionell und maximieren dadurch den Verkaufserlös.
              Der BetterDeal‑Preisrechner sammelt die wichtigsten Eckdaten und gibt Ihnen eine solide
              Ersteinschätzung. Im Anschluss melden wir uns mit einer detaillierten Analyse.</p>
              <ul class="list-unstyled small">
                <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Transparente, strukturierte Abfrage</li>
                <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Ajax – kein Seiten‑Reload</li>
                <li class="mb-2"><i class="bi bi-check2-circle me-2"></i>Daten werden sicher gespeichert</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card shadow-sm h-100">
            <div class="card-body p-4">
              <h2 class="h4">Kontakt</h2>
              <p class="mb-3">Sie haben Fragen? Wir sind gern für Sie da.</p>
              <dl class="row small mb-0">
                <dt class="col-4">E‑Mail</dt>
                <dd class="col-8"><a href="mailto:info@betterdeal.example">info@betterdeal.example</a></dd>
                <dt class="col-4">Telefon</dt>
                <dd class="col-8">+49 (0) 89 123 456</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal: Preisrechner Wizard -->
    <div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Progress -->
            <div class="mb-4">
              <div class="progress" role="progressbar" aria-label="Wizard fortschritt">
                <div id="wizardProgress" class="progress-bar" style="width: 33%"></div>
              </div>
              <div class="d-flex justify-content-between small text-muted mt-1">
                <span>Adresse</span>
                <span>Objektart</span>
                <span>Details</span>
              </div>
            </div>

            <form id="preisrechnerForm" class="needs-validation" novalidate>
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>">
              <!-- STEP 1: Adresse -->
              <div class="wizard-step" data-step="1">
                <div class="mb-3">
                  <label class="form-label fw-semibold">Adresse <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <input type="text" class="form-control" name="adresse" id="adresse" maxlength="120" placeholder="Geben Sie Ihre Adresse ein" required>
                  </div>
                  <div class="form-text">Optional: Karten‑Pin später integrierbar (Google Places / Leaflet).</div>
                  <div class="invalid-feedback">Bitte Adresse angeben.</div>
                </div>
              </div>

              <!-- STEP 2: Objektart -->
              <div class="wizard-step d-none" data-step="2">
                <label class="form-label fw-semibold">Objektart wählen</label>
                <div class="row g-3">
                  <div class="col-md-4">
                    <label class="w-100">
                      <input class="btn-check" type="radio" name="objektart" id="artWohnung" value="wohnung" required>
                      <div class="card selectable h-100">
                        <div class="card-body text-center py-4">
                          <i class="bi bi-building-check display-6 d-block mb-2"></i>
                          <div class="fw-semibold">Wohnung</div>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-md-4">
                    <label class="w-100">
                      <input class="btn-check" type="radio" name="objektart" id="artHaus" value="haus">
                      <div class="card selectable h-100">
                        <div class="card-body text-center py-4">
                          <i class="bi bi-house-door display-6 d-block mb-2"></i>
                          <div class="fw-semibold">Haus</div>
                        </div>
                      </div>
                    </label>
                  </div>
                  <div class="col-md-4">
                    <label class="w-100">
                      <input class="btn-check" type="radio" name="objektart" id="artMFH" value="mehrfamilienhaus">
                      <div class="card selectable h-100">
                        <div class="card-body text-center py-4">
                          <i class="bi bi-building display-6 d-block mb-2"></i>
                          <div class="fw-semibold">Mehrfamilienhaus</div>
                        </div>
                      </div>
                    </label>
                  </div>
                </div>
                <div class="invalid-feedback d-block mt-2" id="objektartError" style="display:none;">Bitte eine Objektart auswählen.</div>
              </div>

              <!-- STEP 3: Details (dynamisch je nach Objektart) -->
              <div class="wizard-step d-none" data-step="3">
                <!-- Wohnung -->
                <div id="detailsWohnung" class="d-none">
                  <h6 class="mb-3">Details zur Wohnung</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Subtyp</label>
                      <select class="form-select" name="w_subtyp">
                        <option value="" selected>Bitte wählen</option>
                        <option>Etagenwohnung</option>
                        <option>Erdgeschosswohnung</option>
                        <option>Dachgeschosswohnung</option>
                        <option>Maisonette</option>
                        <option>Penthouse</option>
                        <option>Loft</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Transaktionstyp</label>
                      <select class="form-select" name="w_transaktion">
                        <option>Verkauf</option>
                        <option>Vermietung</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Baujahr <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="w_baujahr" min="1800" max="2100" required>
                      <div class="invalid-feedback">Bitte Baujahr angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Modernisierungsjahr</label>
                      <input type="number" class="form-control" name="w_modernisierung" min="1900" max="2100">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Wohnfläche (m²) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="w_wohnflaeche" min="1" step="0.1" required>
                      <div class="invalid-feedback">Bitte Wohnfläche angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Energie‑Label</label>
                      <select class="form-select" name="w_energie">
                        <option value="" selected>Nicht bekannt</option>
                        <option>A+</option><option>A</option><option>B</option><option>C</option>
                        <option>D</option><option>E</option><option>F</option><option>G</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Etage</label>
                      <input type="number" class="form-control" name="w_etage" min="-3" max="60">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Etagen</label>
                      <input type="number" class="form-control" name="w_anzahl_etagen" min="1" max="60">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Zimmer</label>
                      <input type="number" class="form-control" name="w_zimmer" min="1" step="0.5">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Badezimmer</label>
                      <input type="number" class="form-control" name="w_baeder" min="0" max="20">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Balkon / Terrasse (m²)</label>
                      <input type="number" class="form-control" name="w_balkon" min="0" step="0.1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Garten (m²)</label>
                      <input type="number" class="form-control" name="w_garten" min="0" step="0.1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Garagenplätze</label>
                      <input type="number" class="form-control" name="w_garagenplaetze" min="0" max="20">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Außenparkplätze</label>
                      <input type="number" class="form-control" name="w_aussenplaetze" min="0" max="50">
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Art der Wärmeerzeugung</label>
                      <select class="form-select" name="w_waerme">
                        <option value="" selected>Bitte wählen</option>
                        <option>Gas</option><option>Öl</option><option>Fernwärme</option>
                        <option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option>
                        <option>Solarthermie</option><option>Sonstiges</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Haus -->
                <div id="detailsHaus" class="d-none">
                  <h6 class="mb-3">Haus‑Spezifikation</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Subtyp</label>
                      <select class="form-select" name="h_subtyp">
                        <option value="" selected>Bitte wählen</option>
                        <option>Einfamilienhaus</option>
                        <option>Doppelhaushälfte</option>
                        <option>Reihenhaus</option>
                        <option>Reihenendhaus</option>
                        <option>Bungalow</option>
                        <option>Villa</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Transaktionstyp</label>
                      <select class="form-select" name="h_transaktion">
                        <option>Verkauf</option>
                        <option>Vermietung</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Baujahr <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="h_baujahr" min="1800" max="2100" required>
                      <div class="invalid-feedback">Bitte Baujahr angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Modernisierungsjahr</label>
                      <input type="number" class="form-control" name="h_modernisierung" min="1900" max="2100">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Wohnfläche (m²) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="h_wohnflaeche" min="1" step="0.1" required>
                      <div class="invalid-feedback">Bitte Wohnfläche angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Grundstücksfläche (m²) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="h_grundstueck" min="1" step="0.1" required>
                      <div class="invalid-feedback">Bitte Grundstücksfläche angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Erbpacht</label>
                      <select class="form-select" name="h_erbpacht">
                        <option value="nein" selected>Nein</option>
                        <option value="ja">Ja</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Energie‑Label</label>
                      <select class="form-select" name="h_energie">
                        <option value="" selected>Nicht bekannt</option>
                        <option>A+</option><option>A</option><option>B</option><option>C</option>
                        <option>D</option><option>E</option><option>F</option><option>G</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Etagen</label>
                      <input type="number" class="form-control" name="h_anzahl_etagen" min="1" max="6">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Zimmer</label>
                      <input type="number" class="form-control" name="h_zimmer" min="1" step="0.5">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Badezimmer</label>
                      <input type="number" class="form-control" name="h_baeder" min="0" max="20">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Balkon / Terrasse (m²)</label>
                      <input type="number" class="form-control" name="h_balkon" min="0" step="0.1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Garagenplätze</label>
                      <input type="number" class="form-control" name="h_garagenplaetze" min="0" max="20">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Außenparkplätze</label>
                      <input type="number" class="form-control" name="h_aussenplaetze" min="0" max="50">
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Art der Wärmeerzeugung</label>
                      <select class="form-select" name="h_waerme">
                        <option value="" selected>Bitte wählen</option>
                        <option>Gas</option><option>Öl</option><option>Fernwärme</option>
                        <option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option>
                        <option>Solarthermie</option><option>Sonstiges</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- Mehrfamilienhaus -->
                <div id="detailsMFH" class="d-none">
                  <h6 class="mb-3">Mehrfamilienhaus‑Spezifikation</h6>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label">Baujahr <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="m_baujahr" min="1800" max="2100" required>
                      <div class="invalid-feedback">Bitte Baujahr angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Modernisierungsjahr</label>
                      <input type="number" class="form-control" name="m_modernisierung" min="1900" max="2100">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Anzahl Wohneinheiten <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="m_we" min="1" required>
                      <div class="invalid-feedback">Bitte Anzahl der Wohneinheiten angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Gesamtwohnfläche (m²) <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="m_gesamtwohnflaeche" min="1" step="0.1" required>
                      <div class="invalid-feedback">Bitte Gesamtwohnfläche angeben.</div>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Grundstücksfläche (m²)</label>
                      <input type="number" class="form-control" name="m_grundstueck" min="0" step="0.1">
                    </div>
                    <div class="col-md-6">
                      <label class="form-label">Energie‑Label</label>
                      <select class="form-select" name="m_energie">
                        <option value="" selected>Nicht bekannt</option>
                        <option>A+</option><option>A</option><option>B</option><option>C</option>
                        <option>D</option><option>E</option><option>F</option><option>G</option>
                      </select>
                    </div>
                    <div class="col-md-12">
                      <label class="form-label">Jährliche Nettomieteinnahmen (EUR)</label>
                      <input type="number" class="form-control" name="m_netto_miete" min="0" step="0.01">
                    </div>
                  </div>
                </div>
              </div>

              <div class="mt-4 d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" id="btnZurueck" disabled>
                  <i class="bi bi-arrow-left"></i> Zurück
                </button>
                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-secondary" id="btnAbbrechen" data-bs-dismiss="modal">Abbrechen</button>
                  <button type="button" class="btn btn-primary" id="btnWeiter">Weiter</button>
                  <button type="submit" class="btn btn-success d-none" id="btnSenden">
                    <i class="bi bi-send"></i> Abschicken
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1200">
      <div id="toastSuccess" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body"><i class="bi bi-check2-circle me-2"></i>Vielen Dank! Wir haben Ihre Angaben erhalten.</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>

    <script>
      const CSRF_TOKEN = "<?php echo htmlspecialchars($csrf, ENT_QUOTES); ?>";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/app.js"></script>
  </body>
</html>
