<?php
class Diagnosis_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_all_diagnoses()
    {
        $this->db->select('diagnosis.*, registration.name, registration.mname, registration.lname, diagnosis_types.type');
        $this->db->from('diagnosis');
        $this->db->join('registration', 'registration.id = diagnosis.registration_id');
        $this->db->join('diagnosis_types', 'diagnosis_types.id = diagnosis.diagnosis_type_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_diagnosis_by_id($id)
    {
        $this->db->select('diagnosis.*, registration.name, diagnosis_types.type');
        $this->db->from('diagnosis');
        $this->db->join('registration', 'registration.id = diagnosis.registration_id');
        $this->db->join('diagnosis_types', 'diagnosis_types.id = diagnosis.diagnosis_type_id');
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



    
}
