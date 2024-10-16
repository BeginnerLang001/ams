<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'form', 'string']);
        $this->load->library(['session', 'form_validation']);
        $this->load->model('Registration_model');
        $this->load->model('Appointment_model');
        $this->load->model('User_model');
    }

    public function index()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level === 'admin') {
            redirect('registration/patients');
        } else {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/user_sidebarold');
        }
    }

    public function patients()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level === 'admin') {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
        } else {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/user_sidebarold');
        }

        $data['registrations'] = $this->Registration_model->rows_with_files_ordered();
        $this->load->view('dashboard/patients', $data);
    }

    public function generate_patient_id()
{
    $total_registrations = $this->get_total_registrations();
    $new_id_number = $total_registrations + 1;
    $new_patient_id = 'PAT-' . str_pad($new_id_number, 4, '0', STR_PAD_LEFT); // Format: PAT-0001

    return $new_patient_id;
}

    public function create()
    {
        $user_level = $this->session->userdata('user_level');

        if ($user_level === 'admin') {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
        } else {
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/user_sidebarold');
        }

        $data['custom_id'] = $this->generate_patient_id();
        $this->load->view('dashboard/registration', $data);
    }

    // public function submit()
    // {
    //     $this->form_validation->set_rules('birthday', 'Birthday', 'required');
    //     $this->form_validation->set_rules('address', 'Address', 'required');
    //     $this->form_validation->set_rules('name', 'Name', 'required');
    //     $this->form_validation->set_rules('lname', 'Last Name', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('dashboard/registration');
    //     } else {
    //         $patient_id = $this->input->post('custom_id') ?: $this->generate_patient_id();

    //         $data = array(
    //             'name' => $this->input->post('name'),
    //             'mname' => $this->input->post('mname'),
    //             'lname' => $this->input->post('lname'),
    //             'marital_status' => $this->input->post('marital_status'),
    //             'husband_phone' => $this->input->post('husband_phone'),
    //             'patient_contact_no' => $this->input->post('patient_contact_no'),
    //             'philhealth_id' => $this->input->post('philhealth_id'),
    //             'birthday' => $this->input->post('birthday'),
    //             'address' => $this->input->post('address'),
    //             'age' => $this->input->post('age'),
    //             'husband' => $this->input->post('husband'),
    //             'occupation' => $this->input->post('occupation'),
    //             'no_of_pregnancy' => $this->input->post('no_of_pregnancy'),
    //             'last_menstrual' => $this->input->post('last_menstrual'),
    //             'age_gestation' => $this->input->post('age_gestation'),
    //             'expected_date_confinement' => $this->input->post('expected_date_confinement'),
    //             'custom_id' => $patient_id,
    //             'last_update' => date('Y-m-d H:i:s'),
    //             'created_at' => date('Y-m-d H:i:s')
    //         );

    //         $this->Registration_model->insert_registration($data);
    //         $user_level = $this->session->userdata('user_level');
    //         if ($user_level === 'admin') {
    //             redirect('registration/patients');
    //         } else {
    //             redirect('dashboard/user');
    //         }
    //     }
    // }
    public function submit()
{
    $this->form_validation->set_rules('birthday', 'Birthday', 'required');
    $this->form_validation->set_rules('address', 'Address', 'required');
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('lname', 'Last Name', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('dashboard/registration');
    } else {
        // Generate a new patient ID if one is not provided
        $patient_id = $this->input->post('custom_id') ?: $this->generate_patient_id();


        $data = array(
            'custom_id' => $patient_id, // Store the generated patient ID
            'name' => $this->input->post('name'),
            'mname' => $this->input->post('mname'),
            'lname' => $this->input->post('lname'),
            'marital_status' => $this->input->post('marital_status'),
            'husband_phone' => $this->input->post('husband_phone'),
            'patient_contact_no' => $this->input->post('patient_contact_no'),
            'philhealth_id' => $this->input->post('philhealth_id'),
            'birthday' => $this->input->post('birthday'),
            'address' => $this->input->post('address'),
            'age' => $this->input->post('age'),
            'husband' => $this->input->post('husband'),
            'occupation' => $this->input->post('occupation'),
            'no_of_pregnancy' => $this->input->post('no_of_pregnancy'),
            'last_menstrual' => $this->input->post('last_menstrual'),
            'age_gestation' => $this->input->post('age_gestation'),
            'expected_date_confinement' => $this->input->post('expected_date_confinement'),
            'last_update' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->Registration_model->insert_registration($data);
        redirect('registration/patients');
    }
}

    public function edit($id)
    {
        $data['registration'] = $this->Registration_model->row($id);
        if (!$data['registration']) {
            show_404();
            return;
        }
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('registration_crud/reg_edit', $data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|integer');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('lname', 'Last Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['registration'] = $this->Registration_model->row($id);
            if (!$data['registration']) {
                show_404();
                return;
            }
            $this->load->view('r_assets/navbar');
            $this->load->view('r_assets/sidebar');
            $this->load->view('registration_crud/reg_edit', $data);
        } else {
            $data = array(
                
                'name' => $this->input->post('name'),
                'mname' => $this->input->post('mname'),
                'lname' => $this->input->post('lname'),
                'marital_status' => $this->input->post('marital_status'),
                'husband_phone' => $this->input->post('husband_phone'),
                'patient_contact_no' => $this->input->post('patient_contact_no'),
                'philhealth_id' => $this->input->post('philhealth_id'),
                'birthday' => $this->input->post('birthday'),
                'address' => $this->input->post('address'),
                'age' => $this->input->post('age'),
                'husband' => $this->input->post('husband'),
                'occupation' => $this->input->post('occupation'),
                'no_of_pregnancy' => $this->input->post('no_of_pregnancy'),
                'last_menstrual' => $this->input->post('last_menstrual'),
                'age_gestation' => $this->input->post('age_gestation'),
                'expected_date_confinement' => $this->input->post('expected_date_confinement'),
                'last_update' => date('Y-m-d H:i:s')
            );

            $this->Registration_model->update_registration($id, $data);
            redirect('registration/index');
        }
    }

    public function delete($id)
    {
        $this->Registration_model->delete($id);
        redirect('dashboard/admin');
    }

    public function details($id)
    {
        $data['registration'] = $this->Registration_model->row($id);
        if (!$data['registration']) {
            show_404();
            return;
        }
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('registration_crud/details', $data);
    }

    public function registration_form($user_id)
    {
        $this->load->model('User_model');
        $data['user'] = $this->User_model->get_user_by_id($user_id);
        $this->load->view('dashboard/registration', $data);
    }

    public function get_total_registrations()
    {
        return $this->db->count_all('registration');
    }
}
