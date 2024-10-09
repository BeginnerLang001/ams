<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');

        // if (!$this->session->userdata('logged_in') || $this->session->userdata('user_level') != 'user') {
        //     redirect('auth/login');
        // }
    }

    public function index() {
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/user_sidebarold');
    }
}
?>
