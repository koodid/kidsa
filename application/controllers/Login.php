<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once __DIR__ . '/../libraries/Facebook/autoload.php';
file_exists(__DIR__ . '/../config/secret_config.php') AND require_once __DIR__ . '/../config/secret_config.php';

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user', '', TRUE);
    }

    function index()
    {
        if ($this->session->userdata('logged_in')) {
            // TODO maybe not redirect for "Veebilehitseja edasi-tagasi nuppude tugi"
            if (isset($_GET['uri'])) {
                redirect(base_url() . trim($_GET['uri'], "/"));
            } else {
                redirect('home');
            }
        }

        //This method will have the credentials validation
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $title['title'] = lang("msg_login");

            if (!defined("FACEBOOK_APP_SECRET")) {
                echo "FACEBOOK_APP_SECRET must be defined to use facebook";
            } else {
                $fb = new Facebook\Facebook([
                    'app_id' => FACEBOOK_APP_ID,
                    'app_secret' => FACEBOOK_APP_SECRET,
                    'default_graph_version' => 'v2.5',
                    'pseudo_random_string_generator' => 'openssl',
                ]);
                $helper = $fb->getRedirectLoginHelper();
                $permissions = ['email']; // optional
                if (isset($_GET['uri'])) {
                    $loginUrl = $helper->getLoginUrl(base_url() . '/fb_login_callback/fb_login_callback/' . $_GET['uri'], $permissions);
                } else {
                    $loginUrl = $helper->getLoginUrl(base_url() . '/fb_login_callback/fb_login_callback/', $permissions);
                }
                $title['fb_link'] = $loginUrl;
            }
            $this->load->view('navbar', $title);
            $this->load->view('login_view', $title);
            $this->load->view('footer');
        } else {
            //Go to private area
            if ($this->input->post('uri')) {
                // go to where user wanted
                redirect(base_url() . urlencode(trim($this->input->post('uri'), "/")));
            } else {
                redirect('home');
            }
        }

    }

    function check_database($password)
    {
        //Field validation succeeded.  Validate against database
        $username = $this->input->post('username');

        //query the database
        $row = $this->user->login($username, $password);

        if ($row) {
            $sess_array = array(
                'id' => $row->id,
                'username' => $row->username,
                'name' => $row->name
            );
            $this->session->set_userdata('logged_in', $sess_array);
            return TRUE;
        } else {
            $this->form_validation->set_message('check_database', 'Invalid username or password');
            return false;
        }
    }
}