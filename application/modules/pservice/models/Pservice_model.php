<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pservice_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertPservice($data) {
       
      //  $data2 = array_merge($data, $data1);
        $this->db->insert('pservice', $data);
    }

    function getPservice() {
      
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pservice');
        return $query->result();
    }

    function getPserviceById($id) {
       
        $this->db->where('id', $id);
        $query = $this->db->get('pservice');
        return $query->row();
    }

    function updatePservice($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pservice', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('pservice');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getPserviceBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('pservice')
               
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR alpha_code LIKE '%" . $search . "%'OR code LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPserviceByLimit($limit, $start) {
       
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('pservice');
        return $query->result();
    }

    function getPserviceByLimitBySearch($limit, $start, $search) {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('pservice')
                
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR alpha_code LIKE '%" . $search . "%'OR code LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getPserviceByActive() {
       
        $this->db->where('active', "1");
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('pservice');
        return $query->result();
    }

}
