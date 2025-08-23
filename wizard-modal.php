<?php
// Enhanced Modal: 5-step Preisrechner Wizard (corrected MFH logic)
?>
<div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>
      <div class="modal-body">
        <div class="stepper small">
          <div class="step active" data-step="1"><span class="dot">1</span><span class="label">Adresse</span></div>
          <div class="step" data-step="2"><span class="dot">2</span><span class="label">Objektart</span></div>
          <div class="step" data-step="3"><span class="dot">3</span><span class="label">Basisdaten</span></div>
          <div class="step" data-step="4"><span class="dot">4</span><span class="label">Details</span></div>
          <div class="step" data-step="5"><span class="dot">5</span><span class="label">Zusammenfassung</span></div>
        </div>

        <div class="row g-4">
          <div class="col-lg-8">
            <div class="progress mb-3" role="progressbar"><div id="wizardProgress" class="progress-bar" style="width: 20%"></div></div>
            <form id="preisrechnerForm" class="needs-validation" novalidate>
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES); ?>">
              <!-- STEP 1 -->
              <div class="wizard-step" data-step="1">
                <label class="form-label fw-semibold">Adresse <span class="text-danger">*</span></label>
                <div class="input-icon mb-2">
                  <i class="bi bi-geo-alt"></i>
                  <input type="text" class="form-control" name="adresse" id="adresse" maxlength="120" placeholder="Straße Hausnr., PLZ Ort" required>
                </div>
                <div class="small-help"><i class="bi bi-lightbulb"></i> Tipp: Google-Places-Autocomplete kann später ergänzt werden.</div>
              </div>

              <!-- STEP 2 -->
              <div class="wizard-step d-none" data-step="2">
                <label class="form-label fw-semibold">Objektart wählen</label>
                <div class="segment">
                  <label class="w-100 d-block"><input class="btn-check" type="radio" name="objektart" id="artWohnung" value="wohnung" required><div class="seg"><i class="bi bi-building-check d-block fs-3 mb-1"></i><div class="lbl">Wohnung</div></div></label>
                  <label class="w-100 d-block"><input class="btn-check" type="radio" name="objektart" id="artHaus" value="haus"><div class="seg"><i class="bi bi-house-door d-block fs-3 mb-1"></i><div class="lbl">Haus</div></div></label>
                  <label class="w-100 d-block"><input class="btn-check" type="radio" name="objektart" id="artMFH" value="mehrfamilienhaus"><div class="seg"><i class="bi bi-building d-block fs-3 mb-1"></i><div class="lbl">Mehrfamilienhaus</div></div></label>
                </div>
                <div class="invalid-feedback d-block mt-2" id="objektartError" style="display:none;">Bitte eine Objektart auswählen.</div>
              </div>

              <!-- STEP 3: Basisdaten (type-aware) -->
              <div class="wizard-step d-none" data-step="3">
                <h6 class="mb-3" id="basisHeading">Basisdaten</h6>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label">Baujahr <span class="text-danger">*</span></label>
                    <div class="input-icon"><i class="bi bi-hammer"></i><input type="number" class="form-control" name="b_baujahr" min="1800" max="2100" required></div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Modernisierungsjahr</label>
                    <div class="input-icon"><i class="bi bi-tools"></i><input type="number" class="form-control" name="b_modernisierung" min="1900" max="2100"></div>
                  </div>

                  <!-- Wohnung/Haus -->
                  <div class="col-md-6" id="fieldWohnflaeche">
                    <label class="form-label">Wohnfläche (m²) <span class="text-danger">*</span></label>
                    <div class="input-icon"><i class="bi bi-aspect-ratio"></i><input type="number" class="form-control" name="b_wohnflaeche" min="1" step="0.1"></div>
                  </div>
                  <!-- Haus -->
                  <div class="col-md-6 d-none" id="fieldGrundstueck">
                    <label class="form-label">Grundstücksfläche (m²) <span class="text-danger">*</span></label>
                    <div class="input-icon"><i class="bi bi-bounding-box"></i><input type="number" class="form-control" name="b_grundstueck" min="1" step="0.1"></div>
                  </div>

                  <!-- MFH -->
                  <div class="col-md-6 d-none" id="fieldWE">
                    <label class="form-label">Anzahl Wohneinheiten <span class="text-danger">*</span></label>
                    <div class="input-icon"><i class="bi bi-grid-3x3-gap"></i><input type="number" class="form-control" name="b_we" min="1"></div>
                  </div>
                  <div class="col-md-6 d-none" id="fieldGesamtWF">
                    <label class="form-label">Gesamtwohnfläche (m²) <span class="text-danger">*</span></label>
                    <div class="input-icon"><i class="bi bi-diagram-3"></i><input type="number" class="form-control" name="b_gesamtwf" min="1" step="0.1"></div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Energie-Label</label>
                    <select class="form-select" name="b_energie">
                      <option value="" selected>Nicht bekannt</option><option>A+</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- STEP 4: Details (type-aware) -->
              <div class="wizard-step d-none" data-step="4">
                <!-- Wohnung/Haus Ausstattung -->
                <div id="ausstattungWhgHaus">
                  <h6 class="mb-3">Ausstattung</h6>
                  <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">Anzahl Zimmer</label><div class="input-icon"><i class="bi bi-cube"></i><input type="number" class="form-control" name="a_zimmer" min="1" step="0.5"></div></div>
                    <div class="col-md-6"><label class="form-label">Anzahl Badezimmer</label><div class="input-icon"><i class="bi bi-droplet"></i><input type="number" class="form-control" name="a_baeder" min="0" max="20"></div></div>
                    <div class="col-md-6"><label class="form-label">Balkon / Terrasse (m²)</label><div class="input-icon"><i class="bi bi-buildings"></i><input type="number" class="form-control" name="a_balkon" min="0" step="0.1"></div></div>
                    <div class="col-md-6"><label class="form-label">Garten (m²)</label><div class="input-icon"><i class="bi bi-flower1"></i><input type="number" class="form-control" name="a_garten" min="0" step="0.1"></div></div>
                    <div class="col-md-6"><label class="form-label">Garagenplätze</label><div class="input-icon"><i class="bi bi-houses"></i><input type="number" class="form-control" name="a_garagen" min="0" max="20"></div></div>
                    <div class="col-md-6"><label class="form-label">Außenparkplätze</label><div class="input-icon"><i class="bi bi-p-square"></i><input type="number" class="form-control" name="a_park" min="0" max="50"></div></div>
                    <div class="col-md-12"><label class="form-label">Art der Wärmeerzeugung</label>
                      <select class="form-select" name="a_waerme">
                        <option value="" selected>Bitte wählen</option>
                        <option>Gas</option><option>Öl</option><option>Fernwärme</option><option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option><option>Solarthermie</option><option>Sonstiges</option>
                      </select>
                    </div>
                  </div>
                </div>

                <!-- MFH Ertragsdaten -->
                <div id="ausstattungMFH" class="d-none">
                  <h6 class="mb-3">Ertragsdaten</h6>
                  <div class="row g-3">
                    <div class="col-md-12">
                      <label class="form-label">Jährliche Nettomieteinnahmen (EUR)</label>
                      <div class="input-icon"><i class="bi bi-cash-coin"></i><input type="number" class="form-control" name="m_netto_miete" min="0" step="0.01"></div>
                    </div>
                  </div>
                  <div class="small text-muted mt-2"><i class="bi bi-info-circle"></i> Optional – falls bekannt. Weitere Details stimmen wir später ab.</div>
                </div>
              </div>

              <!-- STEP 5: Zusammenfassung -->
              <div class="wizard-step d-none" data-step="5">
                <h6 class="mb-3">Zusammenfassung</h6>
                <div id="summaryList" class="list-group small mb-3"></div>
                <div class="alert alert-info d-flex align-items-center">
                  <i class="bi bi-info-circle me-2"></i>
                  Ihre Angaben werden an BetterDeal übermittelt. Wir melden uns mit einer Einschätzung.
                </div>
              </div>

              <div class="mt-4 d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-outline-secondary" id="btnZurueck" disabled>
                  <i class="bi bi-arrow-left"></i> Zurück
                </button>
                <div class="d-flex align-items-center gap-3">
                  <div class="small text-muted d-none" id="autosaveInfo"><i class="bi bi-cloud-check"></i> gespeichert</div>
                  <button type="button" class="btn btn-secondary" id="btnAbbrechen" data-bs-dismiss="modal">Abbrechen</button>
                  <button type="button" class="btn btn-primary" id="btnWeiter">Weiter</button>
                  <button type="submit" class="btn btn-success d-none" id="btnSenden"><i class="bi bi-send"></i> Abschicken</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="summary">
              <h6 class="mb-2"><i class="bi bi-journals me-1"></i> Live-Zusammenfassung</h6>
              <div id="liveSummary">
                <div class="item"><div class="k">Adresse</div><div class="v text-end" data-k="adresse">–</div></div>
                <div class="item"><div class="k">Objektart</div><div class="v text-end" data-k="objektart">–</div></div>
                <div class="item"><div class="k">Baujahr</div><div class="v text-end" data-k="b_baujahr">–</div></div>
                <div class="item"><div class="k">Fläche</div><div class="v text-end" data-k="flaeche">–</div></div>
                <div class="item"><div class="k">Energie</div><div class="v text-end" data-k="b_energie">–</div></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
