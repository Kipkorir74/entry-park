<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails
{
	protected $config = null;
	protected $CI = null;
	protected $email_instance = null;
	public function __construct()
	{
		/*$this->CI = & get_instance();
		$this->config = Array(
	    'protocol' => 'smtp',
	    'smtp_host' => 'smtp.gmail.com',
	    'smtp_port' => 465,
	    'smtp_user' => 'kenyacounty48@gmail.com',
	    'smtp_pass' => 'smadlo1988',
	    'mailtype'  => 'html', 
	    'charset'   => 'iso-8859-1'
		);
	
		$this->CI->load->library('email', $this->config);
		 print_r($this->email_instance);
		$this->CI->email->set_newline("\r\n");
		$this->CI->email->from('kenyacounty48@gmail.com', 'County');*/

	}
	public function sendmail($email_data)
	{

		/*$data['message'] = $email_data['message'];
		$data['name'] = $email_data['name'];
		$data['subject'] = $email_data['subject'];
		$email_address = $email_data['email'];
		$this->CI->email->to($email_address); 
        echo $body = $this->CI->load->view('templates/email_otp.php',$data,True); 
       
        $this->CI->email->subject($email_data['subject']);
        $this->CI->email->message($body);  

        if(!$this->CI->email->send()):
        	return false;
        endif;
        return true;*/

	}
		
		
		
			
				
	

}