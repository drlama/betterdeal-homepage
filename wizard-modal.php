<?php ?>
<div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="wizard-header d-flex justify-content-between align-items-center">
        <div class="wizard-title"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Schließen"></button>
      </div>

      <div class="wizard-steps">
        <div class="step active" data-step="1"><span class="dot">1</span><span class="label">Adresse</span></div>
        <div class="step" data-step="2"><span class="dot">2</span><span class="label">Objekt</span></div>
        <div class="step" data-step="3"><span class="dot">3</span><span class="label">Basisdaten</span></div>
        <div class="step" data-step="4"><span class="dot">4</span><span class="label">Details</span></div>
        <div class="step" data-step="5"><span class="dot">5</span><span class="label">Zusammenfassung</span></div>
      </div>

      <div class="wizard-progress px-3">
        <div class="progress"><div id="wizardProgress" class="progress-bar" style="width:20%"></div></div>
      </div>

      <div class="wizard-body">
        <form id="preisrechnerForm" class="needs-validation" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES); ?>">

          <div class="wizard-step" data-step="1">
            <div class="row g-3">
              <div class="col-6 col-md-4">
                <label class="form-label">Postleitzahl</label>
                <input type="text" inputmode="numeric" pattern="\d{5}" maxlength="5" class="form-control" name="adr_plz" id="adr_plz" placeholder="z. B. 80807" required>
              </div>
              <div class="col-6 col-md-8">
                <label class="form-label">Ort</label>
                <select class="form-select" name="adr_ort" id="adr_ort" disabled required>
                  <option value="">Bitte PLZ eingeben</option>
                </select>
              </div>
              <div class="col-12 col-md-8">
                <label class="form-label">Straße</label>
                <select class="form-select" name="adr_strasse" id="adr_strasse" disabled required>
                  <option value="">Bitte Ort wählen</option>
                </select>
              </div>
              <div class="col-6 col-md-4">
                <label class="form-label">Hausnummer</label>
                <input type="text" class="form-control" name="adr_hnr" id="adr_hnr" placeholder="z. B. 12A" disabled required>
              </div>
              <div class="col-12">
                <div id="adr_status" class="mt-1"></div>
                <input type="hidden" name="adresse" id="adresse">
              </div>
            </div>
          </div>

          <div class="wizard-step d-none" data-step="2">
            <label class="form-label">Objektart</label>
            <div class="segment">
              <label><input class="btn-check" type="radio" name="objektart" value="wohnung" required><div class="seg"><i class="bi bi-building"></i><div>Wohnung</div></div></label>
              <label><input class="btn-check" type="radio" name="objektart" value="haus"><div class="seg"><i class="bi bi-house"></i><div>Haus</div></div></label>
              <label><input class="btn-check" type="radio" name="objektart" value="mehrfamilienhaus"><div class="seg"><i class="bi bi-buildings"></i><div>Mehrfamilienhaus</div></div></label>
            </div>
            <div class="form-text text-danger mt-2 d-none" id="objektartError">Bitte Objektart wählen.</div>
          </div>

          <div class="wizard-step d-none" data-step="3">
            <h6 class="mb-3" id="basisHeading">Basisdaten</h6>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Baujahr</label>
                <input type="number" class="form-control" name="b_baujahr" min="1800" max="2100" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Modernisierungsjahr</label>
                <input type="number" class="form-control" name="b_modernisierung" min="1900" max="2100">
              </div>
              <div class="col-md-6" id="fieldWohnflaeche">
                <label class="form-label">Wohnfläche (m²)</label>
                <input type="number" class="form-control" name="b_wohnflaeche" min="1" step="0.1">
              </div>
              <div class="col-md-6 d-none" id="fieldGrundstueck">
                <label class="form-label">Grundstücksfläche (m²)</label>
                <input type="number" class="form-control" name="b_grundstueck" min="1" step="0.1">
              </div>
              <div class="col-md-6 d-none" id="fieldWE">
                <label class="form-label">Anzahl Wohneinheiten</label>
                <input type="number" class="form-control" name="b_we" min="1">
              </div>
              <div class="col-md-6 d-none" id="fieldGesamtWF">
                <label class="form-label">Gesamtwohnfläche (m²)</label>
                <input type="number" class="form-control" name="b_gesamtwf" min="1" step="0.1">
              </div>
              <div class="col-md-6">
                <label class="form-label">Energie-Label</label>
                <select class="form-select" name="b_energie">
                  <option value="" selected>Nicht bekannt</option><option>A+</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option>
                </select>
              </div>
            </div>
          </div>

          <div class="wizard-step d-none" data-step="4">
            <div id="ausstattungWhgHaus">
              <h6 class="mb-3">Ausstattung</h6>
              <div class="row g-3">
                <div class="col-md-6"><label class="form-label">Zimmer</label><input type="number" class="form-control" name="a_zimmer" min="1" step="0.5"></div>
                <div class="col-md-6"><label class="form-label">Bäder</label><input type="number" class="form-control" name="a_baeder" min="0" max="20"></div>
                <div class="col-md-6"><label class="form-label">Balkon/Terrasse (m²)</label><input type="number" class="form-control" name="a_balkon" min="0" step="0.1"></div>
                <div class="col-md-6"><label class="form-label">Garten (m²)</label><input type="number" class="form-control" name="a_garten" min="0" step="0.1"></div>
                <div class="col-md-6"><label class="form-label">Garagenplätze</label><input type="number" class="form-control" name="a_garagen" min="0" max="20"></div>
                <div class="col-md-6"><label class="form-label">Außenparkplätze</label><input type="number" class="form-control" name="a_park" min="0" max="50"></div>
                <div class="col-md-12"><label class="form-label">Wärmeerzeugung</label>
                  <select class="form-select" name="a_waerme">
                    <option value="" selected>Bitte wählen</option>
                    <option>Gas</option><option>Öl</option><option>Fernwärme</option><option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option><option>Solarthermie</option><option>Sonstiges</option>
                  </select>
                </div>
              </div>
            </div>
            <div id="ausstattungMFH" class="d-none">
              <h6 class="mb-3">Ertragsdaten</h6>
              <div class="row g-3">
                <div class="col-md-12">
                  <label class="form-label">Nettomiete p.a. (EUR)</label>
                  <input type="number" class="form-control" name="m_netto_miete" min="0" step="0.01">
                </div>
              </div>
            </div>
          </div>

          <div class="wizard-step d-none" data-step="5">
            <h6 class="mb-3">Zusammenfassung</h6>
            <div id="summaryList" class="list-group small mb-3"></div>
            <div class="alert alert-info d-flex align-items-center">
              <i class="bi bi-info-circle me-2"></i>Wir melden uns mit einer realistischen Einschätzung und der Preisgarantie.
            </div>
          </div>
        </form>
      </div>

      <div class="wizard-footer">
        <button type="button" class="btn btn-outline-secondary" id="btnZurueck" disabled><i class="bi bi-arrow-left"></i> Zurück</button>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-secondary" id="btnAbbrechen" data-bs-dismiss="modal">Abbrechen</button>
          <button type="button" class="btn btn-primary" id="btnWeiter">Weiter</button>
          <button type="submit" class="btn btn-success d-none" id="btnSenden" form="preisrechnerForm"><i class="bi bi-send"></i> Abschicken</button>
        </div>
      </div>
    </div>
  </div>
</div>
