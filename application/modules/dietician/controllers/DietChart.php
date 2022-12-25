<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DietChart extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->in_group(array('admin', 'Accountant','Dietician', 'Doctor', 'Receptionist', 'Nurse', 'Laboratorist', 'Patient'))) {
            redirect('home/permission');
        }
    }

    public function index() {
        $this->load->view('home/dashboard');
        $this->load->view('dietchart');
        $this->load->view('home/footer'); 
    }
}