<?php
class Diagnosis_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_diagnoses()
    {
        $this->db->select('diagnosis.*, registration.name, registration.mname, registration.lname' );
        $this->db->from('diagnosis');
        $this->db->join('registration', 'registration.id = diagnosis.registration_id');
        
        $query = $this->db->get();
        
        // Debugging: print the last query to check it
        echo $this->db->last_query();
        return $query->result_array();
    }
    

    public function get_diagnosis_by_id($id)
    {
        $this->db->select('diagnosis.*, registration.name');
        $this->db->from('diagnosis');
        $this->db->join('registration', 'registration.id = diagnosis.registration_id');
        
        $this->db->where('diagnosis.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_diagnosis($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('diagnosis', $data);
    }

    public function delete_diagnosis($id)
    {
        return $this->db->delete('diagnosis', array('id' => $id));
    }

    public function get_all_diagnosis_types()
    {
        $query = $this->db->get('diagnosis_types');
        return $query->result_array();
    }

    public function search_by_name($name)
    {
        $this->db->select('registration.*');
        $this->db->from('registration');
        $this->db->like('name', $name);
        $this->db->or_like('mname', $name);
        $this->db->or_like('lname', $name);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insert_diagnosis($data) {
        return $this->db->insert('diagnosis', $data);
    }
    public function count_diagnoses($period)
    {
        $this->db->select('COUNT(*) as count');
        
        if ($period === 'monthly') {
            $this->db->where('MONTH(date_released)', date('m'));
            $this->db->where('YEAR(date_released)', date('Y'));
        } elseif ($period === 'weekly') {
            $this->db->where('YEARWEEK(date_released, 1) = YEARWEEK(NOW(), 1)', NULL);
        } elseif ($period === 'daily') {
            $this->db->where('DATE(date_released)', date('Y-m-d'));
        }

        $query = $this->db->get('diagnosis');
        return $query->row()->count; // Return the count
    }
    public function count_diagnoses_by_date($start_date, $end_date)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->from('diagnosis');
        $this->db->where('created_at >=', $start_date . ' 00:00:00');
        $this->db->where('created_at <=', $end_date . ' 23:59:59');
        $query = $this->db->get();
        return $query->row()->count;
    }
}
