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
    public function index() {
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
    
        // Fetch patient and appointment data
        $data['patients'] = $this->Appointment_model->get_patients();
        $appointments = $this->calendar_model->get_all_appointments();
        $online_appointments = $this->calendar_model->get_online_registration(); // Changed to fetch online registration data
        $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments();
        $online_registrations = $this->calendar_model->get_online_registration();

        // Modify the logic for online registrations
$data['online_registrations'] = array_filter($online_registrations, function ($online_registration) {
    // Filter online registrations based on appointment status
    return in_array($online_registration['appointment_status'], ['booked', 'arrived', 'in_session']);
});

// Map and format the data for display
$data['online_registrations'] = array_map(function ($online_registration) {
    return [
        'title' => $online_registration['name'] . ' ' . $online_registration['lname'],  // Patient's name
        'start' => $online_registration['appointment_date'] . 'T' . $online_registration['appointment_time'],
        'notes' => 'Online Registration - ' . ucfirst($online_registration['appointment_status']),
        'id' => $online_registration['id'],
        'url' => site_url('calendar/edit_online_registration/' . $online_registration['id'])
    ];
}, $data['online_registrations']);
    
        // Filter and map regular appointments for calendar display (status: 'arrived', 'in_session', 'booked')
        $data['appointments'] = array_filter($appointments, function ($appointment) {
            return in_array($appointment['status'], ['arrived', 'in_session', 'booked']);
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
            // Filter online appointments based on appointment status
            return in_array($online_appointment['appointment_status'], ['booked', 'arrived', 'in_session']);
        });
    
        $data['online_appointments'] = array_map(function ($online_appointment) {
            return [
                'title' => $online_appointment['name'] . ' ' . $online_appointment['lname'],  // Patient's name
                'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
                'notes' => 'Online Appointment - ' . ucfirst($online_appointment['appointment_status']),
                'id' => $online_appointment['id'],
                'url' => site_url('calendar/edit_online/' . $online_appointment['id'])
            ];
        }, $data['online_appointments']);
    
        // Filter doctor appointments based on status
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
    
        // Merge all appointments for calendar display
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

    // Fetch appointment data
    $appointments = $this->calendar_model->get_all_appointments();
    $online_appointments = $this->calendar_model->get_online_registration(); // Fetch online registrations
    $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments();

    $events = [];

    // Add regular appointments (filter and map)
    $filtered_appointments = array_filter($appointments, function ($appointment) {
        return in_array($appointment['status'], ['arrived', 'booked']);
    });

    $mapped_appointments = array_map(function ($appointment) {
        return [
            'id' => $appointment['id'],
            'title' => 'Appointment',
            // 'title' => $appointment['name'] . ' ' . $appointment['lname'],
            'start' => $appointment['appointment_date'] . 'T' . $appointment['appointment_time'],
            'url' => site_url('calendar/edit/' . $appointment['id']),
            'notes' => 'Walk-In Appointment'
        ];
    }, $filtered_appointments);
    $events = array_merge($events, $mapped_appointments);

    // Add online appointments (filter and map)
    $filtered_online_appointments = array_filter($online_appointments, function ($online_appointment) {
        return in_array($online_appointment['appointment_status'], ['booked']);
    });

    $mapped_online_appointments = array_map(function ($online_appointment) {
        return [
            'id' => $online_appointment['id'],
            'title' => 'Appointment',
            // 'title' => $online_appointment['name'] . ' ' . $online_appointment['lname'],
            'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
            'url' => site_url('calendar/edit_online/' . $online_appointment['id']),
            'notes' => 'Online Appointment - ' . ucfirst($online_appointment['appointment_status'])
        ];
    }, $filtered_online_appointments);
    $events = array_merge($events, $mapped_online_appointments);

    // Add doctor appointments (filter and map)
    $filtered_doctor_appointments = array_filter($doctor_appointments, function ($doctor_appointment) {
        return $doctor_appointment['appointment_status'] === 'Scheduled';
    });

    $mapped_doctor_appointments = array_map(function ($doctor_appointment) {
        return [
            'id' => $doctor_appointment['appointment_id'],
            'title' => 'Doctor Appointment',
            'start' => $doctor_appointment['appointment_date'] . 'T' . $doctor_appointment['appointment_time'],
            'url' => site_url('calendar/edit_doctor/' . $doctor_appointment['appointment_id']),
            'notes' => 'Dra. Chona Mendoza - ' . $doctor_appointment['appointment_reason']
        ];
    }, $filtered_doctor_appointments);
    $events = array_merge($events, $mapped_doctor_appointments);

    // Return events as JSON
    echo json_encode($events);
}


}
