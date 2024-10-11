<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExportController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Appointment_model'); 
        $this->load->model('OnlineAppointments_model');
        $this->load->model('Registration_model');
    }

    // Export Walk-In Appointments CSV
    public function walkin_csv() {
        $appointments = $this->Appointment_model->get_appointments(); // Fetch walk-in appointment data

        $filename = 'walkin_appointments_' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");
        
        // Header row
        fputcsv($output, array('Patient Name', 'Appointment Date', 'Appointment Time', 'Doctor', 'Status'));

        // Data rows
        foreach ($appointments as $appointment) {
            fputcsv($output, array(
                $appointment['patient_name'],
                $appointment['appointment_date'],
                $appointment['appointment_time'],
                $appointment['doctor'],
                $appointment['status']
            ));
        }

        fclose($output);
        exit();
    }

    // Export Walk-In Appointments Excel
    public function walkin_excel() {
        $appointments = $this->Appointment_model->get_appointments(); // Fetch walk-in appointment data

        $filename = 'walkin_appointments_' . date('Ymd') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr><th>Patient Name</th><th>Appointment Date</th><th>Appointment Time</th><th>Doctor</th><th>Status</th></tr>";

        foreach ($appointments as $appointment) {
            echo "<tr>";
            echo "<td>{$appointment['patient_name']}</td>";
            echo "<td>{$appointment['appointment_date']}</td>";
            echo "<td>{$appointment['appointment_time']}</td>";
            echo "<td>{$appointment['doctor']}</td>";
            echo "<td>{$appointment['status']}</td>";
            echo "</tr>";
        }

        echo "</table>";
        exit();
    }
    // Export CSV
    public function export_csv() {
        $appointments = $this->Appointment_model->get_appointments(); // Fetch data

        $filename = 'appointments_' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");
        
        // Header row
        fputcsv($output, array('Patient Name', 'Appointment Date', 'Appointment Time', 'Doctor', 'Status'));

        // Data rows
        foreach ($appointments as $appointment) {
            fputcsv($output, array(
                // $appointment['id'],
                $appointment['patient_name'],
                // Uncomment this line if 'custom_id' exists in the appointment data
                // $appointment['custom_id'], 
                $appointment['appointment_date'],
                $appointment['appointment_time'],
                $appointment['doctor'],
                $appointment['status']
            ));
        }

        fclose($output);
        exit();
    }

    
    public function export_excel() {
        $appointments = $this->Appointment_model->get_appointments();

        $filename = 'appointments_' . date('Ymd') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr><th>Patient Name</th><th>Appointment Date</th><th>Appointment Time</th><th>Doctor</th><th>Status</th></tr>";

        foreach ($appointments as $appointment) {
            echo "<tr>";
            // echo "<td>{$appointment['id']}</td>";
            echo "<td>{$appointment['patient_name']}</td>";
            // Uncomment this line if 'custom_id' exists in the appointment data
            // echo "<td>{$appointment['custom_id']}</td>";
            echo "<td>{$appointment['appointment_date']}</td>";
            echo "<td>{$appointment['appointment_time']}</td>";
            echo "<td>{$appointment['doctor']}</td>";
            echo "<td>{$appointment['status']}</td>";
            echo "</tr>";
        }

        echo "</table>";
        exit();
    }
    public function online_csv() {
        $onlineappointments = $this->OnlineAppointments_model->get_all_onlineappointments(); 

        $filename = 'online_appointments_' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");
        
       
        fputcsv($output, array('First Name', 'Last Name', 'Email', 'Contact Number', 'Appointment Date', 'Appointment Time', 'Status'));

        
        foreach ($onlineappointments as $onlineappointment) {
            fputcsv($output, array(
                // $onlineappointment['id'],
                $onlineappointment['firstname'],
                $onlineappointment['lastname'],
                $onlineappointment['email'],
                $onlineappointment['contact_number'],
                $onlineappointment['appointment_date'],
                $onlineappointment['appointment_time'],
                $onlineappointment['status']
            ));
        }

        fclose($output);
        exit();
    }

    public function online_excel() {
        $onlineappointments = $this->OnlineAppointments_model->get_all_onlineappointments(); 

        $filename = 'online_appointments_' . date('Ymd') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Birthday</th><th>Appointment Date</th><th>Appointment Time</th><th>Status</th></tr>";

        foreach ($onlineappointments as $onlineappointment) {
            echo "<tr>";
            // echo "<td>{$onlineappointment['id']}</td>";
            echo "<td>{$onlineappointment['firstname']}</td>";
            echo "<td>{$onlineappointment['lastname']}</td>";
            echo "<td>{$onlineappointment['email']}</td>";
            echo "<td>{$onlineappointment['contact_number']}</td>";
            echo "<td>{$onlineappointment['appointment_date']}</td>";
            echo "<td>{$onlineappointment['appointment_time']}</td>";
            echo "<td>{$onlineappointment['status']}</td>";
            echo "</tr>";
        }

        echo "</table>";
        exit();
    }
    public function export_registration_csv()
    {
        $this->load->model('Registration_model');
        $registrations = $this->Registration_model->get_all_registrations(); // Fetch data

        $filename = 'registrations_' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");

        // Header row
        fputcsv($output, array(
            'Name',
            'Middle Name',
            'Last Name',
            'Marital Status',
            'Patient Contact No',
            'Age',
            'Philhealth ID',
            'Birthday',
            'Address',
            'Guardian Name',
            'Relation to Patient',
            'Guardian Contact Number',
            'Number of Pregnancies',
            'Last Menstrual Date',
            'Age of Gestation',
            'Expected Date of Confinement',
            'Patient Record Date',
            'Patient Record Update'
        ));
        

        // Data rows
        foreach ($registrations as $registration) {
            fputcsv($output, array(
                $registration['name'],
                $registration['mname'],
                $registration['lname'],
                $registration['marital_status'],
                $registration['patient_contact_no'],
                $registration['age'],
                $registration['philhealth_id'],
                $registration['birthday'],
                $registration['address'],
                $registration['husband'],
                $registration['occupation'],
                $registration['husband_phone'],
                $registration['no_of_pregnancy'],
                $registration['last_menstrual'],
                $registration['age_gestation'],
                $registration['expected_date_confinement'],
                $registration['created_at'],
                $registration['last_update']
            ));
        }

        fclose($output);
        exit();
    }

    public function export_registration_excel()
    {
        $this->load->model('Registration_model');
        $registrations = $this->Registration_model->get_all_registrations(); // Fetch data

        $filename = 'registrations_' . date('Ymd') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<th>Name</th>" .
        "<th>Middle Name</th>" .
        "<th>Last Name</th>" .
        "<th>Marital Status</th>" .
        "<th>Age</th>" .
        "<th>Patient Contact No</th>" .
        "<th>Philhealth ID</th>" .
        "<th>Birthday</th>" .
        "<th>Address</th>" .
        "<th>Guardian Name</th>" .
        "<th>Relation to Patient</th>" .
        "<th>Guardian Contact Number</th>" .
        "<th>Number of Pregnancies</th>" .
        "<th>Last Menstrual Date</th>" .
        "<th>Age of Gestation</th>" .
        "<th>Expected Date of Confinement</th></tr>".
        "<th>Patient Record Date</th>" .
        "<th>Patient Record Update</th></tr>";
   
        // <tr><th>Custom ID</th>
        foreach ($registrations as $registration) {
            echo "<tr>";
            // echo "<td>{$registration['custom_id']}</td>";
            echo "<td>{$registration['name']}</td>";
            echo "<td>{$registration['mname']}</td>";
            echo "<td>{$registration['lname']}</td>";
            echo "<td>{$registration['marital_status']}</td>";
            echo "<td>{$registration['age']}</td>";
            echo "<td>{$registration['patient_contact_no']}</td>";
            echo "<td>{$registration['philhealth_id']}</td>";
            echo "<td>{$registration['birthday']}</td>";
            echo "<td>{$registration['address']}</td>";
            echo "<td>{$registration['husband']}</td>";
            echo "<td>{$registration['occupation']}</td>";
            echo "<td>{$registration['husband_phone']}</td>";
            echo "<td>{$registration['no_of_pregnancy']}</td>";
            echo "<td>{$registration['last_menstrual']}</td>";
            echo "<td>{$registration['age_gestation']}</td>";
            echo "<td>{$registration['expected_date_confinement']}</td>";
            echo "<td>{$registration['created_at']}</td>";
            echo "<td>{$registration['last_updated']}</td>";
            echo "</tr>";
        }

        echo "</table>";
        exit();
    }
    public function report_view() {
        $this->load->model('Registration_model');
        $this->load->model('OnlineAppointments_model');
        $this->load->model('Appointment_model');
    
        // Daily Report (Today)
        $data['dailyRegistrations'] = $this->Registration_model->get_registrations_by_date('daily');
        $data['dailyOnlineAppointments'] = $this->OnlineAppointments_model->get_online_appointments_by_date('daily');
        $data['dailyWalkInAppointments'] = $this->Appointment_model->get_appointments_by_date('daily');
    
        // Weekly Report (Current week)
        $data['weeklyRegistrations'] = $this->Registration_model->get_registrations_by_date('weekly');
        $data['weeklyOnlineAppointments'] = $this->OnlineAppointments_model->get_online_appointments_by_date('weekly');
        $data['weeklyWalkInAppointments'] = $this->Appointment_model->get_appointments_by_date('weekly');
    
        // Monthly Report (Current month)
        $data['monthlyRegistrations'] = $this->Registration_model->get_registrations_by_date('monthly');
        $data['monthlyOnlineAppointments'] = $this->OnlineAppointments_model->get_online_appointments_by_date('monthly');
        $data['monthlyWalkInAppointments'] = $this->Appointment_model->get_appointments_by_date('monthly');
    

        $this->load->view('report_view', $data);
    }
    
}