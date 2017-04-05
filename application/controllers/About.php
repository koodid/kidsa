<?php
require_once __DIR__ . '/../config/secret_config.php';

class About extends CI_Controller
{
    public function index()
    {
        $title['title'] = lang("msg_about");
        $title['extra_scripts'] = array('/js/map.js', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY . '&callback=onMapLoad');
        $this->load->view('navbar', $title);
        $this->load->view('about');
        $this->load->view('footer');
    }

    public function received() {
        $title['title'] = lang("msg_about");
        $title['extra_scripts'] = array('/js/map.js', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY . '&callback=onMapLoad');
        $this->load->view('navbar', $title);
        $this->load->view('paymentreceived');
        $this->load->view('about');
        $this->load->view('footer');
    }

    public function cancelled() {
        $title['title'] = lang("msg_about");
        $title['extra_scripts'] = array('/js/map.js', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY . '&callback=onMapLoad');
        $this->load->view('navbar', $title);
        $this->load->view('paymentcancelled');
        $this->load->view('about');
        $this->load->view('footer');
        
    }
}