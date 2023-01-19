<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Ward extends CI_Controller
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
      $this->load->model("wards");
       $this->data['pagefor'] = 'Setting';
  
  }
  
    public function index()
  {
    $this->data['title'] = "RevenuSure|Ward";
    $this->data['page'] = 'Ward';
    $this->data['sub_title']="lists";
    $this->data['records']= $this->wards->lists();
    $this->load->view( "templates/header", $this->data );
    $this->load->view( 'ward/list' );   
    $this->load->view( "templates/footer" );
  }
   public function add()
  {
    $this->form_validation->set_rules( [
       ['field' => 'WardName', 'label' => 'Ward Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
        ['field' => 'SubCountyID', 'label' => 'SubCounty Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
          [
        'field' => 'WardName', 
        'label' => 'Ward Name', 
        'rules' => 'trim|required|is_unique[wards.WardName]',
        'errors' => ['required' => 'Please enter the %s.','is_unique' => 'This %s is already in use.',],
      ],
      
    ] );
    
    if($this->form_validation->run() == FALSE ) :
      $this->load->model("subcountys");
      $this->data['subcountys']= $this->subcountys->lists();
      $this->data['title'] = "RevenuSure|Ward";
      $this->data['page'] = 'Ward';
      $this->data['sub_title']="Add";
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'ward/add' );    
      $this->load->view( "templates/footer" );
    else :
      if( $this->wards->creates() ) : 
        $this->session->set_flashdata( "success",'Ward added successfully' );
        redirect( 'ward' );
      else :
        $this->session->set_flashdata( "error", 'Error occurred while adding Ward' );
        redirect( 'ward' );
      endif;
      
    endif;  
    
  }
  public function edit()
  { 
    $this->data['title'] = "RevenuSure|Ward";
    $this->data['page'] = 'Ward';
    $this->data['sub_title']="Edit";
    $this->form_validation->set_rules( [

          ['field' => 'WardName', 'label' => 'Ward Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
        ['field' => 'SubCountyID', 'label' => 'SubCounty Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      
                  
    ] );
    if( $this->form_validation->run() == FALSE ) :
       $this->load->model("subcountys");
      $this->data['subcountys']= $this->subcountys->lists();
       $this->data['record']= $this->wards->details($this->uri->segment(3));
        $this->load->model("departments");
       $this->data['statuses']= $this->departments->statuses();
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'ward/edit' );   
       $this->load->view( "templates/footer" );
    else :
      if( $this->wards->edits($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","Wards info edited successfully" );
        redirect( 'ward' );
        
      else :
          $this->session->set_flashdata( "error", "Error occurs while editing ward" );
        redirect( 'ward' );
      endif;
    endif;  
    
  }
  public function delete()
   {

      if( $this->wards->deletee($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","Ward deleted successfully" );
        redirect( 'ward' );
      else :
        $this->session->set_flashdata( "error", "Error occurs while deleting ward" );
        redirect( 'ward' );
      endif;
      
  
   } 


  

 
}