<?php include __DIR__.'/includes/header.php'; ?>
<main class="container py-5">
  <h1 class="mb-4">Kontakt</h1>
  
<div class="row g-4">
  <div class="col-lg-6">
    <form class="card-soft" action="/send-contact.php" method="post">
      <h2 class="h6 mb-3">Schreiben Sie uns</h2>
      <div class="row g-3">
        <div class="col-sm-6">
          <label class="form-label">Vorname</label>
          <input name="firstname" class="form-control" required>
        </div>
        <div class="col-sm-6">
          <label class="form-label">Nachname</label>
          <input name="lastname" class="form-control" required>
        </div>
        <div class="col-sm-6">
          <label class="form-label">E‑Mail</label>
          <input name="email" type="email" class="form-control" required>
        </div>
        <div class="col-sm-6">
          <label class="form-label">Telefon (optional)</label>
          <input name="phone" class="form-control">
        </div>
        <div class="col-12">
          <label class="form-label">Nachricht</label>
          <textarea name="message" rows="5" class="form-control" required></textarea>
        </div>
        <div class="col-12 form-check mt-2">
          <input class="form-check-input" type="checkbox" value="1" id="consent" required>
          <label class="form-check-label" for="consent">
            Ich habe die <a href="/datenschutz.php" target="_blank">Datenschutzerklärung</a> gelesen und willige in die Verarbeitung meiner Angaben zum Zweck der Kontaktaufnahme ein.
          </label>
        </div>
        <div class="col-12">
          <button class="btn btn-bd mt-2">Nachricht senden</button>
          <p class="text-secondary small mt-2 mb-0">Hinweis: Die E‑Mail‑Funktion muss serverseitig konfiguriert werden (z. B. via SMTP). Der Endpunkt <code>send-contact.php</code> ist noch nicht implementiert.</p>
        </div>
      </div>
    </form>
  </div>
  <div class="col-lg-6">
    <div class="card-soft h-100">
      <h2 class="h6">Kontakt</h2>
      <p class="mb-2"><strong>PROPERTEE Real Estate GmbH</strong><br>Bomhardstraße 7<br>82031 Grünwald</p>
      <p>Telefon: +49 (0)89 / 945 089 56-0<br>E‑Mail: <a href="mailto:info@propertee.de">info@propertee.de</a></p>
      <div class="ratio ratio-16x9">
        <div class="d-flex align-items-center justify-content-center bg-light rounded">Map‑Platzhalter</div>
      </div>
    </div>
  </div>
</div>

</main>
<?php include __DIR__.'/includes/footer.php'; ?>