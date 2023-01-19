<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require FCPATH.'vendor/autoload';
// use Twilio\Rest\Client;
class Sms
{
	var $shortCode ='';
	var $token = '';
	var $prefix = '';
	var $ch ='';
	// var $from ='';
	public function __construct()
	{
		
		
		   

	}
	
	public function sendsms($recipient, $sms_text)
	{
		$recipient = '254' . substr($recipient,-9,9);
     //$sms_text="test";
     //$recipient = '254' . 727261065;
        $url="http://ke.mtechcomm.com/bulkAPIV2/";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            'user'=>'mpatrick',
            'pass'=>'7cc58a436596929e02e724ba9e15d42c7cbe3916',
            'message ID'=>'msgID',
            'shortCode'=>'PayHive',
            'MSISDN'=>$recipient,
            'MESSAGE'=>$sms_text
        )
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
          return "cURL Error #: " . $err;
        } else {
          return $response;
        }

		
	
	}


}