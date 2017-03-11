<?php

class Settings extends CI_Controller
{
    public function index()
    {
        $title['title'] = 'Settings';
        $this->load->view('navbar', $title);
        $this->load->view('settings');
        $this->load->view('footer');
    }
}