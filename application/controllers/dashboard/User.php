<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Dashboard_model');
        $this->load->model('OnlineAppointments_model');
        $this->load->model('Appointment_model');
 
        // Uncomment this if you need session authentication for admin access
        // if (!$this->session->userdata('logged_in') || $this->session->userdata('user_level') != 'admin') {
        //     redirect('auth/login');
        // }
    }

    public function index() {
        
        $data['appointments_count'] = $this->Dashboard_model->get_count('appointments');
        $data['medical_count'] = $this->Dashboard_model->get_count('medical');
        $data['registration_count'] = $this->Dashboard_model->get_count('registration');
        $data['onlineappointments_count'] = $this->Dashboard_model->get_count('online_appointments');
        $data['findings_count'] = $this->Dashboard_model->get_count('findings');
        $data['vitalsign_count'] = $this->Dashboard_model->get_count('vital_signs');
        $data['appointments'] = $this->Dashboard_model->get_appointments();
        $data['onlineappointments'] = $this->OnlineAppointments_model->get_all_onlineappointments();
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('r_assets/content', $data);  // Pass data to the content view
    }
    
    public function search_form() {
        $this->load->view('medication/search_form');
    }
}
?>
