<?php
/**  Admin-only report hub  */
class Reports extends Controller
{
    public function index(): void
    {
        // ACL - block non-admins
        if (empty($_SESSION['is_admin'])) {
            header('Location: /home'); exit;
        }

        $this->view('reports/index');
    }
}