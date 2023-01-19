<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Login extends CI_Controller
{       
  
  

  public function __construct() 
  {
    parent::__construct();
   // session_start();

    

     
      $this->date=date( 'Y-m-d H:i:s' );
    
    
  }
  
  public function index() 
  {
      $this->form_validation->set_rules( [
      ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'password', 'label' => 'Password', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
    
                    
    ] );
      $this->load->model("logins");
    
    if( $this->form_validation->run() == FALSE ) :
      

         $this->data['title']="Voting System | Login";
          $this->load->model("users");
          $this->data['countys']=$this->users->countys();
        // $this->data['roles']=$this->users->roles();
         $this->load->view( 'templates/lheader',$this->data);
         $this->load->view( 'login/login' );
         $this->load->view( 'templates/footer' );
    else :
      
      
       $user = $this->logins->loginings();

       //echo '<pre>'; print_r( $user); exit;

       if(!empty( $user )){
        if($user->Status==0){
           $this->session->set_flashdata( "error", "Your account has been deactivated. Kindly contact admin" );
           redirect( "login" );
        }
          if( password_verify( $this->input->post( "password" ), $user->Password ) )  : 

   
             $session_id=session_id();
             $this->load->model("users");
             $userrole = (array)$this->users->userroles($user->RoleId);
           
             if(!$userrole){
                 $this->session->set_flashdata( "error", "Your account is not set probably . Kindly contact Admin" );
                 redirect( "login" ); 
             }
             $this->session->set_userdata( $userrole );

            
            $data = array( 'is_logged_in' => '1', 'first_name' => $user->FirstName,'email'=>$user->Email,'lname'=>$user->LastName,'id'=>$user->UserID,'UserID'=>$user->UserID,'role_id'=>$user->RoleId,'phone'=>$user->Telephone,"password_set"=>$user->password_set,"WardId"=>$user->WardId,"SubCountyId"=>$user->SubCountyId,'PollingStream'=>$user->PollingStream ,"Session"=> $session_id,"Ip"=>$this->input->ip_address(),'CountyId'=>$user->CountyId);
          

            $this->session->set_userdata( $data );  
             $this->load->model("users");

            

              
             $ss=[

              "Session"=> $session_id,
              "User_Ip"=>$this->input->ip_address()

             ];

           $this->logins->update($user->UserID,$ss);
           $this->db->insert('audit', [
            'Description' => ''.$user->FirstName.' '.$user->LastName.' Logged In Successfully On Biller ',
            'SourceTable' => 'Users',
            'RecordKey'=> $user->UserID,
            'UserKey'=>  $user->UserID
            
          ] );

            /* $this->sendotp($user->Telephone, $user->FirstName);
             redirect( "login/verify" ); */

             if($this->session->userdata('Dashboard')==1) {
                  redirect( "dashboard" );
              }elseif($this->session->userdata('Billing')==1){
                  redirect( "biller" );
              }elseif($this->session->userdata('Receipting')==1){
                redirect( "receipting" );
              }else{
                 redirect( "dashboard/home" );
              }


              
        else :
          $this->session->set_flashdata( "error", "You have enter wrong password" );
          redirect( "login" ); 
        endif;
      }else{
        $this->session->set_flashdata( "error", " This email ". $this->input->post( "email" ) ." does not exist." );
          redirect( "login" ); 
      }
    
      
    endif;   
  }
  

  public function forget_password() 
  {
      $this->form_validation->set_rules( [
      ['field' => 'email', 'label' => 'Email', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                    
    ] );
    
    if( $this->form_validation->run() == FALSE ) :
       $this->data['title']="Voting System | Forget Password";
      $this->load->view( 'templates/lheader',$this->data);
       $this->load->view( 'login/forget_password' );
       $this->load->view( 'templates/lfooter' );
    else:
       $this->load->model("logins");
      $user = $this->logins->loginings();
       if(!empty( $user )){
        $password=mt_rand(11111,99999);
           $data=[
            'Password'=>password_hash($password, PASSWORD_BCRYPT ),
            'password_set'=>0,

           ];



          if($this->logins->reset_passwords($data,$user->Email)){

                   $this->sendsms($user->PhoneNumber,$password);


                 $this->session->set_flashdata( "success", "Your new password has been sent to your phone number - ".$user->PhoneNumber  );
                 redirect( "login" ); 

          }else{

              $this->session->set_flashdata( "error", "An error occurred while resetting your password. Kindly try again or contact admin" );
              redirect( "login/forget_password" ); 
          }

         }else{
          $this->session->set_flashdata( "error", " This email ". $this->input->post( "email" ) ." does not exist." );
          redirect( "login/forget_password" ); 
      }

    endif;

  }

        function to_curl($url, $data)
     {

     $headers = array
        (
          'Content-Type: application/json',
          'Content-Length: ' . strlen( json_encode($data) ) 
        );
     

      $ch = curl_init();  
      curl_setopt($ch, CURLOPT_URL, $url);  
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" ); 
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1 ); 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
       curl_setopt($ch, CURLOPT_HTTPHEADER,  $headers );
      
      curl_setopt($ch, CURLOPT_POST, 1); 
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  
      $output = curl_exec($ch); 

        
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      /*if($httpcode != 200)
        { 
        $this->session->set_flashdata( "error", "An error has ocurred . Try again" );       
        redirect('land');
        }
*/
      curl_close($ch); 
    return $output;
      
  }
  public function log_out() 
  {
       if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
       }
       $user_data = $this->session->userdata();

         $this->db->insert('audit', [
            'Description' => ''.$this->session->userdata('first_name').' '.$this->session->userdata('lname').' Logged out -  Biller ',
            'SourceTable' => 'Users',
            'RecordKey'=> $this->session->userdata('UserID'),
            'UserKey'=>  $this->session->userdata('UserID')
            
          ] );
        foreach ($user_data as $key => $value) {
            if ($key != 'is_logged_in' && $key != 'user_id' && $key != 'username' && $key != 'token') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
   
         redirect('login');

  }
  public function setpassword(){
    $this->data['title'] = "E-Contruction|Reset the password";
    $this->data['page'] = 'Home';
    $this->data['parent_page'] = "";
    $this->data['sub_title'] = "Reset password";
    $this->form_validation->set_rules( 'password', "Password", 'trim|required' );
    $this->form_validation->set_rules( 'newpassword', "New Password", 'trim|required|min_length[5]|max_length[10]' );
    $this->form_validation->set_rules( 'conpassword', "Confirm Password", 'trim|required|matches[newpassword]' );
    
    if($this->form_validation->run()==FALSE):
      $this->load->view( "templates/pheader", $this->data );
      $this->load->view( 'login/new_password' );    
      $this->load->view( "templates/footer" );
    else:
       $this->load->model("Users");
      if ($this->Users->get_oldpass()):
          if($this->Users->changepassword()):
            $this->session->set_flashdata( "success",'Password Successfully Changed');
            $this->session->set_userdata('password_set', 1);
            
            redirect('login');
            
          else:
            
            $this->session->set_flashdata( "error", "Error changing Password");
            redirect('login/setpassword');
          endif;
      
      else: 
        
        $this->session->set_flashdata( "error", "Old password is wrong");
        redirect('login/setpassword');
      endif;
    endif;  

  }

  private function sendsms($phone,$password){


     $this->load->library('sms');
      $message = "Your new password is - ".$password;
      $result = $this->sms->sendsms($phone, $message);
      if(isset($result)){
        return true;
      }else{
        return false;
      }


  }


  public function sendemail()
  {
    $this->load->library('emails');
    $message = array();
    $message['email'] = "kenyacounty48@gmail.com";
    $message['subject'] = "One Time Pin";
    $message['message'] = "Your one time password is ";
    $message['name'] = "County";
    $result = $this->emails->sendmail($message);
    echo $result;
    
  }
  public function logins()
  {
     redirect('login');
    
  }



  public function verify()
  {
    
    $this->form_validation->set_rules( 'otp', 'One Time Pin', 'trim|required' );
    if( $this->form_validation->run() == FALSE ) :
      $this->data['title'] = "login :: OTP";
      $this->data['phone'] =$this->maskPhoneNumber($_SESSION['phone']);
      $this->load->view( "templates/lheader", $this->data );
      $this->load->view( "login/verify" );
       
    else :
      if($this->input->post('otp') == $_SESSION['otp']){

              if($this->session->userdata('Dashboard')==1) {
                  redirect( "dashboard" );
              }elseif($this->session->userdata('Billing')==1){
                  redirect( "biller" );
              }elseif($this->session->userdata('Receipting')==1){
                redirect( "receipting" );
              }else{
                 redirect( "dashboard/home" );
              }

            


       // redirect('dashboard');
      }else{
        $this->session->set_flashdata( "loginerror", "Wrong OTP. Kindly contact admin or Resend OTP" );
            redirect( "login/verify" );

      }
    endif;
  }


private function maskPhoneNumber($number){
    
    $mask_number =  str_repeat("*", strlen($number)-4) . substr($number, -4);
    
    return $mask_number;
}


  private function generate_otp()
  {

  $otp =mt_rand(11,99).date('s');
    return  $otp;
  }
  public function sendotp($Telephone,$Name){
            $data['otp'] = $this->generate_otp();
             
            $this->session->set_userdata( $data );
             $this->load->model("curlings");
          // $Telephone="0708315149";

             $url = 'https://www.revenuesure.co.ke/RevenueSure/api/General/SendSms';
            $data1=[
                    "from"=>"Forget Password",
                    "to"=>$Telephone,
                    "message"=>"Hi ". $Name  ." Your OTP is - ".$data['otp']  ,
                  ];
                $results=$this->curlings->to_curl($url,$data1);


                /* $url = ' https://api.africastalking.com/version1/messaging';
                 $data1=[
                    "from"=>"REVENUESURE",
                    "to"=>$Telephone,
                    "message"=>"Your OTP is - ".$data['otp']  ,
                    'username'=>"Nouveta"
                  ];
          
              $results=$this->to_curl($url,$data1);
*/


   

  }

    public function getsubcountys()
     {
       $this->load->model("users");
      $getsubcountys= $this->users->constituencys($this->uri->segment(3));   
       $options = array();
       $options[""]='Select SubCounty'; 
      for( $i=0; $i<count($getsubcountys); $i++ ) :
        $getsubcounty = &$getsubcountys[$i];
        $options[$getsubcounty->ConstituencyCode] = $getsubcounty->ConstituencyName; 
      endfor;   
      echo json_encode( $options );
       
     }
     public function get_ward()
     {
       $this->load->model("users");
       $wards= $this->users->get_wards($this->uri->segment(3));
          
          $options = array();
          $options["0"]='Select Ward'; 
      for( $i=0; $i<count($wards); $i++ ) :
        $ward = &$wards[$i];
        $options[$ward->WardCode] = $ward->WardName; 
      endfor;   
      echo json_encode( $options );
       
     }
      public function polling()
      {
         $this->load->model("users");
         $wards= $this->users->pollings($this->uri->segment(3));
            
            $options = array();
            $options["0"]='Select Polling Center'; 
        for( $i=0; $i<count($wards); $i++ ) :
          $ward = &$wards[$i];
          $options[$ward->PollingSationCode] = $ward->PollingSationName; 
        endfor;   
        echo json_encode( $options );
       
      }
      public function Stream()
      {
         $this->load->model("users");
         $wards= $this->users->Streams($this->uri->segment(3),$this->uri->segment(4));
            
            $options = array();
            $options["0"]='Select Polling Streams'; 
        for( $i=0; $i<count($wards); $i++ ) :
          $ward = &$wards[$i];
          $options[$ward->StreamCode] = $ward->StreamNumber; 
        endfor;   
        echo json_encode( $options );
       
      }

  public function register()
  {
      
     $this->load->model("logins");
      if($this->logins->checkemails( $this->input->post("EmailAddress"))){
         exit(  json_encode(['status' => 'ERROR', 'success' => 'This email '. $this->input->post("EmailAddress") .' is already registered'   ]));

      }
      if($this->logins->checkemails( $this->input->post("IDNo"))){
         exit(  json_encode(['status' => 'ERROR', 'success' => 'This ID Number '. $this->input->post("IDNo") .' is already registered'   ]));

      }
      if($result=$this->logins->streams( $this->input->post("PollingStream"))){
         exit(  json_encode(['status' => 'ERROR', 'success' => 'Stream is already assign to '. $result->FirstName .' '. $result->LastName .' '. $result->OtherName .' . Contact Admin'   ]));

      }



    $password=  bin2hex(random_bytes(4));

      if($this->logins->registers($password)){


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