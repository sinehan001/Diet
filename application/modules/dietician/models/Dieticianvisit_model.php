<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dieticianvisit_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDieticianvisit($data) {

        $this->db->insert('dietician_visit', $data);
    }

    function getDieticianvisit() {
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }

    function getDieticianvisitById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('dietician_visit');
        return $query->row();
    }
 function getDieticianvisitByStatus() {
        $this->db->where('status', 'active');
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }
    function updateDieticianvisit($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('dietician_visit', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('dietician_visit');
    }

    function getDieticianvisitBysearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
       $this->db->or_like('dietician_name', $search);
        $this->db->or_like('visit_description', $search);
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }

    function getDieticianvisitByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }

    function getDieticianvisitByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }


        $this->db->or_like('dietician_name', $search);
        $this->db->or_like('visit_description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }

    function getDieticianvisitWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }

}
