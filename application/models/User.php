<?php

Class User extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function login($username, $password)
    {
        // TODO Rakendus ei teosta SELECT päringuid mittekonstantsetel tabelitel (vaadete kasutamine andmete pärimiseks)
        $this->db->select('id, name, username, password');
        $this->db->from('users');
        $this->db->where('username', $username);
        // TODO add once usernames are unique $this->db->limit(1);

        $query = $this->db->get();

        foreach ($query->result() as $row) {
            if (password_verify($password, $row->password)) {
                return $row;
            }
        }

        return false;
    }

    public function authenticate_fb_user($fb_id, $name, $email)
    {
        $this->db->select('id, name, username, password');
        $this->db->from('users');
        $this->db->where('username', $fb_id);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $sess_array = array(
                    'id' => $row->id,
                    'username' => $row->username,
                    'name' => $row->name
                );
                $this->session->set_userdata('logged_in', $sess_array);
                return TRUE;
            }
        } else {
            $this->register_model->create_fb_user($fb_id, $name, $email);
            $this->authenticate_fb_user($fb_id, $name, $email);
            return TRUE;
        }
        return false;
    }
}