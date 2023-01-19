<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Role extends CI_Controller
{       
  
  

  public function __construct() 
  {
    parent::__construct();
    /* if( $this->session->userdata('is_logged_in') !=1  ){
      
      redirect('login');
    }*/
   /*  if($this->session->userdata('SetRole')!=1){
        $this->session->sess_destroy();
        $this->session->set_flashdata( "error", "Your account is not  allowed to view that page" );   
          redirect('login');

      }*/
    
    /* if($this->session->userdata('password_set')==0){
       redirect('login/setpassword');
    }*/

    
      $this->date=date( 'Y-m-d H:i:s' );
      $this->load->model("roles");
        $this->data['pagefor'] = 'User';
   


  }
  
    public function index()
  {
    $this->data['title'] = "E-Contraction|Role";
    $this->data['page'] = 'Role';
    $this->data['sub_title']="lists";
    $this->data['records']= $this->roles->lists();
    $this->load->view( "templates/header", $this->data );
    $this->load->view( 'role/list' );   
    $this->load->view( "templates/footer" );
  }
   public function add()
  {
    $this->form_validation->set_rules( [
       ['field' => 'Title', 'label' => 'Role Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      
    ] );
    
    if($this->form_validation->run() == FALSE ) :
      $this->data['title'] = "E-Contraction|Role";
      $this->data['page'] = 'Role';
      $this->data['sub_title']="Add";
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'role/add' );    
      $this->load->view( "templates/footer" );
    else :
      if( $this->roles->creates() ) : 
        $this->session->set_flashdata( "success",'System role added successfully' );
        redirect( 'role' );
      else :
        $this->session->set_flashdata( "error", 'Error occurred while adding system' );
        redirect( 'role' );
      endif;
      
    endif;  
    
  }
  public function edit()
  { 
    $this->data['title'] = "E-Contraction|Role";
    $this->data['page'] = 'Role';
    $this->data['sub_title']="Edit";
    $this->form_validation->set_rules( [

         ['field' => 'Title', 'label' => 'Role Name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      
                  
    ] );
    if( $this->form_validation->run() == FALSE ) :
       $this->data['record']= $this->roles->details($this->uri->segment(3));
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'role/edit' );   
      $this->load->view( "templates/footer" );
    else :
      if( $this->roles->edits($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","System role info edited successfully" );
        redirect( 'role' );
        
      else :
          $this->session->set_flashdata( "error", "Error occurs while editing system role" );
        redirect( 'role' );
      endif;
    endif;  
    
  }
  public function delete()
   {

      if( $this->roles->deletee($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success","System role deleted successfully" );
        redirect( 'role' );
      else :
        $this->session->set_flashdata( "error", "Error occurs while deleting system role" );
        redirect( 'role' );
      endif;
      
  
   } 
    public function systemrole()
    {
    $this->form_validation->set_rules( [
      ['field' => 'RoleID', 'label' => 'user ID', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                    
    ] );

    
    if( $this->form_validation->run() == FALSE ) :
      $this->data['title'] = "E-Contraction|Role";
      $this->data['page'] = 'Role';
      $this->data['sub_title']="Set Role";
      $this->data['record']=$this->roles->userroles($this->uri->segment(3));
      $this->load->view( "templates/header", $this->data );
      $this->load->view( 'role/systemrole' );   
      $this->load->view( "templates/footer" );
    else :
      if( $this->roles->updateuserroles($this->uri->segment(3)) ) : 
        $this->session->set_flashdata( "success",'Role updated  successfully' );
        redirect( 'role' );
      else :
        $this->session->set_flashdata( "error", 'Error occurred while setting role ' );
        redirect( 'role' );
      endif;
      
    endif;  
    
  }



  

 
}