<?php
/**  Admin-only report hub  */
class Reports extends Controller
{
    public function index(): void
    {
        /* ACL: only logged-in admins */
        if (empty($_SESSION['auth']) || empty($_SESSION['is_admin'])) {
            header('HTTP/1.1 403 Forbidden'); exit('403 – Admins only');
        }

        $note = $this->model('Note');
        $user = $this->model('User');

        $data = [
            'all'       => $note->allForAdmin(),
            'topUser'   => $note->mostActiveUser(),  // ['username'=>…, 'cnt'=>…] or null
            'loginCnts' => $user->loginCounts(),     // array username=>count
        ];

        $this->view('reports/index', $data);
    }

}