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

//     public function add_findings($registration_id)
// {
//     $this->load->view('r_assets/navbar');
//             $this->load->view('r_assets/sidebar');
//     $data['patient'] = $this->Registration_model->get_patient_by_id_findings($registration_id);
    
//     // Check if patient data was found
//     if (empty($data['patient'])) {
//         // Handle the case where no patient was found
//         $this->session->set_flashdata('error', 'Patient not found.');
//         redirect('findings/search_patient'); // Adjust redirect as necessary
//         return; // Stop further execution
//     }

//     $data['vital_signs'] = $this->Vital_sign_model->get_vital_signs_by_registration_id($registration_id);
//     $data['laboratory_tests'] = $this->LaboratoryTest_model->get_tests_by_registration_id($registration_id);
    
//     // Fetch existing findings for the patient
//     $data['findings'] = $this->Findings_model->get_findings_by_registration_id($registration_id); // Assuming you have this method

    
//     $this->load->view('findings/add_findings', $data);
// }

public function add_findings($registration_id) {
    // Load views for navbar and sidebar
    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');

    // Fetch patient data by registration ID
    $data['patient'] = $this->Registration_model->get_patient_by_id_findings($registration_id);
    
    // Check if patient data was found
    if (empty($data['patient'])) {
        $this->session->set_flashdata('error', 'Patient not found.');
        redirect('findings/search_patient'); // Adjust redirect as necessary
        return; // Stop further execution
    }

    // Fetch additional data for the view
    $data['vital_signs'] = $this->Vital_sign_model->get_vital_signs_by_registration_id($registration_id);
    $data['laboratory_tests'] = $this->LaboratoryTest_model->get_tests_by_registration_id($registration_id);
    $data['findings'] = $this->Findings_model->get_findings_by_registration_id($registration_id);

    // Check if the form has been submitted
    if ($this->input->post('submit')) {
        // Form validation rules
        $this->form_validation->set_rules('finding_title', 'Finding Title', 'required');
        $this->form_validation->set_rules('finding_description', 'Finding Description', 'required');

        if ($this->form_validation->run() == TRUE) {
            // Prepare the data for insertion
            $new_finding_data = array(
                'registration_id' => $registration_id,
                'title' => $this->input->post('finding_title'),
                'description' => $this->input->post('finding_description'),
                'created_at' => date('Y-m-d H:i:s'),
                'last_update' => date('Y-m-d H:i:s')
            );

            // Insert the new finding into the database
            if ($this->Findings_model->insert_finding($new_finding_data)) {
                $this->session->set_flashdata('success', 'Finding added successfully.');
                // Redirect to the list of findings or another relevant page
                redirect('findings/view_findings/' . $registration_id);
            } else {
                $this->session->set_flashdata('error', 'Failed to add finding. Please try again.');
            }
        }
    }

    // Load the form view if not submitted or validation failed
    $this->load->view('findings/add_findings', $data);
}



    private function is_admin()
    {
        $user_level = $this->session->userdata('user_level');
    return $user_level === 'admin' || $user_level === 'doctor';
    }

    public function store()
{
    // Admins can access this
    if (!$this->is_admin()) {
        show_error('Unauthorized access.', 403);
    }

    // Retrieve registration ID from the POST data
    $registration_id = $this->input->post('registration_id');

    // Retrieve findings and recommendations from POST data
    $findings = $this->input->post('findings'); // Make sure this input exists in your form
    $recommendations = $this->input->post('recommendations'); // Make sure this input exists in your form

    // Insert findings into the database
    $this->Findings_model->insert_findings($registration_id, $findings, $recommendations);

    // Set flash message and redirect
    $this->session->set_flashdata('success', 'Findings submitted successfully.');
    redirect('findings/index'); // Adjust this redirect according to your flow
}


public function view($registration_id) {

    $data['patient'] = $this->Registration_model->get_patient_by_id_findings($registration_id);  
    $data['vital_signs'] = $this->Vital_sign_model->get_vital_signs_by_registration_id($registration_id);
    $data['laboratory_tests'] = $this->LaboratoryTest_model->get_tests_by_registration_id($registration_id);
    $data['findings'] = $this->Findings_model->get_findings_by_registration_id($registration_id); 

    $this->load->view('r_assets/navbar');
    $this->load->view('r_assets/sidebar');
    $this->load->view('findings/view', $data);
}


}
