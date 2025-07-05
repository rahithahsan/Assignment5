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
          <h6 class="card-title text-muted small">User with the Most Reminders</h6>
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

  <!-- Login totals table ════════════════ -->
  <div class="card shadow-sm mx-auto" style="max-width:420px">
    <div class="card-header d-flex align-items-center gap-1">
      <i data-feather="hash"></i>
      <span class="fw-semibold">Login totals</span>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm mb-0 text-center">
        <thead class="table-light">
          <tr><th class="w-50">User</th><th>Count</th></tr>
        </thead>
        <tbody>
          <?php foreach ($loginCnts as $u => $c): ?>
            <tr>
              <td><?= htmlspecialchars($u) ?></td>
              <td class="fw-semibold"><?= $c ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  
  <!-- ═══════════ 3.  All reminders (filterable) ══════════════════════ -->
  <h5 class="fw-semibold mb-2 mt-4"><i data-feather="list"></i> All reminders</h5>

  <!-- status pill-filter -->
  <ul class="nav nav-pills mb-2" id="statusFilter">
    <li class="nav-item"><button class="nav-link active" data-status="all">All</button></li>
    <li class="nav-item"><button class="nav-link"           data-status="open">Open</button></li>
    <li class="nav-item"><button class="nav-link"           data-status="done">Done</button></li>
    <li class="nav-item"><button class="nav-link"           data-status="archived">Archived</button></li>
  </ul>

  <div class="table-responsive mb-5">
    <table class="table table-sm table-hover align-middle" id="remTbl">
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
        <?php
          $status = $r['deleted'] ? 'archived' : ($r['completed'] ? 'done' : 'open');
        ?>
        <tr data-status="<?= $status ?>">
          <td><?= htmlspecialchars($r['username']) ?></td>
          <td><?= htmlspecialchars($r['subject']) ?></td>
          <td class="text-capitalize"><?= $status ?></td>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
  /* feather icons */
  window.feather && feather.replace();

  /* status filter */
  const filterBar = document.getElementById('statusFilter');
  const rows      = document.querySelectorAll('#remTbl tbody tr');

  filterBar.addEventListener('click', e => {
    if (e.target.tagName !== 'BUTTON') return;
    filterBar.querySelectorAll('.nav-link').forEach(a=>a.classList.remove('active'));
    e.target.classList.add('active');
    const f = e.target.dataset.status;
    rows.forEach(r=>{
      r.style.display = (f==='all' || r.dataset.status===f) ? '' : 'none';
    });
  });
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
