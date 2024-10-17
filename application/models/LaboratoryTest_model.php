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
// Method to get patient name by registration ID
public function get_patient_name($registration_id) {
    $this->db->select('name');
    $this->db->from('registration');
    $this->db->where('id', $registration_id);
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->row()->name : 'Unknown';
}
public function get_patient_by_id($patient_id) {
    $this->db->select('id, name, birthday, address'); // Adjust the fields as necessary
    $this->db->from('registration');
    $this->db->where('id', $patient_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array(); // Return patient data as an associative array
    } else {
        return null; // Return null if no patient is found
    }
}

// Method to get patient birthday by registration ID
public function get_birthday($registration_id) {
    $this->db->select('birthday');
    $this->db->from('registration');
    $this->db->where('id', $registration_id);
    $query = $this->db->get();
    return $query->num_rows() > 0 ? $query->row()->birthday : 'Unknown';
}


// Method to get patient address by registration ID
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
            return $query->row_array(); // Return the test record as an associative array
        } else {
            return null; // No test record found
        }
    }
    
}
