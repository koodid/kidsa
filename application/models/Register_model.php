<?php

class Register_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_new_user()
    {
        $name = $this->db->escape($this->input->post("name"));
        $username = $this->db->escape($this->input->post("username"));
        $password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
        $email = $this->db->escape($this->input->post("email"));

        //$sql = "CALL addNewUser($name, $username, '$password', $email)";
        $sql = "INSERT INTO users (Username, Password, Email) VALUES ($username, '$password', $email)";
        $this->db->query($sql);
    }

    public function create_fb_user($fb_id, $name, $email)
    {
        $name = $this->db->escape($name);
        $username = $this->db->escape($fb_id);
        $password = "";
        $email = $this->db->escape($email);

        //$sql = "CALL addNewUser($name, $username, '$password', $email)";'
        $sql = "INSERT INTO users (Name, Username, Password, Email) VALUES ($name, $username, '$password', $email)";

        $this->db->query($sql);
    }
}