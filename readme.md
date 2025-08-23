# BetterDeal Website - PHP/Bootstrap/Ajax Version

## Übersicht
Diese Website ist eine vollständige Kopie der ursprünglichen BetterDeal-Homepage, entwickelt mit PHP, Bootstrap und Ajax für optimale Performance und Responsivität.

## Technische Features
- **Responsive Design**: Vollständig responsive mit Bootstrap 5
- **Ajax-Kontaktformular**: Asynchrone Formularübermittlung ohne Seitenneuladen
- **PHP-Backend**: Serverseitige Validierung und E-Mail-Verarbeitung
- **Modern UI**: Animationen, Hover-Effekte und professionelles Design
- **Cross-Browser-Kompatibilität**: Funktioniert in allen modernen Browsern
- **Accessibility**: Barrierefreie Navigation und Fokus-Management

## Dateistruktur
```
betterdeal-website/
├── index.html          # Hauptseite
├── contact.php         # PHP-Backend für Kontaktformular
├── css/
│   └── style.css       # Custom CSS-Styles
├── js/
│   └── script.js       # JavaScript mit Ajax-Funktionalität
├── betterdeal-logo.png # Logo
└── README.md           # Diese Dokumentation
```

## Installation & Setup
1. PHP-Server starten: `php -S 0.0.0.0:8080`
2. Website im Browser öffnen: `http://localhost:8080`

## Features im Detail

### Responsive Navigation
- Sticky Navigation mit Scroll-Effekten
- Mobile-freundliches Hamburger-Menü
- Smooth Scrolling zu Sektionen

### Hero-Bereich
- Ansprechende Überschrift mit Farbakzenten
- Call-to-Action-Button mit Hover-Effekten
- Video-Placeholder mit Modal-Integration

### Feature-Karten
- Vier Hauptvorteile von BetterDeal
- Icon-basierte Darstellung
- Hover-Animationen

### Ajax-Kontaktformular
- Client- und serverseitige Validierung
- Echtzeitfeedback ohne Seitenneuladen
- Professionelle Erfolgs-/Fehlermeldungen
- Logging der Anfragen in `contact_log.txt`

### Kontaktinformationen
- Vollständige Firmeninformationen
- Klickbare Telefon- und E-Mail-Links
- Responsive Darstellung

## Browser-Kompatibilität
- Chrome/Chromium (alle Versionen)
- Firefox (alle Versionen)
- Safari (alle Versionen)
- Edge (alle Versionen)

## Performance-Optimierungen
- CDN-basierte Bootstrap- und Font-Awesome-Integration
- Optimierte CSS-Animationen
- Lazy Loading für Bilder
- Minimierte HTTP-Requests

## Sicherheitsfeatures
- CSRF-Schutz durch Validierung
- Input-Sanitization
- E-Mail-Validierung
- XSS-Schutz

## Wartung
- Logs werden in `contact_log.txt` gespeichert
- Regelmäßige Überprüfung der Formulareingaben empfohlen
- Updates der CDN-Links bei Bedarf

## Support
Bei Fragen oder Problemen wenden Sie sich an den Entwickler.

