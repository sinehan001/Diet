<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Service extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('service_model');
        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');  
        }
    }

    public function index() {

        $data['services'] = $this->service_model->getService();
        $this->load->view('home/dashboard'); 
        $this->load->view('service', $data);
        $this->load->view('home/footer'); 
    }

    public function addNewView() {
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new');
        $this->load->view('home/footer'); 
    }

    public function addNew() {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
       
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("service/editService?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); 
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); 
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
                'max_size' => "20480000",
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'title' => $title,
                    'description' => $description,
                );
            } else {
             
                $data = array();
                $data = array(
                    'title' => $title,
                    'description' => $description,
                );
            }

            if (empty($id)) {    
                    $this->service_model->insertService($data);
                    $this->session->set_flashdata('feedback', lang('added'));
                
            } else {
                $this->service_model->updateService($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
          
            redirect('service');
        }
    }

    function getService() {
        $data['services'] = $this->service_model->getService();
        $this->load->view('service', $data);
    }

    function editService() {
        $data = array();
        $id = $this->input->get('id');
        $data['service'] = $this->service_model->getServiceById($id);
        $this->load->view('home/dashboard'); 
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); 
    }
    
    function editServiceByJason(){
        $id = $this->input->get('id');
        $data['service'] = $this->service_model->getServiceById($id);
        echo json_encode($data);
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('service', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->service_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('service');
    }

}

/* End of file service.php */
/* Location: ./application/modules/service/controllers/service.php */
