<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends CI_Controller {

    public function __construct() {
        parent::__construct();
   
        $this->load->model('Appointment_model');
        $this->load->model('OnlineAppointments_model'); 
        $this->load->model('Registration_model');
        $this->load->model('Report_model');
    }

    public function summary() {
   
        $data['totalRegistrations'] = $this->Registration_model->get_total_registrations();
        $data['totalOnlineAppointments'] = $this->OnlineAppointments_model->get_total_online_appointments();
        $data['onlineAppointmentsApproved'] = $this->OnlineAppointments_model->get_online_appointments_by_status('Approved');
        $data['onlineAppointmentsRejected'] = $this->OnlineAppointments_model->get_online_appointments_by_status('Rejected');
        $data['onlineAppointmentsPending'] = $this->OnlineAppointments_model->get_online_appointments_by_status('Pending');
        $data['totalWalkInAppointments'] = $this->Appointment_model->get_total_appointments();
        $data['walkInAppointmentsApproved'] = $this->Appointment_model->get_appointments_by_status('Approved');
        $data['walkInAppointmentsRejected'] = $this->Appointment_model->get_appointments_by_status('Rejected');
        $data['walkInAppointmentsPending'] = $this->Appointment_model->get_appointments_by_status('Pending');
        
        
        $this->load->view('summary_report', $data);
    }

    public function index($reportType = 'daily') {
        $data = $this->get_report_data($reportType);

        $data['reportType'] = $reportType;

     
        $this->load->view('summary_report', $data);
    }

    private function get_report_data($reportType) {
        $startDate = $this->get_start_date($reportType);
        $endDate = date('Y-m-d'); 

        $data['totalRegistrations'] = $this->Report_model->get_total_registrations($startDate, $endDate);
        $data['totalOnlineAppointments'] = $this->Report_model->get_total_online_appointments($startDate, $endDate);
        $data['onlineAppointmentsApproved'] = $this->Report_model->get_online_appointments_status($startDate, $endDate, 'Approved');
        $data['onlineAppointmentsRejected'] = $this->Report_model->get_online_appointments_status($startDate, $endDate, 'Rejected');
        $data['onlineAppointmentsPending'] = $this->Report_model->get_online_appointments_status($startDate, $endDate, 'Pending');
        $data['totalWalkInAppointments'] = $this->Report_model->get_total_walk_in_appointments($startDate, $endDate);
        $data['walkInAppointmentsApproved'] = $this->Report_model->get_walk_in_appointments_status($startDate, $endDate, 'Approved');
        $data['walkInAppointmentsRejected'] = $this->Report_model->get_walk_in_appointments_status($startDate, $endDate, 'Rejected');
        $data['walkInAppointmentsPending'] = $this->Report_model->get_walk_in_appointments_status($startDate, $endDate, 'Pending');

        return $data;
    }

    private function get_start_date($reportType) {
        switch ($reportType) {
            case 'weekly':
                return date('Y-m-d', strtotime('monday this week')); 
            case 'monthly':
                return date('Y-m-01'); 
            default: 
                return date('Y-m-d');
        }
    }

    public function monthly() {
      
        $data = $this->Report_model->get_monthly_report_data();

      
        $this->load->view('monthly_report', $data);
    }

    public function weekly() {
       
        $data = $this->Report_model->get_weekly_report_data();

      
        $this->load->view('weekly_report', $data);
    }
}
