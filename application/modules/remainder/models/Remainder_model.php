<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Remainder_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
   function getAppointmentByyToday() {
        $today = strtotime(date('Y-m-d'));
//        $this->db->where('doctor', $doctor_id);
        $this->db->where('date', $today);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    

}
