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
    }

    public function index()
    {
        $data['diagnoses'] = $this->Diagnosis_model->get_all_diagnoses();

        // Fetch counts for diagnosis reports
        $data['monthlyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('monthly');
        $data['weeklyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('weekly');
        $data['dailyDiagnoses'] = $this->Diagnosis_model->count_diagnoses('daily');

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/diagnosis_view', $data);
    }


    // public function add($patient_id = NULL)
    // {
    //     $data['patient_id'] = $patient_id;
    //     $data['diagnosis_types'] = $this->Diagnosis_model->get_all_diagnosis_types();
    //     $this->load->view('r_assets/navbar');
    //     $this->load->view('r_assets/sidebar');
    //     $this->load->view('diagnosis/diagnosis_add', $data);
    // }
    public function add($patient_id = NULL)
{
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
        $data = array(
            'registration_id' => $this->input->post('registration_id'),
            'diagnosis_type_id' => $this->input->post('diagnosis_type_id'),
            'recommendation' => $this->input->post('recommendation'),
            'prescriptions' => $this->input->post('prescriptions'),
            'date_released' => $this->input->post('date_released'),
        );

        $this->Diagnosis_model->insert_diagnosis($data);
        redirect('diagnosis');
    }

    public function update($id)
    {
        $data = array(
            'diagnosis_type_id' => $this->input->post('diagnosis_type_id'),
            'recommendation' => $this->input->post('recommendation'),
            'prescriptions' => $this->input->post('prescriptions'),
            'date_released' => $this->input->post('date_released'),
        );

        $this->Diagnosis_model->update_diagnosis($id, $data);
        redirect('diagnosis');
    }


    public function edit($id)
    {
        $data['diagnosis'] = $this->Diagnosis_model->get_diagnosis_by_id($id);
        $data['diagnosis_types'] = $this->Diagnosis_model->get_all_diagnosis_types();
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/diagnosis_edit', $data);
    }



    public function delete($id)
    {
        $this->Diagnosis_model->delete_diagnosis($id);
        redirect('diagnosis');
    }

    public function search()
    {
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
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('diagnosis/patient_search');
    }
    
}
