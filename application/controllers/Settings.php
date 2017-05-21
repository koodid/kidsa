<?php

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Register_model', '', TRUE);
    }

    public function index()
    {
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('logged_in')) {

            $this->form_validation->set_rules('newpassword', lang('val_new_password'), 'trim|required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('confirmnewpassword', lang('val_confirmed_password'), 'trim|required|matches[newpassword]');
            $session_data = $this->session->userdata('logged_in');
            $data['id'] = $session_data['id'];
            if ($this->form_validation->run() == FALSE)
            {
                
                $title['title'] = lang("msg_settings");
                $this->load->view('navbar', $title);
                $this->load->view('settings', $data);
                $this->load->view('footer');
            }
            else
            {
                
                $this->Register_model->change_password($data['id']);

                $title['title'] = lang("msg_settings");
                $this->load->view('navbar', $title);
                $this->load->view('formsuccess');
                $this->load->view('settings', $data);
                $this->load->view('footer');
            }

        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }
    function delete()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $id = $this->uri->segment(3);
            if ($session_data['id'] == $id) {
                $this->Register_model->delete_account($id);
                $_SESSION = array('site_lang' => $_SESSION['site_lang']);
                redirect('home');
            }
            
                
        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }

    }
}