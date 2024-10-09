<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');
    }

    public function generateCustomIds() {
        $users = $this->User_model->get_all_users();

        foreach ($users as $user) {
            $custom_id = $this->generateCustomId();
            $this->User_model->update_custom_id($user->id, $custom_id);
        }

        echo "Custom IDs generated and saved successfully.";
    }

    private function generateCustomId() {
        $prefix = 'MCH2024';
        $suffix = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        return $prefix . $suffix;
    }
    public function get_user($user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get('users');
        return $query->row_array(); // or row() if it's an object
    }
    
}
?>
