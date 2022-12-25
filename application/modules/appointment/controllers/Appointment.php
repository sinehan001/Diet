<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment extends MX_Controller {

    function __construct() {
        parent::__construct();
        
        $this->load->model('appointment_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        $this->load->model('appointment/appointment_model');
        $this->load->model('pgateway/pgateway_model');
        $this->load->model('finance/finance_model');
        $this->load->model('doctor/doctorvisit_model');
        $this->load->model('sms/sms_model');
        $this->load->module('sms');

        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor', 'Patient', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }



        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function request() {


        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment_request', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function todays() {
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }


        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('todays', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function upcoming() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('upcoming', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function myTodays() {
        if (!$this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }


        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('my_todays', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function calendar() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            $data['appointments'] = $this->appointment_model->getAppointmentByDoctor($doctor);
        } else {
            $data['appointments'] = $this->appointment_model->getAppointment();
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('calendar', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView() {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }
        $data = array();
        $data['appointment']=''; 
        $data['settings'] = $this->settings_model->getSettings();
        $data['gateway'] = $this->pgateway_model->getPaymentGatewaySettingsByName($data['settings']->payment_gateway);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew() {
        $id = $this->input->post('id');
        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }


        $time_slot = $this->input->post('time_slot');

        $time_slot_explode = explode('To', $time_slot);

        $s_time = trim($time_slot_explode[0]);
        $e_time = trim($time_slot_explode[1]);

        $app_time = strtotime(date('d-m-Y', $date) . ' ' . $s_time);
        $app_time_full_format = date('d-m-Y', $date) . ' ' . $s_time . '-' . $e_time;

        $remarks = $this->input->post('remarks');

        $sms = $this->input->post('sms');

        $status = $this->input->post('status');

        $redirect = $this->input->post('redirect');

        $request = $this->input->post('request');

        if (empty($request)) {
            $request = '';
        }


        $user = $this->ion_auth->get_user_id();

        if ($this->ion_auth->in_group(array('Patient'))) {
            $user = '';
        }



        if ((empty($id))) {
            $add_date = date('m/d/y');
            $registration_time = time();
            $patient_add_date = $add_date;
            $patient_registration_time = $registration_time;
        } else {
            $add_date = $this->appointment_model->getAppointmentById($id)->add_date;
            $registration_time = $this->appointment_model->getAppointmentById($id)->registration_time;
        }

        $s_time_key = $this->getArrayKey($s_time);

        $p_name = $this->input->post('p_name');
        $p_email = $this->input->post('p_email');
        if (empty($p_email)) {
            $p_email = $p_name . '-' . rand(1, 1000) . '-' . $p_name . '-' . rand(1, 1000) . '@example.com';
        }
        if (!empty($p_name)) {
            $password = $p_name . '-' . rand(1, 100000000);
        }
        $p_phone = $this->input->post('p_phone');
        $p_age = $this->input->post('p_age');
        $p_gender = $this->input->post('p_gender');
        $patient_id = rand(10000, 1000000);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($patient == 'add_new') {
            $this->form_validation->set_rules('p_name', 'Patient Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            $this->form_validation->set_rules('p_phone', 'Patient Phone', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        }

        // Validating Name Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Password Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        // Validating Email Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('s_time', 'Start Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('e_time', 'End Time', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Address Field   
        $this->form_validation->set_rules('remarks', 'Remarks', 'trim|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("appointment/editAppointment?id=$id");
            } else {
                
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {

            if ($patient == 'add_new') {

                $data_p = array(
                    'patient_id' => $patient_id,
                    'name' => $p_name,
                    'email' => $p_email,
                    'phone' => $p_phone,
                    'sex' => $p_gender,
                    'age' => $p_age,
                    'add_date' => $patient_add_date,
                    'registration_time' => $patient_registration_time,
                    'how_added' => 'from_appointment',
                    'payment_confirmation' => 'Active',
                    'appointment_confirmation' => 'Active',
                    'appointment_creation' => 'Active',
                    'meeting_schedule' => 'Active'
                );
                $username = $this->input->post('p_name');
                // Adding New Patient
                if ($this->ion_auth->email_check($p_email)) {
                    $this->session->set_flashdata('feedback', lang('this_email_address_is_already_registered'));
                    if (!empty($redirect)) {
                        redirect($redirect);
                    } else {
                        redirect('appointment');
                    }
                } else {
                    $dfg = 5;
                    $this->ion_auth->register($username, $password, $p_email, $dfg);
                    $ion_user_id = $this->db->get_where('users', array('email' => $p_email))->row()->id;
                    $this->patient_model->insertPatient($data_p);
                    $patient_user_id = $this->db->get_where('patient', array('email' => $p_email))->row()->id;
                    $id_info = array('ion_user_id' => $ion_user_id);
                    $this->patient_model->updatePatient($patient_user_id, $id_info);
                }

                $patient = $patient_user_id;
            }


            $patient_phone = $this->patient_model->getPatientById($patient)->phone;
            if (empty($id)) {
                $room_id = 'hms-meeting-' . $patient_phone . '-' . rand(10000, 1000000);
                $live_meeting_link = 'https://meet.jit.si/' . $room_id;
            } else {
                $appointment_details = $this->appointment_model->getAppointmentById($id);
                $room_id = $appointment_details->room_id;
                $live_meeting_link = $appointment_details->live_meeting_link;
            }
            $redirectlink = $this->input->post('redirectlink');

            $patientname = $this->patient_model->getPatientById($patient)->name;
            $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
            $patient_details = $this->patient_model->getPatientById($patient);
            $consultant_fee = $this->input->post('visit_charges');
            $data = array();
            $data = array(
                'patient' => $patient,
                'patientname' => $patientname,
                'doctor' => $doctor,
                'doctorname' => $doctorname,
                'date' => $date,
                's_time' => $s_time,
                'e_time' => $e_time,
                'time_slot' => $time_slot,
                'remarks' => $remarks,
                'add_date' => $add_date,
                'registration_time' => $registration_time,
                'status' => $status,
                's_time_key' => $s_time_key,
                'user' => $user,
                'request' => $request,
                'room_id' => $room_id,
                'live_meeting_link' => $live_meeting_link,
                'app_time' => $app_time,
                'app_time_full_format' => $app_time_full_format,
                'visit_description' => $this->input->post('visit_description'),
            );
            $data_appointment = array(
                'category_name' => 'Consultant Fee',
                'patient' => $patient,
                'amount' => $consultant_fee,
                'doctor' => $doctor,
                'discount' => $this->input->post('discount'),
                'flat_discount' => '0',
                'gross_total' => $this->input->post('grand_total'),
                'status' => 'unpaid',
                'hospital_amount' => '0',
                'doctor_amount' => $this->input->post('grand_total'),
                'user' => $user,
                'patient_name' => $patient_details->name,
                'patient_phone' => $patient_details->phone,
                'patient_address' => $patient_details->address,
                'doctor_name' => $doctorname,
                'remarks' => $remarks,
                'payment_from' => 'appointment'
            );
            $username = $this->input->post('name');
            if (empty($id)) {     // Adding New department
                $data['payment_status'] = 'unpaid';
                $data['visit_charges'] = $this->input->post('visit_charges');
                $data['discount'] = $this->input->post('discount');
                $data['grand_total'] = $this->input->post('grand_total');
                $this->appointment_model->insertAppointment($data);
                $appointment_id = $this->db->insert_id('appointment');
                $data_appointment['appointment_id'] = $appointment_id;
                $data_appointment['date'] = time();
                $data_appointment['date_string'] = date('d-m-Y');
                $this->finance_model->insertPayment($data_appointment);
                $inserted_id = $this->db->insert_id('payment');
                $deposit_type = $this->input->post('deposit_type');
                $patient_doctor = $this->patient_model->getPatientById($patient)->doctor;
                $data_update_payment_id_in_appointment = array('payment_id' => $inserted_id);
                $this->appointment_model->updateAppointment($appointment_id, $data_update_payment_id_in_appointment);
                $patient_doctors = explode(',', $patient_doctor);

                if (!in_array($doctor, $patient_doctors)) {
                    $patient_doctors[] = $doctor;
                    $doctorss = implode(',', $patient_doctors);
                    $data_d = array();
                    $data_d = array('doctor' => $doctorss);
                    $this->patient_model->updatePatient($patient, $data_d);
                }
                $response= $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
                
                $pay_now_appointment = $this->input->post('pay_now_appointment');
                if (!empty($pay_now_appointment)) {
                    $data_for_payment = array();
                    $data_for_payment = array(
                        'card_type' => $this->input->post('card_type'),
                        'card_number' => $this->input->post('card_number'),
                        'expire_date' => $this->input->post('expire_date'),
                        'cardHoldername' => $this->input->post('cardholder'),
                        'cvv' => $this->input->post('cvv'),
                        'token' => $this->input->post('token'),
                        'discount' => $this->input->post('discount'),
                        'grand_total' => $this->input->post('grand_total'),
                    );
                    $date = time();
                    $this->appointmentPayment($deposit_type, $data_for_payment, $patient, $doctor, $consultant_fee, $date, $inserted_id, $redirectlink);
                } else {
                    if ($redirectlink == 'my_today') {
                        redirect('appointment/todays');
                    } elseif ($redirectlink == 'upcoming') {
                        redirect('appointment/upcoming');
                    } elseif ($redirectlink == 'med_his') {
                        redirect("patient/medicalHistory?id=" . $patient);
                    } elseif ($redirectlink == 'request') {
                        redirect("appointment/request");
                    } else {
                        redirect('appointment');
                    }
                }
               // $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating department
                $previous_status = $this->appointment_model->getAppointmentById($id)->status;
                if ($previous_status != "Confirmed") {
                    if ($status == "Confirmed") {
                        $response = $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
                    }
                }
                $appointment_contingent = $this->appointment_model->getAppointmentById($id);
                if ($appointment_contingent->payment_status == 'unpaid') {
                    $data['visit_charges'] = $this->input->post('visit_charges');
                    $data['discount'] = $this->input->post('discount');
                    $data['grand_total'] = $this->input->post('grand_total');
                    $this->appointment_model->updateAppointment($id, $data);

                    $this->finance_model->updatePayment($appointment_contingent->payment_id, $data_appointment);
                    $pay_now_appointment = $this->input->post('pay_now_appointment');
                    if (!empty($pay_now_appointment)) {

                        $deposit_type = $this->input->post('deposit_type');
                        $data_for_payment = array();
                        $data_for_payment = array(
                            'card_type' => $this->input->post('card_type'),
                            'card_number' => $this->input->post('card_number'),
                            'expire_date' => $this->input->post('expire_date'),
                            'cardHoldername' => $this->input->post('cardholder'),
                            'cvv' => $this->input->post('cvv'),
                            'token' => $this->input->post('token'),
                            'discount' => $this->input->post('discount'),
                            'grand_total' => $this->input->post('grand_total'),
                        );
                        $date = time();
                        $this->appointmentPayment($deposit_type, $data_for_payment, $patient, $doctor, $consultant_fee, $date, $appointment_contingent->payment_id, $redirectlink);
                    }
                } else {
                    $this->appointment_model->updateAppointment($id, $data);
                }
                $this->session->set_flashdata('feedback', lang('updated'));
                if ($redirectlink == 'my_today') {
                    redirect('appointment/todays');
                } elseif ($redirectlink == 'upcoming') {
                    redirect('appointment/upcoming');
                } elseif ($redirectlink == 'med_his') {
                    redirect("patient/medicalHistory?id=" . $patient);
                } elseif ($redirectlink == 'request') {
                    redirect("appointment/request");
                } else {
                    redirect('appointment');
                }
               
            }
            // // Loading View

            // if (!empty($redirect)) {
            //     redirect($redirect);
            // } else {
            //     redirect('appointment');
            // }
        }
    }
    public function appointmentPayment($deposit_type, $data, $patient, $doctor, $consultant_fee, $date, $inserted_id, $redirectlink) {
        $patient_details = $this->patient_model->getPatientById($patient);
        $user = $this->ion_auth->get_user_id();
        $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
        if ($deposit_type == 'Card') {
            $gateway = $this->settings_model->getSettings()->payment_gateway;
            if ($gateway == 'PayPal') {

                $card_type = $data['cardtype'];
                $card_number = $data['card_number'];
                $expire_date = $data['expire_date'];
                $cardHoldername = $data['cardHoldername'];
                $cvv = $data['cvv'];

                $all_details = array(
                    'patient' => $patient,
                    'date' => $date,
                    'amount' => $consultant_fee,
                    'doctor' => $doctor,
                    'gross_total' => $data['grand_total'],
                    //'hospital_amount' => $hospital_amount,
                    // 'doctor_amount' => $doctor_amount,
                    'patient_name' => $patient_details->name,
                    'patient_phone' => $patient_details->phone,
                    'patient_address' => $patient_details->address,
                    'doctor_name' => $doctorname,
                    'date_string' => date('d-m-y', $date),
                    'deposited_amount' => $data['grand_total'],
                    'payment_id' => $inserted_id,
                    'card_type' => $card_type,
                    'card_number' => $card_number,
                    'expire_date' => $expire_date,
                    'cvv' => $cvv,
                   // 'from' => 'appointment',
                    'user' => $this->ion_auth->get_user_id(),
                    'cardholdername' => $cardHoldername,
                    'from' => $redirectlink
                );

                $this->paypal->paymentPaypal($all_details);
            } elseif ($gateway == 'Stripe') {

                $card_number = $data['card_number'];
                $expire_date = $data['expire_date'];

                $cvv = $data['cvv'];

                $token = $data['token'];
                $stripe = $this->db->get_where('paymentGateway', array('name =' => 'Stripe'))->row();
                \Stripe\Stripe::setApiKey($stripe->secret);
                $charge = \Stripe\Charge::create(array(
                            "amount" => $data['grand_total'] * 100,
                            "currency" => "usd",
                            "source" => $token
                ));
                $chargeJson = $charge->jsonSerialize();
                if ($chargeJson['status'] == 'succeeded') {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'payment_id' => $inserted_id,
                        'deposited_amount' => $data['grand_total'],
                        'amount_received_id' => $inserted_id . '.' . 'gp',
                        'deposit_type'=>$deposit_type,
                        'gateway' => 'Stripe',
                        'user' => $user,
                        'payment_from' => 'appointment'
                    );
                    $this->finance_model->insertDeposit($data1);
                    $data_payment = array('amount_received' => $data['grand_total'], 'deposit_type' => $deposit_type, 'status' => 'paid', 'date' => time(), 'date_string' => date('d-m-y', time()));
                    $this->finance_model->updatePayment($inserted_id, $data_payment);
                    $appointment_id = $this->finance_model->getPaymentById($inserted_id)->appointment_id;

                    $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);
                    if ($appointment_details->status == 'Requested') {
                        $data_appointment_status = array('status' => 'Confirmed', 'payment_status' => 'paid');
                    } else {
                        $data_appointment_status = array('payment_status' => 'paid');
                    }

                    $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                } else {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                }
            } elseif ($gateway == 'Pay U Money') {
                redirect("payu/check4?deposited_amount=" . $data['grand_total'] . '&payment_id=' . $inserted_id . '&redirectlink=' . $redirectlink);
            } elseif ($gateway == 'Paystack') {

                $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                $amount_in_kobo = $data['grand_total'];
                $this->load->module('paystack');
                $this->paystack->paystack_standard($amount_in_kobo, $ref, $patient, $inserted_id, $this->ion_auth->get_user_id(), $redirectlink);

                // $email=$patient_email;
            } elseif ($gateway == 'Paytm') {

                if ($redirectlink == '10') {
                    $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-10';
                } elseif ($redirectlink == 'my_today') {
                    $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-11';
                } elseif ($redirectlink == 'upcoming') {
                    $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-12';
                } elseif ($redirectlink == 'med_his') {
                    $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-13';
                } elseif ($redirectlink == 'request') {
                    $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m') . '-14';
                }
                $amount = $data['grand_total'];
                $this->load->module('paytm');
                // $configuration=$this->paytm->Configuration();
                //   if($configuration){
                $datapayment = array(
                    'ref' => $ref,
                    'amount' => $amount,
                    'patient' => $patient,
                    'insertid' => $inserted_id,
                    'channel_id' => 'WEB',
                    'industry_type' => 'Retail',
                    'email' => $patient_details->email,
                );
                //  $this->load->module('paytm/pgRedirects');
                $this->paytm->PaytmGateway($datapayment);
                //}
                // $email=$patient_email;
            } elseif ($gateway == 'Authorize.Net') {

                $card_type = $data['cardtype'];
                $card_number = $data['card_number'];
                $expire_date = $data['expire_date'];
                //  $cardHoldername =  $data['cardHoldername'];
                $cvv = $data['cvv'];
                $ref = date('Y') . rand() . date('d');
                $amount = $data['grand_total'];

                $card_number = base64_encode($card_number);
                $cvv = base64_encode($cvv);
                //     if ($configuration) {
                $datapayment = array(
                    'ref' => $ref,
                    'amount' => $amount,
                    'patient' => $patient,
                    'insertid' => $inserted_id,
                    'card_type' => $card_type,
                    'card_number' => $card_number,
                    'expire_date' => $expire_date,
                    'cvv' => $cvv,
                );
                //  print_r($datapayment);
                //    die();
                $this->load->module('authorizenet');
                $response = $this->authorizenet->paymentAuthorize($datapayment, $redirectlink);
            } elseif ($gateway == '2Checkout') {

                $card_type = $data['cardtype'];
                $card_number = $data['card_number'];
                $expire_date = $data['expire_date'];
                $cardHoldername = $data['cardHoldername'];
                $cvv = $data['cvv'];
                $ref = date('Y') . rand() . date('d');
                $amount = $data['grand_total'];
                $token = $this->input->post('token');
                //   $token = $this->input->post('token');
                //  $card_number = base64_encode($card_number);
                //   $cvv = base64_encode($cvv);
                //     if ($configuration) {
                $datapayment = array(
                    'ref' => $ref,
                    'amount' => $data['grand_total'],
                    'patient' => $patient,
                    'insertid' => $inserted_id,
                    'card_type' => $card_type,
                    'card_number' => $card_number,
                    'expire_date' => $expire_date,
                    'cvv' => $cvv,
                    'cardholder' => $cardHoldername
                );

                $this->load->module('twocheckoutpay');
                $charge = $this->twocheckoutpay->createCharge($ref, $token, $amount, $datapayment);

                if ($charge['response']['responseCode'] == 'APPROVED') {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'deposited_amount' => $data['grand_total'],
                        'payment_id' => $inserted_id,
                        'amount_received_id' => $inserted_id . '.' . 'gp',
                        'deposit_type' => $deposit_type,
                        'user' => $user,
                        'payment_from' => 'appointment'
                    );
                    $this->finance_model->insertDeposit($data1);

                    $data_payment = array('amount_received' => $data['grand_total'], 'deposit_type' => $deposit_type, 'status' => 'paid', 'date' => time(), 'date_string' => date('d-m-y', time()));
                    $this->finance_model->updatePayment($inserted_id, $data_payment);
                    $appointment_id = $this->finance_model->getPaymentById($inserted_id)->appointment_id;
                    $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);
                    if ($appointment_details->status == 'Requested') {
                        $data_appointment_status = array('status' => 'Confirmed', 'payment_status' => 'paid');
                    } else {
                        $data_appointment_status = array('payment_status' => 'paid');
                    }
                    $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
                    $this->session->set_flashdata('feedback', lang('added'));
                } else {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                }
            } elseif ($gateway == 'SSLCOMMERZ') {

                //   $SSLCOMMERZ = $this->db->get_where('paymentGateway', array('name =' => 'SSLCOMMERZ'))->row();


                $this->load->module('sslcommerzpayment');

                $this->sslcommerzpayment->request_api_hosted($data['grand_total'], $patient, $inserted_id, $this->ion_auth->get_user_id(), $redirectlink);
            } else {
                $this->session->set_flashdata('feedback', lang('payment_failed_no_gateway_selected'));
                $appointment_id = $this->finance_model->getPaymentById($inserted_id)->appointment_id;
                $data_appointment_status = array('payment_status' => 'unpaid');
                $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
            }
        } else {
            $data1 = array();
            $data1 = array(
                'date' => $date,
                'patient' => $patient,
                'deposited_amount' => $data['grand_total'],
                'payment_id' => $inserted_id,
                'amount_received_id' => $inserted_id . '.' . 'gp',
                'deposit_type' => $deposit_type,
                'user' => $this->ion_auth->get_user_id(),
                'payment_from' => 'appointment'
            );
            $this->finance_model->insertDeposit($data1);

            $data_payment = array('amount_received' => $data['grand_total'], 'deposit_type' => 'Cash', 'status' => 'paid');
            $this->finance_model->updatePayment($inserted_id, $data_payment);
            $appointment_id = $this->finance_model->getPaymentById($inserted_id)->appointment_id;
            $data_appointment_status = array('payment_status' => 'paid');
            $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
            $this->session->set_flashdata('feedback', lang('payment_successful'));
        }
       
        if ($redirectlink == '10') {
            redirect("appointment");
        } elseif ($redirectlink == 'my_today') {
            redirect("appointment/todays");
        } elseif ($redirectlink == 'upcoming') {
            redirect("appointment/upcoming");
        } elseif ($redirectlink == 'med_his') {
            redirect("patient/medicalHistory?id=" . $patient);
        } elseif ($redirectlink == 'request') {
            redirect("appointment/request");
        }
    }
    function sendSmsDuringAppointment($id, $data, $patient, $doctor, $status) {
        $set['settings'] = $this->settings_model->getSettings();
        $patientdetails = $this->patient_model->getPatientById($patient);
        $doctordetails = $this->doctor_model->getDoctorById($doctor);
        if (empty($id)) {
            if ($status != 'Confirmed') {
                $autosms = $this->sms_model->getAutoSmsByType('appoinment_creation');
                $autoemail = $this->email_model->getAutoEmailByType('appoinment_creation');
                $autoemaildoctor = $this->email_model->getAutoEmailByType('appoinment_creation_to_doctor');
            } else {
                $autosms = $this->sms_model->getAutoSmsByType('appoinment_confirmation');
                $autoemail = $this->email_model->getAutoEmailByType('appoinment_confirmation');
                $autoemaildoctor = $this->email_model->getAutoEmailByType('appoinment_creation_to_doctor');
            }
        } else {

            $autosms = $this->sms_model->getAutoSmsByType('appoinment_confirmation');
            $autoemail = $this->email_model->getAutoEmailByType('appoinment_confirmation');
            $autoemaildoctor = $this->email_model->getAutoEmailByType('appoinment_creation_to_doctor');
        }
        $message = $autosms->message;
        $to = $patientdetails->phone;
        $name1 = explode(' ', $patientdetails->name);
      //  $length=count($name1);
        if (!isset($name1[1])) {
            $name1[1] = null;
        }
        $name_doctor = explode(' ', $doctordetails->name);
        //$length_doc=count($name_doctor);
        if (!isset($name_doctor[1])) {
            $name_doctor[1] = null;
        }
        $data1 = array(
            'firstname' => $name1[0],
            'lastname' => $name1[1],
            'name' => $patientdetails->name,
            'doctorname' => $doctordetails->name,
            'appoinmentdate' => date('d-m-Y', $data['date']),
            'time_slot' => $data['time_slot'],
            'hospital_name' => $set['settings']->system_vendor
        );
        $data_doctor = array(
            'firstname' => $name_doctor[0],
            'lastname' => $name_doctor[1],
            'name' => $doctordetails->name,
            'patientname' => $patientdetails->name,
            'appoinmentdate' => date('d-m-Y', $data['date']),
            'time_slot' => $data['time_slot'],
            'hospital_name' => $set['settings']->system_vendor
        );

        if ($autosms->status == 'Active') {

            $messageprint = $this->parser->parse_string($message, $data1);

            $data2[] = array($to => $messageprint);
            $response = $this->sms->sendSmsDuringAppointmentCreation($to, $message, $data2);
        }

        if ($autoemail->status == 'Active') {
                $mail_provider = $this->settings_model->getSettings()->emailtype;
                $settngs_name = $this->settings_model->getSettings()->system_vendor;
                $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);
                if (empty($id)) {
            if ($status != 'Confirmed') {

                if($patientdetails->appointment_creation !='Inactive'){
                    $message1 = $autoemail->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data1);
                    if ($mail_provider == 'Domain Email') {
                        $this->email->from($email_Settings->admin_email);
                    }
                    if ($mail_provider == 'Smtp') {
                        $this->email->from($email_Settings->user, $settngs_name);
                    }
                    $this->email->to($patientdetails->email);
                    $this->email->subject(lang('appointment'));
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
                // if($doctordetails->appointment_confirmation !='Inactive'){
                //     $message1 = $autoemaildoctor->message;
                //     $messageprint1 = $this->parser->parse_string($message1, $data_doctor);
                //     if ($mail_provider == 'Domain Email') {
                //         $this->email->from($email_Settings->admin_email);
                //     }
                //     if ($mail_provider == 'Smtp') {
                //         $this->email->from($email_Settings->user, $settngs_name);
                //     }
                //     $this->email->to($doctordetails->email);
                //     $this->email->subject(lang('appointment'));
                //     $this->email->message($messageprint1);
                //     $this->email->send();
                // }
                }else{
                    if($patientdetails->appointment_confirmation !='Inactive'){
                        $message1 = $autoemail->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data1);
                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($patientdetails->email);
                        $this->email->subject(lang('appointment'));
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }
                    if($doctordetails->appointment_confirmation !='Inactive'){
                        $message1 = $autoemaildoctor->message;
                        $messageprint1 = $this->parser->parse_string($message1, $data_doctor);
                        if ($mail_provider == 'Domain Email') {
                            $this->email->from($email_Settings->admin_email);
                        }
                        if ($mail_provider == 'Smtp') {
                            $this->email->from($email_Settings->user, $settngs_name);
                        }
                        $this->email->to($doctordetails->email);
                        $this->email->subject(lang('appointment'));
                        $this->email->message($messageprint1);
                        $this->email->send();
                    }
                }
            }else{
                if($doctordetails->appointment_confirmation !='Inactive'){
                    $message1 = $autoemaildoctor->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data_doctor);
                    if ($mail_provider == 'Domain Email') {
                        $this->email->from($email_Settings->admin_email);
                    }
                    if ($mail_provider == 'Smtp') {
                        $this->email->from($email_Settings->user, $settngs_name);
                    }
                    $this->email->to($doctordetails->email);
                    $this->email->subject(lang('appointment'));
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
                if($doctordetails->appointment_confirmation !='Inactive'){
                    $message1 = $autoemaildoctor->message;
                    $messageprint1 = $this->parser->parse_string($message1, $data_doctor);
                    if ($mail_provider == 'Domain Email') {
                        $this->email->from($email_Settings->admin_email);
                    }
                    if ($mail_provider == 'Smtp') {
                        $this->email->from($email_Settings->user, $settngs_name);
                    }
                    $this->email->to($doctordetails->email);
                    $this->email->subject(lang('appointment'));
                    $this->email->message($messageprint1);
                    $this->email->send();
                }
            }
                
               
           
        }
        return $response;
    }

    function getArrayKey($s_time) {
        
            $all_slot = array(
                '0' => '12:00 AM',
                '1' => '12:05 AM',
                '2' => '12:10 AM',
                '3' => '12:15 AM',
                '4' => '12:20 AM',
                '5' => '12:25 AM',
                '6' => '12:30 AM',
                '7' => '12:35 AM',
                '8' => '12:40 PM',
                '9' => '12:45 AM',
                '10' => '12:50 AM',
                '11' => '12:55 AM',
                '12' => '01:00 AM',
                '13' => '01:05 AM',
                '14' => '01:10 AM',
                '15' => '01:15 AM',
                '16' => '01:20 AM',
                '17' => '01:25 AM',
                '18' => '01:30 AM',
                '19' => '01:35 AM',
                '20' => '01:40 AM',
                '21' => '01:45 AM',
                '22' => '01:50 AM',
                '23' => '01:55 AM',
                '24' => '02:00 AM',
                '25' => '02:05 AM',
                '26' => '02:10 AM',
                '27' => '02:15 AM',
                '28' => '02:20 AM',
                '29' => '02:25 AM',
                '30' => '02:30 AM',
                '31' => '02:35 AM',
                '32' => '02:40 AM',
                '33' => '02:45 AM',
                '34' => '02:50 AM',
                '35' => '02:55 AM',
                '36' => '03:00 AM',
                '37' => '03:05 AM',
                '38' => '03:10 AM',
                '39' => '03:15 AM',
                '40' => '03:20 AM',
                '41' => '03:25 AM',
                '42' => '03:30 AM',
                '43' => '03:35 AM',
                '44' => '03:40 AM',
                '45' => '03:45 AM',
                '46' => '03:50 AM',
                '47' => '03:55 AM',
                '48' => '04:00 AM',
                '49' => '04:05 AM',
                '50' => '04:10 AM',
                '51' => '04:15 AM',
                '52' => '04:20 AM',
                '53' => '04:25 AM',
                '54' => '04:30 AM',
                '55' => '04:35 AM',
                '56' => '04:40 AM',
                '57' => '04:45 AM',
                '58' => '04:50 AM',
                '59' => '04:55 AM',
                '60' => '05:00 AM',
                '61' => '05:05 AM',
                '62' => '05:10 AM',
                '63' => '05:15 AM',
                '64' => '05:20 AM',
                '65' => '05:25 AM',
                '66' => '05:30 AM',
                '67' => '05:35 AM',
                '68' => '05:40 AM',
                '69' => '05:45 AM',
                '70' => '05:50 AM',
                '71' => '05:55 AM',
                '72' => '06:00 AM',
                '73' => '06:05 AM',
                '74' => '06:10 AM',
                '75' => '06:15 AM',
                '76' => '06:20 AM',
                '77' => '06:25 AM',
                '78' => '06:30 AM',
                '79' => '06:35 AM',
                '80' => '06:40 AM',
                '81' => '06:45 AM',
                '82' => '06:50 AM',
                '83' => '06:55 AM',
                '84' => '07:00 AM',
                '85' => '07:05 AM',
                '86' => '07:10 AM',
                '87' => '07:15 AM',
                '88' => '07:20 AM',
                '89' => '07:25 AM',
                '90' => '07:30 AM',
                '91' => '07:35 AM',
                '92' => '07:40 AM',
                '93' => '07:45 AM',
                '94' => '07:50 AM',
                '95' => '07:55 AM',
                '96' => '08:00 AM',
                '97' => '08:05 AM',
                '98' => '08:10 AM',
                '99' => '08:15 AM',
                '100' => '08:20 AM',
                '101' => '08:25 AM',
                '102' => '08:30 AM',
                '103' => '08:35 AM',
                '104' => '08:40 AM',
                '105' => '08:45 AM',
                '106' => '08:50 AM',
                '107' => '08:55 AM',
                '108' => '09:00 AM',
                '109' => '09:05 AM',
                '110' => '09:10 AM',
                '111' => '09:15 AM',
                '112' => '09:20 AM',
                '113' => '09:25 AM',
                '114' => '09:30 AM',
                '115' => '09:35 AM',
                '116' => '09:40 AM',
                '117' => '09:45 AM',
                '118' => '09:50 AM',
                '119' => '09:55 AM',
                '120' => '10:00 AM',
                '121' => '10:05 AM',
                '122' => '10:10 AM',
                '123' => '10:15 AM',
                '124' => '10:20 AM',
                '125' => '10:25 AM',
                '126' => '10:30 AM',
                '127' => '10:35 AM',
                '128' => '10:40 AM',
                '129' => '10:45 AM',
                '130' => '10:50 AM',
                '131' => '10:55 AM',
                '132' => '11:00 AM',
                '133' => '11:05 AM',
                '134' => '11:10 AM',
                '135' => '11:15 AM',
                '136' => '11:20 AM',
                '137' => '11:25 AM',
                '138' => '11:30 AM',
                '139' => '11:35 AM',
                '140' => '11:40 AM',
                '141' => '11:45 AM',
                '142' => '11:50 AM',
                '143' => '11:55 AM',
                '144' => '12:00 PM',
                '145' => '12:05 PM',
                '146' => '12:10 PM',
                '147' => '12:15 PM',
                '148' => '12:20 PM',
                '149' => '12:25 PM',
                '150' => '12:30 PM',
                '151' => '12:35 PM',
                '152' => '12:40 PM',
                '153' => '12:45 PM',
                '154' => '12:50 PM',
                '155' => '12:55 PM',
                '156' => '01:00 PM',
                '157' => '01:05 PM',
                '158' => '01:10 PM',
                '159' => '01:15 PM',
                '160' => '01:20 PM',
                '161' => '01:25 PM',
                '162' => '01:30 PM',
                '163' => '01:35 PM',
                '164' => '01:40 PM',
                '165' => '01:45 PM',
                '166' => '01:50 PM',
                '167' => '01:55 PM',
                '168' => '02:00 PM',
                '169' => '02:05 PM',
                '170' => '02:10 PM',
                '171' => '02:15 PM',
                '172' => '02:20 PM',
                '173' => '02:25 PM',
                '174' => '02:30 PM',
                '175' => '02:35 PM',
                '176' => '02:40 PM',
                '177' => '02:45 PM',
                '178' => '02:50 PM',
                '179' => '02:55 PM',
                '180' => '03:00 PM',
                '181' => '03:05 PM',
                '182' => '03:10 PM',
                '183' => '03:15 PM',
                '184' => '03:20 PM',
                '185' => '03:25 PM',
                '186' => '03:30 PM',
                '187' => '03:35 PM',
                '188' => '03:40 PM',
                '189' => '03:45 PM',
                '190' => '03:50 PM',
                '191' => '03:55 PM',
                '192' => '04:00 PM',
                '193' => '04:05 PM',
                '194' => '04:10 PM',
                '195' => '04:15 PM',
                '196' => '04:20 PM',
                '197' => '04:25 PM',
                '198' => '04:30 PM',
                '199' => '04:35 PM',
                '200' => '04:40 PM',
                '201' => '04:45 PM',
                '202' => '04:50 PM',
                '203' => '04:55 PM',
                '204' => '05:00 PM',
                '205' => '05:05 PM',
                '206' => '05:10 PM',
                '207' => '05:15 PM',
                '208' => '05:20 PM',
                '209' => '05:25 PM',
                '210' => '05:30 PM',
                '211' => '05:35 PM',
                '212' => '05:40 PM',
                '213' => '05:45 PM',
                '214' => '05:50 PM',
                '215' => '05:55 PM',
                '216' => '06:00 PM',
                '217' => '06:05 PM',
                '218' => '06:10 PM',
                '219' => '06:15 PM',
                '220' => '06:20 PM',
                '221' => '06:25 PM',
                '222' => '06:30 PM',
                '223' => '06:35 PM',
                '224' => '06:40 PM',
                '225' => '06:45 PM',
                '226' => '06:50 PM',
                '227' => '06:55 PM',
                '228' => '07:00 PM',
                '229' => '07:05 PM',
                '230' => '07:10 PM',
                '231' => '07:15 PM',
                '232' => '07:20 PM',
                '233' => '07:25 PM',
                '234' => '07:30 PM',
                '235' => '07:35 PM',
                '236' => '07:40 PM',
                '237' => '07:45 PM',
                '238' => '07:50 PM',
                '239' => '07:55 PM',
                '240' => '08:00 PM',
                '241' => '08:05 PM',
                '242' => '08:10 PM',
                '243' => '08:15 PM',
                '244' => '08:20 PM',
                '245' => '08:25 PM',
                '246' => '08:30 PM',
                '247' => '08:35 PM',
                '248' => '08:40 PM',
                '249' => '08:45 PM',
                '250' => '08:50 PM',
                '251' => '08:55 PM',
                '252' => '09:00 PM',
                '253' => '09:05 PM',
                '254' => '09:10 PM',
                '255' => '09:15 PM',
                '256' => '09:20 PM',
                '257' => '09:25 PM',
                '258' => '09:30 PM',
                '259' => '09:35 PM',
                '260' => '09:40 PM',
                '261' => '09:45 PM',
                '262' => '09:50 PM',
                '263' => '09:55 PM',
                '264' => '10:00 PM',
                '265' => '10:05 PM',
                '266' => '10:10 PM',
                '267' => '10:15 PM',
                '268' => '10:20 PM',
                '269' => '10:25 PM',
                '270' => '10:30 PM',
                '271' => '10:35 PM',
                '272' => '10:40 PM',
                '273' => '10:45 PM',
                '274' => '10:50 PM',
                '275' => '10:55 PM',
                '276' => '11:00 PM',
                '277' => '11:05 PM',
                '278' => '11:10 PM',
                '279' => '11:15 PM',
                '280' => '11:20 PM',
                '281' => '11:25 PM',
                '282' => '11:30 PM',
                '283' => '11:35 PM',
                '284' => '11:40 PM',
                '285' => '11:45 PM',
                '286' => '11:50 PM',
                '287' => '11:55 PM',
            );

        $key = array_search($s_time, $all_slot);
        return $key;
    }

    function getAppointmentByJasonByDoctor() {


        $id = $this->input->get('id');

        $query = $this->appointment_model->getAppointmentByDoctor($id);

        $jsonevents = array();

        foreach ($query as $entry) {

            $doctor = $this->doctor_model->getDoctorById($entry->doctor);
            if (!empty($doctor)) {
                $doctor = $doctor->name;
            } else {
                $doctor = '';
            }
            $time_slot = $entry->time_slot;
            $time_slot_new = explode(' To ', $time_slot);
            $start_time = explode(' ', $time_slot_new[0]);
            $end_time = explode(' ', $time_slot_new[1]);

            if ($start_time[1] == 'AM') {
                $start_time_second = explode(':', $start_time[0]);
                if ($start_time_second[0] == 12) {
                    $day_start_time_second = $start_time_second[1] * 60;
                } else {
                    $day_start_time_second = $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
                }
            } else {
                $start_time_second = explode(':', $start_time[0]);
                if ($start_time_second[0] == 12) {
                    $day_start_time_second = 12 * 60 * 60 + $start_time_second[1] * 60;
                } else {
                    $day_start_time_second = 12 * 60 * 60 + $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
                }
            }

            if ($end_time[1] == 'AM') {
                $end_time_second = explode(':', $end_time[0]);
                if ($end_time_second[0] == 12) {
                    $day_end_time_second = $end_time_second[1] * 60;
                } else {
                    $day_end_time_second = $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
                }
            } else {
                $end_time_second = explode(':', $end_time[0]);
                if ($end_time_second[0] == 12) {
                    $day_end_time_second = 12 * 60 * 60 + $end_time_second[1] * 60;
                } else {
                    $day_end_time_second = 12 * 60 * 60 + $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
                }
            }

            $patient_details = $this->patient_model->getPatientById($entry->patient);

            if (!empty($patient_details)) {
                $patient_mobile = $patient_details->phone;
                $patient_name = $patient_details->name;
            } else {
                $patient_mobile = '';
                $patient_name = '';
            }

            if ($entry->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($entry->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($entry->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($entry->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($entry->status == 'Requested') {
                $appointment_status = lang('requested');
            }

            $info = '<br/>' . lang('status') . ': ' . $appointment_status . '<br>' . lang('patient') . ': ' . $patient_name . '<br/>' . lang('phone') . ': ' . $patient_mobile . '<br/> Doctor: ' . $doctor . '<br/>' . lang('remarks') . ': ' . $entry->remarks;
            if ($entry->status == 'Pending Confirmation') {
                //  $color = '#098098';
                $color = 'yellowgreen';
            }
            if ($entry->status == 'Confirmed') {
                $color = '#009988';
            }
            if ($entry->status == 'Treated') {
                $color = '#112233';
            }
            if ($entry->status == 'Cancelled') {
                $color = 'red';
            }
            if ($entry->status == 'Requested') {
                $color = '#6883a3';
            }

            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $info,
                'start' => date('Y-m-d H:i:s', $entry->date + $day_start_time_second),
                'end' => date('Y-m-d H:i:s', $entry->date + $day_end_time_second),
                'color' => $color,
            );
        }

        echo json_encode($jsonevents);
    }

    function getAppointmentByJason() {



        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            $query = $this->appointment_model->getAppointmentByDoctor($doctor);
        } elseif ($this->ion_auth->in_group(array('Patient'))) {
            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient = $this->db->get_where('patient', array('ion_user_id' => $patient_ion_id))->row()->id;
            $query = $this->appointment_model->getAppointmentByPatient($patient);
        } else {
            $query = $this->appointment_model->getAppointmentForCalendar();
        }
        $jsonevents = array();

        foreach ($query as $entry) {

            $doctor = $this->doctor_model->getDoctorById($entry->doctor);
            if (!empty($doctor)) {
                $doctor = $doctor->name;
            } else {
                $doctor = '';
            }
            $time_slot = $entry->time_slot;
            $time_slot_new = explode(' To ', $time_slot);
            $start_time = explode(' ', $time_slot_new[0]);
            $end_time = explode(' ', $time_slot_new[1]);

            if ($start_time[1] == 'AM') {
                $start_time_second = explode(':', $start_time[0]);
                if ($start_time_second[0] == 12) {
                    $day_start_time_second = $start_time_second[1] * 60;
                } else {
                    $day_start_time_second = $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
                }
            } else {
                $start_time_second = explode(':', $start_time[0]);
                if ($start_time_second[0] == 12) {
                    $day_start_time_second = 12 * 60 * 60 + $start_time_second[1] * 60;
                } else {
                    $day_start_time_second = 12 * 60 * 60 + $start_time_second[0] * 60 * 60 + $start_time_second[1] * 60;
                }
            }

            if ($end_time[1] == 'AM') {
                $end_time_second = explode(':', $end_time[0]);
                if ($end_time_second[0] == 12) {
                    $day_end_time_second = $end_time_second[1] * 60;
                } else {
                    $day_end_time_second = $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
                }
            } else {
                $end_time_second = explode(':', $end_time[0]);
                if ($end_time_second[0] == 12) {
                    $day_end_time_second = 12 * 60 * 60 + $end_time_second[1] * 60;
                } else {
                    $day_end_time_second = 12 * 60 * 60 + $end_time_second[0] * 60 * 60 + $end_time_second[1] * 60;
                }
            }

            $patient_details = $this->patient_model->getPatientById($entry->patient);

            if (!empty($patient_details)) {
                $patient_mobile = $patient_details->phone;
                $patient_name = $patient_details->name;
            } else {
                $patient_mobile = '';
                $patient_name = '';
            }

            if ($entry->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($entry->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($entry->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($entry->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($entry->status == 'Requested') {
                $appointment_status = lang('requested');
            }

            $info = '<br/>' . lang('status') . ': ' . $appointment_status . '<br>' . lang('patient') . ': ' . $patient_name . '<br/>' . lang('phone') . ': ' . $patient_mobile . '<br/> Doctor: ' . $doctor . '<br/>' . lang('remarks') . ': ' . $entry->remarks;
            if ($entry->status == 'Pending Confirmation') {

                $color = 'yellowgreen';
            }
            if ($entry->status == 'Confirmed') {
                $color = '#009988';
            }
            if ($entry->status == 'Treated') {
                $color = '#112233';
            }
            if ($entry->status == 'Cancelled') {
                $color = 'red';
            }
            if ($entry->status == 'Requested') {
                $color = '#6883a3';
            }

            $jsonevents[] = array(
                'id' => $entry->id,
                'title' => $info,
                'description' => 'Click to see the patient history',
                'start' => date('Y-m-d H:i:s', $entry->date + $day_start_time_second),
                'end' => date('Y-m-d H:i:s', $entry->date + $day_end_time_second),
                'color' => $color,
            );
        }

        echo json_encode($jsonevents);
    }

    function getAppointmentByDoctorId() {
        $id = $this->input->get('id');
        $data['doctor_id'] = $id;
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['patients'] = $this->patient_model->getPatient();
        $data['mmrdoctor'] = $this->doctor_model->getDoctorById($id);
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('appointment_by_doctor', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function editAppointment() {
        $data = array();
        $id = $this->input->get('id');

        $data['settings'] = $this->settings_model->getSettings();
        $data['appointment'] = $this->appointment_model->getAppointmentById($id);
        $data['patients'] = $this->patient_model->getPatientById($data['appointment']->patient);
        $data['doctors'] = $this->doctor_model->getDoctorById($data['appointment']->doctor);
        $data['visits'] = $this->doctor_model->getDoctorVisitByDoctorId($data['appointment']->doctor);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file 
    }

    function editAppointmentByJason() {
        $id = $this->input->get('id');
        $data['appointment'] = $this->appointment_model->getAppointmentById($id);
        $data['patient'] = $this->patient_model->getPatientById($data['appointment']->patient);
        $data['doctor'] = $this->doctor_model->getDoctorById($data['appointment']->doctor);
        echo json_encode($data);
    }

    function treatmentReport() {
        $data['settings'] = $this->settings_model->getSettings();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $date_from = strtotime($this->input->post('date_from'));
        $date_to = strtotime($this->input->post('date_to'));
        if (!empty($date_to)) {
            $date_to = $date_to + 24 * 60 * 60;
        }

        if (empty($date_from) || empty($date_to)) {
            $data['appointments'] = $this->appointment_model->getAppointment();
        } else {
            $data['appointments'] = $this->appointment_model->getAppointmentByDate($date_from, $date_to);
            $data['from'] = $this->input->post('date_from');
            $data['to'] = $this->input->post('date_to');
        }

        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('treatment_history', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function myAppointments() {
        $data['appointments'] = $this->appointment_model->getAppointment();
        $data['settings'] = $this->settings_model->getSettings();
        $user_id = $this->ion_auth->user()->row()->id;
        $data['user_id'] = $this->db->get_where('patient', array('ion_user_id' => $user_id))->row()->id;
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('myappointments', $data);
        $this->load->view('home/footer'); // just the header file
    }

    function delete() {
        $data = array();
        $id = $this->input->get('id');
        $doctor_id = $this->input->get('doctor_id');
        $this->appointment_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        if (!empty($doctor_id)) {
            redirect('appointment/getAppointmentByDoctorId?id=' . $doctor_id);
        } else {
            redirect('appointment');
        }
    }

    function getAppointment() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['appointments'] = $this->appointment_model->getAppointmentBysearch($search, $order, $dir);
            } else {
                $data['appointments'] = $this->appointment_model->getAppointmentWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['appointments'] = $this->appointment_model->getAppointmentByLimitBySearch($limit, $start, $search);
            } else {
                $data['appointments'] = $this->appointment_model->getAppointmentByLimit($limit, $start);
            }
        }


        foreach ($data['appointments'] as $appointment) {

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                //   $options1 = '<a type="button" class="btn editbutton" title="Edit" data-toggle="modal" data-id="463"><i class="fa fa-edit"> </i> Edit</a>';
                $options1 = ' <a type="button" class="btn editbutton" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> </i> ' . lang('edit') . '</a>';
            }

            $options2 = '<a class="btn detailsbutton" title="' . lang('info') . '" style="color: #fff;" href="appointment/appointmentDetails?id=' . $appointment->id . '"><i class="fa fa-info"></i> ' . lang('info') . '</a>';

            $options3 = '<a class="btn green" title="' . lang('history') . '" style="color: #fff;" href="appointment/medicalHistory?id=' . $appointment->id . '"><i class="fa fa-stethoscope"></i> ' . lang('history') . '</a>';

            $options4 = '<a class="btn invoicebutton" title="' . lang('payment') . '" style="color: #fff;" href="finance/appointmentPaymentHistory?appointment=' . $appointment->id . '"><i class="fa fa-money"></i> ' . lang('payment') . '</a>';

            if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) {
                $options5 = '<a class="btn delete_button" title="' . lang('delete') . '" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>';
            }


            $info[] = array(
                $appointment->id,
                $appointment->name,
                $appointment->phone,
                $this->settings_model->getSettings()->currency . $this->appointment_model->getDueBalanceByAppointmentId($appointment->id),
                $options1 . ' ' . $options2 . ' ' . $options3 . ' ' . $options4 . ' ' . $options5,
            );
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('appointment')->num_rows(),
                "recordsFiltered" => $this->db->get('appointment')->num_rows(),
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

    function getAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListBySearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {
            $i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }


            if ($this->ion_auth->in_group(array('Doctor'))) {
                if ($appointment->status == 'Confirmed') {
                    if ($appointment->status == 'Confirmed') {
                        $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                    } else {
                        $options7 = '';
                    }
                } else {
                    $options7 = '';
                }
            } else {
                $options7 = '';
            }

            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2 . ' ' . $options7
            );
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $this->db->get('appointment')->num_rows(),
                "recordsFiltered" => $this->db->get('appointment')->num_rows(),
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

    function getRequestedAppointmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentBysearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getRequestAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {
            //  $i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }

            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function getPendingAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentBysearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getPendingAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';

            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }

            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
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

    function getConfirmedAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentBysearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getConfirmedAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }


            if ($this->ion_auth->in_group(array('Doctor'))) {
                if ($appointment->status == 'Confirmed') {
                    $options7 = '<a class="btn btn btn-info btn-xs btn_width  detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->patient . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                } else {
                    $options7 = '';
                }
            } else {
                $options7 = '';
            }
            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2 . ' ' . $options7
            );
            $i = $i + 1;
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function getTreatedAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentBysearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getTreatedAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }

            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                if ($appointment->status == 'Confirmed') {
                    $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                } else {
                    $options7 = '';
                }
            } else {
                $options7 = '';
            }
            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function getCancelledAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentBysearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getCancelledAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }
            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }

            $info[] = array(
                $appointment->id,
                $patientname,
                $doctorname,
                date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                $appointment->remarks,
                $appointment_status,
                $option1 . ' ' . $option2
            );
            $i = $i + 1;
        }

        if (!empty($data['appointments'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
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

    function getTodaysAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListBySearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {
            //$i = $i + 1;

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
            if (!empty($patientdetails)) {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
            } else {
                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
            }
            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $appointment->doctorname;
            }

            if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                if ($appointment->status == 'Confirmed') {
                    $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                } else {
                    $options7 = '';
                }
            } else {
                $options7 = '';
            }
            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            if (date('Y-m-d', $appointment->date) == date('Y-m-d')) {
                //  if ($appointment->date == strtotime(date('Y-m-d'))) {
                $info[] = array(
                    $appointment->id,
                    $patientname,
                    $doctorname,
                    date('d-m-Y', $appointment->date) . '<br>' . $appointment->s_time . '-' . $appointment->e_time,
                    $appointment->remarks,
                    $appointment_status,
                    $option1 . ' ' . $option2 . ' ' . $options7
                );
                $i = $i + 1;
            } else {
                $info1[] = array($appointment->id,
                    $appointment->patientname,
                    $appointment->doctorname,
                    date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                    $appointment->remarks,
                    $appointment_status,
                    $option1 . ' ' . $option2 . ' ' . $options7
                );
            }
        }

        if ($i !== 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
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

    function getUpcomingAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListBySearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';

            $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            if ($appointment->status == 'Pending Confirmation') {
                $appointment_status = lang('pending_confirmation');
            } elseif ($appointment->status == 'Confirmed') {
                $appointment_status = lang('confirmed');
            } elseif ($appointment->status == 'Treated') {
                $appointment_status = lang('treated');
            } elseif ($appointment->status == 'Cancelled') {
                $appointment_status = lang('cancelled');
            } elseif ($appointment->status == 'Requested') {
                $appointment_status = lang('requested');
            }
            if ($appointment->date > strtotime(date('Y-m-d'))) {
                $patientdetails = $this->patient_model->getPatientById($appointment->patient);
                if (!empty($patientdetails)) {
                    $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
                } else {
                    $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
                }
                $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }
                if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                    if ($appointment->status == 'Confirmed') {
                        $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                    } else {
                        $options7 = '';
                    }
                } else {
                    $options7 = '';
                }
                $info[] = array(
                    $appointment->id,
                    $patientname,
                    $doctorname,
                    date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                    $appointment->remarks,
                    $appointment_status,
                    $option1 . ' ' . $option2 . ' ' . $options7
                );
                $i = $i + 1;
            } else {
                if ($this->ion_auth->in_group(array('admin', 'Doctor'))) {
                    if ($appointment->status == 'Confirmed') {
                        $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with this patient? SMS and Email will be sent to the Patient.\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                    } else {
                        $options7 = '';
                    }
                } else {
                    $options7 = '';
                }
                $info1[] = array($appointment->id,
                    $appointment->patientname,
                    $appointment->doctorname,
                    date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                    $appointment->remarks,
                    $appointment_status,
                    $option1 . ' ' . $option2 . ' ' . $options7
                );
            }
        }

        if ($i !== 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
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

    function getMyTodaysAppoinmentList() {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "3" => "app_time",
            "5" => "status",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($this->ion_auth->in_group(array('Doctor'))) {
            $doctor_ion_id = $this->ion_auth->get_user_id();
            $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListBySearchByDoctor($doctor, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByDoctorWithoutSearch($doctor, $order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentListByLimitByDoctor($doctor, $limit, $start, $order, $dir);
                }
            }
        } else {
            if ($limit == -1) {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentBysearch($search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentWithoutSearch($order, $dir);
                }
            } else {
                if (!empty($search)) {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimitBySearch($limit, $start, $search, $order, $dir);
                } else {
                    $data['appointments'] = $this->appointment_model->getAppointmentByLimit($limit, $start, $order, $dir);
                }
            }
        }

        $i = 0;
        foreach ($data['appointments'] as $appointment) {

            $patient_ion_id = $this->ion_auth->get_user_id();
            $patient_details = $this->patient_model->getPatientByIonUserId($patient_ion_id);
            $patient_id = $patient_details->id;
            if ($patient_id == $appointment->patient) {
                $option1 = '<button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="' . $appointment->id . '"><i class="fa fa-edit"> ' . lang('edit') . '</i></button>';
                $option2 = '<a class="btn btn-info btn-xs btn_width delete_button" href="appointment/delete?id=' . $appointment->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
                $patientdetails = $this->patient_model->getPatientById($appointment->patient);
                if (!empty($patientdetails)) {
                    $patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
                } else {
                    $patientname = ' <a type="button" class="" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
                }
                $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
                if (!empty($doctordetails)) {
                    $doctorname = $doctordetails->name;
                } else {
                    $doctorname = $appointment->doctorname;
                }


                if ($this->ion_auth->in_group(array('Patient'))) {
                    if ($appointment->status == 'Confirmed') {
                        $options7 = '<a class="btn btn-info btn-xs btn_width detailsbutton" title="' . lang('start_live') . '" style="color: #fff;" href="meeting/instantLive?id=' . $appointment->id . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting?\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                    } else {
                        $options7 = '';
                    }
                } else {
                    $options7 = '';
                }
                if ($appointment->status == 'Pending Confirmation') {
                    $appointment_status = lang('pending_confirmation');
                } elseif ($appointment->status == 'Confirmed') {
                    $appointment_status = lang('confirmed');
                } elseif ($appointment->status == 'Treated') {
                    $appointment_status = lang('treated');
                } elseif ($appointment->status == 'Cancelled') {
                    $appointment_status = lang('cancelled');
                } elseif ($appointment->status == 'Requested') {
                    $appointment_status = lang('requested');
                }
                if (date('Y-m-d', $appointment->date) == date('Y-m-d')) {

                    $info[] = array(
                        $appointment->id,
                        $patientname,
                        $doctorname,
                        date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                        $appointment->remarks,
                        $appointment_status,
                        $options7
                    );
                    $i = $i + 1;
                } else {
                    $info1[] = array($appointment->id,
                        $appointment->patientname,
                        $appointment->doctorname,
                        date('d-m-Y', $appointment->date) . ' <br> ' . $appointment->s_time . '-' . $appointment->e_time,
                        $appointment->remarks,
                        $appointment_status,
                        $options7
                    );
                }
            }
        }

        if ($i !== 0) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
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

}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
    