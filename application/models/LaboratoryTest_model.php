<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaboratoryTest_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_tests() {
        $this->db->select('laboratory_tests.*, registration.name, registration.birthday, registration.address');
        $this->db->from('laboratory_tests');
        $this->db->join('registration', 'registration.id = laboratory_tests.registration_id');
        $query = $this->db->get();
        return $query->result_array();
    }

public function get_patient_name($registration_id) {
    $this->db->select('name');
    $this->db->from('registration');
    $this->db->where('id', $registration_id);
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->row()->name : 'Unknown';
}
public function get_patient_by_id($patient_id) {
    $this->db->select('id, name, birthday, address'); 
    $this->db->from('registration');
    $this->db->where('id', $patient_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); 
    } else {
        return null; 
    }
}


public function get_birthday($registration_id) {
    $this->db->select('birthday');
    $this->db->from('registration');
    $this->db->where('id', $registration_id);
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->row()->birthday : 'Unknown';
}



public function get_address($registration_id) {
    $this->db->select('address');
    $this->db->from('registration');
    $this->db->where('id', $registration_id);
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->row()->address : 'Unknown';
}

    public function insert_test($data) {
        return $this->db->insert('laboratory_tests', $data);
    }

    public function get_test_by_id($id) {
        return $this->db->get_where('laboratory_tests', array('id' => $id))->row_array();
    }

    public function update_test($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('laboratory_tests', $data);
    }

    public function delete_test($id) {
        return $this->db->delete('laboratory_tests', array('id' => $id));
    }
    public function get_test_by_patient_id($patient_id) {
        $this->db->where('patient_id', $patient_id);
        $query = $this->db->get('laboratory_tests');
    
        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        } else {
            return null; 
        }
    }
    public function get_tests_by_registration_id($registration_id)
    {
        $this->db->select('ultrasound,urinalysis, results, created_at, pregnancy_test');
        $this->db->where('registration_id', $registration_id);
        $query = $this->db->get('laboratory_tests');
    
        return $query->result(); 
    }
    
    
}
