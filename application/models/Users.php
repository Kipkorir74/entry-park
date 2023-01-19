<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Users extends CI_Model {
		
		public function __construct(){
			
			$this->table="users";
			$this->datetime=date("Y-m-d H:i:s");
		    $this->id=$this->session->userdata('id');
		    
		    $this->first_name=$this->session->userdata('first_name');
		    
		}

		public function creates()
		{
			
			$this->db->trans_begin();
			if($this->db->insert( $this->table, [
				
				'DateCreated' => $this->datetime,
				'FirstName' => $this->input->post("FirstName"),
				'LastName' => $this->input->post("LastName"),
				'OtherName' => $this->input->post("OtherName"),
				'PhoneNumber' => '0'.substr($this->input->post("Telephone"),-9,9 ),
				'Email' => $this->input->post("EmailAddress"),
				'RoleId'=>$this->input->post("RoleId"),
				'UserType'=>2,
				'Idnumber'=>$this->input->post("IDNo"), 
				'CountyId'=>$this->input->post("CountyId"),
				'SubCountyId'=>$this->input->post("SubCountyId"), 
				'WardId'=>$this->input->post("WardId"), 
				'DateModified'=>$this->datetime,
				'CreatedBy'=>$this->id, 
				'ModifiedBy'=>$this->id,   			
				'Password' =>  password_hash($this->input->post("Password"), PASSWORD_BCRYPT ),
				
			] )){
				  $id = $this->db->insert_id();
			
				  $this->db->insert('audit', [

						'Description' => $this->first_name ." added user ".  $this->input->post("FirstName") ." ". $this->input->post("LastName"),
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );

				    $this->db->where('id', $id);
					$data=array('UserID'=>$id);
			        $this->db->update($this->table, $data);

			      
			     
			       if ($this->db->trans_status() === FALSE)
	 				{
	       				 $this->db->trans_rollback();
	       				 return false;
					}
					else
					{
	      				  $this->db->trans_commit();
	      				     return true;
					}


				 
				
				}else{
					return false;
				}

				
				
				
			
		}

		public function roles()
		{
			$rows = [];
			$this->db->select('*' )
					->from('roles')->where(array('id>='=>2));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}

			return( $rows );	
				
		}
		public function countys()
		{
			$rows = [];
			$this->db->select('*' )
					->from('countys');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
		public function statuses()
		{
			$rows = [];
			$this->db->select('*' )
					->from('statuses');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

		public function lists()
		{
			$rows = [];
			$this->db->select('u.*,r.Title as role,w.WardName,w.CountyName,ConstituencyName' )
					->from($this->table .' u')
					->join('wards w','u.WardId=w.WardCode')
		            ->join('roles r','u.RoleId=r.id')
					->order_by('u.id','desc')->where(array('u.RoleId>='=>2));
			//$this->db->where( array('u.status'=>1),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			

			return( $rows );	
				
		}
		public function list2s()
		{
			$rows = [];
			$this->db->select('u.*,r.Title as role,w.WardName ,w.WardName,w.CountyName,w.ConstituencyName' )
					->from($this->table .' u')
					->join('wards w','u.WardID=w.WardID')
		            ->join('roles r','u.RoleID=r.id')
					->order_by('u.UserID','desc');
			$this->db->where( array('u.status'=>1,'u.RoleID'=>7),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			

			return( $rows );	
				
		}


	public function logs()
		{
			$rows =[];
			$this->db->select('*' )->from("audit");
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}

			//print_r($rows);exit;
	
		    	return( $rows );	
			
				
		}

		public function detail_user($id){
			$row = array();		
			$this->db->select('*');
			$this->db->from( $this->table);	
			$this->db->where('userId',$id);
			$query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}		
			return( $row );
		}

	   public function user_by_email($email){
			$row = array();		
			$this->db->select('*');
			$this->db->from( $this->table);	
			$this->db->where('Email',$email);
			$query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}		
			return( $row );
		}
		public function edit_users($id)
		{
			
			
			 $data = array(
				
			
				'FirstName' => $this->input->post("FirstName"),
				'LastName' => $this->input->post("LastName"),
				'OtherName' => $this->input->post("OtherName"),
				'PhoneNumber' => '0'.substr($this->input->post("Telephone"),-9,9 ),
				'Email' => $this->input->post("EmailAddress"),
				'RoleId'=>$this->input->post("RoleId"),
				'Idnumber'=>$this->input->post("IDNo"), 
				'CountyId'=>$this->input->post("CountyId"),
				'SubCountyId'=>$this->input->post("SubCountyId"), 
				'WardId'=>$this->input->post("WardId"), 
				'Status' => $this->input->post("Status"),
				'DateModified'=>$this->datetime,
				'ModifiedBy'=>$this->id, 

				);
			  $this->db->where('UserID',$id);
			  if($this->db->update($this->table,  $data)){
			  		$this->db->insert('audit', [
			  			'Description' => $this->first_name ." edited user ".  $this->input->post("FirstName") ." ". $this->input->post("LastName"),
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					 return true;
			  }else{
				 return false;
			  }	
		}

			public function edit_user($id,$phone)
		{
			
			
			 $data = array(
				'Telephone' => '0'.substr($phone,-9,9 ),

				);

			  $this->db->where('UserID',$id);
			  if($this->db->update($this->table,  $data)){
			  		$this->db->insert('audit', [
			  			'Description' => $this->first_name ." edited user ".  $this->input->post("FirstName") ." ". $this->input->post("LastName"),
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					 return true;
			  }else{
				 return false;
			  }	
		}


		
	
		public function deletee($id)
		{
			 $data = array(
						'DateModified' => $this->datetime,
						'ModifiedBy'=>$this->id, 
						'status' => 0,	
				);

			  $this->db->where('Id',$id);
			  if($this->db->update($this->table,  $data)){
			  	
			  		$this->db->insert('audit', [
			  			'Description' => $this->first_name ." Deactivated User ",
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					return true;
			  }else{
				 return false;
			  }	
		}

		public function activate($id)
		{
			 $data = array(
						'DateModified' => $this->datetime,
						'ModifiedBy'=>$this->id, 
						'status' => 1,	
				);

			  $this->db->where('Id',$id);
			  if($this->db->update($this->table,  $data)){
			  	
			  		$this->db->insert('audit', [
			  			'Description' => $this->first_name ." Activated User ",
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					return true;
			  }else{
				 return false;
			  }	
		}
		public function changepassword(){
		$this->db->where('UserID',$this->session->userdata('UserID'));
		$data=array('Password' => password_hash( $this->input->post( "newpassword" ), PASSWORD_BCRYPT ),
			'password_set' =>1,
			);
			if($this->db->update($this->table, $data)):
				return true;
			else:
				return false;
			endif;

		}
		public function get_oldpass(){
			$row=array();
         
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where(['UserID'=>$this->session->userdata('UserID')]);
			$query = $this->db->get();
			$row = $query->row();
      
			if ($query->num_rows()>0){
				$password= $row->Password;
				if(( password_verify( $this->input->post( "password" ), $password ) )){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				$query->free_result();
				return FALSE;
			}


		}
		public function constituencys($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from('constituencys')->where(array('CountyCode'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

		public function get_wards($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from('wards')->where(array('ConstituencyCode'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

		public function pollings($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from(' pollingcenters')->where(array('WardCode'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
/*
		public function pollings($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from('pollings')->where(array('WardCode'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}*/

		public function Streams($WardCode,$PollingSationCode)
		{
			$rows = [];
			$this->db->select('*' )
					->from('stations')->where(array('WardCode'=>$WardCode,'PollingSationCode'=>$PollingSationCode),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
		public function userroles($id){
			$row = array();		
			$this->db->select('*');
			$this->db->from( "rolesettings");	
			$this->db->where('RoleID',$id);
			$query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}		
			return( $row );
		}

	   public function userfroms(){
			$row = array();		
			$this->db->select('*');
			$this->db->from( "userfroms");	
		
			$query = $this->db->get();
			if($query->result()){
				$row = $query->result();	
				$query->free_result();	
			}		
			return( $row );
		}
		
		

       
	
		
		
		
		
}