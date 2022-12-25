<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include("./vendor/autoload.php");

use net\authorize\api\contract\v1 as AnetAPI;

class Authorizenet extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('finance/finance_model');
        $this->load->model('appointment/appointment_model');
    }

    function index() {
        
    }

    function paymentAuthorize($data, $redirect) {
     
       
        $patientdetails = $this->db->get_where('patient', array('id =' => $data['patient']))->row();



        $authorizenet = $this->db->get_where('paymentGateway', array('name =' => 'Authorize.Net'))->row();
        $apiloginid = $authorizenet->apiloginid;
        $transactionkey = $authorizenet->transactionkey;
        $merchanAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchanAuthentication->setName($apiloginid);
        $merchanAuthentication->setTransactionKey($transactionkey);
        $refId = $data['ref'];
       
        $expiredate = explode('/', $data['expire_date']);
        $dt = DateTime::createFromFormat('y', $expiredate['1']);
        $expirecard = $dt->format('Y') . '-' . $expiredate['0'];

       
        $card_number = base64_decode($data['card_number']);
        $cvv = base64_decode($data['cvv']);

        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber($card_number);
        $creditCard->setExpirationDate($expirecard);
        $creditCard->setCardCode($cvv);

        // Add the payment data to a paymentType object
        $paymentOne = new net\authorize\api\contract\v1\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create order information
        $order = new net\authorize\api\contract\v1\OrderType();
        $order->setInvoiceNumber($data['insertid']);
        
        $customerAddress = new net\authorize\api\contract\v1\CustomerAddressType();
        $customerAddress->setFirstName($patientdetails->name);
       
        $customerAddress->setAddress($patientdetails->address);
       
        $customerData = new net\authorize\api\contract\v1\CustomerDataType();
        $customerData->setType("individual");
        $customerData->setId($patientdetails->id . rand());
        $customerData->setEmail($patientdetails->email);

        // Add values for transaction settings
        $duplicateWindowSetting = new net\authorize\api\contract\v1\SettingType();
        $duplicateWindowSetting->setSettingName("duplicateWindow");
        $duplicateWindowSetting->setSettingValue("60");

        // Add some merchant defined fields. These fields won't be stored with the transaction,
        // but will be echoed back in the response.
        $merchantDefinedField1 = new net\authorize\api\contract\v1\UserFieldType();
        $merchantDefinedField1->setName("insertid");
        $merchantDefinedField1->setValue($data['insertid']);

        $merchantDefinedField2 = new net\authorize\api\contract\v1\UserFieldType();
        $merchantDefinedField2->setName("patient");
        $merchantDefinedField2->setValue($data['patient']);

        // Create a TransactionRequestType object and add the previous objects to it
        $transactionRequestType = new net\authorize\api\contract\v1\TransactionRequestType();
        $transactionRequestType->setTransactionType("authOnlyTransaction");
        $transactionRequestType->setAmount($data['amount']);
        $transactionRequestType->setOrder($order);
        $transactionRequestType->setPayment($paymentOne);
        $transactionRequestType->setBillTo($customerAddress);
        $transactionRequestType->setCustomer($customerData);
        $transactionRequestType->addToTransactionSettings($duplicateWindowSetting);
        $transactionRequestType->addToUserFields($merchantDefinedField1);
        $transactionRequestType->addToUserFields($merchantDefinedField2);

        // Assemble the complete transaction request


        $request = new net\authorize\api\contract\v1\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchanAuthentication);
        $request->setRefId($refId);
        $request->setTransactionRequest($transactionRequestType);

        // Create the controller and get the response
        $controller = new net\authorize\api\controller\CreateTransactionController($request);
        if( $authorizenet->status=='test'){
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);
        }else{
              $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        }
     
        if ($response != null) {
            // Check to see if the API request was successfully received and acted upon
            if ($response->getMessages()->getResultCode() == "Ok") {
               
                $tresponse = $response->getTransactionResponse();


                if ($tresponse != null && $tresponse->getMessages() != null) {
                    if ($redirect == '10' || $redirect == 'my_today' || $redirect == 'upcoming' || $redirect == 'med_his' || $redirect == 'request') {
                        $data1 = array(
                            'date' => $date,
                            'patient' => $data['patient'],
                            'deposited_amount' => $data['amount'],
                            'payment_id' => $data['insertid'],
                            'amount_received_id' => $data['insertid'] . '.' . 'gp',
                            'gateway' => 'Authorize.Net',
                            'deposit_type' => 'Card',
                            'user' => $this->ion_auth->get_user_id(),
                            'payment_from' => 'appointment',
                            
                        );
                        $this->finance_model->insertDeposit($data1);
                        $this->log_model->insertLog($this->ion_auth->get_user_id(), date('d-m-Y H:i:s', time()), 'Add new Payment (id='.$this->db->insert_id().' )', $this->db->insert_id());
                        $data_payment = array('amount_received' => $data['amount'], 'deposit_type' => 'Card', 'status' => 'paid', 'date' => time(), 'date_string' => date('d-m-y', time()));
                        $this->finance_model->updatePayment($data['insertid'], $data_payment);
                        $appointment_id = $this->finance_model->getPaymentById($data['insertid'])->appointment_id;
                        $appointment_details = $this->appointment_model->getAppointmentById($appointment_id);
                        if ($appointment_details->status == 'Requested') {
                            $data_appointment_status = array('status' => 'Confirmed', 'payment_status' => 'paid');
                        } else {
                            $data_appointment_status = array('payment_status' => 'paid');
                        }
                        $this->appointment_model->updateAppointment($appointment_id, $data_appointment_status);
                        $this->session->set_flashdata('feedback', lang('payment_successful'));
                        if ($redirect == '10') {
                            redirect("appointment");
                        } elseif ($redirect == 'my_today') {
                            redirect("appointment/todays");
                        } elseif ($redirect == 'upcoming') {
                            redirect("appointment/upcoming");
                        } elseif ($redirect == 'request') {
                            redirect("appointment/request");
                        } elseif ($redirect == 'frontend') {
                            redirect("frontend");
                        } elseif ($redirect == 'med_his') {

                            redirect("patient/medicalHistory?id=" . $data['patient']);
                        }
                    }
                    if ($redirect == 'pos') {
                        $data1 = array(
                            'date' => $date,
                            'patient' => $data['patient'],
                            'deposited_amount' => $data['amount'],
                            'payment_id' => $data['insertid'],
                            'amount_received_id' => $data['insertid'] . '.' . 'gp',
                            'gateway' => 'Authorize.Net',
                            'deposit_type' => 'Card',
                            'payment_from' => 'payment',
                            'user' => $this->ion_auth->get_user_id()
                        );
                        $this->finance_model->insertDeposit($data1);

                        $data_payment = array('amount_received' => $data['amount'], 'deposit_type' => 'Card');
                        $this->finance_model->updatePayment($data['insertid'], $data_payment);

                        $this->session->set_flashdata('feedback', lang('payment_successful'));
                        redirect("finance/invoice?id=" . $data['insertid']);
                    }
                    if ($redirect == 'findep') {
                        $date = time();
                        $data1 = array('patient' => $data['patient'],
                            'date' => $date,
                            'payment_id' => $data['insertid'],
                            'deposited_amount' => $data['amount'],
                            'deposit_type' => 'Card',
                            'gateway' => 'Authorize.Net',
                            'payment_from' => 'payment',
                            'user' => $this->ion_auth->get_user_id()
                        );
                        $payment_details=$this->finance_model->getPaymentById( $data['insertid']);
                        if($payment_details->payment_from=='admitted_patient_bed_medicine'){
                            $data1['payment_from']='admitted_patient_bed_medicine';
                        }elseif($payment_details->payment_from=='admitted_patient_bed_medicine'){
                            $data1['payment_from']='admitted_patient_bed_medicine';
                        }
                        $this->finance_model->insertDeposit($data1);
                        $this->session->set_flashdata('feedback', lang('payment_successful'));
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }
                    if ($redirect == 'patdep') {
                        $date = time();
                        $data1 = array('patient' => $data['patient'],
                            'date' => $date,
                            'payment_id' => $data['insertid'],
                            'deposited_amount' => $data['amount'],
                            'deposit_type' => 'Card',
                            'gateway' => 'Authorize.Net',
                            'payment_from' => 'payment',
                            'user' => $this->ion_auth->get_user_id()
                        );
                        $payment_details=$this->finance_model->getPaymentById($data['insertid']);
                        if($payment_details->payment_from=='admitted_patient_bed_medicine'){
                            $data1['payment_from']='admitted_patient_bed_medicine';
                        }elseif($payment_details->payment_from=='admitted_patient_bed_medicine'){
                            $data1['payment_from']='admitted_patient_bed_medicine';
                        }
                        $this->finance_model->insertDeposit($data1);
                        $this->session->set_flashdata('feedback', lang('payment_successful'));
                        redirect('patient/myPaymentHistory');
                    }
                } else {
                    if ($redirect == '10') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment");
                    }
                    if ($redirect == 'my_today') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/todays");
                    }
                    if ($redirect == 'upcoming') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/upcoming");
                    }
                    if ($redirect == 'med_his') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("patient/medicalHistory?id=" . $data['patient']);
                    }
                    if ($redirect == 'request') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/request");
                    }
                    if ($redirect == 'pos') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("finance/invoice?id=" . $data['insertid']);
                    } if ($redirect == 'findep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }
                    if ($redirect == 'patdep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('patient/myPaymentHistory');
                    }
                    
                }
              
            } else {
               
                $tresponse = $response->getTransactionResponse();

                if ($tresponse != null && $tresponse->getErrors() != null) {
                    if ($redirect == '10') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment");
                    } if ($redirect == 'my_today') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/todays");
                    }
                    if ($redirect == 'upcoming') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/upcoming");
                    }
                      if ($redirect == 'frontend') {
                      $this->session->set_flashdata('feedback', lang('transaction_failed'));
                      redirect("frontend");
                      }
                    if ($redirect == 'med_his') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("patient/medicalHistory?id=" . $data['patient']);
                    }
                    if ($redirect == 'request') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("appointment/request");
                    }
                    if ($redirect == 'pos') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("finance/invoice?id=" . $data['insertid']);
                    } if ($redirect == 'findep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }
                    if ($redirect == 'patdep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('patient/myPaymentHistory');
                    }
                } else {

                    if ($redirect == 'pos') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect("finance/invoice?id=" . $data['insertid']);
                    } if ($redirect == 'findep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
                    }
                    if ($redirect == 'patdep') {
                        $this->session->set_flashdata('feedback', lang('transaction_failed'));
                        redirect('patient/myPaymentHistory');
                    }
                }
            }
        } else {
            if ($redirect == '10') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("appointment");
            }
            if ($redirect == 'my_today') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("appointment/todays");
            }
              if ($redirect == 'frontend') {
              $this->session->set_flashdata('feedback', lang('no_response'));
              redirect("frontend");
              } 
            if ($redirect == 'upcoming') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("appointment/upcoming");
            }
            if ($redirect == 'med_his') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("patient/medicalHistory?id=" . $data['patient']);
            }
            if ($redirect == 'request') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("appointment/request");
            }
            if ($redirect == 'pos') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect("finance/invoice?id=" . $data['insertid']);
            }
            if ($redirect == 'findep') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect('finance/patientPaymentHistory?patient=' . $data['patient']);
            }
            if ($redirect == 'patdep') {
                $this->session->set_flashdata('feedback', lang('no_response'));
                redirect('patient/myPaymentHistory');
            }
        }

       
    }

}
