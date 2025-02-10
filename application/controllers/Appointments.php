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
	public function followup()
    {
        $data['appointments'] = $this->Appointment_model->get_appointments();

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('appointments/followup_index', $data);
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
    $this->load->model('Appointment_model'); // Ensure the Appointment model is loaded

    // Set validation rules
    $this->form_validation->set_rules('patient_id', 'Patient', 'required');
    $this->form_validation->set_rules('appointment_date', 'Date', 'required');
    $this->form_validation->set_rules('appointment_time', 'Time', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
   
    $data = []; // Create an empty data array
    
    // Check if a patient is provided
    if ($patient_id) {
        $patient = $this->Registration_model->get_patient_by_id($patient_id);
        if ($patient) {
            $data['patient'] = $patient; 
            $data['patient_id'] = $patient_id; 
        } else {
            $data['patient'] = null; 
        }
    } else {
        $data['patient'] = [
            'name' => '',
            'mname' => '',
            'lname' => '',
        ];
        $data['patient_id'] = null; 
    }

    if ($this->form_validation->run() === FALSE) {
        $data['patients'] = $this->Appointment_model->get_patients();
        
        // Capture the selected doctor or custom doctor name
        $doctor = $this->input->post('doctor');
        if ($doctor === "others") {
            $doctor = $this->input->post('otherDoctor'); // Get the custom doctor name
        }

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('appointments/create', $data);
    } else {
        // Process the form data
        $appointment_date = $this->input->post('appointment_date');
        $appointment_time = $this->input->post('appointment_time');

        // Check if the time slot is already booked
        if ($this->Appointment_model->is_time_slot_booked($appointment_date, $appointment_time)) {
            $this->session->set_flashdata('error_message', 'This time slot is already booked. Please choose another time.');
            redirect('appointments/create'); 
        }

        $appointment_data = array(
            'registration_id' => $this->input->post('patient_id'),
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'doctor' => $this->input->post('doctor'),
            'notes' => $this->input->post('notes'),
            'status' => $this->input->post('status'),
        );

        // Create the appointment in the database
        if ($this->Appointment_model->create_appointment($appointment_data)) {
            // Success message and redirect
            $this->session->set_flashdata('message', 'Appointment created successfully!');
            redirect('dashboard/admin/index');
        } else {
            // Error message if creation fails
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

	// If the appointment does not exist, show a 404 error
	if (empty($data['appointment'])) {
		show_404();
	}

	// Pass appointment details to the view
	$data['patient_name'] = $data['appointment']['patient_name'];

	// Set form validation rules
	$this->form_validation->set_rules('appointment_date', 'Date', 'required');
	$this->form_validation->set_rules('appointment_time', 'Time', 'required');
	$this->form_validation->set_rules('status', 'Status', 'required');

	// Load common views for navbar and sidebar
	$this->load->view('r_assets/navbar');
	$this->load->view('r_assets/sidebar');

	// Check if form is valid
	if ($this->form_validation->run() === FALSE) {
		// Validation failed, reload the form with error messages
		$this->load->view('appointments/edit', $data);
	} else {
		// Form is valid, proceed to update the appointment
		
		// Prepare data for updating the appointment
		$update_data = array(
			'appointment_date' => $this->input->post('appointment_date'),
			'doctor' => $this->input->post('doctor'), // You can add more logic here for doctor if needed
			'appointment_time' => $this->input->post('appointment_time'),
			'status' => $this->input->post('status'), // Capture status input
			'notes' => $this->input->post('notes') // Capture doctor's notes
		);

		// Check if the date or time has changed
		if ($data['appointment']['appointment_date'] != $update_data['appointment_date'] || $data['appointment']['appointment_time'] != $update_data['appointment_time']) {
			// Mark the current appointment as completed
			$this->Appointment_model->update_appointment($id, ['status' => 'completed']);

			// Create a new appointment with the updated data
			$new_appointment_data = array(
				'registration_id' => $data['appointment']['registration_id'],
				'appointment_date' => $update_data['appointment_date'],
				'appointment_time' => $update_data['appointment_time'],
				'doctor' => $update_data['doctor'],
				'notes' => $update_data['notes'],
				'status' => $update_data['status'],
			);

			if ($this->Appointment_model->create_appointment($new_appointment_data)) {
				// If successful, set success message and redirect
				$this->session->set_flashdata('success', 'Appointment updated successfully.');
				redirect('dashboard/admin/index');
			} else {
				// If creation fails, set error message and reload the form
				$this->session->set_flashdata('error', 'Update failed!');
				redirect('appointments/edit/' . $id); // Keep user on the edit page
			}
		} else {
			// If date and time have not changed, update the existing appointment
			if ($this->Appointment_model->update_appointment($id, $update_data)) {
				// If successful, set success message and redirect
				$this->session->set_flashdata('success', 'Appointment updated successfully.');
				redirect('dashboard/admin/index');
			} else {
				// If update fails, set error message and reload the form
				$this->session->set_flashdata('error', 'Update failed!');
				redirect('appointments/edit/' . $id); // Keep user on the edit page
			}
		}
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
