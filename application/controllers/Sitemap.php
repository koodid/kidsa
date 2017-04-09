<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends CI_Controller
{
    public function index()
    {
        $title['title'] = lang("msg_sitemap");
        $this->load->view('navbar', $title);
        $this->load->view('sitemap');
        $this->load->view('footer');
    }
}