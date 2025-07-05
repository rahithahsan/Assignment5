<?php

class Home extends Controller
{
    public function index(): void
    {
        if (!isset($_SESSION['auth'])) {
            header('Location:/login');
            exit;
        }

        /* ── NEW: gentle nudge if user still has open reminders ── */
        $open = $this->model('Note')->open($_SESSION['uid']);   // array
        if ($open) {
            $_SESSION['toast'] =
              "You have " . count($open) . " open reminder(s) – don’t forget!";
        }

        $this->view('home/index');
    }
}
