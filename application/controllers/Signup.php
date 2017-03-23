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

        $title['title'] = lang("msg_signup");
        $title['extra_scripts'] = array("/js/signup.js");
        $this->load->view('navbar', $title);
        $this->load->view('signup');
        $this->load->view('footer');
    }

    function create_new_user()
    {
        $this->load->model('Register_model');
        $this->Register_model->create_new_user();


        //as i dont know where to load now, then ill just redirrect for now..
        redirect("/login");

    }
}