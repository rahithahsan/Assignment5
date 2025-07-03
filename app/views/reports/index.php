<?php require 'app/views/templates/header.php'; ?>

<main class="container py-4">
  <h2 class="mb-4"><i data-feather="bar-chart-2"></i> Admin Reports</h2>

  <!-- KPI cards -->
  <div class="row g-3 mb-4">
    <div class="col-md">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6 class="card-title text-muted small">Total reminders</h6>
          <p class="display-6 fw-semibold mb-0">
            <?= count($all) ?>
          </p>
        </div>
      </div>
    </div>

    <div class="col-md">
      <div class="card text-center shadow-sm">
        <div class="card-body">
          <h6 class="card-title text-muted small">Top user</h6>
          <?php if ($topUser): ?>
            <p class="fw-semibold mb-0"><?= htmlspecialchars($topUser['username']) ?></p>
            <span class="text-muted small"><?= $topUser['cnt'] ?> reminders</span>
          <?php else: ?>
            <p class="text-muted mb-0">—</p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- login bar chart (bonus) -->
  <div class="card mb-4 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
      <span class="fw-semibold"><i data-feather="activity"></i> Logins per user</span>
    </div>
    <div class="card-body">
      <canvas id="loginChart" height="90"></canvas>
    </div>
  </div>

  <!-- full reminders table -->
  <div class="table-responsive mb-5">
    <table class="table table-sm table-hover align-middle">
      <thead class="table-light">
        <tr>
          <th>User</th>
          <th>Subject</th>
          <th>Status</th>
          <th>Created</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($all as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['username']) ?></td>
          <td><?= htmlspecialchars($r['subject']) ?></td>
          <td>
            <?= $r['deleted'] ? 'Archived'
                 : ($r['completed'] ? 'Done' : 'Open') ?>
          </td>
          <td><?= date('Y-m-d H:i', strtotime($r['created_at'])) ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</main>

<!-- Chart.js & feather icons -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace();

  /* build bar chart */
  const ctx   = document.getElementById('loginChart');
  const labels = <?= json_encode(array_keys($loginCnts)) ?>;
  const data   = <?= json_encode(array_values($loginCnts)) ?>;

  new Chart(ctx, {
    type: 'bar',
    data: { labels, datasets: [{
      label: 'Successful logins',
      data,
      borderWidth: 1
    }]},
    options: { plugins:{legend:{display:false}} }
  });
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
