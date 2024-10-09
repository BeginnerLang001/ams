<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
    }

    public function search_patients($query) {
        $this->db->like('name', $query);
        $query = $this->db->get('patients');
        return $query->result_array();
    }
}
