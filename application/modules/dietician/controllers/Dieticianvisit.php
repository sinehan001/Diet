<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dieticianvisit extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('dieticianvisit_model');
        $this->load->model('dietician/dietician_model');
       

        
        if (!$this->ion_auth->in_group(array('pharmacist', 'admin', 'Accountant', 'Doctor','Dietician', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {

            redirect('home/permission');
        }
    }

    public function index() {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('dieticianvisit/dietician_visit', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('dieticianvisit/add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $id = $this->input->post('id');
        //$name = $this->input->post('name');
        $visit_description = $this->input->post('visit_description');
        $visit_charges = $this->input->post('visit_charges');
        $status = $this->input->post('status');
        $dietician = $this->input->post('dietician');

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
                redirect("dieticianvisit/dieticianvisit/editDieticianvisit?id=" . $id);
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('dieticianvisit/add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {


            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $dietician_name = $this->dietician_model->getDieticianById($dietician)->name;
            $data = array(
                'dietician_id' => $dietician,
                'dietician_name' => $dietician_name,
                'visit_description' => $visit_description,
                'visit_charges' => $visit_charges,
                'status' => $status
            );


            ///   $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Dieticianvisit
                $this->dieticianvisit_model->insertDieticianvisit($data);
                 $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Dieticianvisit
                $this->dieticianvisit_model->updateDieticianvisit($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('dietician/dieticianvisit');
        }
    }

    function getDieticianvisit() {
        $data['dieticianvisits'] = $this->dieticianvisit_model->getDieticianvisit();
        $this->load->view('dieticianvisit/dietician_visit', $data);
    }

    function editDieticianvisit() {
        $data = array();
        $id = $this->input->get('id');
        $data['dieticianvisit'] = $this->dieticianvisit_model->getDieticianvisitById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('dieticianvisit/add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDieticianvisitByJason() {
        $id = $this->input->get('id');
        $data['dieticianvisit'] = $this->dieticianvisit_model->getDieticianvisitById($id);
        $data['dietician']= $this->dietician_model->getDieticianById($data['dieticianvisit']->dietician_id);
        echo json_encode($data);
    }

    function delete() {

        $id = $this->input->get('id');

        $this->dieticianvisit_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('dietician/dieticianvisit');
    }

    function getDieticianvisitList() {
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
                $data['dieticianvisits'] = $this->dieticianvisit_model->getDieticianvisitBysearch($search, $order, $dir);
            } else {
                $data['dieticianvisits'] = $this->dieticianvisit_model->getDieticianvisitWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['dieticianvisits'] = $this->dieticianvisit_model->getDieticianvisitByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['dieticianvisits'] = $this->dieticianvisit_model->getDieticianvisitByLimit($limit, $start, $order, $dir);
            }
        }
       
        $options1 = '';

        $options5 = '';

        $i = 1;
        foreach ($data['dieticianvisits'] as $dieticianvisit) {

            if ($this->ion_auth->in_group(array('admin'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $dieticianvisit->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="dietician/dieticianvisit/delete?id=' . $dieticianvisit->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }

            $status = '';
            if ($dieticianvisit->status == 'active') {
                $status = lang('active');
            } else {
                $status = lang('in_active');
            }
            $dietician = $this->dietician_model->getDieticianById($dieticianvisit->dietician_id);
            if (empty($dietician)) {
                $dietician_name = $dieticianvisit->dietician_name;
            } else {
                $dietician_name = $dietician->name;
            }
            $settings = $this->settings_model->getSettings();
            if ($this->ion_auth->in_group(array('admin'))) {
                $info[] = array(
                    $i,
                    $dietician_name,
                    $dieticianvisit->visit_description,
                    $settings->currency . ' ' . $dieticianvisit->visit_charges,
                    $status,
                    $options1 . ' ' . $options5,
                        //  $options2
                );
                $i = $i + 1;
            }
            if ($this->ion_auth->in_group(array('Dietician'))) {
                $info[] = array(
                    $i,
                    $dietician_name,
                    $dieticianvisit->visit_description,
                    $settings->currency . ' ' . $dieticianvisit->visit_charges,
                    $status
                );
                $i = $i + 1;
            }
        }

        if (!empty($data['dieticianvisits'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['dieticianvisits']),
                "recordsFiltered" => count($data['dieticianvisits']),
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

/* End of file dieticianvisit.php */
/* Location: ./application/modules/dieticianvisit/controllers/dieticianvisit.php */
