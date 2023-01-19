<?php 
if( !defined('BASEPATH') ) exit('No direct script access allowed');

class User extends CI_Controller 
{


	public function __construct()
	{
  		parent::__construct();
		
	/*if( $this->session->userdata('is_logged_in') !=1  ){
      
      redirect('login');
    }
    

     if($this->session->userdata('password_set')==0){
       redirect('login/setpassword');
    }
     if($this->session->userdata('Systemuser')!=1){
        	redirect('dashboard');

        }*/

        $this->load->model( 'logins' );

         if($checksession=$this->logins->checksession()){
          if($this->session->userdata('Session')!=$checksession->Session){
             $this->session->set_flashdata( "error", "Session has expired or Somebody else has already logged in using your account" );
                 redirect( "login" ); 

          }

         }else{
               redirect('logins');
         }
		$this->load->model("users");
		$this->data['parent_page'] = 'User';
		 $this->data['pagefor'] = 'User';
		
		
		
  	}

  	public function index()
	{

		$this->data['title'] = "Voting System|User";
		$this->data['page'] = 'User';
		$this->data['sub_title']="lists";
		$this->data['records']= $this->users->lists();
		$this->load->view( "templates/header", $this->data );
		$this->load->view( 'user/list' );		
		$this->load->view( "templates/footer" );
	}
	public function add()
	{
		$this->form_validation->set_rules( [

			['field' => 'FirstName', 'label' => 'First name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'LastName', 'label' => 'Last name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'CountyId', 'label' => 'County Code', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'RoleId', 'label' => 'Role ', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'SubCountyId', 'label' => 'Sub County', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'WardId', 'label' => 'Ward', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'IDNo', 'label' => 'Id Number', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'Telephone', 'label' => 'Mobile', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'Password', 'label' => 'Password', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			[
				'field' => 'EmailAddress', 
				'label' => 'EmailAddress', 
				'rules' => 'trim|required|is_unique[users.Email]',
				'errors' => ['required' => 'Please enter the %s.','is_unique' => 'This %s is already in use.',],
			],
			
										
		] );
		
		if( $this->form_validation->run() == FALSE ) :
			$this->data['title'] = "Voting System|User";
			$this->data['page'] = 'User';
		    $this->data['countys']=$this->users->countys();
			$this->data['roles']=$this->users->roles();
			$this->data['sub_title']="Add";
			$this->load->view( "templates/header", $this->data );
			$this->load->view( 'user/add' );		
			$this->load->view( "templates/footer" );
		else :
			if( $this->users->creates() ) : 
				$this->session->set_flashdata( "success",'User added successfully' );
				redirect( 'user' );
			else :
				$this->session->set_flashdata( "error", 'Error occurred while adding user ' );
				redirect( 'user' );
			endif;
			
		endif;	
		
	}



	public function edit()
	{	
		$this->data['title'] = "Voting System|User";
		$this->data['page'] = 'User';
		$this->data['sub_title'] = "Edit"; 
		$this->data['fa']="fa fa-edit";
		$this->form_validation->set_rules( [
		  ['field' => 'FirstName', 'label' => 'First name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'LastName', 'label' => 'Last name', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'RoleId', 'label' => 'Role ', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'SubCountyId', 'label' => 'Sub County', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'WardId', 'label' => 'Ward', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'CountyId', 'label' => 'Ward', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'IDNo', 'label' => 'Id Number', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
			['field' => 'Telephone', 'label' => 'Mobile', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
										
		] );
		if( $this->form_validation->run() == FALSE ) :
			
			$this->data['countys']=$this->users->countys();
			$this->data['record']= $this->users->detail_user($this->uri->segment(3));
			$this->data['subcountys']= $this->users->constituencys($this->data['record']->CountyId);
			$this->data['wards']= $this->users->get_wards($this->data['record']->SubCountyId);
			$this->data['user_roles']=$this->users->roles();
			$this->data['statuses']=$this->users->statuses();
			$this->load->view( "templates/header", $this->data );
			$this->load->view( 'user/edit' );		
			$this->load->view( "templates/footer" );
		else :
		
			if( $this->users->edit_users($this->uri->segment(3)) ) : 
				$this->session->set_flashdata( "success","user info edited successfully" );
				redirect( 'user' );
				
			else :
				
				redirect( 'user' );
			endif;
		endif;	
		
	}
	public function delete()
	 {

			if( $this->users->deletee($this->uri->segment(3)) ) : 
				$this->session->set_flashdata( "success","User deactivated successfully" );
				redirect( 'user' );
			else :
				$this->session->set_flashdata( "error", "Error occurs while deactivating user" );
				redirect( 'user' );
			endif;
			
	
	 } 

	 public function activate()
	 {
			if( $this->users->activate($this->uri->segment(3)) ) : 
				$this->session->set_flashdata( "success","User Activated successfully" );
				redirect( 'user' );
			else :
				$this->session->set_flashdata( "error", "Error occurs while activating user" );
				redirect( 'user' );
			endif;
			
	
	 } 
	 public function getsubcountys()
     {
      
       $getsubcountys= $this->users->constituencys($this->uri->segment(3));   
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
   
       $wards= $this->users->get_wards($this->uri->segment(3));
          
          $options = array();
          $options["0"]='Select Ward'; 
	    for( $i=0; $i<count($wards); $i++ ) :
	      $ward = &$wards[$i];
	      $options[$ward->WardCode] = $ward->WardName; 
	    endfor;   
	    echo json_encode( $options );
	     
       }
       

}