<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendar_model extends CI_Model {

    public function get_all_appointments() {
        $this->db->select('appointments.*, registration.name, registration.lname');
        $this->db->from('appointments');
        $this->db->join('registration', 'appointments.registration_id = registration.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_online_appointments() {
        $this->db->select('*');
        $this->db->from('online_appointments');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_online_registration() {
        $this->db->select('*');
        $this->db->from('registration');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_appointment_by_id($id) {
        $this->db->select('*');
        $this->db->from('appointments');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function create_appointment($data) {
        $this->db->insert('appointments', $data);
    }

    public function update_appointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointments', $data);
    }

    public function delete_appointment($id) {
        $this->db->where('id', $id);
        $this->db->delete('appointments');
    }
}