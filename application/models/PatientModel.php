<?php
defined('BASEPATH') or exit('No direct script access allowed');
class PatientModel extends CI_Model {

    public function searchPatients($name = '', $lname = '') {
        $this->db->select('*');
        $this->db->from('registration');
        
        if (!empty($name)) {
            $this->db->like('name', $name);
        }
        if (!empty($lname)) {
            $this->db->like('lname', $lname);
        }

        $query = $this->db->get();
        return $query->result();
    }
}
