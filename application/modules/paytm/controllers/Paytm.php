<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Paytm extends MX_Controller {

    function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
        $paytm = $this->db->get_where('paymentGateway', array('name =' => 'Paytm'))->row();
        $merchant_key = $paytm->merchant_key;
        $merchant_mid = $paytm->merchant_mid;
        $merchant_website = $paytm->merchant_website;
        if ($paytm->status == 'test') {
            $status = 'TEST';
        } else {
            $tatus = 'PROD';
        }
        define('PAYTM_ENVIRONMENT', $status); 
        define('PAYTM_MERCHANT_KEY', $merchant_key); 
        define('PAYTM_MERCHANT_MID', $merchant_mid); 
        define('PAYTM_MERCHANT_WEBSITE', $merchant_website); 

        $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw-stage.paytm.in/order/status';
        $PAYTM_TXN_URL = 'https://securegw-stage.paytm.in/order/process';
        if (PAYTM_ENVIRONMENT == 'PROD') {
            $PAYTM_STATUS_QUERY_NEW_URL = 'https://securegw.paytm.in/order/status';
            $PAYTM_TXN_URL = 'https://securegw.paytm.in/order/process';
        }

        define('PAYTM_REFUND_URL', '');
        define('PAYTM_STATUS_QUERY_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_STATUS_QUERY_NEW_URL', $PAYTM_STATUS_QUERY_NEW_URL);
        define('PAYTM_TXN_URL', $PAYTM_TXN_URL);
    }

    public function Configuration() {
        $paytm = $this->db->get_where('paymentGateway', array('name =' => 'Paytm'))->row();
        $merchant_key = $paytm->merchant_key;
        $merchant_mid = $paytm->merchant_mid;
        $merchant_website = $paytm->merchant_website;
        

        $path = APPPATH . 'libraries/paytmlib/config_paytm.php';
        $file = file_get_contents($path);
        $file = trim($file);

        $file = str_replace("merchantkey", $merchant_key, $file);
        $file = str_replace("merchantmid", $merchant_mid, $file);
        $file = str_replace("website", $merchant_website, $file);
        if ($paytm->status == 'test') {
            $file = str_replace("status", 'TEST', $file);
        } else {
            $file = str_replace("status", 'PROD', $file);
        }
       
        $handle = fopen($path, 'w+');
       
        @chmod($path, 0777);
       
        if (is_writable($path)) {
           
            if (fwrite($handle, $file)) {
                return true;
            } else {
              
                return false;
            }
        } else {
            
            return false;
        }
    }

    public function PaytmGateway($payment) {
       
        $this->StartPayment($payment);
    }

    public function StartPayment($orderId) {
       
        require_once(APPPATH . "libraries/paytmlib/encdec_paytm.php");
        $session = array(
            'insertid' => $orderId['insertid'],
            'patient' => $orderId['patient'],
               
        );
        $this->session->set_userdata($session);
        $patientdetails = $this->db->get_where('patient', array('id =' => $orderId['patient']))->row();
        $paramList["MID"] = PAYTM_MERCHANT_MID;
        $paramList["ORDER_ID"] = $orderId['ref'] . '-' . $orderId['patient'] . '-' . $orderId['insertid'];
        $paramList["CUST_ID"] = $orderId['patient'];   
        $paramList["INDUSTRY_TYPE_ID"] = 'Retail';
        $paramList["CHANNEL_ID"] = 'WEB';
        $paramList["TXN_AMOUNT"] = $orderId['amount']; 
       
        $paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;

        $paramList["CALLBACK_URL"] = base_url() . "paytm/PaytmResponse";
        
        $checkSum = getChecksumFromArray($paramList, PAYTM_MERCHANT_KEY);
        ?>

       
        <form id="myForm" method="post" action="<?php echo PAYTM_TXN_URL ?>" name="f1">
        
            <?php
            foreach ($paramList as $a => $b) {
                echo '<input type="hidden" name="' . htmlentities($a) . '" value="' . htmlentities($b) . '">';
            }
            ?>

            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $checkSum ?>">
        </form>
        <script type="text/javascript">
            document.getElementById('myForm').submit();
        </script>

        <?php
    }

    

    public function PaytmResponse() {
        header("Pragma: no-cache");
        header("Cache-Control: no-cache");
        header("Expires: 0");


        require_once(APPPATH . "libraries/paytmlib/encdec_paytm.php");

        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = $_POST;
        $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 

        $isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 


        if ($isValidChecksum == "TRUE") {
            
            if ($_POST["STATUS"] == "TXN_SUCCESS") {

                $orderid = $_POST["ORDERID"];
                
                $orderdetails = explode('-', $orderid);
                $inserted_id = $orderdetails['5'];
                $patient = $orderdetails['4'];
                $redirectlink = $orderdetails['3'];
               
                $amount = $_POST["TXNAMOUNT"];


                $date = time();
                
                if ($redirectlink == '10' || $redirectlink == '11' || $redirectlink == '12' || $redirectlink == '13' || $redirectlink == '14' || $redirectlink == '15') {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'deposited_amount' => $amount,
                        'payment_id' => $inserted_id,
                        'amount_received_id' => $inserted_id . '.' . 'gp',
                        'gateway' => 'Paytm',
                        'deposit_type' => 'Card',
                        'user' => $this->ion_auth->get_user_id(),
                        'payment_from' => 'appointment'
                    );
                    $data_payment = array('amount_received' => $amount, 'deposit_type' => 'Card', 'status' => 'paid', 'date' => time(), 'date_string' => date('d-m-y', time()));
                    $this->finance_model->updatePayment($inserted_id, $data_payment);
                    $this->finance_model->insertDeposit($data1);
                    $this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Add new Payment(id='.$this->db->insert_id().' )', $this->db->insert_id());
                    $appointment_id = $this->finance_model->getPaymentById($inserted_id)->appointment_id;
                    $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);
                    if ($appointment_details->status == 'Requested') {
                        $data_appointment_status = array('status' => 'Confirmed', 'payment_status' => 'paid');
                    } else {
                        $data_appointment_status = array('payment_status' => 'paid');
                    }
                    $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
                    if ($redirectlink == '10') {
                        redirect("appointment");
                    } elseif ($redirectlink == '11') {
                        redirect("appointment/todays");
                    } elseif ($redirectlink == '12') {
                        redirect("appointment/upcoming");
                    } elseif ($redirectlink == '13') {
                        redirect("patient/medicalHistory?id=" . $patient);
                    } elseif ($redirectlink == '14') {
                        redirect("appointment/request");
                    } elseif ($redirectlink == '15') {
                        redirect("frontend");
                    }elseif ($redirectlink == 'frontend') {
                        redirect("frontend");
                    }
                } elseif ($redirectlink == '0') {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'deposited_amount' => $amount,
                        'payment_id' => $inserted_id,
                        'amount_received_id' => $inserted_id . '.' . 'gp',
                        'gateway' => 'Paytm',
                        'deposit_type' => 'Card',
                        'payment_from' => 'payment',
                        'user' => $this->ion_auth->get_user_id()
                    );
                    $data_payment = array('amount_received' => $amount, 'deposit_type' => 'Card');
                    $this->finance_model->updatePayment($inserted_id, $data_payment);
                    $this->finance_model->insertDeposit($data1);
                    redirect("finance/invoice?id=" . $inserted_id);
                } else {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $patient,
                        'deposited_amount' => $amount,
                        'payment_id' => $inserted_id,
                        'gateway' => 'Paytm',
                        'deposit_type' => 'Card',
                        'payment_from' => 'payment',
                        'user' => $this->ion_auth->get_user_id()
                    );
                    $payment_details=$this->finance_model->getPaymentById($inserted_id);
                    if($payment_details->payment_from=='admitted_patient_bed_medicine'){
                        $data1['payment_from']='admitted_patient_bed_medicine';
                    }elseif($payment_details->payment_from=='admitted_patient_bed_medicine'){
                        $data1['payment_from']='admitted_patient_bed_medicine';
                    }
                    $this->finance_model->insertDeposit($data1);
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        $sesdata = $this->session->userdata('insertid');
                        redirect("patient/myPaymentHistory");
                    } else {
                      
                        redirect('finance/patientPaymentHistory?patient=' . $patient);
                    }
                }

                
            } else {
                $this->session->set_flashdata('feedback', lang('transaction_failed'));
                
                $sesdata = $this->session->userdata('insertid');
                $orderid = $_POST["ORDERID"];
                $orderdetails = explode('-', $orderid);
                $inserted_id = $orderdetails['5'];
                $patient = $orderdetails['4'];
                $redirectlink = $orderdetails[3];
                if ($this->ion_auth->in_group(array('Patient'))) {
                    redirect("patient/myPaymentHistory");
                } elseif ($redirectlink == '11') {
                    redirect('appointment/todays');
                } elseif ($redirectlink == '12') {
                    redirect('appointment/upcoming');
                } elseif ($redirectlink == '13') {
                    redirect("patient/medicalHistory?id=" . $patient);
                } elseif ($redirectlink == '10') {
                    redirect('appointment');
                } elseif ($redirectlink == '14') {
                    redirect("appointment/request");
                }  else {
                    if ($redirectlink == '0') {
                       
                        redirect("finance/invoice?id=" . $inserted_id);
                    } else {
                       
                        redirect('finance/patientPaymentHistory?patient=' . $patient);
                    }
                }
               
            }


           
        } else {
            $this->session->set_flashdata('feedback', '"Checksum mismatched"');
            
            if ($this->ion_auth->in_group(array('Patient'))) {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect("patient/myPaymentHistory");
            } elseif ($redirectlink == '11') {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect('appointment/todays');
            } elseif ($redirectlink == '12') {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect('appointment/upcoming');
            } elseif ($redirectlink == '13') {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect("patient/medicalHistory?id=" . $patient);
            } elseif ($redirectlink == '14') {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect("appointment/request");
            } elseif ($redirectlink == '10') {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect('appointment');
            } else {
                $sesdata = $this->session->userdata($session['insertid']);
                redirect("finance/payment");
            }
          
        }
    }

    public function redirectlink($patient) {
      
        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect("patient/myPaymentHistory");
        } else {
           
            redirect('finance/patientPaymentHistory?patient=' . $patient);
        }
    }

}
?>