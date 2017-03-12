<?php

class Children extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Children_model', '', TRUE);
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('Children_model');
            $session_data = $this->session->userdata('logged_in');
            $data['children'] = $this->Children_model->get_children($session_data['id']);

            $title['title'] = 'Children';
            $this->load->view('navbar', $title);
            $this->load->view('children', $data);
            $this->load->view('footer');

        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    function add_child()
    {
        $this->form_validation->set_rules('childname', 'name', 'required');
        $session_data = $this->session->userdata('logged_in');
        $data['id'] = $session_data['id'];
        $this->load->model('Children_model');

        if ($this->form_validation->run()) {
            $this->Children_model->add_child($data['id']);

            redirect('/Children');
        } else {
            $title['title'] = 'Children';
            $this->load->view('navbar', $title);
            $this->load->view('children');
            $this->load->view('footer');
        }
    }
}