<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('checkup_model');
        $this->load->model('Registration_model');
        $this->load->model('Report_model');
    }

    // Display form to create a new check-up
    public function create()
    {
        $data['patients'] = $this->checkup_model->get_patients(); // Fetch patient names
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/create', $data);
    }
    public function view($id)
    {
        // Fetch the specific checkup data based on the ID
        $data['checkup'] = $this->checkup_model->get_checkup($id);

        // No need to fetch patient data separately as it is included in the checkup data now

        // Load the view and pass the data
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/view', $data);
    }


    public function store()
    {
        $data = [
            'registration_id' => $this->input->post('registration_id'),
            'blood_pressure' => $this->input->post('blood_pressure'),
            'pulse_rate' => $this->input->post('pulse_rate'),
            'respiration_rate' => $this->input->post('respiration_rate'),
            'temperature' => $this->input->post('temperature'),
            'oxygen_saturation' => $this->input->post('oxygen_saturation'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'ultrasound' => $this->input->post('ultrasound'),
            'prescription' => $this->input->post('prescription'),
            'recommendation' => $this->input->post('recommendation'),
            'doctor_comment' => $this->input->post('doctor_comment'),
            'next_checkup_date' => $this->input->post('next_checkup_date'),

        ];

        $this->checkup_model->insert($data);
        redirect('checkup/index');
    }



    // Display the form to update a check-up
    public function update($id)
    {
        // Fetch checkup data
        $data['checkup'] = $this->checkup_model->get_checkup($id);
        // Fetch patient data (you may want to create a separate method in the model for clarity)
        $data['patient'] = $this->checkup_model->get_patient_by_registration_id($data['checkup']->registration_id);

        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/update', $data);
    }

    public function update_action()
    {
        $id = $this->input->post('id');
        $data = [
            'registration_id' => $this->input->post('registration_id'),
            'blood_pressure' => $this->input->post('blood_pressure'),
            'pulse_rate' => $this->input->post('pulse_rate'),
            'respiration_rate' => $this->input->post('respiration_rate'),
            'temperature' => $this->input->post('temperature'),
            'oxygen_saturation' => $this->input->post('oxygen_saturation'),
            'height' => $this->input->post('height'),
            'weight' => $this->input->post('weight'),
            'ultrasound' => $this->input->post('ultrasound'),
            'doctor_comment' => $this->input->post('doctor_comment'),
            'next_checkup_date' => $this->input->post('next_checkup_date'),
            'prescription' => $this->input->post('prescription'), // New field
            'recommendation' => $this->input->post('recommendation') // New field
        ];

        $this->checkup_model->update($id, $data);
        redirect('checkup/index'); // Redirect to the index method after update
    }

    // Display all check-ups
    public function index()
    {
        $data['checkups'] = $this->checkup_model->get_all_with_patients(); // Fetch check-ups with patient details
        $this->load->view('r_assets/navbar');
        $this->load->view('r_assets/sidebar');
        $this->load->view('checkup/index', $data);
    }
    public function export_checkup_excel()
    {
        $checkups = $this->checkup_model->get_all_with_patients();

        // Create a new PHPExcel object
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);

        // Set the headers
        $headers = [
            'A1' => 'Patient Full Name',
            'B1' => 'Birthday',
            'C1' => 'Age',
            'D1' => 'Address',
            'E1' => 'Blood Pressure',
            'F1' => 'Pulse Rate',
            'G1' => 'Respiration Rate',
            'H1' => 'Temperature',
            'I1' => 'Oxygen Saturation',
            'J1' => 'Height',
            'K1' => 'Weight',
            'L1' => 'Checkup Date',
            'O1' => 'Prescription',
            'P1' => 'Recommendation',
            'M1' => 'Next Checkup Date',
            'N1' => 'Doctor Comment',
        ];

        foreach ($headers as $cell => $header) {
            $objPHPExcel->getActiveSheet()->setCellValue($cell, $header);
        }

        $row = 2; // Start from the second row
        foreach ($checkups as $checkup) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, htmlspecialchars($checkup->name . ' ' . ($checkup->mname ? htmlspecialchars($checkup->mname) . ' ' : '') . htmlspecialchars($checkup->lname)));
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, htmlspecialchars(date('Y-m-d', strtotime($checkup->birthday))));
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, htmlspecialchars($checkup->age));
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, htmlspecialchars($checkup->address));
            $objPHPExcel->getActiveSheet()->setCellValue('E' . $row, htmlspecialchars($checkup->blood_pressure));
            $objPHPExcel->getActiveSheet()->setCellValue('F' . $row, htmlspecialchars($checkup->pulse_rate));
            $objPHPExcel->getActiveSheet()->setCellValue('G' . $row, htmlspecialchars($checkup->respiration_rate));
            $objPHPExcel->getActiveSheet()->setCellValue('H' . $row, htmlspecialchars($checkup->temperature));
            $objPHPExcel->getActiveSheet()->setCellValue('I' . $row, htmlspecialchars($checkup->oxygen_saturation));
            $objPHPExcel->getActiveSheet()->setCellValue('J' . $row, htmlspecialchars($checkup->height));
            $objPHPExcel->getActiveSheet()->setCellValue('K' . $row, htmlspecialchars($checkup->weight));
            $objPHPExcel->getActiveSheet()->setCellValue('L' . $row, date('Y-m-d H:i', strtotime($checkup->checkup_date)));
            $objPHPExcel->getActiveSheet()->setCellValue('M' . $row, htmlspecialchars($checkup->next_checkup_date));
            $objPHPExcel->getActiveSheet()->setCellValue('N' . $row, htmlspecialchars($checkup->prescription));
            $objPHPExcel->getActiveSheet()->setCellValue('O' . $row, htmlspecialchars($checkup->recommendation));
            $objPHPExcel->getActiveSheet()->setCellValue('p' . $row, htmlspecialchars($checkup->doctor_comment));
            $row++;
        }

        // Set headers for Excel download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="checkups.xlsx"');
        header('Cache-Control: max-age=0');

        // Write the file
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();
    }

    public function export_checkup_csv()
    {
        $checkups = $this->checkup_model->get_all_with_patients();

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="checkups.csv"');

        // Open output stream
        $output = fopen('php://output', 'w');

        // Set the CSV headers
        fputcsv($output, [
            'Patient Full Name',
            'Birthday',
            'Age',
            'Address',
            'Blood Pressure',
            'Pulse Rate',
            'Respiration Rate',
            'Temperature',
            'Oxygen Saturation',
            'Height',
            'Weight',
            'Checkup Date',
            'Next Checkup Date',
            'Prescription',
            'Recommendation',
            'Doctor Comment'
        ]);

        foreach ($checkups as $checkup) {
            fputcsv($output, [
                htmlspecialchars($checkup->name . ' ' . ($checkup->mname ? htmlspecialchars($checkup->mname) . ' ' : '') . htmlspecialchars($checkup->lname)),
                htmlspecialchars(date('Y-m-d', strtotime($checkup->birthday))),
                htmlspecialchars($checkup->age),
                htmlspecialchars($checkup->address),
                htmlspecialchars($checkup->blood_pressure),
                htmlspecialchars($checkup->pulse_rate),
                htmlspecialchars($checkup->respiration_rate),
                htmlspecialchars($checkup->temperature),
                htmlspecialchars($checkup->oxygen_saturation),
                htmlspecialchars($checkup->height),
                htmlspecialchars($checkup->weight),
                date('Y-m-d H:i', strtotime($checkup->checkup_date)),
                htmlspecialchars($checkup->next_checkup_date),
                htmlspecialchars($checkup->prescription),
                htmlspecialchars($checkup->recommendation),
                htmlspecialchars($checkup->doctor_comment),
            ]);
        }

        fclose($output);
        exit();
    }
}
