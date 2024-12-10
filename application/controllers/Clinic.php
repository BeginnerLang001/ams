<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clinic extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        

    }
    //this is login page http://chstnsgd.com/Clinic/auth/login
    public function index()
    {
       
        $this->load->view('login/clinic');

        
    }


    public function dashboard()
{
    $user_level = $this->session->userdata('user_level');
    
    // Redirect based on user level
    switch ($user_level) {
        case 'admin':
            redirect('dashboard/admin');
            break;
        case 'secretary':
            redirect('dashboard/admin');
            break;
        case 'doctor':
            redirect('dashboard/admin');
            break;
        case 'user':
            redirect('dashboard/user');
            break;
        default:
            // Handle unknown user levels or redirect to a default page
            redirect('auth/login');
            break;
    }

    // This line is unreachable due to the redirects above, but included for completeness
    $this->load->view('dashboard_view');
}

}
