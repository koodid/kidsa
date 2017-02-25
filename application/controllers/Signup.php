<?php
class Signup extends CI_Controller {
    public function index() {
        $title['title'] = 'Sign up';
        $this->load->view('navbar', $title);
        $this->load->view('signup');
        $this->load->view('footer');
    }
}