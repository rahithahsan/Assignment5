<?php
/* docs.php – public + private */
require_once isset($_SESSION['auth'])
      ? 'app/views/templates/header.php'
      : 'app/views/templates/headerPublic.php';
?>
<main class="container py-5">

  <!-- ======= Page header ======= -->
  <header class="mb-5 text-center">
    <h1 class="display-5 fw-bold"><i data-feather="book-open"></i> Project Docs</h1>
    <p class="lead text-muted">Everything you need to know about the COSC&nbsp;4806 demo site.</p>
  </header>


  <!-- ======= 1.  Dismissible ALERT component ========================= -->
  <div class="alert alert-info alert-dismissible fade show shadow-sm" role="alert">
    <i data-feather="info" class="me-1"></i>
    These docs are a <strong>live Bootstrap component showcase</strong>.  
    Play with the accordion, modal &amp; toast buttons below!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>


  <!-- ======= 2.  3-column feature CARDS (you already had) ============= -->
  <div class="row g-4 mb-5">
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="lock"></i> Authentication</h5>
          <p class="card-text small">Secure registration, bcrypt hashing, per-user lock-out &amp; flash messages.</p>
          <a href="/menu/login-info" class="stretched-link">Read more</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="check-circle"></i> Reminders CRUD</h5>
          <p class="card-text small">Create, edit, mark done/undo, archive; collapsible completed list.</p>
          <a href="/notes" class="stretched-link">Try it live</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <h5 class="card-title"><i data-feather="bar-chart-2"></i> Admin Reports</h5>
          <p class="card-text small">(Assignment 5) aggregate stats, most reminders, login totals &amp; charts.</p>
          <a href="/reports" class="stretched-link">View report</a>
        </div>
      </div>
    </div>
  </div>


  <!-- ======= 3.  ACCORDION – FAQ section ============================== -->
  <h2 class="h4 fw-semibold mb-3"><i data-feather="help-circle"></i> FAQ</h2>

  <div class="accordion mb-5" id="faqAcc">
    <div class="accordion-item">
      <h2 class="accordion-header" id="q1-h"><button class="accordion-button" data-bs-target="#q1" data-bs-toggle="collapse" aria-expanded="true" aria-controls="q1">Why no JavaScript SPA?</button></h2>
      <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAcc">
        <div class="accordion-body small">
          Simplicity for marking – every feature works even if JS is disabled (only the bonus chart requires it).
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="q2-h"><button class="accordion-button collapsed" data-bs-target="#q2" data-bs-toggle="collapse" aria-controls="q2">Where is the DB connection?</button></h2>
      <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
        <div class="accordion-body small">
          `app/database.php` exposes a singleton PDO via the global `db()` helper.
        </div>
      </div>
    </div>
    <div class="accordion-item">
      <h2 class="accordion-header" id="q3-h"><button class="accordion-button collapsed" data-bs-target="#q3" data-bs-toggle="collapse" aria-controls="q3">Can I delete reminders forever?</button></h2>
      <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAcc">
        <div class="accordion-body small">
          By design, <em>archive</em> only hides a reminder (`deleted = 1`) – no hard delete to keep an audit trail.
        </div>
      </div>
    </div>
  </div>


  <!-- ======= 4.  MODAL demo =========================================== -->
  <h2 class="h4 fw-semibold mb-3"><i data-feather="eye"></i> Live modal demo</h2>
  <button class="btn btn-outline-primary mb-4" data-bs-toggle="modal" data-bs-target="#demoModal">
    Launch modal
  </button>

  <div class="modal fade" id="demoModal" tabindex="-1" aria-labelledby="demoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content shadow">
        <div class="modal-header">
          <h5 class="modal-title" id="demoModalLabel"><i data-feather="thumbs-up"></i> Hello!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          This little window is a standard <strong>Bootstrap <span class="badge bg-secondary">Modal</span></strong>.
          No extra JS – just markup + data attributes.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Nice!</button>
        </div>
      </div>
    </div>
  </div>


  <!-- ======= 5.  Toast trigger ======================================== -->
  <h2 class="h4 fw-semibold mb-3"><i data-feather="bell"></i> Toast trigger</h2>
  <button class="btn btn-outline-success mb-5" id="toastBtn">
    Show toast
  </button>

  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="demoToast" class="toast text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body">
          This toast was launched via <code>toast.show()</code>!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>


  <!-- ======= Quick-start snippet (kept) =============================== -->
  <section class="mb-5">
    <h2 class="h4 fw-semibold mb-3"><i data-feather="code"></i> Quick start</h2>
<pre class="border rounded px-3 py-2 bg-light small">
git clone https://github.com/&lt;your&gt;/Assignment5.git
cp .env.sample .env     # add DB creds
php -S localhost:8000 -t public
</pre>
  </section>

</main>


<script>
document.addEventListener('DOMContentLoaded', () => {
  window.feather && feather.replace();

  /* toast trigger */
  const toast     = new bootstrap.Toast(document.getElementById('demoToast'), {delay:4000});
  document.getElementById('toastBtn').addEventListener('click', () => toast.show());
});
</script>

<?php require 'app/views/templates/footer.php'; ?>
