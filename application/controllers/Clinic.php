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
        if ($user_level === 'admin') {
            redirect('dashboard/admin');
            
        } else {
            redirect('dashboard/user');
        }
        $this->load->view('dashboard_view');
    }
}
