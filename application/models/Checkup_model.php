<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup_model extends CI_Model {

    protected $table = 'check_up';

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    // public function get_checkup($id) {
    //     return $this->db->get_where($this->table, ['id' => $id])->row();
    // }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data) {
        return $this->db->update($this->table, $data, ['id' => $id]);
    }

    public function delete($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function get_all_with_patients() {
        $this->db->select('check_up.*, registration.id as registration_id, registration.name, registration.mname, registration.lname, registration.address, registration.birthday, registration.age');
        $this->db->from($this->table);
        $this->db->join('registration', 'registration.id = check_up.registration_id'); 
        return $this->db->get()->result();
    }
    public function get_patients() {
        $this->db->select('id, CONCAT(name, " ", mname, " ", lname) as full_name');
        $this->db->from('registration');
        $this->db->where('is_deleted', 0); 
        return $this->db->get()->result();
    }    
    public function get_patient_by_registration_id($registration_id) {
        $this->db->select('name, mname, lname');
        $this->db->from('registration'); 
        $this->db->where('id', $registration_id);
        return $this->db->get()->row(); 
    }
    public function get_checkup($id) {
        $this->db->select('check_up.*, registration.id as registration_id, registration.name, registration.mname, registration.lname, registration.address, registration.birthday, registration.age');
        $this->db->from('check_up');
        $this->db->join('registration', 'check_up.registration_id = registration.id'); 
        $this->db->where('check_up.id', $id);
        return $this->db->get()->row(); 
    }
    // public function get_checkups_by_date($date_range) {
    //     $this->db->select('check_up.*, registration.id as registration_id, registration.name, registration.mname, registration.lname');
    //     $this->db->from('check_up');
    //     $this->db->join('registration', 'registration.id = check_up.registration_id'); 
    //     $this->db->where('check_up.created_at >=', $date_range['start']);
    //     $this->db->where('check_up.created_at <=', $date_range['end']);
    //     return $this->db->get()->result();
    // }
    public function get_checkups_by_date($start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('check_up');
        $this->db->where('created_at >=', $start_date . ' 00:00:00');
        $this->db->where('created_at <=', $end_date . ' 23:59:59');
        $query = $this->db->get();
        return $query->result();
    }
}
