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

      <!-- Hero Video (Click-to-Play, DSGVO-freundlich) -->
      <div class="col-lg-6">
        <div class="ratio ratio-16x9 video-wrapper rounded-3 shadow-sm"
             data-ytid="A_O5oMTj1P0" data-title="BetterDeal – Erklärvideo">
          <!-- Poster -->
          <img class="video-poster" src="https://i.ytimg.com/vi/A_O5oMTj1P0/hqdefault.jpg"
               alt="BetterDeal Video Vorschaubild">
          <!-- Play Button Overlay -->
          <button class="video-play" aria-label="Video abspielen">
            <svg viewBox="0 0 68 48" width="68" height="48" aria-hidden="true">
              <path d="M66.52 7.74a8 8 0 0 0-5.63-5.66C56.6 1 34 1 34 1s-22.6 0-26.9 1.08A8 8 0 0 0 1.48 7.74 83.2 83.2 0 0 0 0 24a83.2 83.2 0 0 0 1.48 16.26 8 8 0 0 0 5.63 5.66C11.4 47 34 47 34 47s22.6 0 26.9-1.08a8 8 0 0 0 5.63-5.66A83.2 83.2 0 0 0 68 24a83.2 83.2 0 0 0-1.48-16.26Z" fill="#f00"/>
              <path d="M45 24 27 14v20l18-10z" fill="#fff"/>
            </svg>
          </button>
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

<!-- Preisrechner Modal -->
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
              <h6 class="mb-3"><i class="bi bi-clipboard2-check me-1"></i> Live-Zusammenfassung</h6>
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

<!-- === Video Click-to-Play: Styles & Script (lokal, damit self-contained) === -->
<style>
  .video-wrapper{position:relative;background:#000;overflow:hidden}
  .video-poster{width:100%;height:100%;object-fit:cover;display:block}
  .video-play{position:absolute;inset:0;display:grid;place-items:center;background:radial-gradient(rgba(0,0,0,.35),rgba(0,0,0,.55));border:0;cursor:pointer;transition:transform .15s ease}
  .video-play svg{filter:drop-shadow(0 6px 16px rgba(0,0,0,.4))}
  .video-play:hover{transform:scale(1.02)}
  .video-wrapper iframe{border:0;width:100%;height:100%}
</style>
<script>
  document.querySelectorAll('.video-wrapper').forEach(wrap => {
    const id = wrap.dataset.ytid;
    const title = wrap.dataset.title || 'Video';
    function play(){
      const src = `https://www.youtube-nocookie.com/embed/${id}?autoplay=1&rel=0&modestbranding=1`;
      const ifr = document.createElement('iframe');
      ifr.src = src;
      ifr.title = title;
      ifr.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
      ifr.allowFullscreen = true;
      wrap.innerHTML = '';
      wrap.appendChild(ifr);
    }
    wrap.addEventListener('click', e => {
      if (e.target.closest('.video-play') || e.target.classList.contains('video-poster')) play();
    });
  });
</script>
