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
        $child = $this->input->post("child");
        //language is constant atm
        $language = 'ee';
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
    }

    public function get_posts($id)
    {
        $sql = "CALL getUserPosts(?)";
        $query = $this->db->query($sql, array('id' => $id));
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
}