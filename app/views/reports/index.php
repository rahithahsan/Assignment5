<?php require 'app/views/templates/header.php'; ?>

<main class="container py-4">
  <h2 class="mb-4"><i data-feather="bar-chart-2"></i> Admin Reports</h2>

  <div class="alert alert-info">
    <strong>Welcome, Admin!</strong><br>
    The reporting dashboard is under construction.  
    Next sprint: add the <em>reminder count</em>, <em>top users</em>,
    <em>login stats</em> and a fancy chart 🗺️.
  </div>

  <p class="text-muted">Path: <code>/reports</code></p>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace();
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
