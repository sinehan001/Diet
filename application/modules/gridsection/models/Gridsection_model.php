<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gridsection_model extends CI_Model {
    
    function getGridsection() {
        $query = $this->db->get('site_grid')->result();
        return $query;
    }
    
    function insertGridsection($data) {
        $this->db->insert('site_grid',$data);
    }
    
    function updateGridsection($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('site_grid',$data);
    }
    
    function getGridsectionById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('site_grid')->row();
        return $query;
    }
    
    function deleteGridsection($id) {
        $this->db->where('id', $id);
        $this->db->delete('site_grid');
    }
    
    function getActiveGrids() {
        $this->db->where('status','Active');
        $this->db->order_by('position','ASC');
        $query = $this->db->get('site_grid')->result();
        return $query;
    }
}