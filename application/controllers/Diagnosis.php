<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diagnosis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Diagnosis_model');
        $this->load->model('Registration_model'); // Load Registration model to fetch patient details
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Report_model');
        
        // Check if user is logged in, if not redirect to login
        if (!$this->session->userdata('logged_in')) {
            redirect('login'); // Adjust this according to your login route
        }
    }

    private function is_admin()
    {
        $user_level = $this->session->userdata('user_level');
return $user_level === 'admin' || $user_level === 'doctor';
    }

    public function index()
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        $data['diagnoses'] = $this->Diagnosis_model->get_all_diagnoses();

        // Fetch counts for diagnosis reports
        $data['monthlyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('monthly');
        $data['weeklyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('weekly');
        $data['dailyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('daily');

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/diagnosis_view', $data);
    }

    public function add($patient_id = NULL)
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        $data['patient_id'] = $patient_id;

        // Fetch patient details
        $patient = $this->Registration_model->get_patient_by_id($patient_id);
        if ($patient) {
            $data['patient_name'] = $patient['name'];
            $data['patient_mname'] = $patient['mname'];
            $data['patient_lname'] = $patient['lname'];
        } else {
            // Handle case where patient is not found
            $data['patient_name'] = '';
            $data['patient_mname'] = '';
            $data['patient_lname'] = '';
        }

        $data['diagnosis_types'] = $this->Diagnosis_model->get_all_diagnosis_types();
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/diagnosis_add', $data);
    }

    public function store()
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        $data = array(
            'registration_id' => $this->input->post('registration_id'),
            'prescriptions' => $this->input->post('prescriptions'),
            'date_released' => $this->input->post('date_released'),
        );

        $this->Diagnosis_model->insert_diagnosis($data);
        redirect('diagnosis');
    }

    public function update($id)
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        $data = array(
            'prescriptions' => $this->input->post('prescriptions'),
            'date_released' => $this->input->post('date_released'),
        );

        $this->Diagnosis_model->update_diagnosis($id, $data);
        redirect('diagnosis');
    }

    public function delete($id)
    {
        // Admins can access this
        if (!$this->is_admin()) {
            show_error('Unauthorized access.', 403);
        }

        $this->Diagnosis_model->delete_diagnosis($id);
        redirect('diagnosis');
    }

    public function search()
    {
        // Both admin and secretary can access this
        $name = $this->input->post('name');
        $data['patients'] = $this->Diagnosis_model->search_by_name($name);

        if (!empty($data['patients'])) {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
            $this->load->view('diagnosis/patient_search_results', $data);
        } else {
            $this->session->set_flashdata('error', 'No patients found with that name.');
            redirect('diagnosis/search_form');
        }
    }

    public function search_form()
    {
        // Both admin and secretary can access this
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/patient_search');
    }
}
