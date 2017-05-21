<?php

class Post extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_new_post($unixTime)
    {
        $text = $this->input->post("newpost");
        if (strlen($text) <= 0) {
            return false;
        }
        $child = $this->input->post("child");
        if (!isset($child)) {
            return false;
        }

        if (isset($_SESSION['site_lang']) && ($_SESSION['site_lang'] === 'estonian')) {
            $language = 'ee';
        } else {
            $language = 'en';
        }
        $session_data = $this->session->userdata('logged_in');
        $id = $session_data['id'];

        if (isset($_POST["publicpost"])) {
            $public = 'n';
        } else {
            $public = 'y';
        }

        if ($unixTime === '') {
            $sql = "CALL newPostwLink(?,?,?,?,?)";
            $this->db->query($sql, array('user' => $id, 'public' => $public, 'text' => $text, 'language' => $language, 'child' => $child));
        } else {
            $sql = "CALL newPostwLinkTime(?,?,?,?,?,?)";
            $this->db->query($sql, array('user' => $id,
                'public' => $public,
                'text' => $text,
                'language' => $language,
                'child' => $child,
                'time' => $unixTime));
        }
        return true;
    }

    public function get_all_posts()
    {
        $sql = "CALL getPosts()";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_posts($id)
    {
        $sql = "CALL getUserPosts(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }

    public function load_some_posts($offset, $limit)
    {
        $sql = "SELECT * FROM postview WHERE postview.Public = 'y' ORDER BY Date DESC LIMIT ? OFFSET ?;";
        $query = $this->db->query($sql, array('limit' => intval($limit), 'offset' => intval($offset)));
        return $query->result_array();
    }

    public function get_childrenposts($id)
    {
        $this->db->close();
        $this->db->initialize();
        $sql = "CALL getUserChildrenPostsNo(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }

    public function getPostsCount()
    {
        $sql = "SELECT COUNT(*) AS 'posts' FROM postview WHERE postview.Public = 'y'";
        $query = $this->db->query($sql);
        return $query->row()->posts;
    }

    public function set_user_like($postID)
    {
        $session_data = $this->session->userdata('logged_in');
        $id = $session_data['id'];
        if (!isset($id)) {
            return -1;
        }
        $sql = "CALL addUserLike(?,?)";
        $this->db->query($sql, array('user' => $id, 'post' => $postID));

        return $this->get_likes($postID);
    }

    public function has_my_like($postId)
    {
        $session_data = $this->session->userdata('logged_in');
        $id = $session_data['id'];
        $sql = "SELECT f_hasMyLike(?,?) as result";
        $query = $this->db->query($sql, array('user' => $id, 'post' => $postId));
        return $query->row()->result;
    }

    public function get_likes($postId)
    {
        $sql = "SELECT f_calcLikes(?) as result";
        $query = $this->db->query($sql, array('id' => $postId));
        return $query->row()->result;
    }

    public function searchPosts($searchQuery)
    {

        $sql = "SELECT * FROM postview WHERE postview.Public = 'y' AND postview.Text LIKE ? ESCAPE '\\\'";
        $query = $this->db->query($sql, array('searchquery' => "%$searchQuery%"));
        return $query->result_array();

    }
}