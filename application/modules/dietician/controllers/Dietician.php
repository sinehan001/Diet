<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dietician extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('dietician_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('patient/patient_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('schedule/schedule_model');
        $this->load->model('dietician/dieticianvisit_model');
        $this->load->module('patient');
        $this->load->module('sms');
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor','Dietician', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        $data['dietician'] = $this->dietician_model->getDietician();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('dietician', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $data = array();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $visit_price = $this->input->post('visit_price');
        $profile = $this->input->post('profile');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        if (empty($id)) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        }
        // Validating Email Field
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
        // Validating Phone Field           
        $this->form_validation->set_rules('profile', 'Profile', 'trim|required|min_length[1]|max_length[50]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['dietician'] = $this->dietician_model->getDieticianById($id);
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the footer file
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "1768",
                'max_width' => "2024"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'profile' => $profile,
                    'visit_price'=>$visit_price,
                    'appointment_confirmation' => 'Active',
                    

                );
            } else {
               
                $data = array();
                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'profile' => $profile,
                    'visit_price'=>$visit_price,
                    'appointment_confirmation' => 'Active',
                    
                );
            }
            $data_visit=array(
                'dietician_name' => $name,
                'visit_description' => 'Visit Price',
                'visit_charges' => $visit_price,
                'status' => 'active'
            );
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New Dietician
                if ($this->ion_auth->email_check($email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    redirect('dietician/addNewView');
                } else {
                    $dfg = 4;
                    $this->ion_auth->register($username, $password, $email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $email))->row()->id;
                    $this->dietician_model->insertDietician($data);
                    $inserted_id=$this->db->insert_id();
                    $data_visit['dietician_id']=$inserted_id;
                    $this->dieticianvisit_model->insertDieticianvisit($data_visit);
                    $inserted_id_dietician=$this->db->insert_id('dietician_visit');
                    $dietician_user_id = $this->db->get_where('dietician', array('email' => $email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id,'dietician_visit'=>$inserted_id_dietician);
                    $this->dietician_model->updateDietician($dietician_user_id, $id_info);

                    //sms
                    $set['settings'] = $this->settings_model->getSettings();
                    $autosms = $this->sms_model->getAutoSmsByType('dietician');
                    $message = $autosms->message;
                    $to = $phone;
                    $name1 = explode(' ', $name);
                    if (!isset($name1[1])) {
                        $name1[1] = null;
                    }
                    $data1 = array(
                        'firstname' => $name1[0],
                        'lastname' => $name1[1],
                        'name' => $name,
                        'company' => $set['settings']->system_vendor
                    );

                    if ($autosms->status == 'Active') {
                        $messageprint = $this->parser->parse_string($message, $data1);
                        $data2[] = array($to => $messageprint);
                        $this->sms->sendSms($to, $message, $data2);
                    }
                    //end
                    //email

                    $autoemail = $this->email_model->getAutoEmailByType('dietician');
                    if ($autoemail->status == 'Active') {
                        $mail_provider = $this->settings_model->getSettings()->emailtype;
                        $settngs_name = $this->settings_model->getSettings()->system_vendor;
                        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);

                        $this->load->library('encryption');

                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($email);
                        $this->email->subject('Registration confirmation');
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }

                    //end


                    $this->session->set_flashdata('feedback', lang('added'));
                }
            } else { // Updating Dietician
                $ion_user_id = $this->db->get_where('dietician', array('id' => $id))->row()->ion_user_id;
                $dietician_details = $this->db->get_where('dietician', array('id' => $id))->row();
                if (empty($password)) {
                    $password = $this->db->get_where('users', array('id' => $ion_user_id))->row()->password;
                } else {
                    $password = $this->ion_auth_model->hash_password($password);
                }
                $this->dieticianvisit_model->updateDieticianvisit($dietician_details->dietician_visit,$data_visit);
                $this->dietician_model->updateIonUser($username, $email, $password, $ion_user_id);
                $this->dietician_model->updateDietician($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('dietician');
        }
    }

    function editDietician() {
        $data = array();
        $id = $this->input->get('id');
        $data['dietician'] = $this->dietician_model->getDieticianById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function details() {

        $data = array();

        if ($this->ion_auth->in_group(array('Dietician'))) {
            $dietician_ion_id = $this->ion_auth->get_user_id();
            $id = $this->dietician_model->getDieticianByIonUserId($dietician_ion_id)->id;
        } else {
            redirect('home');
        }


        $data['dietician'] = $this->dietician_model->getDieticianById($id);
        $data['todays_appointments'] = $this->appointment_model->getAppointmentByDieticianByToday($id);
        $data['appointments'] = $this->appointment_model->getAppointmentByDietician($id);
        $data['patients'] = $this->patient_model->getPatient();
        $data['appointment_patients'] = $this->patient->getPatientByAppointmentByDieticianId($id);
        $data['dieticians'] = $this->dietician_model->getDietician();
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByDieticianId($id);
        $data['holidays'] = $this->schedule_model->getHolidaysByDietician($id);
        $data['schedules'] = $this->schedule_model->getScheduleByDietician($id);



        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('details', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDieticianByJason() {
        $id = $this->input->get('id');
        $data['dietician'] = $this->dietician_model->getDieticianById($id);
        echo json_encode($data);
    }

    function delete() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('dietician', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->dietician_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('dietician');
    }

    function getDietician() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
            "3" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['dieticians'] = $this->dietician_model->getDieticianBysearch($search, $order, $dir);
            } else {
                $data['dieticians'] = $this->dietician_model->getDieticianWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['dieticians'] = $this->dietician_model->getDieticianByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['dieticians'] = $this->dietician_model->getDieticianByLimit($limit, $start, $order, $dir);
            }
        }
       

        foreach ($data['dieticians'] as $dietician) {
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
              
            }
            $options2 = '<a class="btn btn-info btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByDieticianId?id=' . $dietician->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="dietician/delete?id=' . $dietician->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options4 = '<a href="schedule/holidays?dietician=' . $dietician->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?dietician=' . $dietician->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-info btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }
            
 
            $info[] = array(
                $dietician->id,
                $dietician->name,
                $dietician->email,
                $dietician->phone,
               
                $dietician->profile,
            
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options5 . ' ' . $options3,
                   
            );
        }

        if (!empty($data['dieticians'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('dietician')->num_rows(),
                "recordsFiltered" => $this->db->get('dietician')->num_rows(),
                "data" => $info
            );
        } else {
            $output = array(
                
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    public function getDieticianInfo() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->dietician_model->getDieticianInfo($searchTerm);

        echo json_encode($response);
    }

    public function getDieticianWithAddNewOption() {
// Search term
        $searchTerm = $this->input->post('searchTerm');

// Get users
        $response = $this->dietician_model->getDieticianWithAddNewOption($searchTerm);

        echo json_encode($response);
    }
    function getDieticianByDepartment() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        $department = $this->input->post("id");
        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "email",
            "3" => "phone",
            "4" => "department",
            "5" => "profile", 
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['dieticians'] = $this->dietician_model->getDieticianBysearchByDepartment($search, $order, $dir,$department);
            } else {
                $data['dieticians'] = $this->dietician_model->getDieticianWithoutSearchByDepartment($order, $dir,$department);
            }
        } else {
            if (!empty($search)) {
                $data['dieticians'] = $this->dietician_model->getDieticianByLimitBySearchByDepartment($limit, $start, $search, $order, $dir,$department);
            } else {
                $data['dieticians'] = $this->dietician_model->getDieticianByLimitByDepartment($limit, $start, $order, $dir,$department);
            }
        }


        $i = 0;
        foreach ($data['dieticians'] as $dietician) {
            $i = $i + 1;
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options1 = '<a type="button" class="btn btn-info btn-xs btn_width editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }
            $options2 = '<a class="btn btn-info btn-xs detailsbutton" title="' . lang('appointments') . '"  href="appointment/getAppointmentByDieticianId?id=' . $dietician->id . '"> <i class="fa fa-calendar"> </i> ' . lang('appointments') . '</a>';
            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options3 = '<a class="btn btn-info btn-xs btn_width delete_button" title="' . lang('delete') . '" href="dietician/delete?id=' . $dietician->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('delete') . '</a>';
            }



            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options4 = '<a href="schedule/holidays?dietician=' . $dietician->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-book"></i> ' . lang('holiday') . '</a>';
                $options5 = '<a href="schedule/timeSchedule?dietician=' . $dietician->id . '" class="btn btn-info btn-xs btn_width" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-book"></i> ' . lang('time_schedule') . '</a>';
                $options6 = '<a type="button" class="btn btn-info btn-xs btn_width detailsbutton inffo" title="' . lang('info') . '" data-toggle="modal" data-id="' . $dietician->id . '"><i class="fa fa-info"> </i> ' . lang('info') . '</a>';
            }
            $department_details=$this->department_model->getDepartmentById($dietician->department);
            if(!empty($department_details)){
                $depart=$department_details->name;
            }else{
                $depart=$dietician->department_name;
            }
            $info[] = array(
                $dietician->id,
                $dietician->name,
                $dietician->email,
                $dietician->phone,
                $depart,
                $dietician->profile,
                $options6 . ' ' . $options1 . ' ' . $options2 . ' ' . $options4 . ' ' . $options5 . ' ' . $options3,
            );
        }

        if (!empty($data['dieticians'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->db->get_where('dietician',array('department'=>$department))->result()),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }
   
        
    public function getDieticianVisit() {
        $id = $this->input->get('id');
       // $description = $this->input->get('description');
        $visits = $this->dietician_model->getDieticianVisitByDieticianId($id);
        $option = '<option>' . lang('select') . '</option>';
        foreach ($visits as $visit) {
           
                $option .= '<option value="' . $visit->id . '">' . $visit->visit_description . '</option>';
            
        }
        $data['response'] = $option;
        echo json_encode($data);
    }
    public function getDieticianVisitForEdit() {
        $id = $this->input->get('id');
        $description = $this->input->get('description');
        $visits = $this->dietician_model->getDieticianVisitByDieticianId($id);
        $option = '<option>' . lang('select') . '</option>';
        foreach ($visits as $visit) {
            if($visit->id == $description){
              $option .= '<option value="' . $visit->id . '" selected>' . $visit->visit_description . '</option>';
            }else{
                $option .= '<option value="' . $visit->id . '">' . $visit->visit_description . '</option>';
            }
        }
        $data['response'] = $option;
        echo json_encode($data);
    }
    public function getDieticianVisitCharges() {
        $id = $this->input->get('id');
        $data['response'] = $this->dieticianvisit_model->getDieticianvisitById($id);


        echo json_encode($data);
    }

}

/* End of file dietician.php */
/* Location: ./application/modules/dietician/controllers/dietician.php */