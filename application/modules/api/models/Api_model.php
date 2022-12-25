<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_model {
    
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    function apiGetProfileById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->result();
    }
    
    function getUsersGroups($id) {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users_groups');
        return $query;
    }

    function getGroups($group_id) {
        $this->db->where('id', $group_id);
        $query = $this->db->get('groups');
        return $query;
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
    
    function updateProfile($id, $data, $group_name) {
        $this->db->where('ion_user_id', $id);
        $this->db->update($group_name, $data);
    }
    
    function getDonor() {
        $query = $this->db->get('donor');
        return $query->result();
    }
    
    function getBloodBank() {
        $query = $this->db->get('bankb');
        return $query->result();
    }
    
    function getReportById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('report');
        return $query->row();
    }
    
    function getReport() {
        $query = $this->db->get('report');
        return $query->result();
    }
    
    function deleteReport($id) {
        $this->db->where('id', $id);
        $this->db->delete('report');
    }
    
    function getDonorById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('donor');
        return $query->row();
    }
    
    function getManualEmailTemplateById($id, $type) {
        $this->db->where('id', $id);
        $this->db->where('type', $type);
        $query = $this->db->get('manual_email_template');
        return $query->row();
    }
    
    function getManualEmailShortcodeTag($type) {
        $this->db->order_by('id', 'desc');
        $this->db->where('type', $type);
        $query = $this->db->get('manualemailshortcode');
        return $query->result();
    }
    
    function getPatientMaterialByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_material');
        return $query->result();
    }
    
    function getEmailSettings() {
        $query = $this->db->get('email_settings');
        return $query->row();
    }
    
    function updateManualEmailTemplate($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('manual_email_template', $data);
    }
    
    function addManualEmailTemplate($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('manual_email_template', $data2);
    }
    
    function getMedicalHistoryByPatientId($id) {
        $this->db->where('patient_id', $id);
        $query = $this->db->get('medical_history');
        return $query->result();
    }
    
    function getPatient() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('patient');
        return $query->result();
    }
    
    function getDoctor() {
        $query = $this->db->get('doctor');
        return $query->result();
    }
    
    function getPrescriptionByPatientId($patient_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient_id);
        $query = $this->db->get('prescription');
        return $query->result();
    }
    
    function getReportByType($type) {
        $this->db->where('report_type', $type);
        $query = $this->db->get('report');
        return $query->result();
    }
    
    function insertReport($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('report', $data2);
    }
    
    function updateReport($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('report', $data);
    }
    
    
    
    function getSettings() {
        $query = $this->db->get('settings');
        return $query->row();
    }
    
    function getLabCategory() {
        $query = $this->db->get('lab_category');
        return $query->result();
    }
    
    function updatePayment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('payment', $data);
    }
    
    function updateDeposit($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient_deposit', $data);
    }
    
    function insertDeposit($data) {
        //$data1 = array('hospital_id' => $hospitalID);
       // $data2 = array_merge($data, $data1);
        $this->db->insert('patient_deposit', $data);
    }
    
    function getDepositById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient_deposit');
        return $query->row();
    }
    
    function getLabById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('lab');
        return $query->row();
    }
    
    function deleteLab($id) {
        $this->db->where('id', $id);
        $this->db->delete('lab');
    }
    
    function getLab() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('lab');
        return $query->result();
    }
    
    function insertAppointment($data) {
        // $data2 = array_merge($data, $data1);
        $this->db->insert('appointment', $data);
    }
    
    function getAppointmentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }
    
    function getAppointmentByIdOnly($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('appointment');
        return $query->row();
    }
    
    function updateAppointment($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('appointment', $data);
    }
    
    function updatePatient($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('patient', $data);
    }
    
    function getPatientById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }
    
    function insertEmail($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('email', $data2);
    }
    
    function insertPatient($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient', $data2);
    }
    
    function getDoctorById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('doctor');
        return $query->row();
    }
    
    function getPrescriptionById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('prescription');
        return $query->row();
    }
    
    function getMedicalHistoryById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medical_history');
        return $query->row();
    }
    
    function deleteMedicalHistory($id) {
        $this->db->where('id', $id);
        $this->db->delete('medical_history');
    }
    
    function deletePrescription($id) {
        $this->db->where('id', $id);
        $this->db->delete('prescription');
    }
    
    function getMedicalHistory() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('medical_history');
        return $query->result();
    }
    
    function insertLab($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('lab', $data2);
    }
    
    function insertPrescription($data) {
        // $data2 = array_merge($data, $data1);
        $this->db->insert('prescription', $data);
    }
    
    function updatePrescription($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('prescription', $data);
    }
    
    function updateLab($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('lab', $data);
    }
    
    function getTemplate() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('template');
        return $query->result();
    }
    
    function insertTemplate($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('template', $data2);
    }
    
      function updateTemplate($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('template', $data);
    }
    
    function deletetemplate($id) {
        $this->db->where('id', $id);
        $this->db->delete('template');
    }
    
    function getTemplateById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('template');
        return $query->row();
    }
    
     function insertPatientMaterial($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('patient_material', $data2);
    }
    
    function getPaymentById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('payment');
        return $query->row();
    }
    
    function getDiscountType() {
        $query = $this->db->get('settings');
        return $query->row()->discount;
    }
    
     function getDoctorByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('doctor');
        return $query->row();
    }
    
    function getAppointmentByDoctorByToday($doctor_id) {
        $today = strtotime(date('Y-m-d'));
        $this->db->where('doctor', $doctor_id);
        $this->db->where('date', $today);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointmentByDoctor($doctor) {
        $this->db->order_by('id', 'desc');
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getPrescriptionByDoctorId($doctor_id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('doctor', $doctor_id);
        $query = $this->db->get('prescription');
        return $query->result();
    }
    
    function getHolidaysByDoctor($id) {
        $this->db->order_by('id', 'asc');
        $this->db->where('doctor', $id);
        $query = $this->db->get('holidays');
        return $query->result();
    }
    
    function getScheduleByDoctor($doctor) {
        $this->db->where('doctor', $doctor);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }
    
     function getMedicine() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('medicine');
        return $query->result();
    }
    
    function getScheduleByDoctorByWeekday($doctor, $weekday) {
        $this->db->where('doctor', $doctor);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }
    
    function getScheduleByDoctorByWeekdayById($doctor, $weekday, $id) {
        $this->db->where_not_in('id', $id);
        $this->db->where('doctor', $doctor);
        $this->db->where('weekday', $weekday);
        $query = $this->db->get('time_schedule');
        return $query->result();
    }
    
    function updateSchedule($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('time_schedule', $data);
    }
    
    function insertTimeSlot($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('time_slot', $data2);
    }
    
    function insertSchedule($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('time_schedule', $data2);
    }
    
    function getHolidayByDoctorByDate($doctor, $date) {
        $this->db->where('doctor', $doctor);
        $this->db->where('date', $date);
        $query = $this->db->get('holidays');
        return $query->row();
    }
    
    function insertHoliday($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('holidays', $data2);
    }
    
    function updateTimeSlot($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('time_slot', $data);
    }
    
    function getLimit() {
        $current = $this->db->get_where('patient', array('hospital_id' => $hospitalID))->num_rows();
        $limit = $this->db->get_where('hospital', array('id' => $hospitalID))->row()->p_limit;
        if (!is_numeric($limit)) {
            $limit = 0;
        }
        return $limit - $current;
    }
    
    function insertDoctor($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('doctor', $data2);
    }
    
    function updateDoctor($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('doctor', $data);
    }
    
    function addHospitalIdToIonUser($ion_user_id) {
        $hospital_ion_id = $this->db->get_where('hospital', array('id' => $hospital_id))->row()->ion_user_id;
        $uptade_ion_user = array(
            'hospital_ion_id' => $hospital_ion_id,
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }
    
    function getAutoSmsByType($type) {
        $this->db->where('type', $type);
        $query = $this->db->get('autosmstemplate');
        return $query->row();
    }
    
     function getSmsSettingsByGatewayName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('sms_settings');
        return $query->row();
    }
    
    function getPaymentByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    function getDepositByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }
    
    function getDepositByPatientIdByDate($id, $date_from, $date_to) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $this->db->where('date >=', $date_from);
        $this->db->where('date <=', $date_to);
        $query = $this->db->get('patient_deposit');
        return $query->result();
    }
    
    function getPaymentByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('payment');
        return $query->result();
    }
    
    function getOtPaymentByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('ot_payment');
        return $query->result();
    }
    
    function getPharmacyPaymentByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('pharmacy_payment');
        return $query->result();
    }
    
    function getGatewayByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('paymentGateway')->row();
        return $query;
    }
    
    function getAutoEmailByType($type) {
        $this->db->where('type', $type);
        $query = $this->db->get('autoemailtemplate');
        return $query->row();
    }
    
    function getPatientByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('patient');
        return $query->row();
    }
    
    function insertMedicalHistory($data) {
        $data2 = array_merge($data, $data1);
        $this->db->insert('medical_history', $data2);
    }
    
    function updateMedicalHistory($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('medical_history', $data);
    }
    
    function getAppointmentByPatient($patient) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $patient);
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointmentForCalendar() {
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getLabByPatientId($id) {
        $this->db->order_by('id', 'desc');
        $this->db->where('patient', $id);
        $query = $this->db->get('lab');
        return $query->result();
    }
    
    function getBedAllotmentsByPatientId($id) {
        $this->db->where('patient', $id);
        $query = $this->db->get('alloted_bed');
        return $query->result();
    }
    
    function getAvailableSlotByDoctorByDateByAppointmentId($date, $doctor, $appointment_id) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('doctor', $doctor);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {

            $this->db->where('date', $date);
            $this->db->where('doctor', $doctor);
            $query = $this->db->get('appointment')->result();

            $this->db->where('doctor', $doctor);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    if ($bookedTime->id != $appointment_id) {
                        $bookedTimeSlot[] = $bookedTime->time_slot;
                    }
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }
    
    function getAppointmentListByDoctor($doctor) {
        $this->db->where('doctor', $doctor);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAppointment() {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('appointment');
        return $query->result();
    }
    
    function getAvailableSlotByDoctorByDate($date, $doctor) {
        //$newDate = date("m-d-Y", strtotime($date));
        $weekday = strftime("%A", $date);

        $this->db->where('date', $date);
        $this->db->where('doctor', $doctor);
        $holiday = $this->db->get('holidays')->result();

        if (empty($holiday)) {
            $this->db->where('date', $date);
            $this->db->where('doctor', $doctor);
            $query = $this->db->get('appointment')->result();


            $this->db->where('doctor', $doctor);
            $this->db->where('weekday', $weekday);
            $this->db->order_by('s_time_key', 'asc');
            $query1 = $this->db->get('time_slot')->result();

            $availabletimeSlot = array();
            $bookedTimeSlot = array();

            foreach ($query1 as $timeslot) {
                $availabletimeSlot[] = $timeslot->s_time . ' To ' . $timeslot->e_time;
            }
            foreach ($query as $bookedTime) {
                if ($bookedTime->status != 'Cancelled') {
                    $bookedTimeSlot[] = $bookedTime->time_slot;
                }
            }

            $availableSlot = array_diff($availabletimeSlot, $bookedTimeSlot);
        } else {
            $availableSlot = array();
        }

        return $availableSlot;
    }
    
    
    function getPatientinfoWithAddNewOption($searchTerm) {
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
        /*$data = array();
        $data[] = array("id" => 'add_new', "text" => lang('add_new'));
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }*/
        return $users;
    }
    
     function getDoctorInfo($searchTerm) {
        if (!empty($searchTerm)) {
            $query = $this->db->select('*')
                    ->from('doctor')
                    ->where("(id LIKE '%" . $searchTerm . "%' OR name LIKE '%" . $searchTerm . "%')", NULL, FALSE)
                    ->get();
            $users = $query->result_array();
        } else {
            $this->db->select('*');
            $this->db->limit(10);
            $fetched_records = $this->db->get('doctor');
            $users = $fetched_records->result_array();
        }


        /*if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $this->db->select('*');
            $this->db->where('hospital_id', $hospitalID);
            $this->db->where('ion_user_id', $doctor_ion_id);
            $fetched_records = $this->db->get('doctor');
            $users = $fetched_records->result_array();
        }*/


        // Initialize Array with fetched data
        /*$data = array();
        foreach ($users as $user) {
            $data[] = array("id" => $user['id'], "text" => $user['name'] . ' (' . lang('id') . ': ' . $user['id'] . ')');
        }*/
        return $users;
    }
    
    function getMedicineById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('medicine');
        return $query->row();
    }
    
    function getMedicineBySearch($search) {
        $this->db->order_by('id', 'desc');
        $query = $this->db->select('*')
                ->from('medicine')
                ->where("(id LIKE '%" . $search . "%' OR category LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR e_date LIKE '%" . $search . "%'OR generic LIKE '%" . $search . "%'OR company LIKE '%" . $search . "%'OR effects LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        return $query->result();
    }
    
    // aurnab edits
    
    function getDepartment( ) {
        // $this->db->where('hospital_id', $hospitalId);
       
        $query = $this->db->get('department');
        return $query->result();
    }
    
    function getDoctorByDepartmentname($department) {
        // $this->db->where('hospital_id', $hospitalId);
        $query =  $this->db->select('*')
                    ->from('doctor')
                    ->where('department', $department)
                    ->get();;
        return $query->result();
    }
}