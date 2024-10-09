<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function update_custom_id($user_id, $custom_id)
    {
        $this->db->where('id', $user_id);
        $this->db->update('users', array('custom_id' => $custom_id));
    }

    public function create_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_id($id)
    {
        $query = $this->db->get_where('users', array('id' => $id));
        return $query->row_array(); 
    }

    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', array('email' => $email))->row();
    }
}
?>
