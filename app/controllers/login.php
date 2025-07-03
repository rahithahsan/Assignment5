<?php
class Login extends Controller
{
    public function index(): void
    {
        $this->view('login/index');
    }

    public function verify(): void
    {
        $u = $_POST['username'] ?? '';
        $p = $_POST['password'] ?? '';

        $user = $this->model('User');

        /* rate-limit */
        if ($user->lockedOut($u)) {
            $_SESSION['flash'] = 'Too many failed attempts – try again in 60 s.';
            header('Location: /login'); exit;
        }

        /* attempt login */
        if ($uid = $user->authenticate($u, $p)) {
            $_SESSION['auth']     = 1;
            $_SESSION['username'] = ucwords($u);   // pretty display name
            header('Location: /home'); exit;
        }

        /* failure path */
        $_SESSION['flash'] = 'Invalid credentials.';
        header('Location: /login'); exit;
    }
}

