<!-- Wohnung -->
<div id="detailsWohnung" class="d-none">
  <h6 class="mb-3">Details zur Wohnung</h6>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Subtyp</label>
      <select class="form-select" name="w_subtyp">
        <option value="" selected>Bitte wählen</option>
        <option>Etagenwohnung</option><option>Erdgeschosswohnung</option><option>Dachgeschosswohnung</option><option>Maisonette</option><option>Penthouse</option><option>Loft</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Transaktionstyp</label>
      <select class="form-select" name="w_transaktion">
        <option>Verkauf</option><option>Vermietung</option>
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
      <label class="form-label">Energie-Label</label>
      <select class="form-select" name="w_energie">
        <option value="" selected>Nicht bekannt</option>
        <option>A+</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option>
      </select>
    </div>
    <div class="col-md-6"><label class="form-label">Etage</label><input type="number" class="form-control" name="w_etage" min="-3" max="60"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Etagen</label><input type="number" class="form-control" name="w_anzahl_etagen" min="1" max="60"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Zimmer</label><input type="number" class="form-control" name="w_zimmer" min="1" step="0.5"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Badezimmer</label><input type="number" class="form-control" name="w_baeder" min="0" max="20"></div>
    <div class="col-md-6"><label class="form-label">Balkon / Terrasse (m²)</label><input type="number" class="form-control" name="w_balkon" min="0" step="0.1"></div>
    <div class="col-md-6"><label class="form-label">Garten (m²)</label><input type="number" class="form-control" name="w_garten" min="0" step="0.1"></div>
    <div class="col-md-6"><label class="form-label">Garagenplätze</label><input type="number" class="form-control" name="w_garagenplaetze" min="0" max="20"></div>
    <div class="col-md-6"><label class="form-label">Außenparkplätze</label><input type="number" class="form-control" name="w_aussenplaetze" min="0" max="50"></div>
    <div class="col-md-12">
      <label class="form-label">Art der Wärmeerzeugung</label>
      <select class="form-select" name="w_waerme">
        <option value="" selected>Bitte wählen</option>
        <option>Gas</option><option>Öl</option><option>Fernwärme</option><option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option><option>Solarthermie</option><option>Sonstiges</option>
      </select>
    </div>
  </div>
</div>

<!-- Haus -->
<div id="detailsHaus" class="d-none">
  <h6 class="mb-3">Haus-Spezifikation</h6>
  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Subtyp</label>
      <select class="form-select" name="h_subtyp">
        <option value="" selected>Bitte wählen</option>
        <option>Einfamilienhaus</option><option>Doppelhaushälfte</option><option>Reihenhaus</option><option>Reihenendhaus</option><option>Bungalow</option><option>Villa</option>
      </select>
    </div>
    <div class="col-md-6">
      <label class="form-label">Transaktionstyp</label>
      <select class="form-select" name="h_transaktion">
        <option>Verkauf</option><option>Vermietung</option>
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
    <div class="col-md-6"><label class="form-label">Erbpacht</label>
      <select class="form-select" name="h_erbpacht"><option value="nein" selected>Nein</option><option value="ja">Ja</option></select>
    </div>
    <div class="col-md-6"><label class="form-label">Energie-Label</label>
      <select class="form-select" name="h_energie"><option value="" selected>Nicht bekannt</option><option>A+</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option></select>
    </div>
    <div class="col-md-6"><label class="form-label">Anzahl Etagen</label><input type="number" class="form-control" name="h_anzahl_etagen" min="1" max="6"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Zimmer</label><input type="number" class="form-control" name="h_zimmer" min="1" step="0.5"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Badezimmer</label><input type="number" class="form-control" name="h_baeder" min="0" max="20"></div>
    <div class="col-md-6"><label class="form-label">Balkon / Terrasse (m²)</label><input type="number" class="form-control" name="h_balkon" min="0" step="0.1"></div>
    <div class="col-md-6"><label class="form-label">Garagenplätze</label><input type="number" class="form-control" name="h_garagenplaetze" min="0" max="20"></div>
    <div class="col-md-6"><label class="form-label">Außenparkplätze</label><input type="number" class="form-control" name="h_aussenplaetze" min="0" max="50"></div>
    <div class="col-md-12">
      <label class="form-label">Art der Wärmeerzeugung</label>
      <select class="form-select" name="h_waerme">
        <option value="" selected>Bitte wählen</option>
        <option>Gas</option><option>Öl</option><option>Fernwärme</option><option>Wärmepumpe</option><option>Strom (Direkt)</option><option>Pellets/Holz</option><option>Solarthermie</option><option>Sonstiges</option>
      </select>
    </div>
  </div>
</div>

<!-- Mehrfamilienhaus -->
<div id="detailsMFH" class="d-none">
  <h6 class="mb-3">Mehrfamilienhaus-Spezifikation</h6>
  <div class="row g-3">
    <div class="col-md-6"><label class="form-label">Baujahr <span class="text-danger">*</span></label><input type="number" class="form-control" name="m_baujahr" min="1800" max="2100" required><div class="invalid-feedback">Bitte Baujahr angeben.</div></div>
    <div class="col-md-6"><label class="form-label">Modernisierungsjahr</label><input type="number" class="form-control" name="m_modernisierung" min="1900" max="2100"></div>
    <div class="col-md-6"><label class="form-label">Anzahl Wohneinheiten <span class="text-danger">*</span></label><input type="number" class="form-control" name="m_we" min="1" required><div class="invalid-feedback">Bitte Anzahl der Wohneinheiten angeben.</div></div>
    <div class="col-md-6"><label class="form-label">Gesamtwohnfläche (m²) <span class="text-danger">*</span></label><input type="number" class="form-control" name="m_gesamtwohnflaeche" min="1" step="0.1" required><div class="invalid-feedback">Bitte Gesamtwohnfläche angeben.</div></div>
    <div class="col-md-6"><label class="form-label">Grundstücksfläche (m²)</label><input type="number" class="form-control" name="m_grundstueck" min="0" step="0.1"></div>
    <div class="col-md-6"><label class="form-label">Energie-Label</label>
      <select class="form-select" name="m_energie"><option value="" selected>Nicht bekannt</option><option>A+</option><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option><option>G</option></select>
    </div>
    <div class="col-md-12"><label class="form-label">Jährliche Nettomieteinnahmen (EUR)</label><input type="number" class="form-control" name="m_netto_miete" min="0" step="0.01"></div>
  </div>
</div>
