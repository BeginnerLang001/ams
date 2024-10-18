<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OnlineAppointments extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OnlineAppointments_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
    }

    public function index() {
        $this->load->model('OnlineAppointments_model');
        
        // Fetch all online appointments
        $data['onlineappointments'] = $this->OnlineAppointments_model->get_all_onlineappointments();
        
        // Define the status labels
        $data['status_labels'] = [
            'approved' => 'Approved',
            'declined' => 'Declined',
            'pending' => 'Pending', // Add other status labels as needed
            // Add more mappings as required
        ];

        // Load your view and pass the data
        $this->load->view('onlineappointments/index', $data);
    }

    public function create()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $this->load->view('onlineappointments/create');
    }

    public function store()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $data = array(
            'email' => $this->input->post('email'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'contact_number' => $this->input->post('contact_number'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'status' => 'pending'
        );

        $this->OnlineAppointments_model->insert_appointment($data);
        redirect('onlineappointments');
    }
    public function get_available_slots() {
        $this->load->model('OnlineAppointments_model');
        
        $date = $this->input->get('date');
        
        if ($date) {
            $existingAppointments = $this->OnlineAppointments_model->get_booked_slots($date);
            
            // Define your time slots
            $timeSlots = [
                '09:00', '09:30', '10:00', '10:30',
                '12:30', '13:00', '13:30', '14:00',
                '14:30', '15:00', '15:30', '16:00', '16:30', '17:00'
            ];
            
            // Filter out booked time slots
            $availableSlots = array_diff($timeSlots, $existingAppointments);
            
            // Return available slots as JSON
            echo json_encode(['availableSlots' => array_values($availableSlots)]);
        }
    }
    

    public function onlinestore() {
        // Load necessary libraries
        $this->load->library('form_validation');
        $this->load->library('session');
    
        // Set form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required|callback_check_appointment_date'); // Custom callback for date validation
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
    
        // Run validation
        if ($this->form_validation->run() === FALSE) {
            // Set error flash data and redirect if validation fails
            $this->session->set_flashdata('error', validation_errors());
            redirect('clinic/index'); 
        } else {
            // Get form data
            $email = $this->input->post('email');
            $appointment_date = $this->input->post('appointment_date');
            $appointment_time = $this->input->post('appointment_time');
    
            // Check if the user can book an appointment
            if (!$this->OnlineAppointments_model->can_book_appointment($email)) {
                // Set warning flash data if booking is attempted within the last 5 minutes
                $this->session->set_flashdata('warning', 'You can only book an appointment once every 5 minutes.');
                redirect('clinic/index'); 
            } else {
                // Check if the time slot is already booked
                if ($this->OnlineAppointments_model->is_time_booked($appointment_date, $appointment_time)) {
                    // Set warning flash data if time slot is already booked
                    $this->session->set_flashdata('warning', 'The selected time slot is already booked. Please choose a different time.');
                    redirect('clinic/index'); 
                } else {
                    // Proceed with booking
                    $data = array(
                        'email' => $email,
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'contact_number' => $this->input->post('contact_number'),
                        'appointment_date' => $appointment_date,
                        'appointment_time' => $appointment_time,
                        'status' => 'pending',
                        'last_booking_time' => date('Y-m-d H:i:s') // Add the current time
                    );
    
                    // Insert appointment data into the database
                    $this->OnlineAppointments_model->insert_appointment($data);
    
                    // Update the last_booking_time in the user's record
                    $this->OnlineAppointments_model->update_last_booking_time($email, $data['last_booking_time']);
    
                    // Set success flash data
                    $this->session->set_flashdata('success', 'Your appointment was booked successfully.');
                    redirect('clinic/index'); 
                }
            }
        }
    }
    
    // Callback function to check the appointment date
    public function check_appointment_date($date) {
        // Get the current date and time
        $current_datetime = new DateTime(); // Current date and time
        $appointment_datetime = new DateTime($date . ' ' . $this->input->post('appointment_time')); // Combine date and time
    
        // Check if the appointment date and time is in the past
        if ($appointment_datetime < $current_datetime) {
            $this->form_validation->set_message('check_appointment_date', 'The appointment date and time must be today or a future date and time.');
            return FALSE; // Invalid date and time
        }
    
        return TRUE; // Valid date and time
    }
    
    
    
    

    public function edit($id)
{
    $user_level = $this->session->userdata('user_level');

    // // Check if the user is authorized
    // if ($user_level != 'admin') {
    //     redirect('dashboard');
    //     return;
    // }

    // Retrieve the appointment data based on the ID
    $data['appointment'] = $this->OnlineAppointments_model->get_appointment_by_id($id);

    // Check if the appointment exists
    if (empty($data['appointment'])) {
        $this->session->set_flashdata('error', 'Appointment not found.');
        redirect('onlineappointments'); // Redirect to appointments list if not found
    }

    // Load views
    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('onlineappointments/edit', $data);
}


public function update($id) {
    // Load form validation library
    $this->load->library('form_validation');

    // Set validation rules
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
    $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
    $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');

    if ($this->form_validation->run() === FALSE) {
        // Load the appointment data to show in the form
        $data['appointment'] = $this->OnlineAppointments_model->get_appointment($id);
        $this->load->view('onlineappointments/update', $data);
    } else {
        // Prepare the data for update
        $data = [
            'email' => $this->input->post('email'),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'contact_number' => $this->input->post('contact_number'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'status' => $this->input->post('status'),
        ];

        // Update the appointment
        if ($this->OnlineAppointments_model->update_appointment($id, $data)) {
            // Set success message and redirect
            $this->session->set_flashdata('success', 'Appointment updated successfully!');
            redirect('onlineappointments');
        } else {
            // Set error message
            $this->session->set_flashdata('error', 'Failed to update appointment. Please try again.');
            redirect('onlineappointments/update/' . $id);
        }
    }
}



    public function delete($id)
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $this->OnlineAppointments_model->delete_appointment($id);
        redirect('onlineappointments');
    }

    public function approve($id)
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        // Set status to 'booked' for approval
        $data = array('status' => 'booked');
        $this->OnlineAppointments_model->update_appointment($id, $data);
        $this->session->set_flashdata('success', 'Appointment approved successfully.');

        redirect('onlineappointments');
    }

    public function reject($id)
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        // Set status to 'cancelled' for rejection
        $data = array('status' => 'cancelled');
        $this->OnlineAppointments_model->update_appointment($id, $data);
        $this->session->set_flashdata('success', 'Appointment rejected successfully.');

        redirect('onlineappointments');
    }
    

        public function get_total_online_appointments() {
            return $this->db->count_all('onlineappointments');
        }
    
        public function get_online_appointments_by_status($status) {
            $this->db->where('status', $status);
            return $this->db->count_all_results('onlineappointments');
        }
    }
