<?php require 'app/views/templates/header.php'; ?>

<main class="container py-5">

  <!-- ── 1. optional alert flash (built-in from templates/header) ── -->
  <!-- nothing to do – it shows automatically if $_SESSION['flash'] is set -->


  <!-- ── 2. welcome card ── -->
  <div class="card shadow-sm mb-4">
    <div class="card-body text-center">
      <h3 class="fw-bold mb-1">
        Welcome, <?= htmlspecialchars($_SESSION['username']); ?>!
      </h3>
      <p class="text-muted mb-4">
        <?= date('l, F j Y • g:i A'); ?>
      </p>

      <!-- progress bar if user has any reminders -->
      <?php if ($openCount + $doneCount > 0):  
              $pct = round(($doneCount / ($openCount + $doneCount)) * 100); ?>
        <div class="mb-4">
          <div class="progress" style="height:8px">
            <div class="progress-bar bg-success"
                 style="width:<?= $pct ?>%" role="progressbar"
                 aria-label="completed ratio"
                 aria-valuenow="<?= $pct ?>" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <small class="text-muted">
            <?= $doneCount ?> / <?= $openCount + $doneCount ?> reminders completed
          </small>
        </div>
      <?php endif; ?>

      <!-- log-out -->
      <a href="/logout" class="btn btn-outline-danger">
        <i data-feather="log-out" class="me-1"></i> Log out
      </a>
    </div>
  </div>


  <!-- ── 3. quick-action cards (card group) ── -->
  <div class="row row-cols-1 row-cols-md-3 g-3">

    <!-- reminders -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i data-feather="check-circle" class="mb-2" width="32" height="32"></i>
          <h5 class="card-title">Manage reminders</h5>
          <p class="card-text small">Create, edit, mark done &amp; archive.</p>
          <a href="/notes" class="btn btn-sm btn-primary">Open</a>
        </div>
      </div>
    </div>

    <!-- admin reports (only if admin) -->
    <?php if (!empty($_SESSION['is_admin'])): ?>
      <div class="col">
        <div class="card h-100 shadow-sm border-warning">
          <div class="card-body text-center">
            <i data-feather="bar-chart-2" class="mb-2" width="32" height="32"></i>
            <h5 class="card-title">Admin reports</h5>
            <p class="card-text small">Site-wide stats &amp; charts.</p>
            <a href="/reports" class="btn btn-sm btn-warning text-dark">View</a>
          </div>
        </div>
      </div>
    <?php endif; ?>

    <!-- docs -->
    <div class="col">
      <div class="card h-100 shadow-sm">
        <div class="card-body text-center">
          <i data-feather="book" class="mb-2" width="32" height="32"></i>
          <h5 class="card-title">Project docs</h5>
          <p class="card-text small">Architecture &amp; developer guide.</p>
          <a href="/pages/docs" class="btn btn-sm btn-outline-secondary">Read</a>
        </div>
      </div>
    </div>

  </div>
</main>



<!-- ── Toast: “You have X open reminders” ── -->
<?php if ($openCount > 0): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="remToast" class="toast align-items-center text-bg-primary border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          You have <?= $openCount ?> open reminder<?= $openCount>1?'s':''; ?>.
          <a href="/notes" class="link-light text-decoration-underline">Review now</a>
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
<?php endif; ?>


<script>
document.addEventListener('DOMContentLoaded', () => {
  feather.replace({width:16,height:16});

  /* bootstrap toast */
  const t = document.getElementById('remToast');
  if (t) new bootstrap.Toast(t, { delay: 6000 }).show();
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
