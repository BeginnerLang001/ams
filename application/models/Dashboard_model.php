<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_count($table_name)
    {
        $this->db->from($table_name);
        return $this->db->count_all_results();
    }

    public function get_appointments() {
        $this->db->select('appointments.*, CONCAT(registration.name, " ", registration.mname, " ", registration.lname) AS patient_name, registration.custom_id');
        $this->db->from('appointments');
        $this->db->join('registration', 'appointments.registration_id = registration.id', 'left'); // Use LEFT JOIN to include all appointments
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>