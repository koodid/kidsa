<?php

class Children extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Children_model', '', TRUE);
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->helper('url');

        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $this->form_validation->set_rules('childname', lang('val_name'), 'trim|required');
            $this->form_validation->set_rules('cday', lang('val_day'), 'required|numeric');
            $this->form_validation->set_rules('cmonth', lang('val_month'), 'required|numeric');
            $this->form_validation->set_rules('cyear', lang('val_year'), 'required|numeric');

            if ($this->form_validation->run() == FALSE) {
                $data['children'] = $this->Children_model->get_children($session_data['id']);
                $title['title'] = lang("msg_addchildren");
                $this->load->view('navbar', $title);
                $this->load->view('children', $data);
                $this->load->view('footer');
            } else {
                $this->form_validation->set_rules('cyear', lang('val_year'), 'callback_validate_date');

                if ($this->form_validation->run() == FALSE) {
                    $data['children'] = $this->Children_model->get_children($session_data['id']);
                    $title['title'] = lang("msg_addchildren");
                    $this->load->view('navbar', $title);
                    $this->load->view('children', $data);
                    $this->load->view('footer');
                } else {
                    $data['child'] = $this->Children_model->add_child($session_data['id']);
                    $data['children'] = $this->Children_model->get_children($session_data['id']);
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
            $this->form_validation->set_message('validate_date', lang('val_invalid_date'));
            return FALSE;
        }
    }

    function delete()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $userChildren = $this->Children_model->get_children($session_data['id']);
            $id = $this->uri->segment(3);
            foreach ($userChildren as $child) {
                if ($child['ID'] == $id) {
                     $this->Children_model->delete_child($id);
                    redirect('children');
                }
            }
                
        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }

    }

    function edit()
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $userChildren = $this->Children_model->get_children($session_data['id']);
            $id = $this->uri->segment(3);
            foreach ($userChildren as $child) {
                if ($child['ID'] == $id) {
                     $child = $this->Children_model->get_child($id);
                    $birthday = explode('-', $child[0]['Birthday']);
                    $data['id'] = $id;
                    $data['year'] = intval($birthday[0]);
                    $data['month'] = intval($birthday[1]);
                    $data['day'] = intval($birthday[2]);
                    $data['name'] = $child[0]['Name'];
                    $title['title'] = lang("msg_edit");
                    $this->load->view('navbar', $title);
                    $this->load->view('edit_child', $data);
                    $this->load->view('footer');
                }
            }
        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
        
    }
    function editChild()
    {
        $session_data = $this->session->userdata('logged_in');
       
        $id = $this->uri->segment(3);
        $this->form_validation->set_rules('childname', lang('val_name'), 'trim|required');
        $this->form_validation->set_rules('cday', lang('val_day'), 'required|numeric');
        $this->form_validation->set_rules('cmonth', lang('val_month'), 'required|numeric');
        $this->form_validation->set_rules('cyear', lang('val_year'), 'required|numeric');
        if ($this->form_validation->run() == FALSE) {
            $title['title'] = lang("msg_edit");
            $this->load->view('navbar', $title);
            $this->load->view('edit_child', $data);
            $this->load->view('footer');
        } else {
            $this->form_validation->set_rules('cyear', lang('val_year'), 'callback_validate_date');
            if ($this->form_validation->run() == FALSE) {
                $data['children'] = $this->Children_model->get_children($session_data['id']);
                $title['title'] = lang("msg_edit");
                $this->load->view('navbar', $title);
                $this->load->view('edit_child', $data);
                $this->load->view('footer');
            } else {
                $this->Children_model->edit_child($id);
                $data['children'] = $this->Children_model->get_children($session_data['id']);
                $title['title'] = lang("msg_addchildren");
                $this->load->view('navbar', $title);
                $this->load->view('formsuccess');
                $this->load->view('children', $data);
                $this->load->view('footer');
            }
        }
    }    

}