<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OnlineAppointments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('OnlineAppointments_model');
        $this->load->model('Registration_model');
        $this->load->model('Dashboard_model');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->config('email');


    }
   
    
    public function create()
    {
        $this->load->view('onlineappointments/create');
    }
    public function onlinestore()
{
    // Load necessary libraries and models
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('Registration_model');

    // Set validation rules for the form fields
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('mname', 'Middle Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    $this->form_validation->set_rules('marital_status', 'Marital Status', 'required');
    $this->form_validation->set_rules('contact_number', 'Contact Number', 'required');
    $this->form_validation->set_rules('birthday', 'Birthday', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('occupation', 'Occupation', 'required');
    $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
    $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
    $this->form_validation->set_rules('philhealth_id', 'PhilHealth ID', 'max_length[50]');

    // Run validation
    if ($this->form_validation->run() === FALSE) {
        $this->session->set_flashdata('error', validation_errors());
        redirect('clinic/index');
    } else {
        $email = $this->input->post('email');
        $appointment_date = $this->input->post('appointment_date');
        $appointment_time = $this->input->post('appointment_time');
        $current_time = time();

        // Check if a recent appointment exists within 5 minutes
        $recentAppointment = $this->Registration_model->check_recent_appointment($email, $current_time);
        if ($recentAppointment) {
            $this->session->set_flashdata('error', 'You can only create one appointment every 5 minutes.');
            redirect('clinic/index');
        }

        // Check for an existing appointment at the same date and time with "booked" status
        $existingAppointment = $this->Registration_model->check_appointment_exists($appointment_date, $appointment_time);
        if ($existingAppointment) {
            if ($existingAppointment['appointment_status'] == 'booked') {
                $this->session->set_flashdata('error', 'This time slot is already booked.');
                redirect('clinic/index');
            }
        }

        // Collect input data
        $data = array(
            'email' => $email,
            'name' => $this->input->post('firstname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lastname'),
            'marital_status' => $this->input->post('marital_status'),
            'husband' => $this->input->post('husband'),
            'husband_phone' => $this->input->post('husband_phone'),
            'patient_contact_no' => $this->input->post('contact_number'),
            'philhealth_id' => $this->input->post('philhealth_id'),
            'birthday' => $this->input->post('birthday'),
            'age' => date_diff(date_create($this->input->post('birthday')), date_create('today'))->y,
            'address' => $this->input->post('address'),
            'occupation' => $this->input->post('occupation'),
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'appointment_status' => 'pending', // Set status as 'booked' directly
            'created_at' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s')
        );

        // Insert data into the database
        if ($this->Registration_model->insert_appointment($data)) {
            $this->session->set_flashdata('success', 'Your appointment has been successfully booked!');
        } else {
            $this->session->set_flashdata('error', 'There was an issue booking your appointment. Please try again.');
        }

        redirect('clinic/index');
    }
}


    public function store()
    {
        // Define lunch break slots
        $lunchBreakSlots = ['11:00', '12:30', '17:00', '15:30'];

        // Get form input data
        $data = array(
            'email' => $this->input->post('email'),
            'name' => $this->input->post('firstname'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lastname'),
            'marital_status' => $this->input->post('marital_status'),
            'husband' => $this->input->post('husband'),
            'husband_phone' => $this->input->post('husband_phone'),
            'patient_contact_no' => $this->input->post('contact_number'),
            'philhealth_id' => $this->input->post('philhealth_id'),
            'birthday' => $this->input->post('birthday'),
            'age' => date_diff(date_create($this->input->post('birthday')), date_create('today'))->y,
            'address' => $this->input->post('address'),
            'occupation' => $this->input->post('occupation'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'appointment_status' => 'pending',
            'created_at' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s')
        );

        // Check if the selected time is a lunch break slot
        if (in_array($data['appointment_time'], $lunchBreakSlots)) {
            $this->session->set_flashdata('warning', 'The selected time slot is during lunch break. Please choose a different time.');
            redirect('onlineappointments/create');
            return;
        }

        // Check if the time slot is already booked
        if ($this->OnlineAppointments_model->is_time_booked($data['appointment_date'], $data['appointment_time'])) {
            $this->session->set_flashdata('warning', 'The selected time slot is already booked. Please choose a different time.');
            redirect('onlineappointments/create');
        } else {
            if ($this->Registration_model->insert_appointment($data)) {
                $this->session->set_flashdata('success', 'Your appointment has been successfully booked!');
            } else {
                $this->session->set_flashdata('error', 'There was an issue booking your appointment. Please try again.');
            }
            redirect('onlineappointments');
        }
    }

    public function get_available_slots()
{
    $this->load->model('OnlineAppointments_model');
    $this->load->model('Registration_model');
    $date = $this->input->get('date');

    if ($date) {
        $existingAppointments = $this->OnlineAppointments_model->get_booked_slots($date);
        $timeSlots = [
            '09:00', '09:30', '10:00', '10:30',
            '11:00', '11:30', '12:00', '12:30',
            '13:00', '13:30', '14:00', '14:30',
            '15:00', '15:30', '16:00', '16:30', '17:00', '17:30',
        ];

        $availableSlots = array_diff($timeSlots, $existingAppointments);
        echo json_encode(['availableSlots' => array_values($availableSlots)]);
    }
}


    public function online_edit($id)
    {
        $this->load->model('Registration_model');
        $data['registration'] = $this->Registration_model->onlineedit($id);

        if (empty($data['registration'])) {
            $this->session->set_flashdata('error', 'Registration not found.');
            redirect('onlineappointments');
        }

       
        $this->load->view('onlineappointments/edit', $data);
    }

    public function online_update($id) {
        $this->load->model('Registration_model');
        $this->load->library('email', $config);

        // Collect form data
        $data = [
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'philhealth_id' => $this->input->post('philhealth_id'),
            'birthday' => $this->input->post('birthday'),
            'age' => $this->input->post('age'),
            'address' => $this->input->post('address'),
            'patient_contact_no' => $this->input->post('patient_contact_no'),
            'marital_status' => $this->input->post('marital_status'),
            'husband' => $this->input->post('husband'),
            'husband_phone' => $this->input->post('husband_phone'),
            'occupation' => $this->input->post('occupation'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_status' => $this->input->post('appointment_status'), // Make sure this is set
            'appointment_time' => $this->input->post('appointment_time')
        ];
        
        // Call the model's update method
        $updateStatus = $this->Registration_model->onlineupdate($id, $data);
        
        // Set a flash message and redirect
        if ($updateStatus) {
            $this->session->set_flashdata('success', 'Registration updated successfully.');
            
            // Send confirmation email if the status is "booked"
            if ($data['appointment_status'] === 'booked') {
                $this->send_email_confirmation(
                    $data['email'], 
                    $data['name'], 
                    $data['lname'], 
                    $data['appointment_date'], 
                    $data['appointment_time']
                );
            }
        } else {
            $this->session->set_flashdata('error', 'Failed to update the registration.');
        }
        
        redirect('dashboard/admin/index');
    }
    

    //send message
    private function send_email_confirmation($recipient_email, $name, $lname, $appointment_date, $appointment_time)
{
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

    $this->load->library('email', $config);

    $this->email->from('myeclass2021@gmail.com', 'Mendoza Clinic');
    $this->email->to($recipient_email);
    $this->email->subject('Appointment Confirmation');

    // Email message
    $message = "
    <html>
    <head>
        <title>Appointment Confirmation</title>
    </head>
    <body>
        <p>Dear $name $lname,</p>
        <p>Your appointment at Mendoza Clinic has been successfully booked. Below are the details of your appointment:</p>
        <ul>
            <li><strong>Date:</strong> $appointment_date</li>
            <li><strong>Time:</strong> $appointment_time</li>
            <li><strong>Location:</strong> Mendoza Clinic</li>
        </ul>
        <p>Please ensure that you arrive at least 15 minutes before your scheduled appointment time.</p>
        <p>Thank you for choosing Mendoza Clinic. We look forward to seeing you!</p>
        <br>
        <p>Best regards,</p>
        <p>The Mendoza Clinic Team</p>
    </body>
    </html>
    ";

    $this->email->message($message);

    // Send email and set flash message
    if ($this->email->send()) {
        $this->session->set_flashdata('success', 'Confirmation email sent successfully.');
    } else {
        $this->session->set_flashdata('error', 'Failed to send confirmation email. Error: ' . $this->email->print_debugger());
    }
}


    
    public function edit($id) {
        $this->load->model('Registration_model');
        
        // Get registration data by ID
        $data['registration'] = $this->Registration_model->getRegistrationById($id);
    
        // Load the edit view and pass the data
        $this->load->view('edit_view', $data);
    }
    
    public function delete($id)
    {
        $this->OnlineAppointments_model->delete_appointment($id);
        redirect('onlineappointments');
    }

    public function approve($id)
    {
        $data = array('appointment_status' => 'booked');
        $this->OnlineAppointments_model->update_appointment($id, $data);
        $this->session->set_flashdata('success', 'Appointment approved successfully.');
        redirect('onlineappointments');
    }

    public function reject($id)
    {
        $data = array('appointment_status' => 'cancelled');
        $this->OnlineAppointments_model->update_appointment($id, $data);
        $this->session->set_flashdata('success', 'Appointment rejected successfully.');
        redirect('onlineappointments');
    }

    public function index() {
        // Load necessary models and libraries
        $this->load->model('Registration_model');
    
        // Fetch registrations from the model
        $data['registrations'] = $this->Registration_model->get_all_registrations();
    
        // Load the view and pass the data
        $this->load->view('appointments/index', $data);
    }
    
    

    public function update($id)
{
    // Define lunch break slots
    $lunchBreakSlots = ['11:00', '12:30', '17:00'];

    // Get existing appointment data based on the ID
    $existingAppointment = $this->Registration_model->get_appointment_by_id($id);

    // Check if appointment exists
    if (!$existingAppointment) {
        $this->session->set_flashdata('error', 'Appointment not found.');
        redirect('onlineappointments');
    }

    // Get form input data
    $data = array(
        'email' => $this->input->post('email'),
        'name' => $this->input->post('firstname'),
        'mname' => $this->input->post('mname'),
        'lname' => $this->input->post('lastname'),
        'marital_status' => $this->input->post('marital_status'),
        'husband' => $this->input->post('husband'),
        'husband_phone' => $this->input->post('husband_phone'),
        'patient_contact_no' => $this->input->post('contact_number'),
        'philhealth_id' => $this->input->post('philhealth_id'),
        'birthday' => $this->input->post('birthday'),
        'age' => date_diff(date_create($this->input->post('birthday')), date_create('today'))->y,
        'address' => $this->input->post('address'),
        'occupation' => $this->input->post('occupation'),
        'appointment_date' => $this->input->post('appointment_date'),
        'appointment_time' => $this->input->post('appointment_time'),
        'last_update' => date('Y-m-d H:i:s')
    );

    // Check if the selected time is a lunch break slot
    if (in_array($data['appointment_time'], $lunchBreakSlots)) {
        $this->session->set_flashdata('warning', 'The selected time slot is during lunch break. Please choose a different time.');
        redirect('onlineappointments/edit/' . $id);
        return;
    }

    // Check if the time slot is already booked (excluding the current appointment)
    if ($this->OnlineAppointments_model->is_time_booked($data['appointment_date'], $data['appointment_time'], $id)) {
        $this->session->set_flashdata('warning', 'The selected time slot is already booked. Please choose a different time.');
        redirect('onlineappointments/edit/' . $id);
    } else {
        if ($this->Registration_model->update_appointment($id, $data)) {
            $this->session->set_flashdata('success', 'Your appointment has been successfully updated!');
        } else {
            $this->session->set_flashdata('error', 'There was an issue updating your appointment. Please try again.');
        }
        redirect('onlineappointments');
    }
}

}
?>
