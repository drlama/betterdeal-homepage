# BetterDeal PHP + Bootstrap + Ajax Preisrechner

**Schnellstart**

1. Dateien auf Ihren Webserver kopieren (PHP 8 empfohlen).
2. `storage/` muss für den Webserver schreibbar sein (755 oder 775).  
3. `index.php` im Browser öffnen und den Button **Preisrechner** klicken.
4. Nach dem Absenden finden Sie die Daten in `storage/requests.csv`.

**Anpassungen**

- Logo austauschen: `assets/img/logo.png`
- E-Mail Versand aktivieren: `api/submit_price_request.php` – `mail()` konfigurieren oder per SMTP versenden.
- Felder erweitern/ändern: `index.php` (Formular) + ggf. `assets/js/app.js` (Validierung).
