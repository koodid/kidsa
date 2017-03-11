<?php

class Children extends CI_Controller
{
    public function index()
    {
        $title['title'] = 'Children';
        $this->load->view('navbar', $title);
        $this->load->view('children');
        $this->load->view('footer');
    }
}