<?php
class Doctors_appointments_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_appointments()
    {
        $this->db->select('*');
        $this->db->from('doctors_appointments');
        $query = $this->db->get();
        return $query->result_array();
    }
    // Create a new appointment
    public function create_appointment()
    {
        $data = array(
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'appointment_reason' => $this->input->post('appointment_reason'),
            'doctor_name' => 'Dra. Chona Mendoza' // Fixed value
        );
        return $this->db->insert('doctors_appointments', $data);
    }

    // Check if a time slot is available
    public function is_time_slot_available($date, $time)
    {
        $this->db->where('appointment_date', $date);
        $this->db->where('appointment_time', $time);
        $this->db->where('appointment_status', 'Scheduled');
        $query = $this->db->get('doctors_appointments');

        return $query->num_rows() == 0; // If no rows, time slot is available
    }
}
