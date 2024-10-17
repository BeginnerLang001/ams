<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vital_sign_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Insert a new vital sign record
    public function insert($data)
    {
        $this->db->insert('vital_signs', $data);
        return $this->db->insert_id();
    }

    // Get a specific vital sign record by ID
    public function get_vital_sign($id)
    {
        $this->db->select('vs.*, r.name as patient_name, r.birthday, r.age, r.address');
        $this->db->from('vital_signs vs');
        $this->db->join('registration r', 'vs.registration_id = r.id');
        $this->db->where('vs.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    // Get all vital sign records with patient details
    public function get_all_with_patients()
    {
        $this->db->select('vs.*, r.name as patient_name, r.birthday, r.age, r.address');
        $this->db->from('vital_signs vs');
        $this->db->join('registration r', 'vs.registration_id = r.id');
        $this->db->order_by('vs.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    // Update a vital sign record
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('vital_signs', $data);
    }

    // Delete a vital sign record
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('vital_signs');
    }

    // Get patient list for dropdowns
    public function get_patients()
    {
        $this->db->select('id, name');
        $this->db->from('registration');
        $query = $this->db->get();
        return $query->result();
    }
    public function search_patients($name)
    {
        // Perform a database query to find patients by name
        $this->db->like('name', $name);
        $query = $this->db->get('registration'); // Change 'patients' to your actual table name
    
        return $query->result(); // Return the result as an array of objects
    }
    // vital_sign_model.php
public function get_patient_by_registration_id($registration_id)
{
    $this->db->select('id, name, mname, lname');
    $this->db->from('registration'); // Assuming your table is named 'patients'
    $this->db->where('id', $registration_id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        $patient = $query->row();
        // Concatenate the full name
        $patient->full_name = $patient->name . ' ' . ($patient->mname ? $patient->mname . ' ' : '') . $patient->lname;
        return $patient;
    } else {
        return null;
    }
}


}
