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
        $this->load->helper(array('form', 'url'));

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $data['children'] = $this->Children_model->get_children($session_data['id']);

            $this->form_validation->set_rules('childname', 'name', 'trim|required');
            $this->form_validation->set_rules('cday', 'day', 'required');
            $this->form_validation->set_rules('cmonth', 'month', 'required');
            $this->form_validation->set_rules('cyear', 'year', 'required');

            if ($this->form_validation->run() == FALSE) {
                $title['title'] = lang("msg_addchildren");
                $this->load->view('navbar', $title);
                $this->load->view('children', $data);
                $this->load->view('footer');
            } else {
                $this->form_validation->set_rules('cyear', 'year', 'callback_validate_date');

                if ($this->form_validation->run() == FALSE) {
                    $title['title'] = lang("msg_addchildren");
                    $this->load->view('navbar', $title);
                    $this->load->view('children', $data);
                    $this->load->view('footer');
                } else {
                    $data['child'] = $this->Children_model->add_child($session_data['id']);

                    $title['title'] = lang("msg_addchildren");
                    $this->load->view('navbar', $title);
                    $this->load->view('formsuccess');
                    $this->load->view('children', $data);
                    $this->load->view('footer');
                }
            }
        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    function validate_date()
    {
        $bday = $this->input->post("cday");
        $bmonth = $this->input->post("cmonth");
        $byear = $this->input->post("cyear");

        if (checkdate($bmonth, $bday, $byear)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_date', 'Invalid date.');
            return FALSE;
        }
    }
}