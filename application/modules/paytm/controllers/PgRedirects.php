<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");


require_once(APPPATH . "libraries/paytmlib/config_paytm.php");
require_once(APPPATH . "libraries/paytmlib/encdec_paytm.php");

class PgRedirects extends MX_Controller {

	function __construct() {
		parent::__construct();
		
		
	}

	public function PaytmGateway($datapayment)
	{
		$this->session->set_userdata('course_id',$datapayment['insertid']);
		$checkSum = "";
		$paramList = array();

		$ORDER_ID = $datapayment['ref'];
		$CUST_ID = $datapayment['patient'];
		$INDUSTRY_TYPE_ID = $datapayment['industry_type'];
		$CHANNEL_ID = $datapayment['channel_id'];
		$TXN_AMOUNT = $datapayment['amount'];

		
		$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
		$paramList["CUST_ID"] = $CUST_ID;
		$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
		$paramList["CHANNEL_ID"] = $CHANNEL_ID;
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		$paramList["CALLBACK_URL"] = base_url()."pgResponses";

		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
		$paramList["CHECKSUMHASH"]=$checkSum;	

		$this->load->view('pgRedirect',['paramList'=>$paramList]);
	}


}
