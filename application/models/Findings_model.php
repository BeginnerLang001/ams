<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Findings_model extends CI_Model
{
    public function insert_findings($data)
    {
        $this->db->insert('findings', $data);
    }

    public function get_all_findings()
{
    $this->db->select('id, registration_id, findings, recommendations, created_at'); // Adjust fields as necessary
    $this->db->from('findings'); // Make sure this points to the correct table
    $query = $this->db->get();
    return $query->result(); // Return the result as an array of objects
}
public function get_all_findings_index()
{
    $this->db->select('f.id, f.registration_id, f.findings, f.recommendations, f.created_at, 
                       CONCAT(r.name, " ", r.mname, " ", r.lname) AS full_name'); // Construct full name
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
}
