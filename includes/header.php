<?php if(session_status()!==PHP_SESSION_ACTIVE){session_start();} if(empty($_SESSION['csrf_token'])){$_SESSION['csrf_token']=bin2hex(random_bytes(16));} ?>
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top border-bottom"><div class="container">
  <a class="navbar-brand d-none d-lg-flex align-items-center brand-desktop" href="index.php"><img src="assets/img/logo.png" alt="BetterDeal" class="img-fluid"></a>
  <a class="navbar-brand d-flex d-lg-none align-items-center gap-2 brand-mobile" href="index.php"><img src="assets/img/brand-haus-28.png" alt="" class="brand-mark" width="28" height="28"><span class="fw-bold">BetterDeal</span></a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
  <div id="nav" class="collapse navbar-collapse justify-content-end">
    <ul class="navbar-nav align-items-center gap-2">
      <li class="nav-item"><a class="nav-link" href="index.php#warum">Warum BetterDeal?</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php#funktioniert">So funktioniert's</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php#kalkulation">Rechenbeispiel</a></li>
      <li class="nav-item"><a class="nav-link" href="makler.php">Informationen für Makler</a></li>
      <li class="nav-item"><a class="nav-link" href="index.php#kontakt">Kontakt</a></li>
    </ul>
  </div>
</div></nav>
