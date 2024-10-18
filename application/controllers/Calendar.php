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
        return $appointment['status'] === 'confirmed'; // Only include confirmed appointments
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
        return in_array($online_appointment['STATUS'], ['booked', 'arrived', 'attended']);
    });

    $data['online_appointments'] = array_map(function ($online_appointment) {
        return [
            'title' => $online_appointment['firstname'] . ' ' . $online_appointment['lastname'],  // Patient's name
            'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
            'notes' => 'Online Appointment - ' . ucfirst($online_appointment['STATUS']),
            'id' => $online_appointment['id'],
            'url' => site_url('calendar/edit_online/' . $online_appointment['id']) // Ensure this route exists
        ];
    }, $data['online_appointments']);

    // Filter and map doctor's appointments for calendar display (status: 'Scheduled')
    $data['doctor_appointments'] = array_filter($doctor_appointments, function ($doctor_appointment) {
        return $doctor_appointment['appointment_status'] === 'Scheduled'; // Only include scheduled appointments
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

    // Combine all appointments for display in the calendar
    $data['all_appointments'] = array_merge($data['appointments'], $data['online_appointments'], $data['doctor_appointments']);

    // Pass data to view
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

        // Combine all appointments for display
        $data['all_appointments'] = array_merge($data['appointments'], $data['online_appointments'], $data['doctor_appointments']);

        // Load the front page view with calendar
        $this->load->view('frontpage', $data);
    }
    public function get_events()
    {
        $this->load->model('calendar_model'); // Ensure you have loaded the model
        $this->load->model('Doctors_appointments_model'); // Ensure you have loaded the model

        // Fetch all appointments
        $appointments = $this->calendar_model->get_all_appointments();
        $online_appointments = $this->calendar_model->get_online_appointments();
        $doctor_appointments = $this->Doctors_appointments_model->get_all_appointments();

        $events = [];

        // Map regular appointments (only approved)
        foreach ($appointments as $appointment) {
            // Check if the appointment status is 'confirmed' or 'arrived'
            if ($appointment['status'] === 'confirmed' || $appointment['status'] === 'arrived') {
                $events[] = [
                    'id' => $appointment['id'],
                    'title' => 'Walk-IN Appointment',
                    'start' => $appointment['appointment_date'] . 'T' . $appointment['appointment_time'],
                    'description' => 'Walk-In Appointment',
                    // 'url' => site_url('calendar/edit/' . $appointment['id'])
                ];
            }
        }


        // Map online appointments (only approved)
        foreach ($online_appointments as $online_appointment) {
            // Check if the appointment status is 'booked', 'arrived', or 'attended'
            if (
                $online_appointment['status'] === 'booked' ||
                $online_appointment['status'] === 'arrived' ||
                $online_appointment['status'] === 'attended'
            ) {
                $events[] = [
                    'id' => $online_appointment['id'],
                    'title' => 'Online Appointment',
                    'start' => $online_appointment['appointment_date'] . 'T' . $online_appointment['appointment_time'],
                    'description' => 'Booked Appointment',
                    // 'url' => site_url('calendar/edit_online/' . $online_appointment['id'])
                ];
            }
        }

        // Map doctor's appointments (only approved)
        foreach ($doctor_appointments as $doctor_appointment) {
            if ($doctor_appointment['appointment_status'] === 'Scheduled') { // Assuming 'status' is the field for approval
                $events[] = [
                    'id' => $doctor_appointment['appointment_id'],
                    'title' => 'Doctor Appointment',
                    'start' => $doctor_appointment['appointment_date'] . 'T' . $doctor_appointment['appointment_time'],
                    'description' => 'Dra. Chona Mendoza - ' . $doctor_appointment['appointment_reason'],
                    // 'url' => site_url('calendar/edit_doctor/' . $doctor_appointment['appointment_id'])
                ];
            }
        }

        echo json_encode($events);
    }
}
