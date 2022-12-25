<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");


require_once(APPPATH . "libraries/paytm/config_paytm.php");
require_once(APPPATH . "libraries/paytm/encdec_paytm.php");

class PgResponses extends MX_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('student');
        $this->load->model('course');
	$this->load->model('payment');       
    }

	public function index()
	{

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; 


$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); 


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		
		if (isset($_POST) && count($_POST)>0 )
		{ 
			$userData= array(
				'order_id' => $_POST['ORDERID'],
				'student_id' => $this->session->userdata('userId'),
				'course_id' => $this->session->userdata('course_id'),
				'txn_id' => $_POST['TXNID'],
				'paid_amt' => $_POST['TXNAMOUNT'],
				'mid' => $_POST['MID'],
				'payment_mode' => $_POST['PAYMENTMODE'],
				'currency' => $_POST['CURRENCY'],
				'txn_date' => $_POST['TXNDATE'],
				'gateway_name' => $_POST['GATEWAYNAME'],
				'bank_txn_id' => $_POST['BANKTXNID'],
				'bank_name' => $_POST['BANKNAME'],
				'check_sum_hash'=> $_POST['CHECKSUMHASH'],
				'status' => $_POST['STATUS']
			);
			$insert=$this->payment->insert($userData); 
			if($insert)
			{
				redirect('payment_success'); 
			}
			
		}
	}
	else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}



}
else {
	echo "<b>Checksum mismatched.</b>";
	
}
}
}
