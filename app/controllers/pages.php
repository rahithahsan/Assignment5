<?php
/**
 * Lightweight public pages controller
 *  /pages/docs      → docs()
 *  /pages/contact   → contact()
 */
class Pages extends Controller
{
    /** Product-style documentation splash */
    public function docs(): void
    {
        $this->view('pages/docs');
    }

    /** Pretty contact page (still shows the same e-mail) */
    public function contact(): void
    {
        $this->view('pages/contact');
    }
}
