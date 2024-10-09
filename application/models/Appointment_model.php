<?php
class Appointment_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_all_appointments()
    {
        // Fetch all appointments from the database
        $query = $this->db->get('appointments'); // Assuming 'appointments' is your table name
        return $query->result_array(); // Return the result as an array
    }


    public function get_appointments()
    {
        $this->db->select('appointments.*, CONCAT(registration.name, " ", registration.mname, " ", registration.lname) AS patient_name, registration.custom_id');
        $this->db->from('appointments');
        $this->db->join('registration', 'appointments.registration_id = registration.id', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_appointment_by_id($id)
    {
        $this->db->select('appointments.*, CONCAT(registration.name, " ", registration.mname, " ", registration.lname) AS patient_name, registration.custom_id');
        $this->db->from('appointments');
        $this->db->join('registration', 'appointments.registration_id = registration.id', 'left');
        $this->db->where('appointments.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_patients()
    {
        $this->db->select('r.id, CONCAT(r.name, " ", r.mname, " ", r.lname) AS full_name');
        $this->db->from('registration r');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function create_appointment($data)
    {
        return $this->db->insert('appointments', $data);
    }

    public function update_appointment($id, $data)

    {
        $data = array(
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'doctor' => $this->input->post('doctor'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status')
        );
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);
    }

    public function delete_appointment($id)
    {
        return $this->db->delete('appointments', array('id' => $id));
    }

    public function approve_appointment($id)
    {
        // Define the data to update the status
        $data = array('status' => 'approved');

        // Update the appointment record with the specified ID
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);
    }

    public function reject_appointment($id)
    {
        // Define the data to update the status
        $data = array('status' => 'rejected');

        // Update the appointment record with the specified ID
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);
    }



    public function get_settings()
    {
        // Implement the logic to get settings if needed
        return array(); // Placeholder
    }

    public function update_settings()
    {
        // Implement the logic to update settings if needed
    }
    public function get_total_appointments() {
        return $this->db->count_all('appointments');
    }

    public function get_appointments_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('appointments');
    }
    public function get_appointments_by_date($range) {
        $this->db->select('*');
        $this->db->from('appointments');
        
        switch($range) {
            case 'daily':
                $this->db->where('DATE(appointment_date)', date('Y-m-d'));
                break;
            case 'weekly':
                $this->db->where('YEARWEEK(appointment_date, 1) = YEARWEEK(CURDATE(), 1)');
                break;
            case 'monthly':
                $this->db->where('MONTH(appointment_date)', date('m'));
                $this->db->where('YEAR(appointment_date)', date('Y'));
                break;
        }
        
        return $this->db->get()->result_array();
    }
    
}
