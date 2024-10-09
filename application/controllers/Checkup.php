<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('checkup_model');
        $this->load->model('Registration_model');
    }

    // Display form to create a new check-up
    public function create() {
        $data['patients'] = $this->checkup_model->get_patients(); // Fetch patient names
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/create', $data);
    }
    public function view($id) {
        // Fetch the specific checkup data based on the ID
        $data['checkup'] = $this->checkup_model->get_checkup($id);
        
        // No need to fetch patient data separately as it is included in the checkup data now
        
        // Load the view and pass the data
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/view', $data);
    }
    

    // Store the new check-up in the database
    public function store() {
        $data = [
            'registration_id' => $this->input->post('registration_id'),
            'blood_pressure' => $this->input->post('blood_pressure'),
            'pulse_rate' => $this->input->post('pulse_rate'),
            'respiration_rate' => $this->input->post('respiration_rate'),
            'temperature' => $this->input->post('temperature'),
            'oxygen_saturation' => $this->input->post('oxygen_saturation'),
            'ultrasound' => $this->input->post('ultrasound'),
            'doctor_comment' => $this->input->post('doctor_comment'),
            'next_checkup_date' => $this->input->post('next_checkup_date')
            // created_at will default to CURRENT_TIMESTAMP
        ];
        
        $this->checkup_model->insert($data);
        redirect('checkup/index'); // Redirect to the index method after insert
    }
    

    // Display the form to update a check-up
    public function update($id) {
        // Fetch checkup data
        $data['checkup'] = $this->checkup_model->get_checkup($id);
        // Fetch patient data (you may want to create a separate method in the model for clarity)
        $data['patient'] = $this->checkup_model->get_patient_by_registration_id($data['checkup']->registration_id);
        
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/update', $data);
    }

    // Update the check-up in the database
   public function update_action() {
    $id = $this->input->post('id');
    $data = [
        'registration_id' => $this->input->post('registration_id'),
        'blood_pressure' => $this->input->post('blood_pressure'),
        'pulse_rate' => $this->input->post('pulse_rate'),
        'respiration_rate' => $this->input->post('respiration_rate'),
        'temperature' => $this->input->post('temperature'),
        'oxygen_saturation' => $this->input->post('oxygen_saturation'),
        'ultrasound' => $this->input->post('ultrasound'),
        'doctor_comment' => $this->input->post('doctor_comment'),
        'next_checkup_date' => $this->input->post('next_checkup_date')
    ];

    $this->checkup_model->update($id, $data);
    redirect('checkup/index'); // Redirect to the index method after update
}

    // Display all check-ups
    public function index() {
        $data['checkups'] = $this->checkup_model->get_all_with_patients(); // Fetch check-ups with patient details
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/index', $data);
    }
    
   
    
}
