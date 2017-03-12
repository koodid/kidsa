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
       
        $text = $this->input->post("newpost");
        $child = $this->input->post("child");
        //language is constant atm
        $language = 'ee';

        if(isset($_POST["publicpost"])) {
            $public = 'n';
        }
        else {
            $public = 'y';

        }

        $sql = "CALL newPostwLink(?,?,?,?,?)";
        $this->db->query($sql, array('user' => $id, 'public' => $public, 'text' => $text, 'language' => $language, 'child' => $child));


    }
    public function get_posts($id)
    {
        $sql = "CALL getUserPosts(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }
}