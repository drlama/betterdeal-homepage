<?php
// Modal: Preisrechner Wizard (partial)
?>
<div class="modal fade" id="preisrechnerModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="bi bi-calculator me-2"></i>BetterDeal Preisrechner</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-4">
          <div class="progress" role="progressbar" aria-label="Wizard fortschritt">
            <div id="wizardProgress" class="progress-bar" style="width: 33%"></div>
          </div>
          <div class="d-flex justify-content-between small text-muted mt-1">
            <span>Adresse</span><span>Objektart</span><span>Details</span>
          </div>
        </div>

        <form id="preisrechnerForm" class="needs-validation" novalidate>
          <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'] ?? '', ENT_QUOTES); ?>">
          <!-- STEP 1 -->
          <div class="wizard-step" data-step="1">
            <label class="form-label fw-semibold">Adresse <span class="text-danger">*</span></label>
            <div class="input-icon mb-2">
              <i class="bi bi-geo-alt"></i>
              <input type="text" class="form-control" name="adresse" id="adresse" maxlength="120" placeholder="Geben Sie Ihre Adresse ein" required>
            </div>
            <div class="small-help">Sie können später optional eine Kartenfunktion integrieren (Google Places / Leaflet).</div>
            <div class="invalid-feedback">Bitte Adresse angeben.</div>
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

          <!-- STEP 3 – Details sections (unchanged from v2) -->
          <div class="wizard-step d-none" data-step="3">
            <?php include 'wizard-details.php'; ?>
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
