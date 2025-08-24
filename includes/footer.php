<?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
<footer>
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
    <div>© <?php echo date('Y'); ?> BetterDeal – Wir renovieren. Sie profitieren.</div>
    <div class="d-flex gap-3">
      <a href="impressum.php">Impressum</a>
      <a href="agb.php">AGB</a>
      <a href="datenschutz.php">Datenschutz</a>
      <a href="widerruf.php">Widerruf</a>
    </div>
  </div>
</footer>

<?php include __DIR__ . '/../wizard-modal.php'; ?>

<script>
const CSRF_TOKEN = "<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>";
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/app.js"></script>
