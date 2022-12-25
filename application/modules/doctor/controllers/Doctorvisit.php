<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Doctorvisit extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('doctorvisit_model');
        $this->load->model('doctor/doctor_model');
       

        
        if ($this->ion_auth->in_group(array('pharmacist', 'Accountant', 'Doctor', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {

            redirect('home/permission');
        }
    }

    public function index() {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('doctorvisit/doctor_visit', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('doctorvisit/add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        //$name = $this->input->post('name');
        $visit_description = $this->input->post('visit_description');
        $visit_charges = $this->input->post('visit_charges');
        $status = $this->input->post('status');
        $doctor = $this->input->post('doctor');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('visit_description', 'Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        // $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        //  $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        // $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
        // Validating Phone Field           
        // $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("doctorvisit/doctorvisit/editDoctorvisit?id=" . $id);
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('doctorvisit/add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {


            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $doctor_name = $this->doctor_model->getDoctorById($doctor)->name;
            $data = array(
                'doctor_id' => $doctor,
                'doctor_name' => $doctor_name,
                'visit_description' => $visit_description,
                'visit_charges' => $visit_charges,
                'status' => $status
            );


            ///   $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Doctorvisit
                $this->doctorvisit_model->insertDoctorvisit($data);
                 $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Doctorvisit
                $this->doctorvisit_model->updateDoctorvisit($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('doctor/doctorvisit');
        }
    }

    function getDoctorvisit() {
        $data['doctorvisits'] = $this->doctorvisit_model->getDoctorvisit();
        $this->load->view('doctorvisit/doctor_visit', $data);
    }

    function editDoctorvisit() {
        $data = array();
        $id = $this->input->get('id');
        $data['doctorvisit'] = $this->doctorvisit_model->getDoctorvisitById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('doctorvisit/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDoctorvisitByJason() {
        $id = $this->input->get('id');
        $data['doctorvisit'] = $this->doctorvisit_model->getDoctorvisitById($id);
        $data['doctor']= $this->doctor_model->getDoctorById($data['doctorvisit']->doctor_id);
        echo json_encode($data);
    }

    function delete() {

        $id = $this->input->get('id');

        $this->doctorvisit_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('doctor/doctorvisit');
    }

    function getDoctorvisitList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "phone",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['doctorvisits'] = $this->doctorvisit_model->getDoctorvisitBysearch($search, $order, $dir);
            } else {
                $data['doctorvisits'] = $this->doctorvisit_model->getDoctorvisitWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['doctorvisits'] = $this->doctorvisit_model->getDoctorvisitByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['doctorvisits'] = $this->doctorvisit_model->getDoctorvisitByLimit($limit, $start, $order, $dir);
            }
        }
       
        $options1 = '';

        $options5 = '';

        $i = 1;
        foreach ($data['doctorvisits'] as $doctorvisit) {

            if ($this->ion_auth->in_group(array('admin'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $doctorvisit->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="doctor/doctorvisit/delete?id=' . $doctorvisit->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $status = '';
            if ($doctorvisit->status == 'active') {
                $status = lang('active');
            } else {
                $status = lang('in_active');
            }
            $doctor = $this->doctor_model->getDoctorById($doctorvisit->doctor_id);
            if (empty($doctor)) {
                $doctor_name = $doctorvisit->doctor_name;
            } else {
                $doctor_name = $doctor->name;
            }
            $settings = $this->settings_model->getSettings();
            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $i,
                    $doctor_name,
                    $doctorvisit->visit_description,
                    $settings->currency . ' ' . $doctorvisit->visit_charges,
                    $status,
                    $options1 . ' ' . $options5,
                        //  $options2
                );
                $i = $i + 1;
            }
        }

        if (!empty($data['doctorvisits'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['doctorvisits']),
                "recordsFiltered" => count($data['doctorvisits']),
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

}

/* End of file doctorvisit.php */
/* Location: ./application/modules/doctorvisit/controllers/doctorvisit.php */
