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
        $name = $_POST["name"];
        $username = $_POST["username"];
        $password = md5($_POST["password"]);
        $email = $_POST["email"];

        $sql = "CALL addNewUser('$name', '$username', '$password', '$email')";
        $this->db->query($sql);

    }
}