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
            $this->load->model('Post');
            $data['posts'] = $this->Post->get_posts($session_data['id']);
            $this->db->reconnect();
            $this->load->model('Children_model');
            $data['children'] = $this->Children_model->get_children($session_data['id']);

            $data['name'] = $session_data['name'];
            $data['id'] = $session_data['id'];
            $data['username'] = $session_data['username'];
            $data['title'] = 'Secret Home';
        
            $this->load->view('navbar', $data);
            $this->load->view('home_view', $data);
            $this->load->view('footer');


        } else {
            //If no session, redirect to login page
            redirect('login?uri=' . urlencode($_SERVER['REQUEST_URI']));
        }
    }

    function logout()
    {
        $_SESSION = array('site_lang' => $_SESSION['site_lang']);
        redirect('home');
    }

    function create_new_post()
    {
        $session_data = $this->session->userdata('logged_in');
        $this->load->model('Post');
        $this->Post->create_new_post($session_data['id']);

        //redirect back to private area..
        redirect('home');
    }

}