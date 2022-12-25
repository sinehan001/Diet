<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Patient_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->imgTbl = 'patient_material';
    }

    function insertFolder($data) {
        $this->db->insert('folder', $data);
    }

    function getFolder() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('folder');
        return $query->result();
    }

    function getFolderById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('folder');
        return $query->row();
    }

    function updateFolder($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('folder', $data);
    }

    function getFolderByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('folder');
        return $query->result();
    }

    function getPatientMaterialByFolderId($id) {
        $this->db->where('folder', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }
    

    function deleteFolder($id) {
        $this->db->where(array('id'=> $id));
        $this->db->delete('folder');
    }

    function deletePatientMaterialByFolderId($id) {
        $this->db->where(array('folder'=> $id));
        $this->db->delete('patient_material');

    }
     public function deleteImage($con){ 
        // Delete image data 
        $delete = $this->db->delete($this->imgTbl, $con); 
         
        // Return the status 
        return $delete?true:false; 
    } 

    function getPatientMaterialByyPatientId($patient_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient_id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function insertPatient($data) {
        $this->db->insert('patient', $data);
    }

    function getPatient() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('name', $search);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('name', $search);
        $this->db->or_like('phone', $search);
        $this->db->or_like('address', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('patient');
        return $query->result();
    }

    function getPatientById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getPatientDietById($id) {
        $this->db->where('pid', $id);
        $query = $this->db->get('dietplan');
        return $query->row();
    }

    function getPatientByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function getPatientByEmail($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('patient');
        return $query->row();
    }

    function insertDiet($data) {
        $this->db->insert('dietplan', $data);
    }

    function updatePatient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient');
    }

    function insertMedicalHistory($data) {
        $this->db->insert('medical_history', $data);
    }

    function getMedicalHistoryByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('description', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('medical_history');
        return $query->result();
    }

    function getMedicalHistoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medical_history');
        return $query->row();
    }

    function updateMedicalHistory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medical_history', $data);
    }

    function insertDiagnosticReport($data) {
        $this->db->insert('diagnostic_report', $data);
    }

    function updateDiagnosticReport($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('diagnostic_report', $data);
    }

    function getDiagnosticReport() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function getDiagnosticReportById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByInvoiceId($id) {
        $this->db->where('invoice', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->row();
    }

    function getDiagnosticReportByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('diagnostic_report');
        return $query->result();
    }

    function insertPatientMaterial($data) {
        $this->db->insert('patient_material', $data);
    }

    function getPatientMaterial() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getPatientMaterialWithoutSearch($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getDocumentBySearch($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->like('id', $search);
        $this->db->or_like('patient_name', $search);
        $this->db->or_like('date_string', $search);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getDocumentByLimit($limit, $start, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getDocumentByLimitBySearch($limit, $start, $search, $order, $dir) {

        $this->db->like('id', $search);

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc');
        }

        $this->db->or_like('date_string', $search);

        $this->db->or_like('patient_name', $search);
        $this->db->or_like('patient_phone', $search);
        $this->db->or_like('patient_address', $search);

        $this->db->or_like('title', $search);

        $this->db->limit($limit, $start);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function getPatientMaterialById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_material');
        return $query->row();
    }

    function getPatientMaterialByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }

    function deletePatientMaterial($id) {
        $this->db->where('id', $id);
        $this->db->delete('patient_material');
    }

    function deleteMedicalHistory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medical_history');
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

    function getDueBalanceByPatientId($patient) {
        $query = $this->db->get_where('payment', array('patient' => $patient))->result();
        $deposits = $this->db->get_where('patient_deposit', array('patient' => $patient))->result();
        $balance = array();
        $deposit_balance = array();
        foreach ($query as $gross) {
            $balance[] = $gross->gross_total;
        }
        $balance = array_sum($balance);


        foreach ($deposits as $deposit) {
            $deposit_balance[] = $deposit->deposited_amount;
        }
        $deposit_balance = array_sum($deposit_balance);



        $bill_balance = $balance;

        return $due_balance = $bill_balance - $deposit_balance;
    }

    function getPatientInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');

            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }

        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }
        return $data;
    }

    function getPatientinfoWithAddNewOption($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            $this->db->where("name like '%" . $searchTerm . "%' ");
            $this->db->or_where("id like '%" . $searchTerm . "%' ");
            $this->db->or_where("phone like '%" . $searchTerm . "%' ");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');

            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }

        $data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ' : '.lang('phone').': '.$user['phone'].')');
        }
        return $data;
    }
    function insertVitalSign($data) {
        
        $this->db->insert('vital_signs', $data);
    }
    function updateVitalSign($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('vital_signs', $data);
    }
    function getVitalSignByPatientId($id) {
       
        $this->db->where('patient_id', $id);
        $query = $this->db->get('vital_signs');
        return $query->result();
    }
    function getVitalSignById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('vital_signs');
        return $query->row();
    }
    function deleteVitalSign($id) {
        $this->db->where('id', $id);
        $this->db->delete('vital_signs');
    }
    function getPatientInfoId($searchTerm) {
        if (!empty($searchTerm)) {
            $this->db->select('*');
            
            $this->db->where("name like '%" . $searchTerm . "%' OR id like '%" . $searchTerm . "%'");
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        } else {
            $this->db->select('*');
          
            $this->db->limit(10);
            $fetched_records = $this->db->get('patient');
            $users = $fetched_records->result_array();
        }
        // Initialize Array with fetched data
        $data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" =>  lang('id') . ': ' . $user['id']);
        }
      
        return $data;
    }
    function getOdontogram($pid) {
        $this->db->where('patient_id',$pid);
        $query = $this->db->get('odontogram')->row();
        
        if(!empty($query)) {
          return $query;
        } else {
            $value = array('patient_id' => $pid, 'Tooth1' => 'white', 'Tooth2' => 'white', 'Tooth3' => 'white', 
                'Tooth4' => 'white', 'Tooth5' => 'white', 'Tooth6' => 'white', 'Tooth7' => 'white', 'Tooth8' => 'white', 'Tooth1' => 'white', 
                'Tooth9' => 'white', 'Tooth10' => 'white', 'Tooth11' => 'white', 'Tooth12' => 'white', 
                'Tooth13' => 'white', 'Tooth14' => 'white', 'Tooth15' => 'white', 'Tooth16' => 'white', 'Tooth17' => 'white', 
                'Tooth18' => 'white', 'Tooth19' => 'white', 'Tooth20' => 'white', 
                'Tooth21' => 'white', 'Tooth22' => 'white', 'Tooth23' => 'white', 'Tooth24' => 'white',
                'Tooth25' => 'white', 'Tooth26' => 'white', 'Tooth27' => 'white', 'Tooth28' => 'white',
                'Tooth29' => 'white', 'Tooth30' => 'white', 'Tooth31' => 'white', 'Tooth32' => 'white',
                'description' => ''
            );
            $this->db->insert('odontogram',$value);
            $this->db->where('patient_id',$pid);
            $query = $this->db->get('odontogram')->row();
            return $query;
        }
    }
    function odontogram($pid,$value) {
        $this->db->where('patient_id',$pid);
        $this->db->update('odontogram',$value);
    }


}
