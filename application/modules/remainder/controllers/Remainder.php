<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
use Twilio\Rest\Client;
class Remainder extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('remainder_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('patient/patient_model');
        $this->load->model('sms/sms_model');
        $language = $this->db->get('settings')->row()->language;
        $this->lang->load('system_syntax', $language);
    }
  function sendSms($to, $message, $data) {
        $sms_gateway = $this->settings_model->getSettings()->sms_gateway;
        if (!empty($sms_gateway)) {
            $smsSettings = $this->sms_model->getSmsSettingsByGatewayName($sms_gateway);
        } else {
            $this->session->set_flashdata('feedback', lang('gatewany_not_selected'));
            redirect('sms/sendView');
        }
        $j = sizeof($data);

        foreach ($data as $key => $value) {
            foreach ($value as $key2 => $value2) {
                if ($smsSettings->name == 'Clickatell') {
                    $username = urldecode(base64_decode($smsSettings->username));
                    $password = urldecode(base64_decode($smsSettings->password));
                    $api_id = urldecode($smsSettings->api_id);
                    //$to=$key2;
                    $value2 = urlencode($value2);

                    $racepage[] = file_get_contents("https://api.clickatell.com/http/sendmsg?user=" . $username . "&password=" . $password . "&api_id=" . $api_id . "&to=" . $key2 . "&text=" . $value2);
                }





                if ($smsSettings->name == 'MSG91') {
                    $authkey = $smsSettings->authkey;
                    $sender = $smsSettings->sender;
                    $value2 = urlencode($value2);
                    //  file_get_contents('http://api.msg91.com/api/v2/sendsms?route=4&sender=' . $sender . '&mobiles=' . $key2 . '&authkey=' . $authkey . '&message=' . $value2 . '&country=0');           // file_get_contents('https://platform.clickatell.com/messages/http/send?apiKey='.$api_id.'&to='.$to.'&content='.$message1);           // file_get_contents('https://api.clickatell.com/http/sendmsg?user=' . $username . '&password=' . $password . '&api_id=' . $api_id . '&to=' . $to . '&text=' . $message1);
                    file_get_contents('http://world.msg91.com/api/v2/sendsms?authkey=' . $authkey . '&mobiles=' . $key2 . '&message=' . $value2 . '&sender=' . $sender . '&route=4&country=0');
                }

                if ($smsSettings->name == 'Twilio') {
                    $sid = $smsSettings->sid;
                    $token = $smsSettings->token;
                    $sendername = $smsSettings->sendernumber;
                    if (!empty($sid) && !empty($token) && !empty($sendername)) {
                        $client = new Client($sid, $token);
                        $client->messages->create(
                                $key2, 
                                array(
                            'from' => $sendername, 
                            'body' => $value2
                                )
                        );
                    }
                }
                if ($smsSettings->name == 'Bulk Sms') {
                    $username = base64_decode($smsSettings->username);
                    $password = base64_decode($smsSettings->password);
                    $messages = array(
                        array('to' => $key2, 'body' => $value2)
                    );

                    $result = $this->send_message(json_encode($messages), 'https://api.bulksms.com/v1/messages?auto-unicode=true&longMessageMaxParts=30', $username, $password);
                }
                if ($smsSettings->name == 'Bd Bulk Sms') {
                    $token = $smsSettings->token;
                    $to = $key2;
                    $message = $value2;
                    $data = array(
                        'to' => $to,
                        'message' => $message,
                        'token' => $token
                    );

                    $url = "http://api.greenweb.com.bd/api.php";
                    $ch = curl_init(); // Initialize cURL
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_ENCODING, '');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $smsresult = curl_exec($ch);
                }
            }
        }
    }

    
        public function appointmentRemainder() {
      
     
        $settngsname = $this->settings_model->getSettings()->system_vendor;
        $autosms = $this->sms_model->getAutoSmsByType('appoinment_confirmation');
//        $patients = $this->patient_model->getpatient();
        $appointments = $this->appointment_model->getAppointmentByyToday();
        foreach ($appointments as $appointment) {
            $to[] = $this->patient_model->getPatientById($appointment->patient)->phone;
            $message = $autosms->message;
            $name = explode(' ', $this->patient_model->getPatientById($appointment->patient)->name);
            if (!isset($name[1])) {
                $name[1] = null;
            }
            $data1 = array(
                'firstname' => $name[0],
                'lastname' => $name[1],
                'name' => $this->patient_model->getPatientById($appointment->patient)->name,
                'phone' => $this->patient_model->getPatientById($appointment->patient)->phone,
                'doctorname' => $this->doctor_model->getDoctorById($appointment->doctor)->name,
                'appoinmentdate' => date('d-m-Y', $appointment->date),
                'time_slot' => $appointment->time_slot,
                'hospital_name' => $set['settings']->system_vendor,
                'company' => $settngsname
            );
            $messageprint = $this->parser->parse_string($message, $data1);
            $data2[] = array($this->patient_model->getPatientById($appointment->patient)->phone => $messageprint);
        }

        if (!empty($to)) {
            $message = $autosms->message;
            $message1 = urlencode($message);
//            $this->sendSms($to, $message1, $data2);
            $this->sendSms($to, $message1, $data2);
            $data = array();
            $date = time();
            $data = array(
                'message' => $message,
                'date' => $date,
                'recipient' => $recipient,
                'user' => $this->ion_auth->get_user_id()
            );
            $this->sms_model->insertSms($data);
            $this->session->set_flashdata('feedback', lang('message_sent'));
        } else {
            $this->session->set_flashdata('feedback', lang('not_sent'));
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
//        $this->sendSmsDuringAppointment($id, $data, $patient, $doctor, $status);
        $this->load->view('home/dashboard', $data); // just the header file
        $this->load->view('remainder', $data);
        $this->load->view('home/footer'); // just the header file
    }

}

/* End of file appointment.php */
    /* Location: ./application/modules/appointment/controllers/appointment.php */
    