<?php

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {

            $title['title'] = 'Settings';
            $this->load->view('navbar', $title);
            $this->load->view('settings');
            $this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }

        function change_password()
        {
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $this->load->model('Register_model');
            $this->Register_model->change_password($data['id']);

            redirect("/settings");

        }

}