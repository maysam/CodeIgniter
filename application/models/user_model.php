<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

    public function find_by_username($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    public function authenticate($username, $password)
    {
        $user = $this->find_by_username($username);

        if (empty($user)) {
            return NULL;
        }

        if ($user['password_hash'] !== sha1($password)) {
            return NULL;
        }

        return $user;
    }
}
