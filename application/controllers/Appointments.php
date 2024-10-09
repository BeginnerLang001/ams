<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Appointments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Appointment_model');
        $this->load->model('Registration_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['form_validation', 'session']);
    }

    public function index()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            $this->session->set_flashdata('error', 'You are not authorized to access this page.');
            redirect('dashboard');
            return;
        }

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

        $user_level = $this->session->userdata('user_level');
        $this->load->view('r_assets/navbar');

        if ($user_level == 'admin') {
            $this->load->view('r_assets/sidebar');
        } else {
            $this->load->view('r_assets/user_sidebarold');
        }

        $this->load->view('appointments/view', $data);
    }

    public function create()
    {
        $this->form_validation->set_rules('patient_id', 'Patient', 'required');
        $this->form_validation->set_rules('appointment_date', 'Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Time', 'required');
        // $this->form_validation->set_rules('email_account', 'Email', 'required|valid_email');

        if ($this->form_validation->run() === FALSE) {
            $data['patients'] = $this->Appointment_model->get_patients();
            $data['doctor'] = 'Dra. Chona Mendoza';

            $user_level = $this->session->userdata('user_level');
            $this->load->view('r_assets/navbar');

            if ($user_level == 'admin') {
                $this->load->view('r_assets/sidebar');
            } else {
                $this->load->view('r_assets/user_sidebarold');
            }

            $this->load->view('appointments/create', $data);
        } else {
            $appointment_data = array(
                'registration_id' => $this->input->post('patient_id'),
                'appointment_date' => $this->input->post('appointment_date'),
                'appointment_time' => $this->input->post('appointment_time'),
                'doctor' => $this->input->post('doctor'),
                'notes' => $this->input->post('notes'),
                'status' => $this->input->post('status'),
                // 'email_account' => $this->input->post('email_account') // Store email here
            );

            $appointment_id = $this->Appointment_model->create_appointment($appointment_data);

            if ($appointment_id) {
                $this->session->set_flashdata('message', 'Appointment created successfully!');
                redirect($this->session->userdata('user_level') == 'admin' ? 'appointments' : 'dashboard/user');
            } else {
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

        // Load doctor name for display
        $data['doctor_name'] = "Dr. Chona Mendoza"; // Assuming Dr. Chona Mendoza is static
        // Get the user level from session
        $user_level = $this->session->userdata('user_level');

        // Load the navbar
        $this->load->view('r_assets/navbar');

        // Load the sidebar based on user level
        if ($user_level == 'admin') {
            $this->load->view('r_assets/sidebar');
        } else {
            $this->load->view('r_assets/user_sidebarold');
        }

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
                echo "Update successful!";
            } else {
                echo "Update failed!";
            }

            // Redirect to the appointments list or show a success message
            $this->session->set_flashdata('success', 'Appointment updated successfully.');

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
