<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function index()
    {
        $this->load->model('Post');
        //$data['allposts'] = $this->Post->get_all_posts();
        //$data['allposts'] = $this->Post->load_some_posts(0, 10);
        $title['title'] = 'Kidsa';
        $title['extra_scripts'] = array('/js/loadposts.js', '/js/polling.js', '/js/likes.js');
        $this->load->view('navbar', $title);
        //$this->load->view('main', $data);
        $this->load->view('main');
        $this->load->view('footer');
    }

    public function postsCount()
    {
        $this->load->model('Post');
        $pollingResults = $this->Post->getPostsCount();
        echo json_encode($pollingResults);
    }

    public function getNewPosts($limit)
    {
        $this->load->model('Post');
        $data['all_posts'] = $this->Post->load_some_posts(0, $limit);
        $new_posts = $this->load->view('show_posts', $data, TRUE);
        echo $new_posts;
    }

    public function showAllPublicPosts()
    {
        $this->load->model('Post');
        $data['all_posts'] = $this->Post->get_all_posts();
        $response = $this->load->view('show_posts', $data, TRUE);
        echo $response;
    }
}
