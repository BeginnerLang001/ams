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
    public function get_appointments_count($month, $year) {
        $this->db->select('COUNT(*) as appointments_count');
        $this->db->from('appointments');
        $this->db->where('MONTH(appointment_date)', $month);
        $this->db->where('YEAR(appointment_date)', $year);
        $query = $this->db->get();
        return $query->row()->appointments_count;
    }

    public function get_online_appointments_count($month, $year) {
        $this->db->select('COUNT(*) as online_appointments_count');
        $this->db->from('online_appointments');
        $this->db->where('MONTH(appointment_date)', $month);
        $this->db->where('YEAR(appointment_date)', $year);
        $query = $this->db->get();
        return $query->row()->online_appointments_count;
    }

    public function get_registration_count($month, $year) {
        $this->db->select('COUNT(*) as registration_count');
        $this->db->from('registration');
        $this->db->where('MONTH(created_at)', $month);
        $this->db->where('YEAR(created_at)', $year);
        $query = $this->db->get();
        return $query->row()->registration_count;
    }

}
?>