<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaboratoryTests extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LaboratoryTest_model');
        $this->load->model('Registration_model'); 
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
    }

    public function index() {
        
        $data['tests'] = $this->LaboratoryTest_model->get_all_tests();
        $this->load->view('laboratory_tests/index', $data);
    }

    public function search_patient() {
        
        $name = $this->input->post('name');
        $data['patients'] = $this->Registration_model->search_by_name($name);
        $this->load->view('laboratory_tests/search_results', $data);
    }

    public function create($patient_id = null) {
        if ($patient_id) {
            $data['patient'] = $this->LaboratoryTest_model->get_patient_by_id($patient_id);
        } else {
            $data['patient'] = null; 
        }
        $this->load->view('laboratory_tests/create', $data);
    }
    
    public function store() {
        $this->form_validation->set_rules('registration_id', 'Registration ID', 'required');
        $this->form_validation->set_rules('ultrasound', 'Ultrasound Result', 'required');
        // $this->form_validation->set_rules('pregnancy_test', 'Pregnancy Test Result', 'required');
        // $this->form_validation->set_rules('urinalysis', 'Urinalysis Result', 'required');
        $this->form_validation->set_rules('test_date', 'Test Date', 'required');
        $this->form_validation->set_rules('results', 'Results', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Re-use the patient_id to load the patient data if available
            $patient_id = $this->input->post('registration_id'); // Assuming you post the patient id here
            if ($patient_id) {
                $data['patient'] = $this->LaboratoryTest_model->get_patient_by_id($patient_id);
            } else {
                $data['patient'] = null; 
            }
            
            // Pass the patient data back to the view
            $this->load->view('laboratory_tests/create', $data); 
        } else {
            $data = array(
                'registration_id' => $this->input->post('registration_id'),
                'ultrasound' => $this->input->post('ultrasound'),
                // 'pregnancy_test' => $this->input->post('pregnancy_test'),
                // 'urinalysis' => $this->input->post('urinalysis'),
                'test_date' => $this->input->post('test_date'),
                'results' => $this->input->post('results'),
                'created_at' => date('Y-m-d H:i:s'),
                'last_update' => date('Y-m-d H:i:s')
            );
    
            if ($this->LaboratoryTest_model->insert_test($data)) {
                $this->session->set_flashdata('success', 'Laboratory test added successfully.');
            } else {
                $this->session->set_flashdata('error', 'Failed to add laboratory test. Please try again.');
            }
    
            redirect('laboratorytests/index');
        }
    }
    

    public function edit($id) {
        
        $data['test'] = $this->LaboratoryTest_model->get_test_by_id($id);
        $this->load->view('laboratory_tests/edit', $data);
    }

    public function update($id) {
        
        $data = array(
            'ultrasound' => $this->input->post('ultrasound'),
            // 'pregnancy_test' => $this->input->post('pregnancy_test'),
            // 'urinalysis' => $this->input->post('urinalysis'),
            'test_date' => $this->input->post('test_date'),
            'results' => $this->input->post('results'),
            'last_update' => date('Y-m-d H:i:s')
        );

        $this->LaboratoryTest_model->update_test($id, $data);
        redirect('laboratorytests/index');
    }

    public function delete($id) {
        
        $this->LaboratoryTest_model->delete_test($id);
        redirect('laboratorytests/index');
    }

    public function view($id) {
        
        $data['test'] = $this->LaboratoryTest_model->get_test_by_id($id);
        if ($data['test']) {
            
            $data['patient_name'] = $this->LaboratoryTest_model->get_patient_name($data['test']['registration_id']);
            $data['birthday'] = $this->LaboratoryTest_model->get_birthday($data['test']['registration_id']);
            $data['address'] = $this->LaboratoryTest_model->get_address($data['test']['registration_id']);
            $this->load->view('laboratory_tests/details', $data);
        } else {
            
            show_404();
        }
    }
}
