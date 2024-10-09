<?
class Report_model extends CI_Model {

    public function get_total_registrations($startDate, $endDate) {
        $this->db->where('registration_date >=', $startDate);
        $this->db->where('registration_date <=', $endDate);
        return $this->db->count_all_results('registrations');
    }

    public function get_total_online_appointments($startDate, $endDate) {
        $this->db->where('appointment_type', 'online');
        $this->db->where('appointment_date >=', $startDate);
        $this->db->where('appointment_date <=', $endDate);
        return $this->db->count_all_results('appointments');
    }

    public function get_online_appointments_status($startDate, $endDate, $status) {
        $this->db->where('appointment_type', 'online');
        $this->db->where('status', $status);
        $this->db->where('appointment_date >=', $startDate);
        $this->db->where('appointment_date <=', $endDate);
        return $this->db->count_all_results('appointments');
    }

    public function get_total_walk_in_appointments($startDate, $endDate) {
        $this->db->where('appointment_type', 'walk-in');
        $this->db->where('appointment_date >=', $startDate);
        $this->db->where('appointment_date <=', $endDate);
        return $this->db->count_all_results('appointments');
    }

    public function get_walk_in_appointments_status($startDate, $endDate, $status) {
        $this->db->where('appointment_type', 'walk-in');
        $this->db->where('status', $status);
        $this->db->where('appointment_date >=', $startDate);
        $this->db->where('appointment_date <=', $endDate);
        return $this->db->count_all_results('appointments');
    }
    
}
