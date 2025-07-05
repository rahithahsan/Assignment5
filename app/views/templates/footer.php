<!-- ========= FOOTER ========= -->
<footer class="mt-auto bg-body-tertiary border-top small py-4 shadow-sm">
  <div class="container d-flex flex-column flex-md-row
              justify-content-between align-items-center gap-3">

    <!-- brand / copyright -->
    <span class="text-muted d-flex align-items-center gap-2">
      <i data-feather="coffee"></i>
      © <?= date('Y') ?> <strong>COSC 4806</strong> • All rights reserved
    </span>

    <!-- quick links -->
    <nav class="d-flex gap-4">
      <a class="link-secondary text-decoration-none" href="/about">
        <i data-feather="info"></i> About
      </a>
      <a class="link-secondary text-decoration-none" href="/pages/docs">
        <i data-feather="book"></i> Docs
      </a>
      <a class="link-secondary text-decoration-none" href="/pages/contact">
        <i data-feather="mail"></i> Contact
      </a>
    </nav>
  </div>
</footer>

<!-- ───────── Toast (flash message) ───────── -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <?php if (!empty($_SESSION['flash'])): ?>
    <div class="toast align-items-center text-bg-primary border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  <?php endif; ?>
</div>

<!-- Bootstrap bundle (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

<!-- Feather icons refresh -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace({ width:14, height:14 });
});
</script>
</body>
</html>
