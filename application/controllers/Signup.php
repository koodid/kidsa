<?php

class Signup extends CI_Controller
{
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

        $this->load->library('form_validation');
        $this->form_validation->set_rules('set_username', 'username', 'trim|required');
        $this->form_validation->set_rules('set_password', 'password', 'trim|required');
        $this->form_validation->set_rules('set_confirmpassword', 'password confirmation', 'trim|required|matches[set_password]');
        $this->form_validation->set_rules('set_email', 'email', 'trim|required|valid_email');

        if ($this->form_validation->run() == TRUE) {
            $this->form_validation->set_rules('set_username', 'username', 'callback_check_username_db');
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
            $this->form_validation->set_message('check_username_db', 'This username is not available. Please choose new username.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}