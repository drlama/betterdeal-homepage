<?php
// BetterDeal Preisrechner (Wizard) – Bootstrap Modal
?>
<div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-labelledby="preisrechnerLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="preisrechnerLabel"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>
      <div class="modal-body">
        <div class="d-lg-flex gap-4">
          <div class="flex-grow-1">
            <!-- Steps nav -->
            <ol class="wizard-steps mb-3">
              <li class="active"><span>Adresse</span></li>
              <li><span>Objektart</span></li>
              <li><span>Basisdaten</span></li>
              <li><span>Details</span></li>
              <li><span>Zusammenfassung</span></li>
            </ol>

            <!-- Step 1: Adresse -->
            <form id="step1" class="wizard-step needs-validation" novalidate>
              <div class="row g-3">
                <div class="col-6 col-md-4">
                  <label class="form-label">Postleitzahl</label>
                  <input type="text" pattern="\d{5}" maxlength="5" class="form-control" id="plz" required>
                  <div class="invalid-feedback">Bitte eine gültige PLZ eingeben.</div>
                </div>
                <div class="col-6 col-md-8">
                  <label class="form-label">Ort</label>
                  <div class="input-group">
                    <select class="form-select" id="ortSelect" required>
                      <option value="">Bitte PLZ eingeben</option>
                    </select>
                    <button class="btn btn-outline-primary d-none d-sm-inline" type="button" id="reloadOrte"><i class="bi bi-arrow-repeat"></i></button>
                  </div>
                  <div class="form-text"><i class="bi bi-info-circle me-1"></i>Orte werden über die OpenPLZ API geladen.</div>
                </div>
                <div class="col-md-8">
                  <label class="form-label">Straße</label>
                  <div class="input-group">
                    <select class="form-select" id="strasseSelect">
                      <option value="">Bitte Ort wählen</option>
                    </select>
                    <button class="btn btn-outline-primary" type="button" id="btnManuelleStrasse">Manuell</button>
                  </div>
                  <div id="streetHelp" class="form-text">Klappt die Auswahl nicht? „Manuell“ wählen und eintippen.</div>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Hausnummer</label>
                  <input type="text" class="form-control" id="hausnr" placeholder="z. B. 12A" required>
                </div>
              </div>
            </form>

            <!-- Step 2: Objektart -->
            <form id="step2" class="wizard-step d-none">
              <div class="row g-3">
                <div class="col-md-4">
                  <input class="btn-check" type="radio" name="typ" id="typWhg" value="wohnung" autocomplete="off" checked>
                  <label class="btn btn-outline-primary w-100 py-3" for="typWhg"><i class="bi bi-building me-2"></i>Wohnung</label>
                </div>
                <div class="col-md-4">
                  <input class="btn-check" type="radio" name="typ" id="typHaus" value="haus" autocomplete="off">
                  <label class="btn btn-outline-primary w-100 py-3" for="typHaus"><i class="bi bi-house-door me-2"></i>Haus</label>
                </div>
                <div class="col-md-4">
                  <input class="btn-check" type="radio" name="typ" id="typMfh" value="mehrfamilienhaus" autocomplete="off">
                  <label class="btn btn-outline-primary w-100 py-3" for="typMfh"><i class="bi bi-buildings me-2"></i>Mehrfamilienhaus</label>
                </div>
              </div>
            </form>

            <!-- Step 3: Basisdaten (conditional fields) -->
            <form id="step3" class="wizard-step d-none">
              <div id="fieldsContainer" class="row g-3"></div>
            </form>

            <!-- Step 4: Details -->
            <form id="step4" class="wizard-step d-none">
              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Besonderheiten</label>
                  <textarea class="form-control" id="notes" rows="4" placeholder="z. B. Lage, Zustand, Besonderheiten"></textarea>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Kontakt</label>
                  <input class="form-control mb-2" id="cntName" placeholder="Ihr Name">
                  <input type="email" class="form-control mb-2" id="cntMail" placeholder="E-Mail">
                  <input class="form-control" id="cntTel" placeholder="Telefon (optional)">
                </div>
              </div>
            </form>

            <!-- Step 5: Zusammenfassung -->
            <div id="step5" class="wizard-step d-none">
              <div class="alert alert-light border">
                <h6 class="mb-2">Vielen Dank! Wir melden uns kurzfristig mit einer Ersteinschätzung.</h6>
                <div id="summaryPreview" class="small text-muted"></div>
              </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
              <button class="btn btn-outline-primary" id="btnBack"><i class="bi bi-arrow-left"></i> Zurück</button>
              <div class="d-flex gap-2">
                <button class="btn btn-secondary" id="btnCancel" data-bs-dismiss="modal">Abbrechen</button>
                <button class="btn btn-primary" id="btnNext">Weiter</button>
              </div>
            </div>
          </div>

          <!-- Right rail summary -->
          <aside class="d-none d-lg-block" style="width:320px;">
            <div class="card shadow-sm border-0">
              <div class="card-body">
                <h6 class="mb-3"><i class="bi bi-journal-text me-2"></i>Live‑Zusammenfassung</h6>
                <dl class="row small mb-0" id="liveSummary"></dl>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </div>
</div>
