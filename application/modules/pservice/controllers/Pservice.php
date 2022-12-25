<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pservice extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pservice_model');
       
        if ($this->ion_auth->in_group(array('Laboratorist', 'Receptionist', 'Patient', 'pharmacist'))) {

            redirect('home/permission');
        }
    }

    public function index() {

        if (!$this->ion_auth->in_group(array('admin'))) {

            redirect('home/permission');
        }
        $data['pservices'] = $this->pservice_model->getPservice();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('pservice', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {

        if (!$this->ion_auth->in_group(array('admin'))) {

            redirect('home/permission');
        }
        $data['pservice'] = ' ';
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {

        $active = $this->input->post('active');
        if (empty($active)) {
            $active = '0';
        } else {
            $active = '1';
        }
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $code = $this->input->post('code');
        $alpha_code = $this->input->post('alpha_code');

        $price = $this->input->post('price');
       
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating date Field
        $this->form_validation->set_rules('price', 'Price', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("pservice/editPservice?id=$id");
            } else {
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new');
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'name' => $name,
                'code' => $code,
                'alpha_code' => $alpha_code,
                'price' => $price,
                'active' => $active
            );



            if (empty($id)) {     // Adding New Pservice
                $this->pservice_model->insertPservice($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating Pservice
                $this->pservice_model->updatePservice($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('pservice');
        }
    }

    function getPservice() {
        $data['pservices'] = $this->pservice_model->getPservice();
        $this->load->view('pservice', $data);
    }

    function editPservice() {

        if (!$this->ion_auth->in_group(array('admin'))) {

            redirect('home/permission');
        }
        $data = array();
        $id = $this->input->get('id');
        $data['pservice'] = $this->pservice_model->getPserviceById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPserviceByJason() {

        if (!$this->ion_auth->in_group(array('admin'))) {

            redirect('home/permission');
        }
        $id = $this->input->get('id');
        $data['pservice'] = $this->pservice_model->getPserviceById($id);
        echo json_encode($data);
    }

    function delete() {

        if (!$this->ion_auth->in_group(array('admin'))) {

            redirect('home/permission');
        }
        $data = array();
        $id = $this->input->get('id');
        $this->pservice_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('pservice');
    }

    function getPserviceList() {


        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];
        if ($limit == -1) {
            if (!empty($search)) {
                $data['pservices'] = $this->pservice_model->getPserviceBysearch($search);
            } else {
                $data['pservices'] = $this->pservice_model->getPservice();
            }
        } else {
            if (!empty($search)) {
                $data['pservices'] = $this->pservice_model->getPserviceByLimitBySearch($limit, $start, $search);
            } else {
                $data['pservices'] = $this->pservice_model->getPserviceByLimit($limit, $start);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
      
        foreach ($data['pservices'] as $pservice) {
            $i = $i + 1;
            $option2 = '';
            $option1 = '';
            if ($this->ion_auth->in_group(array('admin')) || $permis == 'ok') {

                $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $pservice->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';
            }

            if ($this->ion_auth->in_group(array('admin')) || $permis_2 == 'ok') {
                $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="pservice/delete?id=' . $pservice->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            }
            if (!empty($pservice->price)) {
                $price = $pservice->price;
            } else {
                $price = '0';
            }
            if (!empty($pservice->referential_price)) {
                $referential_price = $pservice->referential_price;
            } else {
                $referential_price = '0';
            }
            if (!empty($pservice->special_price)) {
                $special_price = $pservice->special_price;
            } else {
                $special_price = '0';
            }
            if ($pservice->active == "1") {
                $active = lang('yes');
            } else {
                $active = lang('no');
            }


            $info[] = array(
                $i,
                $pservice->code,
                $pservice->alpha_code,
                $pservice->name,
                $price,
                $active,
                $option1 . ' ' . $option2
            );
        }

        if (!empty($data['pservices'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" =>count($data['pservices']),
                "recordsFiltered" => count($data['pservices']),
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

/* End of file pservice.php */
/* Location: ./application/modules/pservice/controllers/pservice.php */
