<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->model('Post');
        $data['allposts'] = $this->Post->get_all_posts();
        $title['title'] = 'Kidsa';
        $title['extra_scripts'] = array('/js/loadposts.js', '/js/polling.js');
        $this->load->view('navbar', $title);
        $this->load->view('main', $data);
        $this->load->view('footer');
    }

    public function postsCount()
    {
        $this->load->model('Post');
        $pollingResults = $this->Post->getPostsCount();
        echo json_encode($pollingResults);
    }

    public function getNewPosts($limit){
        $result = "";
        $this->load->model('Post');
        $posts = $this->Post->load_some_posts(0, $limit);
        $result = $result."<h2><small>".lang("msg_newposts")."</small></h2>";
        foreach ($posts as $post) {
            $result = $result."<blockquote class=\"blockquote\">".$post['Text']."<footer class=\"blockquote-footer\">".$post['Name'].", ".$post['Birthday']."</blockquote>";
        }
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
}
