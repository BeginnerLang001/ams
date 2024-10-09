<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OnlineAppointments_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all online appointments
    public function get_all_onlineappointments() {
        $query = $this->db->get('online_appointments');
        return $query->result_array();
    }

    // Get a single appointment by ID
    public function get_appointment($id) {
        $query = $this->db->get_where('online_appointments', array('id' => $id));
        return $query->row_array();
    }

    // Check if the user can book a new appointment based on email
    /**
     * Check if an appointment can be booked for the given email.
     * Enforces a restriction of booking once every minute.
     *
     * @param string $email The email address to check.
     * @return bool True if booking is allowed, false otherwise.
     */
    public function can_book_appointment($email) {
        $this->db->select('last_booking_time');
        $this->db->from('online_appointments');
        $this->db->where('email', $email);
        $this->db->order_by('last_booking_time', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        
        $result = $query->row_array();
        if ($result) {
            $lastBookingTime = new DateTime($result['last_booking_time']);
            $currentDateTime = new DateTime();
            $interval = $currentDateTime->diff($lastBookingTime);
            
            // Check if the last booking was within the last 5 minutes
            if ($interval->i < 5 && $interval->h == 0 && $interval->days == 0) {
                return false;
            }
        }
        return true;
    }
    public function update_last_booking_time($email, $last_booking_time) {
        $this->db->where('email', $email);
        $this->db->update('online_appointments', array('last_booking_time' => $last_booking_time));
    }
    
    

    /**
     * Check if a specific time slot is already booked.
     *
     * @param string $date The date of the appointment.
     * @param string $time The time of the appointment.
     * @return bool True if the time slot is booked, false otherwise.
     */
    public function is_time_booked($date, $time) {
        $this->db->where('appointment_date', $date);
        $this->db->where('appointment_time', $time);
        $query = $this->db->get('online_appointments');
        
        return $query->num_rows() > 0;
    }

    // Insert a new appointment
    public function insert_appointment($data) {
        return $this->db->insert('online_appointments', $data);         
    }

    // Update an existing appointment
    public function update_appointment($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('online_appointments', $data);
    }

    // Delete an appointment
    public function delete_appointment($id) {
        return $this->db->delete('online_appointments', array('id' => $id));
    }

    public function approve($id) {
        $data = array(
            'status' => 'approved'
        );
        $this->update_appointment($id, $data);
    }
    
    public function reject($id) {
        $data = array(
            'status' => 'declined'
        );
        $this->update_appointment($id, $data);
    }
    public function get_total_online_appointments() {
        return $this->db->count_all('online_appointments');
    }

    public function get_online_appointments_by_status($status) {
        $this->db->where('status', $status);
        return $this->db->count_all_results('online_appointments');
    }
    public function get_online_appointments_by_date($range) {
        $this->db->select('*');
        $this->db->from('online_appointments');  // Assuming your table is 'online_appointments'

        switch ($range) {
            case 'daily':
                // Get appointments for today
                $this->db->where('DATE(appointment_date)', date('Y-m-d'));
                break;

            case 'weekly':
                // Get appointments for the current week
                $this->db->where('YEARWEEK(appointment_date, 1) = YEARWEEK(CURDATE(), 1)');
                break;

            case 'monthly':
                // Get appointments for the current month
                $this->db->where('MONTH(appointment_date)', date('m'));
                $this->db->where('YEAR(appointment_date)', date('Y'));
                break;
        }

        return $this->db->get()->result_array();
    }
    
}
