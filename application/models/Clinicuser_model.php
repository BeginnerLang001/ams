<?php
class Clinicuser_model extends CI_Model {

    public function get_all_users() {
        return $this->db->get('users')->result_array();
    }

    public function get_user_by_id($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }


    public function insert_user($data) {
        $this->db->insert('users', $data);
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function delete_user($id) {
        $this->db->delete('users', ['id' => $id]);
    }
}
?>

