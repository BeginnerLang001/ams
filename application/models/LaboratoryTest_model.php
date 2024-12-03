<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaboratoryTest_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function save_test($data) {
        // Insert data into the laboratory tests table
        $this->db->insert('laboratory_tests', $data);
    }
    
    public function get_all_tests() {
        $this->db->select('laboratory_tests.*, registration.name, registration.birthday, registration.address');
        $this->db->from('laboratory_tests');
        $this->db->join('registration', 'registration.id = laboratory_tests.registration_id');
        $query = $this->db->get();
        return $query->result_array();
    }
// In your LaboratoryTest_model
public function get_diagnosis_type($registration_id)
{
    // Joining laboratory_tests with diagnosis_types, with aliases for clarity
    $this->db->select('diagnosis_types.type');
    $this->db->from('laboratory_tests');
    $this->db->join('diagnosis_types', 'laboratory_tests.diagnosis_type_id = diagnosis_types.id');
    $this->db->where('laboratory_tests.registration_id', $registration_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row()->type;
    } else {
        return "N/A"; // Return "N/A" if no diagnosis type is found
    }
}

    public function get_patient_name($registration_id) {
        $this->db->select('name, mname, lname');
        $this->db->from('registration');
        $this->db->where('id', $registration_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $patient = $query->row();
            return htmlspecialchars($patient->name . ' ' . (!empty($patient->mname) ? $patient->mname . ' ' : '') . $patient->lname);
        } else {
            return 'Unknown';
        }
    }
    
public function get_patient_by_id($patient_id) {
    $this->db->select('id, name, mname, lname, birthday, address'); 
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
        $this->db->select('ultrasound,urinalysis, results, created_at, pregnancy_test, diagnosis_type_id');
        $this->db->where('registration_id', $registration_id);
        $query = $this->db->get('laboratory_tests');
    
        return $query->result(); 
    }
    
    
}
