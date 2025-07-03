<?php
/* bounce authenticated users away from public pages */
if (isset($_SESSION['auth'])) { header('Location: /home'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>COSC 4806 – Welcome</title>

  <!-- Bootstrap 5.3 & Feather -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
  <script src="https://unpkg.com/feather-icons" defer></script>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/favicon.png">
</head>

<body class="d-flex flex-column min-vh-100 bg-light">

<!-- ======= NAVBAR (public) ======= -->
<nav class="navbar navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-semibold" href="/">COSC 4806</a>
    <a class="btn btn-sm btn-light" href="/login">Log in</a>
  </div>
</nav>
