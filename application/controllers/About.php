<?php

class About extends CI_Controller
{
    public function index()
    {
        $title['title'] = 'About';
        $this->load->view('navbar', $title);
        $this->load->view('about');
        $this->load->view('footer');
    }
}