<?php 
if( !defined('BASEPATH') ) exit('No direct script access allowed');

class Home extends CI_Controller 
{


	public function __construct()
	{
  		parent::__construct();
		
		  $this->load->model("homes");
		 $this->url ='http://164.92.152.121/county/api/entry/';
		
  	}

  	public function index()
	{

		 $this->data['title'] = "Entry Park|Home";
		 $this->data['page'] = 'Home';
		 $this->data['sub_title']="";
		 $this->data['userId']=35;
		

		
		 
		 $types=json_decode($this->get_curl($this->url.'type'));

	     if(!empty($types)){
	          if($types->status==1){
	              $this->data['types'] = $types->response_data->types;
	              
	            }else{
	              $this->data['types'] = [];
	            
	            }
	      }else{
	        $this->data['types'] = [];
	        
	      }
	      $vehicletypes=json_decode($this->get_curl($this->url.'vehicletype'));

	     if(!empty($vehicletypes)){
	          if($vehicletypes->status==1){
	              $this->data['vehicletypes'] = $vehicletypes->response_data->vehicletypes;
	              
	            }else{
	              $this->data['vehicletypes'] = [];
	            
	            }
	      }else{
	        $this->data['vehicletypes'] = [];
	        
	      }
	     $persontypes=json_decode($this->get_curl($this->url.'persontype'));

	     if(!empty($persontypes)){
	          if($persontypes->status==1){
	              $this->data['persontypes'] = $persontypes->response_data->persontypes;
	              
	            }else{
	              $this->data['persontypes'] = [];
	            
	            }
	      }else{
	        $this->data['persontypes'] = [];
	        
	      }

	     $records=json_decode($this->get_curl_data($this->url.'billingitems?UserID='.$this->data['userId']));
	     if($records){

	     	if($records->status==1){
	     		 $this->data['addvehicle']=$records->addvehicle;
	     	     $this->data['NoOfPassenger']=$records->NoOfPassenger;
	     	     $this->data['TotalAssign']=$records->TotalAssign;
	     	     $this->data['SessionKey']=$records->response_data[0]->SessionKey;

	     	     if($records->TotalAssign==$records->NoOfPassenger ){
					 $this->data['CompletedAssigns']=1;
				}else{
					 $this->data['CompletedAssigns']=0;

				}
	     	   
	     	     $this->data['records']=$records->response_data;

	     	}else{
	     		 $this->data['addvehicle']=1;
	     	     $this->data['NoOfPassenger']="";
	     	     $this->data['TotalAssign']="";
	     	     $this->data['SessionKey']="";
	     	     $this->data['records']=[];
	     	      $this->data['CompletedAssigns']=0;
	     	}

	     }else{
	     	 $this->data['addvehicle']=1;
	     	 $this->data['NoOfPassenger']="";
	     	 $this->data['TotalAssign']="";
	     	 $this->data['SessionKey']="";
	     	  $this->data['records']=[];
	     	   $this->data['CompletedAssigns']=0;
	     	  

	     }





		
		$this->load->view( "templates/lheader", $this->data );
		$this->load->view( 'home/home' );		
		$this->load->view( "templates/lfooter" );
	}
	 function get_curl( $url)
    {
     

     $request_headers = array
        (
          'Content-Type: application/json'

        );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $output = curl_exec($ch);

      if (curl_errno($ch))
        {
        print "Error: " . curl_error($ch);
        }
        else
        {
        // Show me the result
        return $output;

       

      }
    }

	 function get_curl_data( $url)
    {
      
       $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => $url ,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
          'Cookie: ci_session=v45i6r6at1l3abst5totbo99qgivd4tl'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);
      return $response;

      
    }

   public function billing()
  {
       
    $this->form_validation->set_rules( [

      ['field' => 'PlateNumber', 'label' => 'PlateNumber', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'BillType', 'label' => 'Bill Type', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'Charge', 'label' => 'Charge', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
 
            
                
    ] );
    if( $this->form_validation->run() == FALSE ) :   
        redirect( 'home' ); 
    else :

    $sending=[
                'PlateNumber'=>$this->input->post("PlateNumber"),
                'BillType'=>$this->input->post("BillType"),
                'UserID'=>$this->input->post("userId"),
                'EffectiveDate'=>$this->input->post("EffectiveDate"),
                'NoOfPassenger'=>$this->input->post("NoOfPassenger"),            
	         ];
	  $url=$this->url.'billingvehicle';
	  if($addvehicle=json_decode($this->post_curl($url,$sending))){
	  	

		  	if($addvehicle->status==1){
		  		 $this->session->set_flashdata( "success",$addvehicle->message );
                 redirect( 'home');

		  	}else{
		  		 $this->session->set_flashdata( "error",$addvehicle->message );
                 redirect( 'home');

		  	}


	  }else{
	  	  $this->session->set_flashdata( "error","An error occured while adding vehicle. Try again" );
          redirect( 'home');
	  }


     
    endif;  

  }
  public function assigning()
  {
       
    $this->form_validation->set_rules( [

       ['field' => 'BillType', 'label' => 'BillType', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'ChargeAmount', 'label' => 'Charge Amount', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'IdNumber', 'label' => 'IdNumber', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'FullName', 'label' => 'FullName', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       //['field' => 'FullName', 'label' => 'FullName', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
     
            
                
    ] );
    if( $this->form_validation->run() == FALSE ) :  
    	   redirect( 'home' ); 
       
    else :

    
    	$sending=[
                'SessionKey'=>$this->input->post("SessionKey"),
                'UserID'=>$this->input->post("userId"),
                'FullName'=>$this->input->post("FullName"),
                'IdNumber'=>$this->input->post("IdNumber"),
                'BillType'=>$this->input->post("BillType"),            
	         ];
	  $url=$this->url.'assignvehicle';
	  if($addvehicle=json_decode($this->post_curl($url,$sending))){
	  	

		  	if($addvehicle->status==1){
		  		 $this->session->set_flashdata( "success",$addvehicle->message );
                 redirect( 'home');

		  	}else{
		  		 $this->session->set_flashdata( "error",$addvehicle->message );
                 redirect( 'home');

		  	}

	  }else{
	  	  $this->session->set_flashdata( "error","An error occured while assigning passanger. Try again" );
          redirect( 'home');
	  }



    endif;  

  }

  function post_curl($url, $data)
  {
    $server_output=[];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $server_output = curl_exec($ch);

      curl_close ($ch);
   

       return $server_output;

      
      
     }
       public function getamount()
       {
         
         
         
         


        $sending=[
                'BillType'=>$this->input->post("BillType"),
                         
	         ];
	   $url=$this->url.'getamount';
	     if($Amount=json_decode($this->post_curl($url,$sending))){
	     	/*echo "<pre>";
	     	print_r($Amount);
	     	exit;*/



        
         	if($Amount->status==1){
         		echo json_encode( $Amount->BillAmount );
         		exit;
         	}else{
         		  $Amount=0;
         		echo json_encode( $Amount );
         		exit;

         	}
            
         }else{
         	$Amount=0;
         
            echo json_encode( $Amount );
         }
         
          
          
          
      
       }


         /*public function generate()
      {

     
           if($result=$this->billings->generates($this->input->post('BillNumber')) ) {

        

        exit( json_encode(['status' => 'OK', 'success' => 'Confirm the billing information','responsedata'=>$result ]));
          
        }else{

           exit( json_encode(['status' => 'ERROR', 'success' => 'Error occurs while creating bill. Try again']));

             
    
        }
       
      }*/

       public function generate()
       {
         
        $sending=[
                'SessionKey'=>$this->input->post("SessionKey"),
                'UserID'=>$this->input->post("UserID")      
	         ];
	   $url=$this->url.'generatebill';
	     if($record=json_decode($this->post_curl($url,$sending))){

	     	/*echo '<pre>';
	     	print_r($record->response_data->billinfo);
	     	exit;*/


	     	
         if($record->status==1){

         		exit( json_encode(['status' => 'OK', 'success' => 'Confirm the billing information','responsedata'=>$record->response_data->billinfo]));
		  		 

		  	}else{
		  		  exit( json_encode(['status' => 'ERROR', 'success' => 'Error occurs while creating bill. Try again']));
		  	
		  	}

	  }else{
	  	    exit( json_encode(['status' => 'ERROR', 'success' => 'Error occurs while creating bill. Try again']));
	  }
         
          
          
          
      
       }






    
  
































	public function getcounty()
     {
      
      $getsubcountys= $this->homes->getcountys($this->uri->segment(3));   
       $options = array();
       $options["0"]='Select County'; 
      for( $i=0; $i<count($getsubcountys); $i++ ) :
        $getsubcounty = &$getsubcountys[$i];
        $options[$getsubcounty->CountyCode] = $getsubcounty->CountyName; 
      endfor;   
      echo json_encode( $options );
       
     }
    public function getsubcountys()
     {
      
      $getsubcountys= $this->homes->constituencys($this->uri->segment(3));   
       $options = array();
       $options["0"]='Select SubCounty'; 
      for( $i=0; $i<count($getsubcountys); $i++ ) :
        $getsubcounty = &$getsubcountys[$i];
        $options[$getsubcounty->ConstituencyCode] = $getsubcounty->ConstituencyName; 
      endfor;   
      echo json_encode( $options );
       
     }
     public function get_ward()
     {
    
       $wards= $this->homes->get_wards($this->uri->segment(3));
          
          $options = array();
          $options["0"]='Select Ward'; 
      for( $i=0; $i<count($wards); $i++ ) :
        $ward = &$wards[$i];
        $options[$ward->WardCode] = $ward->WardName; 
      endfor;   
      echo json_encode( $options );
       
     }
      public function register()
	  {
	      
	     
	      if($this->homes->checkemails( $this->input->post("EmailAddress"))){
	         exit(  json_encode(['status' => 'ERROR', 'success' => 'This email '. $this->input->post("EmailAddress") .' is already registered'   ]));

	      }
	      if($this->homes->checkidnumbers( $this->input->post("IDNo"))){
	         exit(  json_encode(['status' => 'ERROR', 'success' => 'This ID Number '. $this->input->post("IDNo") .' is already registered'   ]));

	      }
	      if($this->homes->checkmobile( $this->input->post("Telephone"))){
	         exit(  json_encode(['status' => 'ERROR', 'success' => 'This Phone Number '. $this->input->post("Telephone") .' is already registered'   ]));

	      }




	       $password=  bin2hex(random_bytes(4));

	      if($this->homes->registers($this->input->post("IDNo"))){

	            //$message=" Dear ".$this->input->post("FirstName") . "  ". $this->input->post("LastName") .", Your Username is - ". $this->input->post("EmailAddress") ." and password ". $this->input->post("IDNo").". Please click https://verifyingfast.com/voting to login\n" ;

	         // $this->sendsmss($this->input->post("Telephone"), $message);


	          /*  $config = Array(
	            'protocol' => 'smtp',
	            'smtp_host' => 'ssl://smtp.googlemail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'kenyacounty48@gmail.com',
	            'smtp_pass' => 'smadlo1988',
	            'mailtype'  => 'html',
	            'charset'   => 'iso-8859-1'
	        );
	        $this->load->library('email', $config);
	        $this->email->set_newline("\r\n");
	        $this->message['message'] = "";
	        $this->message['name'] =ucwords(strtolower($this->input->post("FirstName")));
	        $this->message['subject'] = "New Registration";
	        $this->email->from('kenyacounty48@gmail.com', 'kenyacounty48@gmail.com');
	        $this->email->to("mpatrickmungai@gmail.com"); 
	        $body =$this->load->view('templates/email_otp.php', $this->message,True); 
	        $this->email->subject($this->message['subject']);
	        $this->email->message($body);
	        $this->email->send();*/


	        exit( json_encode(['status' => 'OK', 'success' => 'Register successfully and Password is your National Id ']));
	          

	      }else{
	          exit(  json_encode(['status' => 'ERROR', 'success' => 'Fail to register'  ]));
	          
	      }
	        
	    
	    
	  }
	
}