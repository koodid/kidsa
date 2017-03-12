<?php
require_once __DIR__ . '/../config/secret_config.php';

class About extends CI_Controller
{
    public function index()
    {
        $title['title'] = 'About';
        $title['extra_scripts'] = array('/js/map.js', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY . '&callback=onMapLoad');
        $this->load->view('navbar', $title);
        $this->load->view('about');
        $this->load->view('footer');
    }
}