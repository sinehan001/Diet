<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dietician_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertDietician($data) {
        $this->db->insert('dietician', $data);
    }

    function getDietician() {
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $this->db->or_like('department_name', $search);
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);
        $this->db->or_like('email', $search);
        $this->db->or_like('department_name', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('dietician');
        return $query->row();
    }

    function getDieticianByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('dietician');
        return $query->row();
    }

    function updateDietician($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('dietician', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('dietician');
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

    function getDieticianInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            
            $this->db->limit(10);
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        }


        if ($this->ion_auth->in_group(array('Dietician'))) {
            $dietician_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');
            $this->db->where('ion_user_id', $dietician_ion_id);
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        }


        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getDieticianWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        }


        if ($this->ion_auth->in_group(array('Dietician'))) {
            $dietician_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');
            $this->db->where('ion_user_id', $dietician_ion_id);
            $fetched_records = $this->db->get('dietician');
            $users = $fetched_records->result_array();
        }



        // Initialize Array with fetched data
        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }
    function getDieticianBySearchByDepartment($search, $order, $dir,$department) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->select('*')
                ->from('dietician')
                ->where('department', $department)
              
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%'OR department_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }

    function getDieticianByLimitByDepartment($limit, $start, $order, $dir,$department) {
        $this->db->where('department', $department);
      
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('dietician');
        return $query->result();
    }

    function getDieticianByLimitBySearchByDepartment($limit, $start, $search, $order, $dir,$department) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('dietician')
                ->where('department', $department)
             
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR phone LIKE '%" . $search . "%' OR address LIKE '%" . $search . "%'OR email LIKE '%" . $search . "%'OR department_name LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();

        return $query->result();
    }
    function getDieticianWithoutSearchByDepartment($order, $dir,$department) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->where('department', $department);
       
        $query = $this->db->get('dietician');
        return $query->result();
    }
    function getDieticianVisitByDieticianId($id) {
        $this->db->where('dietician_id', $id);
        $query = $this->db->get('dietician_visit');
        return $query->result();
    }
}
