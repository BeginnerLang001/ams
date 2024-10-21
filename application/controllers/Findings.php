<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Findings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Findings_model');
        $this->load->model('Registration_model');
        $this->load->model('Vital_sign_model');
        $this->load->model('LaboratoryTest_model');
        $this->load->model('PatientModel');

        // Check if user is logged in, if not redirect to login
        if (!$this->session->userdata('logged_in')) {
            redirect('login'); // Adjust this according to your login route
        }
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }
    }
    public function index()
    {
        
        // Retrieve all findings
        $data['findings'] = $this->Findings_model->get_all_findings_index(); // Adjust this method as necessary
    
        // Check if findings are being retrieved correctly
        if (empty($data['findings'])) {
            log_message('info', 'No findings found in the database.');
        } else {
            log_message('info', 'Findings retrieved successfully.');
        }
    
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('findings/index', $data);
    }
    
    // Display the search form
    public function search_patient()
    {
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('findings/patient_search');
    }

    // Search for patients by name
    public function search()
    {
        $name = $this->input->post('name'); // Get the name from the input
        $data['patients'] = $this->Registration_model->search_by_name($name); // Use the model to search for patients
        

        if (!empty($data['patients'])) {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
            $this->load->view('findings/patient_search_results', $data); // Load search results view
        } else {
            $this->session->set_flashdata('error', 'No patients found with that name.'); // Flash message if no patients found
            redirect('findings/search_patient'); // Redirect to search form
        }
    }

    public function add_findings($registration_id)
{
    $data['patient'] = $this->Registration_model->get_patient_by_id_findings($registration_id);
    
    // Check if patient data was found
    if (empty($data['patient'])) {
        // Handle the case where no patient was found
        $this->session->set_flashdata('error', 'Patient not found.');
        redirect('findings/search_patient'); // Adjust redirect as necessary
        return; // Stop further execution
    }

    $data['vital_signs'] = $this->Vital_sign_model->get_vital_signs_by_registration_id($registration_id);
    $data['laboratory_tests'] = $this->LaboratoryTest_model->get_tests_by_registration_id($registration_id);
    
    // Fetch existing findings for the patient
    $data['findings'] = $this->Findings_model->get_findings_by_registration_id($registration_id); // Assuming you have this method

    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('findings/add_findings', $data);
}


    private function is_admin()
    {
        return $this->session->userdata('user_level') === 'admin';
    }

    public function store()
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        // Retrieve registration ID from the POST data
        $registration_id = $this->input->post('registration_id');

        $data = array(
            'registration_id' => $registration_id,
            'findings' => $this->input->post('findings'),
            'recommendations' => $this->input->post('recommendations'),
            'created_at' => date('Y-m-d H:i:s'),
        );

        // Insert findings into the database
        $this->Findings_model->insert_findings($data);

        // Set flash message and redirect
        $this->session->set_flashdata('success', 'Findings submitted successfully.');
        redirect('findings/index', $data); // Adjust this redirect according to your flow
    }
}
