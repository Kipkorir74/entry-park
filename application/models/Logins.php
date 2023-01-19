<?php 
if( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Logins extends CI_Model 
{	
	protected $is_logged_in;	
	
	public function __construct() 
	{		
		parent::__construct();
		$this->table="users";
		$this->datetime=date("Y-m-d H:i:s");
		$this->id=1;
		    
		$this->first_name="Self Registration";
		
	}	
	
	public function loginings()
	{
		$row = array();
		$this->db->select( '*' );
		$this->db->from($this->table );
		$this->db->where( array('Email'=>$this->input->post( "email" )),'AND' );
		$query = $this->db->get();
		if($query->row()){
			$row = $query->row();
			$query->free_result();
		}
		
		return( $row );	
	}

		
	
	public function logout()
	{
		$this->is_logged_in = $this->session->userdata( 'is_logged_in' );	
		$data = array( 'is_logged_in', 'user_id', 'user_role_id', 'user', 'id_no', 'service_no', 'station_id' );		
		$this->session->unset_userdata( $data );
		$this->session->sess_destroy();
		
		if( $this->is_logged_in() == true )	
			return false;
		else
			return true;		
	}	
		
	public function is_logged_in()	
	{
		if( !isset( $this->is_logged_in ) or $this->is_logged_in != true  )		
			return false;
		else 
			return true;		
	}
	
	
	public function change_password()
	{
		#$username = $this->input->post("username");
		$password = $this->input->post("password");
		$password1 = $this->input->post("password1");
		$user_id=$_SESSION['user_id'];
		$array=array('id'=>$user_id,'active'=>0);
		$this->db->where($array);
		$this->db->select( '*' )->from( 'users' );
		$query = $this->db->get();
			
		if( $query->num_rows() == 1 ) :
		 
			$result = $query->row();
			$query->free_result();
			$hash = $result->hash;
			$stored_password = $result->password;
			$password = hash( 'sha256', $hash . $password );
			
			if( $stored_password == $password ) : 
				$password = hash( 'sha256', $hash . $password1);
				$data=array(
				'password' =>$password,
				);

				$this->db->where( 'id', $user_id );
				if( $this->db->update('users', $data )):
					return true;
				else:
					return false;
				endif;				
			else :
				return false;				
			endif;
			
		else :	
			return false;
		endif;	
	}

	public function checkmails()
	{
		$row = array();
		$this->db->select( '*' );
		$this->db->from('sys_users' );
		$this->db->where( array('email'=> $this->input->post( "email" )),'AND' );
		$query = $this->db->get();
		if($query->result()){
	
			$row = $query->row();
			$query->free_result();
		}
		return( $row );
		
		
	}
	public function checkmobile()
	{
		
		$phone = '0'.substr($this->input->post( "email" ),-9,9);
		$row = array();
		$this->db->select( '*' );
		$this->db->from('sys_users' );
		$this->db->where( array('phone_number'=> $phone),'AND' );
		$query = $this->db->get();
		if($query->result()){
	
			$row = $query->row();
			$query->free_result();
		}
		return( $row );
		
		
	}
	public function reset_passwords($data,$email)
		{
			
			 $this->db->where('Email',$email);
			 if($this->db->update($this->table,  $data)){
			 	return true;
			 }else{
			 	return false;
			 }
			
				
			
		}

			public function update($id,$data)
		{
			
			 $this->db->where('id',$id);
			 if($this->db->update($this->table,  $data)){
			 	return true;
			 }else{
			 	return false;
			 }
			
				
			
		}

		public function checksession()
	{
		$row = array();
		$this->db->select( 'Session,id' );
		$this->db->from($this->table );
		$this->db->where( array('id'=>$this->session->userdata('UserID'),'AND' ));
		$query = $this->db->get();
		if($query->row()){
			$row = $query->row();
			$query->free_result();
		}
		
		return( $row );	
	}

	public function logining1s()
	{
		$row = array();
		$this->db->select( '*' );
		$this->db->from($this->table );
		$this->db->where( array('Email'=>$this->input->post( "email" )),'AND' );
		$query = $this->db->get();
		if($query->row()){
			$row = $query->row();
			$query->free_result();
		}
		
		return( $row );	
	}

	public function countys()
	{
		$rows = array();
		$this->db->select( '*' );
		$this->db->from('demographics')->group_by('countyCode');
		$query = $this->db->get();
		if($query->result()){
			$rows = $query->result();
			$query->free_result();
		}
		return( $rows );
		
	}

	public function get_subcountys($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from('demographics')->where(array('countyCode'=>$id),'AND')->group_by('subCountyCode');
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
					->from('demographics')->where(array('subCountyCode'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

		public function registers($password)
		{
		   $row= [];
			$this->db->select('StreamNumber')
					->from('stations')->where(array('StreamCode'=>$this->input->post("PollingStream")),'AND');
			$query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}		
			if(!$row){

				return false;
			}
			$StationId=$row->StreamNumber;

			$this->db->trans_begin();
			if($this->db->insert( $this->table, [
				'DateCreated' => $this->datetime,
				'FirstName' => $this->input->post("FirstName"),
				'LastName' => $this->input->post("LastName"),
				'OtherName' => $this->input->post("OtherName"),
				'PhoneNumber' => '0'.substr($this->input->post("Telephone"),-9,9 ),
				'Email' => $this->input->post("EmailAddress"),
				'RoleId'=>1,
				'UserType'=>1,
				'Idnumber'=>$this->input->post("IDNo"), 
				'CountyId'=>$this->input->post("CountyId"),
				'SubCountyId'=>$this->input->post("SubCountyId"), 
				'WardId'=>$this->input->post("WardId"),
				'PollingCenterId'=>$this->input->post("PollingCenterId"),
				'PollingStream'=>$this->input->post("PollingStream"), 
				'StationId'=>$StationId,
				'DateModified'=>$this->datetime,
				'CreatedBy'=>1, 
				'ModifiedBy'=>1,   			
				'Password' =>  password_hash($this->input->post("IDNo"), PASSWORD_BCRYPT ),
			] )){
				  $id = $this->db->insert_id();
				  $last_id = $this->db->insert_id();
			
				  $this->db->insert('audit', [

						'Description' => $this->first_name ." as ".  $this->input->post("FirstName") ." ". $this->input->post("LastName"),
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
				    $this->db->where('id', $id);
					$data=array('UserID'=>$id);
					 $this->db->update($this->table, $data);
			      
					   /*if($this->input->post("RoleId") >=4){

					   	    $this->load->library('upload');
							if(isset($_FILES) and $_FILES['documents']['error'][0]!=4){
				                $count = count($_FILES['documents']['name']);

				                $files = $_FILES;
				                for($i=0; $i<$count; $i++):
				                    $_FILES['documents']['name'] = $files['documents']['name'][$i];
				                    $_FILES['documents']['type'] = $files['documents']['type'][$i];
				                    $_FILES['documents']['tmp_name'] = $files['documents']['tmp_name'][$i];
				                    $_FILES['documents']['error'] = $files['documents']['error'][$i];
				                    $_FILES['documents']['size'] = $files['documents']['size'][$i];
				                    $uploadPath = FCPATH."uploads/registration";
				                    $config['upload_path'] = $uploadPath;
				                    //$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|csv|docx|doc|csv|';
				                    $config['allowed_types'] = '*';
				                    $config['max_size'] = 15000000000000000;
				                    $config['max_width'] = 29200000000;
				                    $config['max_height'] = 2080000000;
				                    $config['overwrite'] = TRUE;
				                    $config['file_name'] = str_replace(' ','', $last_id.$files['documents']['name'][$i]);
				                   
				                    $this->upload->initialize($config);
				                   // print_r($config['upload_path']);exit;
				                    if($this->upload->do_upload("documents")){
				                    	  
				                    	$fileData = $this->upload->data();
				                    	$data = [
				                    		'Titles'=>$fileData['file_name'],
				                            'UserID'=>$last_id,
				                            'DateCreated' => $this->datetime,
				                            'DateCreated' => $this->datetime,

				                          ];
				                        $this->db->insert('documents', $data);
				                            
				                    }else{

				                       //$error= array('error' => $this->upload->display_errors()); 
				                         return false;
				                    }
				                endfor;
					        if (!empty($error) and count($error) > 0):
					            #print_r($error);exit;
					            //return $error;
					         return false;
				           else:
				            
				            $this->db->trans_complete();
					        if ($this->db->trans_status()==True):
					            return true;
					           else:
					            return false;
					           endif;
				             endif;  

                            }




					   }*/
			     
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

  	public function checkemails($email)
		{
			$rows = [];
			$this->db->select('*' )
					->from($this->table)->where(array('Email'=>$email),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
		public function checkidnumbers($Idnumber)
		{
			$rows = [];
			$this->db->select('*' )
					->from($this->table)->where(array('Idnumber'=>$IDNo),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
		public function streams($PollingStream)
		{
			$rows = [];
			$this->db->select('*' )
					->from($this->table)->where(array('PollingStream'=>$PollingStream),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->row();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

	
	public function __destruct() 
	{
	
	}	
}