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
		// Load the models
		$this->load->model('Appointment_model');
		$this->load->model('Registration_model'); // Load the registration model to get patient email
		$this->load->library('email'); // Load email library

		// Load appointment details
		$data['appointment'] = $this->Appointment_model->get_appointment_by_id($id);

		// If the appointment does not exist, show 404
		if (empty($data['appointment'])) {
			show_404();
		}

		// Get patient details
		$patient_id = $data['appointment']['registration_id'];
		$patient = $this->Registration_model->get_patient_by_id($patient_id);
		$patient_email = $patient['email'] ?? '';

		$data['patient_name'] = $data['appointment']['patient_name'];

		// Set validation rules
		$this->form_validation->set_rules('appointment_date', 'Date', 'required');
		$this->form_validation->set_rules('appointment_time', 'Time', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');

		// Load views
		$this->load->view('r_assets/navbar');
		$this->load->view('r_assets/sidebar');

		if ($this->form_validation->run() === FALSE) {
			// Reload the form with errors
			$this->load->view('appointments/edit', $data);
		} else {
			// Prepare data for update
			$update_data = array(
				'appointment_date' => $this->input->post('appointment_date'),
				'doctor' => $this->input->post('doctor'),
				'appointment_time' => $this->input->post('appointment_time'),
				'status' => $this->input->post('status'),
				'notes' => $this->input->post('notes')
			);

			// Track previous status
			$old_status = $data['appointment']['status'];
			$new_status = $update_data['status'];

			// Update existing appointment
			if ($this->Appointment_model->update_appointment($id, $update_data)) {
				// Send email notification based on status change
				$this->send_status_email($patient_email, $data['patient_name'], $new_status, $update_data);

				// Success message
				$this->session->set_flashdata('success', 'Appointment updated successfully.');
				redirect('dashboard/admin/index');
			} else {
				// Failure message
				$this->session->set_flashdata('error', 'Update failed!');
				redirect('appointments/edit/' . $id);
			}
		}
	}

	/**
	 * Sends an email notification based on appointment status.
	 */
	private function send_status_email($to_email, $patient_name, $status, $appointment_data)
	{
		if (empty($to_email)) {
			return; // No email provided, exit function
		}

		$this->load->library('email');

		// SMTP Configuration
		$config = [
			'protocol'    => 'smtp',
			'smtp_host'   => 'smtp.gmail.com',
			'smtp_user'   => 'myeclass2021@gmail.com',
			'smtp_pass'   => 'nlqnjtrhbazoqlgx', // Replace with your App Password
			'smtp_port'   => 465,
			'smtp_crypto' => 'ssl',
			'mailtype'    => 'html',
			'charset'     => 'utf-8',
			'wordwrap'    => TRUE,
			'newline'     => "\r\n"
		];
		$this->email->initialize($config);

		$this->email->from('myeclass2021@gmail.com', 'Mendoza Clinic');
		$this->email->to($to_email);

		// Email Subject & Message
		$subject = "Appointment Status Update";
		$message = "<h2>Dear {$patient_name},</h2>";

		switch ($status) {
			case 'booked':
				$message .= "<p>Your appointment has been successfully booked.</p>";
				break;
			case 'reschedule':
				$message .= "<p>Your appointment has been rescheduled.</p>";
				break;
			case 'cancelled':
				$message .= "<p>We regret to inform you that your appointment has been cancelled.</p>";
				break;
			case 'completed':
				$message .= "<p>Your appointment has been completed. Thank you for visiting.</p>";
				break;
			default:
				$message .= "<p>Your appointment status has been updated to: <strong>{$status}</strong>.</p>";
				break;
		}

		// Add appointment details
		$message .= "
       <p><strong>Appointment Date:</strong> {$appointment_data['appointment_date']}</p>
<p><strong>Time:</strong> {$appointment_data['appointment_time']}</p>
<p><strong>Important:</strong> Please arrive at least <strong>15 minutes before your scheduled time</strong> to complete any necessary paperwork and ensure a smooth consultation.</p>
<p>If you have any questions or need to reschedule, feel free to contact us.</p>
<p>We look forward to seeing you!</p>
<p>Best Regards,<br><strong>Mendoza Clinic</strong></p>

    ";

		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			log_message('info', "Status email sent to {$to_email}");
		} else {
			log_message('error', "Email failed: " . $this->email->print_debugger());
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
