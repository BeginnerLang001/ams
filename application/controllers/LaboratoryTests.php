<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaboratoryTests extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('LaboratoryTest_model');
        $this->load->model('Registration_model'); // Model for patient registration
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
    }

    public function index() {
        // Fetch all laboratory tests
        $data['tests'] = $this->LaboratoryTest_model->get_all_tests();
        $this->load->view('laboratory_tests/index', $data);
    }

    public function search_patient() {
        // Search for patients by name
        $name = $this->input->post('name');
        $data['patients'] = $this->Registration_model->search_by_name($name);
        $this->load->view('laboratory_tests/search_results', $data);
    }

    public function create($patient_id = null) {
        // Prepare for creating a new laboratory test
        if ($patient_id) {
            $data['patient'] = $this->LaboratoryTest_model->get_patient_by_id($patient_id);
        } else {
            $data['patient'] = null; 
        }
        $this->load->view('laboratory_tests/create', $data);
    }

    public function store() {
        // Store laboratory test data
        $data = array(
            'registration_id' => $this->input->post('registration_id'),
            'ultrasound' => $this->input->post('ultrasound'),
            'pregnancy_test' => $this->input->post('pregnancy_test'),
            // 'urinalysis' => $this->input->post('urinalysis'),
            'test_date' => $this->input->post('test_date'),
            'results' => $this->input->post('results'),
            'created_at' => date('Y-m-d H:i:s'),
            'last_update' => date('Y-m-d H:i:s')
        );

        // Insert the test data into the database
        $this->LaboratoryTest_model->insert_test($data);

        // Redirect to the index page
        redirect('laboratorytests/index');
    }

    public function edit($id) {
        // Edit an existing laboratory test record
        $data['test'] = $this->LaboratoryTest_model->get_test_by_id($id);
        $this->load->view('laboratory_tests/edit', $data);
    }

    public function update($id) {
        // Update laboratory test data
        $data = array(
            'ultrasound' => $this->input->post('ultrasound'),
            'pregnancy_test' => $this->input->post('pregnancy_test'),
            // 'urinalysis' => $this->input->post('urinalysis'),
            'test_date' => $this->input->post('test_date'),
            'results' => $this->input->post('results'),
            'last_update' => date('Y-m-d H:i:s')
        );

        $this->LaboratoryTest_model->update_test($id, $data);
        redirect('laboratorytests/index');
    }

    public function delete($id) {
        // Delete a laboratory test record
        $this->LaboratoryTest_model->delete_test($id);
        redirect('laboratorytests/index');
    }

    public function view($id) {
        // View a specific laboratory test record
        $data['test'] = $this->LaboratoryTest_model->get_test_by_id($id);
        if ($data['test']) {
            // Fetch patient details
            $data['patient_name'] = $this->LaboratoryTest_model->get_patient_name($data['test']['registration_id']);
            $data['birthday'] = $this->LaboratoryTest_model->get_birthday($data['test']['registration_id']);
            $data['address'] = $this->LaboratoryTest_model->get_address($data['test']['registration_id']);
            $this->load->view('laboratory_tests/details', $data);
        } else {
            // Handle the case where the test does not exist
            show_404();
        }
    }
}
