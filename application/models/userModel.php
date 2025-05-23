<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userModel extends CI_Model {

    public function authenticate($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', MD5($password));
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return $query->row('id');
        } else {
            return false;
        }
    }
}