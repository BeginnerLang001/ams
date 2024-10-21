<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');

class Appointments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Appointment_model');
        $this->load->model('Registration_model');
        $this->load->model('Diagnosis_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'session']);
    }

    public function search()
    {
        $name = $this->input->post('name');

        // Search patients using the Appointment_model
        $data['patients'] = $this->Appointment_model->search_patient_by_name($name);
        $data['search_name'] = $name; // Store the search term

        // Load the view with search results
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('appointments/patient_search_results', $data);
    }

    public function search_form()
    {
        // Prepare data for the view
        $data['search_name'] = $this->session->flashdata('search_name'); // Use flashdata for temporary storage
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('appointments/patient_search'); // Ensure this is the correct view file
    }

    public function index()
    {
        $data['appointments'] = $this->Appointment_model->get_appointments();

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('appointments/index', $data);
    }

    public function view($id)
{
    $data['appointment'] = $this->Appointment_model->get_appointment_by_id($id);

    if (empty($data['appointment'])) {
        show_404();
    }

    // Debugging line
    log_message('debug', 'Appointment data: ' . print_r($data['appointment'], true));

    // Extract patient name if available
    $data['patient_name'] = $data['appointment']['patient_name']; // Default if not set

    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('appointments/view', $data);
}


public function create($patient_id = null)
{
    $this->load->library('form_validation');
    $this->load->model('Registration_model');

    // Set validation rules
    $this->form_validation->set_rules('patient_id', 'Patient', 'required');
    $this->form_validation->set_rules('appointment_date', 'Date', 'required');
    $this->form_validation->set_rules('appointment_time', 'Time', 'required');

    // Initialize the data array
    $data = []; // Create an empty data array

    // Check if a patient_id is provided as a parameter in the URL
    if ($patient_id) {
        $patient = $this->Registration_model->get_patient_by_id($patient_id);

        if ($patient) {
            // Store patient details in the data array
            $data['patient'] = $patient; // Store the whole patient array
            $data['patient_id'] = $patient_id; // Set patient_id for the form
        } else {
            // Handle case where patient is not found
            $data['patient'] = null; // Set patient to null if not found
        }
    } else {
        // Initialize patient data to an empty array
        $data['patient'] = [
            'name' => '',
            'mname' => '',
            'lname' => '',
        ];
        // Since no patient ID was provided, it won't be set.
        $data['patient_id'] = null; // Default to null
    }

    // Check if the form validation has failed
    if ($this->form_validation->run() === FALSE) {
        // Prepare data for the view
        $data['patients'] = $this->Appointment_model->get_patients();
        $data['doctor'] = 'Dra. Chona Mendoza';

        // Load navbar and sidebar
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');

        // Load the appointment creation view with patient data
        $this->load->view('appointments/create', $data);
    } else {
        // Prepare appointment data to be saved
        $appointment_date = $this->input->post('appointment_date');
        $appointment_time = $this->input->post('appointment_time');

        // Check if the time slot is already booked
        if ($this->Appointment_model->is_time_slot_booked($appointment_date, $appointment_time)) {
            $this->session->set_flashdata('error_message', 'This time slot is already booked. Please choose another time.');
            redirect('appointments/create'); // Redirect back to the create appointment page
        }

        $appointment_data = array(
            'registration_id' => $this->input->post('patient_id'), // Use the patient_id here
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'doctor' => 'Dra. Chona Mendoza',
            'notes' => $this->input->post('notes'),
            'status' => 'pending', // Set default status or use input if available
        );

        // Create the appointment
        if ($this->Appointment_model->create_appointment($appointment_data)) {
            // Set success message and redirect
            $this->session->set_flashdata('message', 'Appointment created successfully!');
            redirect('appointments');
        } else {
            // Set error message
            $this->session->set_flashdata('error_message', 'Failed to create appointment. Please try again.');
            redirect('appointments/create');
        }
    }
}


    public function edit($id)
{
    // Load the appointment model
    $this->load->model('Appointment_model');

    // Load the appointment details
    $data['appointment'] = $this->Appointment_model->get_appointment_by_id($id);

    if (empty($data['appointment'])) {
        show_404();
    }

    // Pass patient name to the view
    $data['patient_name'] = $data['appointment']['patient_name'];

    // Load doctor name for display
    $data['doctor_name'] = "Dr. Chona Mendoza"; // Assuming Dr. Chona Mendoza is static

    // Load the navbar
    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');

    // Validation rules
    $this->form_validation->set_rules('appointment_date', 'Date', 'required');
    $this->form_validation->set_rules('appointment_time', 'Time', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    if ($this->form_validation->run() === FALSE) {
        // Validation failed, reload the form with errors
        $this->load->view('appointments/edit', $data);
    } else {
        // Collect form data
        $update_data = array(
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'status' => $this->input->post('status'),
            'notes' => $this->input->post('notes')
        );

        // Update the appointment in the database
        if ($this->Appointment_model->update_appointment($id, $update_data)) {
            $this->session->set_flashdata('success', 'Appointment updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Update failed!');
        }

        // Redirect to the appointments list
        redirect('appointments');
    }
}

    public function delete($id)
    {
        $this->Appointment_model->delete_appointment($id);
        redirect('appointments');
    }

    public function approve($id)
    {
        if ($this->Appointment_model->approve_appointment($id)) {
            $this->session->set_flashdata('message', 'Appointment approved successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to approve appointment.');
        }

        redirect('appointments');
    }

    public function reject($id)
    {
        if ($this->Appointment_model->reject_appointment($id)) {
            $this->session->set_flashdata('message', 'Appointment rejected successfully!');
        } else {
            $this->session->set_flashdata('message', 'Failed to reject appointment.');
        }

        redirect('appointments');
    }

    public function settings()
    {
        $this->form_validation->set_rules('open_days', 'Open Days', 'required');
        $this->form_validation->set_rules('open_hours', 'Open Hours', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['settings'] = $this->Appointment_model->get_settings();
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
            $this->load->view('appointments/settings', $data);
        } else {
            $this->Appointment_model->update_settings();
            $this->session->set_flashdata('message', 'Settings updated successfully!');
            redirect('appointments/settings');
        }
    }

    public function get_total_appointments()
    {
        return $this->db->count_all('appointments');
    }

    public function get_appointments_by_status($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('appointments');
    }
}
