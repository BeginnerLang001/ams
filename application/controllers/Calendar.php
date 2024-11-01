<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calendar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar_model');
        $this->load->model('Appointment_model');
        $this->load->model('Doctors_appointments_model');
        $this->load->library('session');
    }
    public function index()
{
    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');

    // Fetch patient and appointment data
    $data['patients'] = $this->Appointment_model->get_patients();
    $appointments = $this->calendar_model->get_all_appointments();
    $online_appointments = $this->calendar_model->get_online_appointments();
    $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments(); // Corrected to use the appropriate model

    // Filter and map regular appointments for calendar display (status: 'confirmed')
    $data['appointments'] = array_filter($appointments, function ($appointment) {
        return in_array($appointment['status'], ['arrived', 'in_session', 'booked']);
 // Only include confirmed appointments
    });

    $data['appointments'] = array_map(function ($appointment) {
        return [
            'title' => $appointment['name'] . ' ' . $appointment['lname'],  // Patient's name
            'start' => $appointment['appointment_date'] . 'T' . $appointment['appointment_time'],
            'notes' => 'Walk-In Appointment',
            'id' => $appointment['id'],
            'url' => site_url('calendar/edit/' . $appointment['id'])
        ];
    }, $data['appointments']);

    // Modify the logic for online appointments
    $data['online_appointments'] = array_filter($online_appointments, function ($online_appointment) {
        // Filter online appointments based on multiple statuses
        return in_array($online_appointment['STATUS'], ['booked', 'arrived', 'in_session']);
    });

    $data['online_appointments'] = array_map(function ($online_appointment) {
        return [
            'title' => $online_appointment['firstname'] . ' ' . $online_appointment['lastname'],  // Patient's name
            'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
            'notes' => 'Online Appointment - ' . ucfirst($online_appointment['STATUS']),
            'id' => $online_appointment['id'],
            'url' => site_url('calendar/edit_online/' . $online_appointment['id'])  
        ];
    }, $data['online_appointments']);

    
    $data['doctor_appointments'] = array_filter($doctor_appointments, function ($doctor_appointment) {
        return $doctor_appointment['appointment_status'] === 'Scheduled';  
    });

    $data['doctor_appointments'] = array_map(function ($doctor_appointment) {
        return [
            'title' => 'Doctor Appointment',
            'start' => $doctor_appointment['appointment_date'] . 'T' . $doctor_appointment['appointment_time'],
            'notes' => 'Dra. Chona Mendoza - ' . $doctor_appointment['appointment_reason'],
            'id' => $doctor_appointment['appointment_id'],
            'url' => site_url('calendar/edit_doctor/' . $doctor_appointment['appointment_id'])
        ];
    }, $data['doctor_appointments']);

    
    $data['all_appointments'] = array_merge($data['appointments'], $data['online_appointments'], $data['doctor_appointments']);

  
    $this->load->view('calendar/calendar', $data);
}

    public function add()
    {
        $this->load->view('calendar/calendar_add');
    }

    public function create()
    {
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
        $this->form_validation->set_rules('doctor', 'Doctor', 'required');
        $this->form_validation->set_rules('notes', 'Notes', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('calendar/calendar_add');
        } else {
            $data = [
                'appointment_date' => $this->input->post('appointment_date'),
                'appointment_time' => $this->input->post('appointment_time'),
                'doctor' => $this->input->post('doctor'),
                'notes' => $this->input->post('notes')
            ];
            $this->calendar_model->create_appointment($data);
            redirect('calendar');
        }
    }

    public function edit($id)
    {
        $data['appointment'] = $this->calendar_model->get_appointment_by_id($id);
        $this->load->view('calendar/calendar_edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('appointment_date', 'Appointment Date', 'required');
        $this->form_validation->set_rules('appointment_time', 'Appointment Time', 'required');
        $this->form_validation->set_rules('doctor', 'Doctor', 'required');
        $this->form_validation->set_rules('notes', 'Notes', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['appointment'] = $this->calendar_model->get_appointment_by_id($id);
            $this->load->view('calendar/calendar_edit', $data);
        } else {
            $data = [
                'appointment_date' => $this->input->post('appointment_date'),
                'appointment_time' => $this->input->post('appointment_time'),
                'doctor' => $this->input->post('doctor'),
                'notes' => $this->input->post('notes')
            ];
            $this->calendar_model->update_appointment($id, $data);
            redirect('calendar');
        }
    }

    public function delete($id)
    {
        $this->calendar_model->delete_appointment($id);
        redirect('calendar');
    }
    public function view_calendar()
    {
        // Fetch appointment data
        $appointments = $this->calendar_model->get_all_appointments();
        $online_appointments = $this->calendar_model->get_online_appointments();
        $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments();

        // Map appointments for calendar display
        $data['appointments'] = array_map(function ($appointment) {
            return [
                'title' => $appointment['name'] . ' ' . $appointment['lname'],
                'start' => $appointment['appointment_date'] . 'T' . $appointment['appointment_time']
            ];
        }, $appointments);

        $data['online_appointments'] = array_map(function ($online_appointment) {
            return [
                'title' => $online_appointment['firstname'] . ' ' . $online_appointment['lastname'],
                'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time']
            ];
        }, $online_appointments);

        $data['doctor_appointments'] = array_map(function ($doctor_appointment) {
            return [
                'title' => 'Doctor Appointment',
                'start' => $doctor_appointment['appointment_date'] . 'T' . $doctor_appointment['appointment_time']
            ];
        }, $doctor_appointments);

        
        $data['all_appointments'] = array_merge($data['appointments'], $data['online_appointments'], $data['doctor_appointments']);

        
        $this->load->view('frontpage', $data);
    }
    public function get_events()
{
    // Load models if needed
    $this->load->model('calendar_model');
    $this->load->model('Doctors_appointments_model');

    // Fetch all appointments (combine your existing logic here)
    $appointments = $this->calendar_model->get_all_appointments();
    $online_appointments = $this->calendar_model->get_online_appointments();
    $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments();

    $events = [];

    // Add regular appointments
    foreach ($appointments as $appointment) {
        if (in_array($appointment['status'], ['arrived', 'in_session', 'booked'])) {
            $events[] = [
                'id' => $appointment['id'],
                'title' => 'Walk-In Appointment', // Show a generic title
                'start' => $appointment['appointment_date'] . 'T' . $appointment['appointment_time'],
                'url' => site_url('calendar/edit/' . $appointment['id']),
                'notes' => 'Walk-In Appointment'
            ];
        }
    }

    // Add online appointments
    foreach ($online_appointments as $online_appointment) {
        if (in_array($online_appointment['STATUS'], ['booked', 'arrived', 'in_session'])) {
            $events[] = [
                'id' => $online_appointment['id'],
                'title' => 'Online Appointment', // Changed to generic title
                'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
                'url' => site_url('calendar/edit_online/' . $online_appointment['id']),
                'notes' => 'Online Appointment - ' . ucfirst($online_appointment['STATUS'])
            ];
        }
    }

    // Add doctor appointments
    foreach ($doctor_appointments as $doctor_appointment) {
        if ($doctor_appointment['appointment_status'] === 'Scheduled') {
            $events[] = [
                'id' => $doctor_appointment['appointment_id'],
                'title' => 'Doctor Appointment', // Keep the doctor appointment title
                'start' => $doctor_appointment['appointment_date'] . 'T' . $doctor_appointment['appointment_time'],
                'url' => site_url('calendar/edit_doctor/' . $doctor_appointment['appointment_id']),
                'notes' => 'Dra. Chona Mendoza - ' . $doctor_appointment['appointment_reason']
            ];
        }
    }

    // Return events as JSON
    echo json_encode($events);
}


}
