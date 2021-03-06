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
            $data['title'] = lang('msg_userhome');
            $data['extra_scripts'] = array('/js/offline.min.js', '/js/postoffline.js', '/js/notify.js', '/js/likes.js');
            $data['extra_style'] = array('/css/offline.css');

            $data['countposts'] = $this->Post->get_childrenposts($session_data['id']);
            if (isset($_SESSION['create_new_post'])) {
                $data['create_new_post'] = $_SESSION['create_new_post'];
                unset($_SESSION['create_new_post']);
            }

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
        if (isset($_SESSION['site_lang'])) {
            $_SESSION = array('site_lang' => $_SESSION['site_lang']);
        } else {
            $_SESSION = array('site_lang' => 'english');
        }
        redirect('home');
    }

    function create_new_post($unixTime = '')
    {
        $this->load->model('Post');
        if ($this->Post->create_new_post($unixTime)) {
            //redirect back to private area..
            redirect('home');
        } else {
            $_SESSION['create_new_post'] = lang("create_new_post_fail");
            redirect('home');
        }

    }
}