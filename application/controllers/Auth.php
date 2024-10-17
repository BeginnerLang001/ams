<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->Auth_model->login($email, $password);
    
            if ($user) {
                $userdata = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'user_level' => $user->user_level,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($userdata);
    
                // Adjust the redirection based on user level
                switch ($user->user_level) {
                    case 'admin':
                        redirect('dashboard/admin');
                        break;
                    case 'secretary':
                        // Here you can create permissions for secretary if needed
                        // For example, you might have a function like create_secretary_permissions()
                        // $this->create_secretary_permissions($user->id);
                        redirect('dashboard/admin'); // Redirecting to admin dashboard for secretary as well
                        break;
                    default:
                        redirect('dashboard/user'); // Default user level
                        break;
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid login credentials');
                redirect('auth/login');
            }
        }
    }
    

    public function register() {
        
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/register');
        } else {
            
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $mobile = $this->input->post('mobile');
            $birthday = $this->input->post('birthday');
            $user_level = 'user';
            // $custom_id = 'MCH' . date('Y') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

            $data = array(
                
                'email' => $email,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
                'birthday' => $birthday,
                'user_level' => $user_level,
                // 'custom_id' => $custom_id
            );

            $insert_id = $this->Auth_model->register($data);

            if ($insert_id) {
                $this->session->set_flashdata('success', 'Registration successful. Please login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                redirect('auth/register');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
?>
