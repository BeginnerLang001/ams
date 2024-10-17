<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VitalSign extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('vital_sign_model');
        $this->load->model('Registration_model');
        $this->load->model('Report_model');
    }
    // Display the search form
    public function search_form()
    {
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('vital_sign/patient_search');
    }

    // Search for patients by name
    public function search_patients()
    {
        $name = $this->input->post('name'); 

        // Fetch patients based on the search term
        $data['patients'] = $this->vital_sign_model->search_patients($name);

        // Load the views
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('vital_sign/patient_search_results', $data);
    }

    public function create()
{
    $registration_id = $this->input->get('registration_id');
    if ($registration_id) {
        $data['patient'] = $this->vital_sign_model->get_patient_by_registration_id($registration_id);
        if (!$data['patient']) {
            // Redirect back to the search form if the patient is not found
            $this->session->set_flashdata('error', 'Patient not found.');
            redirect('VitalSign/search_form');
        }
    } else {
        // Redirect if no registration_id is provided
        redirect('VitalSign/search_form');
    }

    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('vital_sign/create', $data);
}



    public function search()
    {
        $name = $this->input->post('name'); // Assuming the search is done via a POST request
        $data['patients'] = $this->vital_sign_model->search_patients($name);

        if (!empty($data['patients'])) {
            // Load views for search results
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
            $this->load->view('vital_sign/patient_search', $data);
        } else {
            // Set flashdata for no patients found
            $this->session->set_flashdata('error', 'No patients found with that name.');
            redirect('VitalSign/search_form'); // Redirect to search form
        }
    }



    // View a specific vital sign record
    public function view($id)
    {
        $data['vital_sign'] = $this->vital_sign_model->get_vital_sign($id);
        $data['vital_sign']->patient_name = $this->vital_sign_model->get_patient_by_registration_id($data['vital_sign']->registration_id)->full_name;

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('vital_sign/view', $data);
    }


    // Store a new vital sign record
    public function store()
    {
        $data = [
            'registration_id' => $this->input->post('registration_id'),
            'blood_pressure_systolic' => $this->input->post('blood_pressure_systolic'),
            'blood_pressure_diastolic' => $this->input->post('blood_pressure_diastolic'),
            'pulse_rate' => $this->input->post('pulse_rate'),
            'respiration_rate' => $this->input->post('respiration_rate'),
            'temperature' => $this->input->post('temperature'),
            'oxygen_saturation' => $this->input->post('oxygen_saturation'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'bmi' => $this->input->post('bmi'),
            'created_at' => $this->input->post('created_at')
        ];

        $this->vital_sign_model->insert($data);
        redirect('VitalSign/index');
    }

    // Display the form to update a vital sign record
    public function update($id)
    {
        $data['vital_sign'] = $this->vital_sign_model->get_vital_sign($id);
        $data['patient'] = $this->vital_sign_model->get_patient_by_registration_id($data['vital_sign']->registration_id);
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('vital_sign/update', $data);
    }

    // Update an existing vital sign record
    public function update_action()
    {
        $id = $this->input->post('id');
        $data = [
            'registration_id' => $this->input->post('registration_id'),
            'blood_pressure_systolic' => $this->input->post('blood_pressure_systolic'),
            'blood_pressure_diastolic' => $this->input->post('blood_pressure_diastolic'),
            'pulse_rate' => $this->input->post('pulse_rate'),
            'respiration_rate' => $this->input->post('respiration_rate'),
            'temperature' => $this->input->post('temperature'),
            'oxygen_saturation' => $this->input->post('oxygen_saturation'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'bmi' => $this->input->post('bmi'),
            'created_at' => $this->input->post('created_at')
        ];

        $this->vital_sign_model->update($id, $data);
        redirect('VitalSign/index');
    }

   // VitalSign.php - Controller
public function index()
{
    // Fetch all vital signs along with patient data
    $data['vital_signs'] = $this->vital_sign_model->get_all_with_patients();

    // Optionally, you can retrieve registration IDs from the vital_signs data
    // assuming that each vital sign record has a 'registration_id' field.
    if (!empty($data['vital_signs'])) {
        $data['registration_id'] = $data['vital_signs'][0]->registration_id; // Set registration_id for the first record or however you prefer
    } else {
        $data['registration_id'] = null; // Handle the case where no records are found
    }

    // Load the views and pass the data
    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('vital_sign/index', $data);
}

}
