<?php

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('Register_model', '', TRUE);
    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('logged_in')) {

            $this->form_validation->set_rules('newpassword', 'new password', 'required');
            $this->form_validation->set_rules('confirmnewpassword', 'confirmed password', 'required|matches[newpassword]');

            if ($this->form_validation->run() == FALSE)
            {
                $title['title'] = lang("msg_settings");
                $this->load->view('navbar', $title);
                $this->load->view('settings');
                $this->load->view('footer');
            }
            else
            {
                $session_data = $this->session->userdata('logged_in');
                $data['id'] = $session_data['id'];
                $this->Register_model->change_password($data['id']);

                $title['title'] = lang("msg_settings");
                $this->load->view('navbar', $title);
                $this->load->view('formsuccess');
                $this->load->view('settings');
                $this->load->view('footer');
            }

        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }
/*
        function change_password()
        {
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            $this->Register_model->change_password($data['id']);
        }
*/
}