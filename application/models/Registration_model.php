<?php
class Registration_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('string');
        $this->table = 'registration';
    }

    public function insert_registration($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function rows()
    {
        $query = $this->db->get_where($this->table, array('is_deleted' => 0));
        return $query->result();
    }

    public function row($id)
    {
        $query = $this->db->get_where($this->table, array('is_deleted' => 0, 'id' => $id));
        return $query->row();
    }

    public function add($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update_registration($id, $data)
    {
        return $this->db->update($this->table, $data, array('id' => $id, 'is_deleted' => 0));
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, array('id' => $id));
    }


    public function rows_with_files()
    {
        $this->db->select('registration.*, GROUP_CONCAT(files.file_name) as files');
        $this->db->from('registration');
        $this->db->join('files', 'files.registration_id = registration.id', 'left');
        $this->db->where('registration.is_deleted', 0);
        $this->db->group_by('registration.id');
        $query = $this->db->get();
        return $query->result();
    }

//     public function search_by_name($name)
// {
//     $this->db->select('id, name, mname, lname'); // Select required fields
//     $this->db->like('name', $name);
//     $query = $this->db->get('registration');
//     return $query->result(); // Return array of objects or arrays
// }
public function get_all_tests() {
    $this->db->select('laboratory_tests.*, registration.name, registration.birthday, registration.address');
    $this->db->from('laboratory_tests');
    $this->db->join('registration', 'registration.id = laboratory_tests.registration_id');
    $query = $this->db->get();
    return $query->result_array();
}


public function search_by_name($name) {
    // Use the 'like' condition to search for patients by their full name (or parts of it)
    $this->db->select('id, name, mname, lname, address, birthday, marital_status');
    $this->db->from('registration'); // Adjust table name as necessary
    $this->db->like('name', $name); // Assuming you're searching by first name
    $this->db->or_like('mname', $name); // Search by middle name if needed
    $this->db->or_like('lname', $name); // Search by last name if needed
    $query = $this->db->get();
    
    return $query->result(); // Return the result as an array of objects
}



    public function get_registrations()
    {
        $this->db->select('*');
        $this->db->from('registration');
        $query = $this->db->get();
        return $query->result_array();
    }
    // public function get_all_registrations()
    // {
    //     $this->db->where('is_deleted', 0); // Exclude deleted records
    //     $query = $this->db->get('registration');
    //     return $query->result_array();
    // }
    public function rows_with_files_ordered()
    {
        // Fetch the rows with files and order by created_at and last_update in descending order
        $this->db->order_by('created_at', 'DESC');
        $this->db->order_by('last_update', 'DESC');
        $query = $this->db->get('registration'); // Assuming 'patients' is your table name
    
        return $query->result();
    }
    
    public function get_registration_by_id($id)
    {
        $query = $this->db->get_where('registration', array('id' => $id));
        return $query->row_array();
    }
    // Method to get patient by name and/or last name
    public function get_patient_by_name($name = '', $lname = '')
    {
        $this->db->select('*');
        $this->db->from('registration');

        if ($name) {
            $this->db->like('name', $name); // Use LIKE for partial matching
        }
        if ($lname) {
            $this->db->like('lname', $lname); // Use LIKE for partial matching
        }

        $query = $this->db->get();
        return $query->result_array(); // Return multiple rows as an array
    }
    public function get_patient_by_id_findings($registration_id)
{
    // Select only the required fields
    $this->db->select('id, name, mname, lname, address, birthday, marital_status'); // Ensure 'id' is included
    $this->db->where('id', $registration_id); // Make sure you are using the correct ID
    $query = $this->db->get('registration');
    return $query->row(); // Return an object
}

    public function is_valid_registration($registration_id)
{
    $this->db->where('id', $registration_id);
    $query = $this->db->get('registration');
    return $query->num_rows() > 0; // Return true if at least one row is found
}

    public function get_patient_by_id($patient_id)
    {
        $this->db->where('id', $patient_id);
        $query = $this->db->get('registration'); 
        return $query->row_array(); 
    }
    // Method to get patient by registration ID
    public function get_patient_by_registration_id($registration_id)
    {
        $this->db->where('registration_id', $registration_id);
        $query = $this->db->get('registration');
        return $query->row_array(); // Return a single row
    }
    public function export_registration_csv()
    {
        $registrations = $this->get_all_registrations(); // Fetch data

        $filename = 'registrations_' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        $output = fopen("php://output", "w");

        // Header row
        // Header row (plain text, no HTML tags)
        fputcsv($output, array(
            'Name',
            'Middle Name',
            'Last Name',
            'Marital Status',
            'Patient Contact No',
            'Philhealth ID',
            'Birthday',
            'Address',
            'Age',
            'Guardian Name',
            'Relation to Patient',
            'Guardian Contact Number',
            'Number of Pregnancies',
            'Last Menstrual Date',
            'Age of Gestation',
            'Expected Date of Confinement'
        ));


        // Data rows
        foreach ($registrations as $registration) {
            fputcsv($output, array(
                // $registration['custom_id'],
                $registration['name'],
                $registration['mname'],
                $registration['lname'],
                $registration['marital_status'],
                $registration['age'],
                $registration['patient_contact_no'],
                $registration['philhealth_id'],
                $registration['birthday'],
                $registration['address'],
                $registration['husband'],
                $registration['occupation'],
                $registration['husband_phone'],
                $registration['no_of_pregnancy'],
                $registration['last_menstrual'],
                $registration['age_gestation'],
                $registration['expected_date_confinement']
            ));
        }

        fclose($output);
        exit();
    }
    public function get_all_registrations()
{
    $this->db->select('name, mname, lname, marital_status, age, patient_contact_no, philhealth_id, birthday, address, husband, occupation, husband_phone, created_at, last_update');
    $query = $this->db->get('registration');
    return $query->result_array();
}


    public function export_registration_excel()
    {
        $registrations = $this->get_all_registrations(); // Fetch data

        $filename = 'registrations_' . date('Ymd') . '.xls';
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "<table border='1'>";
        echo "<th>Name</th><th>Middle Name</th><th>Last Name</th><th>Marital Status</th><th>age</th><th>Patient Contact No</th><th>Philhealth ID</th><th>Birthday</th><th>Address</th><th>Age</th><th>Guardian Name</th><th>Relation to Patient</th><th>Guardian Contact Number</th><th>Number of Pregnancies</th><th>Last Menstrual Date</th><th>Age of Gestation</th><th>Expected Date of Confinement</th></tr>";

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
            echo "</tr>";
        }

        echo "</table>";
        exit();
    }
    public function get_total_registrations()
    {
        return $this->db->count_all('registration');
    }
   
    public function get_registrations_by_date($start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('created_at >=', $start_date . ' 00:00:00'); // Start of date range
        $this->db->where('created_at <=', $end_date . ' 23:59:59'); // End of date range
        $query = $this->db->get();
        return $query->result();
    }
    public function get_patient_by_custom_id($custom_id)
    {
        $this->db->where('custom_id', $custom_id);
        $query = $this->db->get('registration');
        
        return $query->row_array();
    }
    
    
}
