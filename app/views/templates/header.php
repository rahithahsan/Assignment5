<?php
/* ---------- auth gate ---------- */
if (!isset($_SESSION['auth'])) {
    header('Location: /login'); exit;
}

/* helper: is the logged-in user “admin” ? */
$isAdmin = ($_SESSION['username'] ?? '') === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>COSC 4806 – Dashboard</title>

  <!-- Bootstrap 5.3 & Feather -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
  <script src="https://unpkg.com/feather-icons" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/favicon.png">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- ======= NAVBAR (private) ======= -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-semibold" href="/home">COSC 4806</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/about">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/notes">Reminders</a></li>

        <!-- admin-only menu item (A5 reports) -->
        <?php if ($isAdmin): ?>
          <li class="nav-item"><a class="nav-link" href="/reports">Reports</a></li>
        <?php endif; ?>

        <!-- docs dropdown ------------------------------------>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
            Help
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/menu/login-info">Login flow</a></li>
            <li><a class="dropdown-item" href="/menu/register-info">Register flow</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="https://algomau.ca/" target="_blank">
              Algoma U</a></li>
          </ul>
        </li>
      </ul>

      <!-- right side: user / logout ------------------------->
      <span class="navbar-text text-white small me-3">
        <?= htmlspecialchars($_SESSION['username'] ?? '') ?>
      </span>
      <a href="/logout" class="btn btn-sm btn-light">Log out</a>
    </div>
  </div>
</nav>
