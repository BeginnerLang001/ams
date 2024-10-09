<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctors_appointments extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Doctors_appointments_model'); // Load the model
    }

    // List all appointments
    public function index()
    {
        $data['appointments'] = $this->Doctors_appointments_model->get_all_appointments();
        $this->load->view('doctors_appointment/index', $data);
    }

    // Create a new appointment
    public function create()
    {
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('doctors_appointment/create');
        } else {
            $this->Doctors_appointments_model->create_appointment();
            redirect('doctors_appointments');
        }
    }

    // Check if a time slot is available
    public function check_availability()
    {
        $date = $this->input->post('appointment_date');
        $time = $this->input->post('appointment_time');
        $is_available = $this->Doctors_appointments_model->is_time_slot_available($date, $time);

        if ($is_available) {
            echo 'Available';
        } else {
            echo 'Not Available';
        }
    }
}
