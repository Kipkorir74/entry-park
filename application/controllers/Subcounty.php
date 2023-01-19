<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Subcounty extends CI_Controller
{       
  
  

  public function __construct() 
  {
    parent::__construct();
     if( $this->session->userdata('is_logged_in') !=1  ){
      
      redirect('login');
    }
    
     if($this->session->userdata('password_set')==0){
       redirect('login/setpassword');
    }

    
      $this->date=date( 'Y-m-d H:i:s' );
      $this->load->model("subcountys");
       $this->data['pagefor'] = 'Setting';
   


  }
  
    public function index()
  {
    $this->data['title'] = "RevenuSure|Sub County";
    $this->data['page'] = 'Sub County';
    $this->data['sub_title']="lists";
    $this->data['records']= $this->subcountys->lists();
    $this->load->view( "templates/header", $this->data );
    $this->load->view( 'subcounty/list' );   
    $this->load->view( "templates/footer" );
  }
   public function add()
  {
    $this->form_validation->set_rules( [
       ['field' => 'SubCountyName', 'label' => 'SubCounty Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       
      [
        'field' => 'SubCountyName', 
        'label' => 'SubCounty Name', 
        'rules' => 'trim|required|is_unique[subcountys.SubCountyName]',
        'errors' => ['required' => 'Please enter the %s.','is_unique' => 'This %s is already in use.',],
      ],
      
    ] );
    
    if($this->form_validation->run() == FALSE ) :
      $this->data['title'] = "RevenuSure|Sub County";
      $this->data['page'] = 'Sub County';
      $this->data['sub_title']="Add";
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'subcounty/add' );    
      $this->load->view( "templates/footer" );
    else :
      if( $this->subcountys->creates() ) : 
        $this->session->set_flashdata( "success",'Sub County added successfully' );
        redirect( 'subcounty' );
      else :
        $this->session->set_flashdata( "error", 'Error occurred while adding subcounty' );
        redirect( 'subcounty' );
      endif;
      
    endif;  
    
  }
  public function edit()
  { 
    $this->data['title'] = "RevenuSure|Sub County";
    $this->data['page'] = 'Sub County';
    $this->data['sub_title']="Edit";
    $this->form_validation->set_rules( [

         ['field' => 'SubCountyName', 'label' => 'SubCounty Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      
                  
    ] );
    if( $this->form_validation->run() == FALSE ) :
      $this->data['record']= $this->subcountys->details($this->uri->segment(3));
      $this->load->model("departments");
      $this->data['statuses']= $this->departments->statuses();
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'subcounty/edit' );   
      $this->load->view( "templates/footer" );
    else :
      if( $this->subcountys->edits($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","Sub County info edited successfully" );
        redirect( 'subcounty' );
        
      else :
          $this->session->set_flashdata( "error", "Error occurs while editing subcounty" );
        redirect( 'subcounty' );
      endif;
    endif;  
    
  }
  public function delete()
   {

      if( $this->subcountys->deletee($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","Sub County  deleted successfully" );
        redirect( 'subcounty' );
      else :
        $this->session->set_flashdata( "error", "Error occurs while deleting Sub County " );
        redirect( 'subcounty' );
      endif;
      
  
   } 


  

 
}