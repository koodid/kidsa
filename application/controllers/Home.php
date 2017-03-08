<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['name'] = $session_data['name'];
            $data['id'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $data['title'] = 'Secret Home';

            $this->load->view('navbar', $data);
            $this->load->view('home_view', $data);
            $this->load->view('footer');
        } else {
            //If no session, redirect to login page
            redirect('login', 'refresh');
        }
    }

    function logout()
    {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

}