<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctorvisit_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDoctorvisit($data) {

        $this->db->insert('doctor_visit', $data);
    }

    function getDoctorvisit() {
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

    function getDoctorvisitById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('doctor_visit');
        return $query->row();
    }
 function getDoctorvisitByStatus() {
        $this->db->where('status', 'active');
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }
    function updateDoctorvisit($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('doctor_visit', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('doctor_visit');
    }

    function getDoctorvisitBysearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
       $this->db->or_like('doctor_name', $search);
        $this->db->or_like('visit_description', $search);
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

    function getDoctorvisitByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

    function getDoctorvisitByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }


        $this->db->or_like('doctor_name', $search);
        $this->db->or_like('visit_description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

    function getDoctorvisitWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('doctor_visit');
        return $query->result();
    }

}
