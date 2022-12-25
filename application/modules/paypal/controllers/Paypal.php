<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
include("./vendor/autoload.php");

use Omnipay\Omnipay;

class Paypal extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
    }

    public function paymentPaypal($data) {
        $paypal = $this->db->get_where('paymentGateway', array('name =' => 'PayPal'))->row();
        $gateway = Omnipay::create('PayPal_Pro');
        $gateway->setUsername($paypal->APIUsername);
        $gateway->setPassword($paypal->APIPassword);
        $gateway->setSignature($paypal->APISignature);
        if ($paypal->status == 'test') {
            $gateway->setTestMode(true); 
        } else {
            $gateway->setTestMode(false);
        }
        $arr_expiry = explode("/", $data['expire_date']);
        $cardholdername = explode(" ", $data['cardholdername']);
        $currency = $this->currencyCode();
        $formData = array(
            'firstName' => trim($cardholdername[0]),
            'lastName' => trim($cardholdername[1]),
            'number' => $data['card_number'],
            'expiryMonth' => trim($arr_expiry[0]),
            'expiryYear' => trim($arr_expiry[1]),
            'cvv' => $data['cvv']
        );

        try {
            
            $response = $gateway->purchase([
                        'amount' => $data['deposited_amount'],
                        'currency' => $currency,
                        'card' => $formData
                    ])->send();
            
        
           
            if ($response->isSuccessful()) {

               
                if ($data['from'] == 'pos') {
                    $data1 = array(
                        'date' => $date,
                        'patient' => $data['patient'],
                        'deposited_amount' => $data['deposited_amount'],
                        'payment_id' => $data['payment_id'],
                        'amount_received_id' => $data['payment_id'] . '.' . 'gp',
                        'gateway' => 'PayPal',
                        'deposit_type' => 'Card',
                        'payment_from' => 'payment',
                        'user' => $this->ion_auth->get_user_id()
                    );
                    $this->finance_model->insertDeposit($data1);

                    $data_payment = array('amount_received' => $data['deposited_amount'], 'deposit_type' => 'Card');
                    $this->finance_model->updatePayment($data['payment_id'], $data_payment);

                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                    redirect("finance/invoice?id=" . $data['payment_id']);
                }elseif ($data['from'] == '10' || $data['from'] == 'my_today' || $data['from'] == 'upcoming' || $data['from'] == 'med_his' || $data['from'] == 'request' || $data['from'] == 'frontend') {

                    $data1 = array(
                        'date' => $date,
                        'patient' => $data['patient'],
                        'deposited_amount' => $data['deposited_amount'],
                        'payment_id' => $data['payment_id'],
                        'amount_received_id' => $data['payment_id'] . '.' . 'gp',
                        'gateway' => 'PayPal',
                        'deposit_type' => 'Card',
                        'user' => $this->ion_auth->get_user_id(),
                        'payment_from' => 'appointment'
                    );
                    $this->finance_model->insertDeposit($data1);
                    $this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Add new Payment(id='.$this->db->insert_id().' )', $this->db->insert_id());
                    $data_payment = array('amount_received' => $data['deposited_amount'], 'deposit_type' => 'Card', 'date' => time(), 'date_string' => date('d-m-y', time()));
                    $this->finance_model->updatePayment($data['payment_id'], $data_payment);
                    $appointment_id = $this->finance_model->getPaymentById($data['payment_id'])->appointment_id;
                    $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);
                    if ($appointment_details->status == 'Requested') {
                        $data_appointment_status = array('status' => 'Confirmed', 'payment_status' => 'paid');
                    } else {
                        $data_appointment_status = array('payment_status' => 'paid');
                    }
                    $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                    if ($data['from'] == 'my_today') {
                        redirect('appointment/todays');
                    } elseif ($data['from'] == 'upcoming') {
                        redirect('appointment/upcoming');
                    } elseif ($data['from'] == 'med_his') {
                        redirect("patient/medicalHistory?id=" . $data['patient']);
                    } elseif ($data['from'] == 'request') {
                        redirect("appointment/request");
                    } elseif ($data['from'] == 'frontend') {
                        redirect("frontend");
                    } else {
                        redirect("appointment");
                    }
                } else {
                    $date = time();
                    $data1 = array('patient' => $data['patient'],
                        'date' => $date,
                        'payment_id' => $data['payment_id'],
                        'deposited_amount' => $data['deposited_amount'],
                        'deposit_type' => 'Card',
                        'gateway' => 'PayPal',
                        'payment_from' => 'payment',
                        'user' => $this->ion_auth->get_user_id()
                    );
                    $payment_details=$this->finance_model->getPaymentById($data['payment_id']);
                    if($payment_details->payment_from=='admitted_patient_bed_medicine'){
                        $data1['payment_from']='admitted_patient_bed_medicine';
                    }elseif($payment_details->payment_from=='admitted_patient_bed_medicine'){
                        $data1['payment_from']='admitted_patient_bed_medicine';
                    }
                    $this->finance_model->insertDeposit($data1);
                    $this->session->set_flashdata('feedback', lang('payment_successful'));
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        redirect('patient/myPaymentHistory');
                    } else {
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }

                    
                }
            } else {
                
                if ($data['from'] == 'pos') {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                    redirect("finance/invoice?id=" . $data['payment_id']);
                }elseif ($data['from'] == '10' || $data['from'] == 'my_today' || $data['from'] == 'upcoming' || $data['from'] == 'med_his' || $data['from'] == 'request' || $data['from'] == 'frontend') {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                    if ($data['from'] == 'my_today') {
                        redirect('appointment/todays');
                    } elseif ($data['from'] == 'upcoming') {
                        redirect('appointment/upcoming');
                    } elseif ($data['from'] == 'med_his') {
                        redirect("patient/medicalHistory?id=" . $data['patient']);
                    } elseif ($data['from'] == 'request') {
                        redirect("appointment/request");
                    } elseif ($data['from'] == 'frontend') {
                        redirect("frontend");
                    } else {
                        redirect("appointment");
                    }
                } else {
                    $this->session->set_flashdata('feedback', lang('transaction_failed'));
                    if ($this->ion_auth->in_group(array('Patient'))) {
                        redirect('patient/myPaymentHistory');
                    } else {
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    function currencyCode() {
        $currency = $this->db->get('settings')->row()->currency;
        if ($currency == '$' || strtoupper($currency) == 'USD') {
            $currency = 'USD';
        }
        if ($currency == 'R' || strtoupper($currency) == 'ZAR') {
            $currency = 'ZAR';
        }
        if (strtoupper($currency) == 'TK' || strtoupper($currency) == 'BDT' || strtoupper($currency) == 'TAKA' || $currency == 'ট') {
            $currency = 'BDT';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if ($currency == '€' || strtoupper($currency) == 'EUR') {
            $currency = 'EUR';
        }
        if ($currency == '₹' || strtoupper($currency) == 'INR') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'CNY') {
            $currency = 'CNY';
        }
        if (strtoupper($currency) == 'BRL' || $currency == 'R$') {
            $currency = 'BRL';
        }
        if (strtoupper($currency) == 'GBP' || $currency == '£') {
            $currency = 'GBP';
        }
        if (strtoupper($currency) == 'IDR' || $currency == 'Rp') {
            $currency = 'IDR';
        }
        if (strtoupper($currency) == 'NGN' || $currency == '₦') {
            $currency = 'NGN';
        }

        if (strtoupper($currency) == 'RS' || strtoupper($currency) == 'INR' || strtoupper($currency) == 'RUPEE') {
            $currency = 'INR';
        }
        if (strtoupper($currency) == 'AUD') {
            $currency = 'AUD';
        }
        if (strtoupper($currency) == 'CAD') {
            $currency = 'CAD';
        }
        return $currency;
    }

}
