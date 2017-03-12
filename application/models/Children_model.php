<?php

class Children_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_child($user_id)
    {
        $childname = $this->input->post("childname");
        $birthday = $this->input->post("birthday");
        // Dates in mySQL are YYYY-MM-DD

        $sql = "CALL addChild(?,?,?)";
        $this->db->query($sql, array('user_id' => $user_id, 'childname' => $childname, 'birthday' => $birthday));
    }

    public function get_children($id)
    {
        $sql = "CALL getUserChildren(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }
}