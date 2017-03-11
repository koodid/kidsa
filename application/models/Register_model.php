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
        $username = $this->input->post("username");
        $password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);
        $email = $this->input->post("email");

        $sql = "CALL createNewUser(?,?,?)";
        $this->db->query($sql, array('username' => $username, 'password' => $password, 'email' => $email));
    }

    public function create_fb_user($fb_id, $name, $email)
    {
        $sql = "CALL createNewFBuser(?,?,?)";
        $this->db->query($sql, array('name' => $name, 'username' => $fb_id, 'email' => $email));
    }

    public function change_password($user_id)
    {
        $password = password_hash($this->input->post("password"), PASSWORD_DEFAULT);

        $sql = "CALL changePassword(?,?)";
        $this->db->query($sql, array('user_id' => $user_id, 'password' => $password));
    }
}