<?php

class Post extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function create_new_post($id)
    {
        //TODO set children id from selection..
        $text = $this->input->post("newpost");
        $child = $this->input->post("child");

        if(isset($_POST["publicpost"])) {
            $public = 'n';
        }
        else {
            $public = 'y';

        }
        //atm newPost takes 3 arguments, language not used
        //also TODO  add childrenposts and language to newPost
        $sql = "CALL newPost(?,?,?)";
        $this->db->query($sql, array('user' => $id, 'public' => $public, 'text' => $text));

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