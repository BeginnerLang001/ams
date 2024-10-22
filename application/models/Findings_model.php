<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Findings_model extends CI_Model
{
   
    public function get_all_findings()
    {
        $this->db->select('id, registration_id, findings, recommendations, created_at'); // Adjust fields as necessary
        $this->db->from('findings'); // Make sure this points to the correct table
        $query = $this->db->get();
        return $query->result(); // Return the result as an array of objects
    }

    public function get_all_findings_index()
{
    $this->db->select('f.id, r.birthday, r.address, f.registration_id, f.findings, f.recommendations, f.created_at, 
                       CONCAT(r.name, " ", r.mname, " ", r.lname) AS full_name'); // Get birthday from registration table
    $this->db->from('findings f');
    $this->db->join('registration r', 'f.registration_id = r.id'); // Join with registration table
    $query = $this->db->get();
    return $query->result(); // Return the result as an array of objects
}


    public function get_findings_by_registration_id($registration_id)
    {
        $this->db->where('registration_id', $registration_id);
        $query = $this->db->get('findings'); // Make sure you use the correct table name
        return $query->result(); // Return as an array of objects
    }

    public function get_findings_by_id($id)
    {
        $this->db->where('id', $id); // Assuming 'id' is the primary key column for the findings table
        $query = $this->db->get('findings'); // Replace 'findings' with your actual findings table name

        // Return the result as an array if found, otherwise return null
        return $query->row_array();
    }

    // Logic to get all relevant data
    public function get_vital_signs_by_registration_id($registration_id) {
        $this->db->where('registration_id', $registration_id); // Filter by registration ID
        $query = $this->db->get('vital_signs'); // Query the vital_signs table
        return $query->result(); // Return results as an array of objects
    }
    
    // Method to get all laboratory tests with patient details
    public function get_all_laboratory_tests_index()
    {
        $this->db->select('lt.id, lt.registration_id, lt.urinalysis, lt.ultrasound, lt.results, lt.created_at, 
                           lt.pregnancy_test, CONCAT(r.name, " ", r.mname, " ", r.lname) AS full_name');
        $this->db->from('laboratory_tests lt'); // Adjust the table name if needed
        $this->db->join('registration r', 'lt.registration_id = r.id'); // Join with registration table
        $query = $this->db->get();
        return $query->result();
    }

    // Logic to get all relevant data for a patient
    public function get_patient_report($registration_id)
    {
        $data['findings'] = $this->get_findings_by_registration_id($registration_id);
        $data['vital_signs'] = $this->Vital_sign_model->get_vital_signs_by_registration_id($registration_id);
        $data['laboratory_tests'] = $this->LaboratoryTest_model->get_tests_by_registration_id($registration_id);
        
        return $data;
    }
    public function get_patient_by_registration_id($registration_id) {
        $this->db->where('id', $registration_id);
        $query = $this->db->get('registration');
        return $query->row();
    }


    public function insert_findings($registration_id, $findings, $recommendations) {
        $data = [
            'registration_id' => $registration_id,
            'findings' => $findings,
            'recommendations' => $recommendations,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('findings', $data);
    }
    
}