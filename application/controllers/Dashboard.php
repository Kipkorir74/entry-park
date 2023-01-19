<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Dashboard extends CI_Controller
{       
  
  

  public function __construct() 
  {
    parent::__construct();
    //session_start();




      
     $this->date=date( 'Y-m-d H:i:s' );
     $this->data['parent_page'] = '';
     if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
     }
      if($this->session->userdata('password_set')==0){
           redirect('login/setpassword');
      }


        $this->load->model( 'logins' );

         if($checksession=$this->logins->checksession()){
          if($this->session->userdata('Session')!=$checksession->Session){
             $this->session->set_flashdata( "error", "Session has expired or Somebody has already logged in using your account" );
                 redirect( "login" ); 

          }

         }else{
               redirect('login');
         }

        
       

      /*if($this->session->userdata('Dashboard')==1) {
                  redirect( "dashboard" );
      }elseif($this->session->userdata('Billing')==1){
                  redirect( "biller" );
      }elseif($this->session->userdata('Receipting')==1){
                redirect( "biller" );
      }else{
                 redirect( "dashboard/home" );
      }*/
                 

     $this->load->model( 'dashboards' );
     $this->data['pagefor'] = 'Home';




    
  }
  
  public function index() 
  {
       $this->load->model( 'votes' );
      $this->data['title'] = "Voting System|President";
       $this->data['page'] = 'President';
       $this->data['sub_title'] = "Votes"; 
       $this->data['presidenttotal']= $this->votes->presidenttotals();
       $this->data['presidents']= $this->votes->presidents();
       $this->data['caststreams']= $this->votes->castedstreams();
       $this->data['totalstreams']= $this->votes->totalstreams();
       $this->load->view( 'templates/header',$this->data);
       $this->load->view( 'vote/presidentvotes');
       $this->load->view( 'templates/footer' );  

  }
   public function home() 
  {
 
       $this->data['title'] = "Voting System|President";
       $this->data['page'] = 'Home';
       $this->data['sub_title'] = "";  
       $this->load->view( 'templates/header',$this->data);
       $this->load->view( 'common/home');
       $this->load->view( 'templates/footer' ); 

  }


  public function index1() 
  {
 
       $this->data['title']="RevenueSure|Home";
       $this->data['page'] = 'Home';
       $this->data['sub_title'] = "Dashboard";  
       $this->data['fa']="fa fa-user";
       $this->data['mpesa'] =$this->dashboards->mpesatransactions();
        $this->data['todaytransactions'] =$this->dashboards->todaytransactions();
       $this->data['bank'] =$this->dashboards->banktransactions();
       $this->data['thisweeks'] =$this->dashboards->thisweeks();
       $this->data['thismonth'] =$this->dashboards->thismonth();
       $this->data['perincometypes']=$this->dashboards->Perincometypes();
       $this->data['payments']=$this->dashboards->payment_receiveds();
      $this->data['subcountys']=$this->dashboards->subcountys();
       $this->load->view( 'templates/header',$this->data);
       $this->load->view( 'common/dashboard1');
       $this->load->view( 'templates/footer' ); 

  }

    public function session() 
  {
        $this->load->model("logins");
        return $this->logins->checksession()->Session;
      
     
  }


   
}