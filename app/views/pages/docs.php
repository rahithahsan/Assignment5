<?php
/* docs.php  (same for contact.php) */
require_once isset($_SESSION['auth'])
        ? 'app/views/templates/header.php'        // private navbar
        : 'app/views/templates/headerPublic.php'; // public navbar
?>
<main class="container py-5">

  <header class="mb-5 text-center">
    <h1 class="display-5 fw-bold">Project Docs</h1>
    <p class="lead text-muted">Everything you need to know about the COSC 4806 demo site.</p>
  </header>

  <!-- 3-column feature grid ---------------------------------->
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="lock"></i> Authentication</h5>
          <p class="card-text small">
            Secure registration, bcrypt hashing, per-user lock-out &amp; flash messages.
          </p>
          <a href="/menu/login-info" class="stretched-link">Read more</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="check-circle"></i> Reminders CRUD</h5>
          <p class="card-text small">
            Create, edit, mark done/undo, archive; collapsible completed list.
          </p>
          <a href="/notes" class="stretched-link">Try it live</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="bar-chart-2"></i> Admin Reports</h5>
          <p class="card-text small">
            (Assignment 5) aggregate stats, most reminders, login totals &amp; charts.
          </p>
          <a href="#" class="stretched-link disabled">Coming soon</a>
        </div>
      </div>
    </div>
  </div>

  <section class="mb-5">
    <h2 class="h4 fw-semibold mb-3">Quick start</h2>
<pre class="border rounded px-3 py-2 bg-light small">
git clone https://github.com/rahithahsan/Assignment5.git;
cp .env.sample .env     # add DB creds
php -S localhost:8000 -t public
</pre>
  </section>

</main>

<script>document.addEventListener('DOMContentLoaded',()=>{feather.replace()});</script>
<?php require 'app/views/templates/footer.php'; ?>
