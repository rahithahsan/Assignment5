<?php require 'app/views/templates/headerPublic.php'; ?>
<main class="container py-5">

  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">

      <h1 class="fw-bold mb-3">Need help?</h1>
      <p class="lead text-muted mb-4">
        This demo is maintained for COSC 4806 assignments.  
        Feel free to reach out with questions or bug reports.
      </p>

      <a href="mailto:mikebio@gmail.com"
         class="btn btn-primary btn-lg d-inline-flex align-items-center gap-1">
        <i data-feather="mail"></i><span>mikebio@gmail.com</span>
      </a>

      <hr class="my-5">

      <h2 class="h5 fw-semibold mb-3">Office hours</h2>
      <p class="small text-muted">
        Monday – Friday   13:00 – 15:00 EST  
        Algoma U · Room B42 · or via Zoom on request
      </p>
    </div>
  </div>

</main>

<script>document.addEventListener('DOMContentLoaded',()=>{feather.replace()});</script>
<?php require 'app/views/templates/footer.php'; ?>
