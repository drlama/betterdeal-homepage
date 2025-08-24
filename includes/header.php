<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom">
  <div class="container">
    <!-- Desktop brand (unchanged) -->
    <a class="navbar-brand d-none d-lg-flex align-items-center brand-desktop" href="index.php" aria-label="BetterDeal">
      <img src="assets/img/logo.png" alt="BetterDeal">
    </a>
    <!-- Mobile/Tablet brand (compact) -->
    <a class="navbar-brand d-flex d-lg-none align-items-center gap-2 brand-mobile" href="index.php" aria-label="BetterDeal">
      <i class="bi bi-graph-up-arrow text-bd fs-4"></i>
      <span class="fw-bold">BetterDeal</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Menü öffnen">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="nav" class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav align-items-center gap-2">
        <li class="nav-item"><a class="nav-link" href="index.php#warum">Warum BetterDeal?</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#funktioniert">So funktioniert's</a></li>
        <li class="nav-item"><a class="nav-link" href="makler.php">Informationen für Makler</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#kontakt">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>
