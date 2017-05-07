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
        $bday = $this->input->post("cday");
        $bmonth = $this->input->post("cmonth");
        $byear = $this->input->post("cyear");
        $birthday = $byear.'-'.$bmonth.'-'.$bday;
        // Dates in mySQL are YYYY-MM-DD
        $this->db->close();
        $this->db->initialize();
        $sql = "CALL addChild(?,?,?)";
        $this->db->query($sql, array($user_id, 'childname' => $childname, 'birthday' => $birthday));
    }

    public function get_children($id)
    {
        $sql = "CALL getUserChildren(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }
    
    public function delete_child($id)
    {
        $sql = "CALL deleteChild(?)";
        $this->db->query($sql, array('id' => $id));
    }

    public function get_child($id)
    {
        $sql = "CALL getChild(?)";
        $query = $this->db->query($sql, array('id' => $id));
        return $query->result_array();
    }
    public function edit_child()
    {
        $id = $this->input->post("id");
        $childname = $this->input->post("childname");
        $bday = $this->input->post("cday");
        $bmonth = $this->input->post("cmonth");
        $byear = $this->input->post("cyear");
        $birthday = $byear.'-'.$bmonth.'-'.$bday;
        $this->db->close();
        $this->db->initialize();
        $sql = "CALL editChild(?,?,?)";
        $this->db->query($sql, array('id' => $id, 'childname' => $childname, 'birthday' => $birthday));
    }

}