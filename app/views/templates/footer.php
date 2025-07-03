<!-- ======= FOOTER ======= -->
<footer class="mt-auto bg-body-tertiary border-top small py-3">
  <div class="container d-flex flex-column flex-md-row
              justify-content-between align-items-center gap-2">

    <span class="text-muted">
      © <?= date('Y') ?> COSC 4806 • All rights reserved
    </span>

    <nav class="d-flex gap-3">
      <a class="link-secondary text-decoration-none" href="/about">About</a>
      <a class="link-secondary text-decoration-none" href="/menu/login-info">Docs</a>
      <a class="link-secondary text-decoration-none"
         href="mailto:mikebio@gmail.com">Contact</a>
    </nav>
  </div>
</footer>

<!-- Bootstrap bundle (Popper + JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

<!-- feather icons for pages that insert new icons after load -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace({width:14, height:14});
});
</script>
</body>
</html>
