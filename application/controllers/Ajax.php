<?php

class Ajax extends CI_Controller
{
    public function index()
    {

    }

    function load_some_posts($offset, $limit = 3)
    {
        $this->load->model('Post');
        $this->load->view('post_xml', array('posts' => $this->Post->load_some_posts($offset, $limit)));
    }

    function set_like($post_id)
    {
        $this->load->model('Post');
        echo $this->Post->set_user_like($post_id);
    }
}