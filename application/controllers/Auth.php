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
        // Set validation rules for the login form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Load the login view if validation fails
            $this->load->view('login/login');
        } else {
            // Get the input values
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            // Retrieve user from the model
            $user = $this->Auth_model->login($username, $password);
    
            if ($user) {
                // Set user data in session, include the `firstname`
                $userdata = array(
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'user_level' => $user->user_level,
                    'firstname' => $user->firstname, // Add firstname here
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($userdata);
    
                // Redirect based on user level
                switch ($user->user_level) {
                    case 'admin':
                        redirect('dashboard/admin');
                        break;
                    case 'secretary':
                        redirect('dashboard/admin'); // Redirecting to admin dashboard for secretary
                        break;
                    default:
                        redirect('dashboard/user'); // Default user level
                        break;
                }
            } else {
                // Set flashdata for error message
                $this->session->set_flashdata('error', 'Invalid login credentials');
                redirect('auth/login');
            }
        }
    }
    

    public function register() {
        // Set validation rules for registration
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
            // Prepare user data for registration
            $email = $this->input->post('email');
            $password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $mobile = $this->input->post('mobile');
            $birthday = $this->input->post('birthday');
            $user_level = 'user'; // Default user level

            $data = array(
                'email' => $email,
                'password' => $password,
                'firstname' => $firstname,
                'lastname' => $lastname,
                'mobile' => $mobile,
                'birthday' => $birthday,
                'user_level' => $user_level
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
