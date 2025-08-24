<?php
if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
if (empty($_SESSION['csrf_token'])) { $_SESSION['csrf_token'] = bin2hex(random_bytes(16)); }
?>
<nav class="navbar navbar-expand-md bg-white sticky-top border-bottom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php" aria-label="BetterDeal">
      <img src="assets/img/logo.png" alt="BetterDeal">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center gap-2">
        <li class="nav-item"><a class="nav-link" href="index.php#warum">Warum BetterDeal?</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#funktioniert">So funktioniert's</a></li>
        <li class="nav-item"><a class="nav-link" href="makler.php">Informationen für Makler</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php#kontakt">Kontakt</a></li>
      </ul>
    </div>
  </div>
</nav>
