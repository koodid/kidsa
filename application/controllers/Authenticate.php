<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require_once __DIR__ . "/../libraries/OCSP_PHP_client/ocspcheck.php";

class Authenticate extends CI_Controller
{

    public function index()
    {
        if (!isset($_SERVER['HTTPS'])) {
            http_response_code(426);
            $this->load->view('navbar', array("title" => "SSL Error"));
            $this->load->view("errors/error_headless", array("heading" => "Upgrade Required", "message" => "Try using https instead."));
            $this->load->view("footer");
            return;
        }
//        echo "<br>";
//        $this->load->model('Database');
//        $data['news'] = $this->Database->getChat();
//        $data['title'] = 'Laela';
//        $this->load->view('navbar', $data);
//        $this->load->view('home', $data);
//        $this->load->view('footer');
        if (!$_SERVER["SSL_CLIENT_CERT"]) {
//            echo "Couldn't get client SSL certificate (ID-card autentication certificate)!";
            $this->load->view('navbar', array("title" => "SSL Error"));
            $this->load->view("errors/error_headless", array("heading" => "Missing SSL_CLIENT_CERT", "message" => "Couldn't get client SSL certificate (ID-card autentication certificate)!"));
            $this->load->view("footer");
        } else {
            if (array_key_exists('SSL_CLIENT_S_DN', $_SERVER) && $_SERVER['SSL_CLIENT_VERIFY'] == 'SUCCESS') {
                $authvalues = preg_split('/(?<!\\\\),/', $_SERVER['SSL_CLIENT_S_DN']);
                $auth = array();
                foreach ($authvalues as $authvalue) {
                    $authvalue = explode('=', $authvalue);
                    if (sizeof($authvalue) != 2) continue;
                    $auth[$authvalue[0]] = $authvalue[1];
                }
                if (array_key_exists('C', $auth) && array_key_exists('O', $auth) && array_key_exists('OU', $auth) &&
                    $auth['C'] == 'EE' && $auth['O'] == 'ESTEID' && $auth['OU'] == 'authentication'
                ) {
//                    echo "good!";
                    $this->load->model('user');
                    $this->load->model('register_model');
                    $this->user->authenticate_fb_user("ESTID:" . $auth['serialNumber'], $auth['GN'] . " " . $auth['SN'], $_SERVER["SSL_CLIENT_SAN_Email_0"]);
                    redirect("home");
                    //
//                    $this->session->fname = $auth['GN'];
//                    $this->session->lname = $auth['SN'];
//                    $this->session->id = $auth['serialNumber'];
                }
            }
//            var_dump($_SERVER);
//            $this->load->model('user', '', TRUE);
//            var_dump($_SERVER["SSL_CLIENT_CERT"]);
//            $result = doOCSPcheck($_SERVER["SSL_CLIENT_CERT"]);
//
//            echo "<p>MESSAGE: " . $result[0] . "<br>";
//            echo "RESPONSE: " . $result[1] . "</p>";

        }
    }
}
