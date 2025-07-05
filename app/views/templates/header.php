<?php
/* ────────── Auth gate ────────── */
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
    exit;
}

$isAdmin   = !empty($_SESSION['is_admin']);

/* ── NEW: pull toast message (if any) and forget it right away ── */
$toastMsg  = $_SESSION['toast'] ?? null;
unset($_SESSION['toast']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>COSC 4806 – Dashboard</title>

  <!-- Bootstrap 5.3 & Feather icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/feather-icons" defer></script>

  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" href="/favicon.png">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ========= NAVBAR (private area) ========= -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm position-relative" style="z-index: 1100;">
  <div class="container-fluid">
    <a class="navbar-brand fw-semibold" href="/home">COSC 4806</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/notes">Reminders</a></li>
        <?php if ($isAdmin): ?>
          <li class="nav-item"><a class="nav-link" href="/reports">Reports</a></li>
        <?php endif; ?>
        <!-- Help dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">Help</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/pages/docs">Docs</a></li>
            <li><a class="dropdown-item" href="/pages/contact">Contact</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/menu/loginInfo">Login flow</a></li>
            <li><a class="dropdown-item" href="/menu/registerInfo">Register flow</a></li>
          </ul>
        </li>
      </ul>

      <span class="navbar-text text-white small me-3 d-flex align-items-center gap-2">
        <?= htmlspecialchars($_SESSION['username']) ?>
        <?php if ($isAdmin): ?>
          <span class="badge bg-warning text-dark">ADMIN</span>
        <?php endif; ?>
      </span>
      <a href="/logout" class="btn btn-sm btn-light">Log&nbsp;out</a>
    </div>
  </div>
</nav>

<!-- ========= TOAST CONTAINER (bottom-right) ========= -->
<?php if ($toastMsg): ?>
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast text-bg-primary border-0 show" role="alert" aria-live="assertive">
      <div class="d-flex">
        <div class="toast-body"><?= htmlspecialchars($toastMsg) ?></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto"
                data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
    </div>
  </div>
<?php endif; ?>
