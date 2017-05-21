<?php

class Signup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            // TODO maybe not redirect for "Veebilehitseja edasi-tagasi nuppude tugi"
            if (isset($_GET['uri'])) {
                redirect(base_url() . trim($_GET['uri'], "/"));
            } else {
                redirect('home');
            }
        }
        $this->form_validation->set_rules('set_username', lang('val_username'), 'trim|required');
        $this->form_validation->set_rules('set_password', lang('val_password'), 'trim|required|min_length[5]|max_length[255]');
        $this->form_validation->set_rules('set_confirmpassword', lang('val_confirmed_password'), 'trim|required|matches[set_password]');
        $this->form_validation->set_rules('set_email', lang('val_email'), 'trim|required|valid_email');

        if ($this->form_validation->run() == TRUE) {
            $this->form_validation->set_rules('set_username', lang('val_username'), 'callback_check_username_db');
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('Register_model');
                $this->Register_model->create_new_user();

                $this->load->view('formsuccess');
            }
        }

        $title['title'] = lang("msg_signup");
        $title['extra_scripts'] = array("/js/signup.js");
        $this->load->view('navbar', $title);
        $this->load->view('signup');
        $this->load->view('footer');
    }

    function check_username_db()
    {
        // Check if the username is unique
        $this->load->model('Register_model');
        $username = $this->input->post('set_username');
        $usercount = $this->Register_model->check_username($username);
        if ($usercount > 0) {
            $this->form_validation->set_message('check_username_db', lang('val_username_not_unique'));
            return FALSE;
        } else {
            return TRUE;
        }
    }
}