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
    }

    public function index()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $data['onlineappointments'] = $this->OnlineAppointments_model->get_all_onlineappointments();
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
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


    public function onlinestore() {
        // Load the form validation library and other necessary libraries
        $this->load->library('form_validation');
        $this->load->library('session');
    
        // Set form validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            
            $this->session->set_flashdata('error', validation_errors());
            redirect('clinic/index'); 
        } else {
            
            $email = $this->input->post('email');
            $appointment_date = $this->input->post('appointment_date');
            $appointment_time = $this->input->post('appointment_time');
    
            
            if (!$this->OnlineAppointments_model->can_book_appointment($email)) {
                // Set warning flash data if booking is attempted within the last 5 minutes
                $this->session->set_flashdata('warning', 'You can only book an appointment once every 5 minutes.');
                redirect('clinic/index'); // Adjust the redirect URL as needed
            } else {
                // Check if the time slot is already booked
                if ($this->OnlineAppointments_model->is_time_booked($appointment_date, $appointment_time)) {
                    // Set warning flash data if time slot is already booked
                    $this->session->set_flashdata('warning', 'The selected time slot is already booked. Please choose a different time.');
                    redirect('clinic/index'); // Adjust the redirect URL as needed
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
                    $this->OnlineAppointments_model->insert_appointment($data);
    
                    // Update the last_booking_time in the user's record
                    $this->OnlineAppointments_model->update_last_booking_time($email, $data['last_booking_time']);
    
                    // Set success flash data
                    $this->session->set_flashdata('success', 'Your appointment was booked successfully.');
                    redirect('clinic/index'); // Adjust the redirect URL as needed
                }
            }
        }
    }
    
    

    public function edit($id)
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $data['appointment'] = $this->OnlineAppointments_model->get_appointment($id);
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('onlineappointments/edit', $data);
    }

    public function update($id)
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
            'status' => $this->input->post('status')
        );

        $this->OnlineAppointments_model->update_appointment($id, $data);
        redirect('onlineappointments');
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

        $data = array('status' => 'approved');
        $this->OnlineAppointments_model->update_appointment($id, $data);

        redirect('onlineappointments');
    }

    public function reject($id)
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level != 'admin') {
            redirect('dashboard');
            return;
        }

        $data = array('status' => 'declined');
        $this->OnlineAppointments_model->update_appointment($id, $data);

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
