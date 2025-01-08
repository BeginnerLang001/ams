<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clinicuser extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Clinicuser_model');
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
    }

    public function index() {
        $data['users'] = $this->Clinicuser_model->get_all_users();
        $this->load->view('clinicuser/index', $data);
    }

    public function create() {
        $this->load->view('clinicuser/create');
    }

    public function store() {
        $postData = $this->input->post();
        $postData['password'] = password_hash($postData['password'], PASSWORD_DEFAULT);
        $this->Clinicuser_model->insert_user($postData);
        redirect('clinicuser');
    }

    public function edit($id) {
        $data['user'] = $this->Clinicuser_model->get_user_by_id($id);
        $this->load->view('clinicuser/edit', $data);
    }

    public function update($id) {
        $postData = $this->input->post();
        if (!empty($postData['password'])) {
            $postData['password'] = password_hash($postData['password'], PASSWORD_DEFAULT);
        } else {
            unset($postData['password']);
        }
        $this->Clinicuser_model->update_user($id, $postData);
        redirect('clinicuser');
    }

    public function delete($id) {
        $this->Clinicuser_model->delete_user($id);
        redirect('clinicuser');
    }
}
?>
