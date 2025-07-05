<?php

class Home extends Controller
{
    public function index(): void
    {
        /* ── Auth gate ── */
        if (!isset($_SESSION['auth'])) {
            header('Location:/login'); exit;
        }

        /* gather quick stats for the dashboard toast / progress */
        $note = $this->model('Note');
        $uid  = $_SESSION['uid'];

        $open  = $note->open($uid);
        $done  = $note->done($uid);

        /* optional flash if user has nothing pending */
        if (empty($open) && !empty($done)) {
            $_SESSION['flash'] = 'Nice job – all reminders completed!';
        }

        /* pass counts to the view */
        $this->view('home/index', [
            'openCount' => count($open),
            'doneCount' => count($done)
        ]);
    }
}
