<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Apis extends CI_Model {
		
		public function __construct(){
			
			$this->table="users";
			$this->datetime=date("Y-m-d H:i:s");
		    $this->id=$this->session->userdata('id');
		    $this->first_name=$this->session->userdata('first_name');
		    
		}

		


		public function checkregistations($PhoneNumber)
		{
			
			$rows = [];
			$this->db->select('*' )
					->from($this->table);	
			$this->db->where(array('PhoneNumber'=>$PhoneNumber),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->row();	
				$query->free_result();	
			}
			
			return( $rows );	
				
		}
		public function checkstreamcodes($StreamCode)
		{
			$rows = [];
			$this->db->select('*' )
					->from('stations');	
			$this->db->where(array('StreamCode'=>$StreamCode),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function getstreamcodes($StreamCode,$PollingSationCode)
		{
			$rows = [];
			$this->db->select('*' )
					->from('stations');	
			$this->db->where(array('StreamCode'=>$StreamCode,'PollingSationCode'=>$PollingSationCode),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->row();	
				$query->free_result();	
			}
			return( $rows );	
				
		}

		public function checkregisted($StreamCode,$PollingSationCode)
		{
			$rows = [];
			$this->db->select('*' )
					->from($this->table);	
			$this->db->where(array('PollingStream'=>$StreamCode,'PollingCenterId'=>$PollingSationCode),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->row();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function saveregistration($data)
		{
		  
			$this->db->trans_begin();
			if($this->db->insert( $this->table, $data )){
				  $id = $this->db->insert_id();
				  $last_id = $this->db->insert_id();
			
				  $this->db->insert('audit', [

						'Description' =>" Ussd registration ",
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  1,
						
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

		public function aspirants()
		{
			
			$rows = [];
			$this->db->select('*' )
					->from('aspirants');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			
			return( $rows );	
				
		}
		public function checkgovernors($CountyId)
		{  
			
			$rows = [];
			$this->db->select('*' )
					->from('governors')->where(array('CountyId'=>(int)$CountyId,'Status'=>1));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function checksenators($CountyId)
		{
			
			$rows = [];
			$this->db->select('*' )
					->from('senators')->where(array('CountyId'=>(int)$CountyId,'Status'=>1));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function checkwomanreps($CountyId)
		{
			
			$rows = [];
			$this->db->select('*' )
					->from('womanreps')->where(array('CountyId'=>(int)$CountyId,'Status'=>1));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function checkmps($SubCountyId)
		{
			
			$rows = [];
			$this->db->select('*' )
					->from('mps')->where(array('SubCountyId'=>(int)$SubCountyId,'Status'=>1));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function checkmcas($WardId)
		{
			/*echo $WardId ; exit;*/
			$rows = [];
			$this->db->select('*' )
					->from('mcas')->where(array('WardId'=>(int)$WardId,'Status'=>1));
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );	
				
		}
		public function checkpresidents()
		{
			

				$rows = [];
				$this->db->select('*' )
						->from('presidents')->where(array('Status'=>1));
				$query = $this->db->get();
				if($query->result()){
					$rows = $query->result();	
					$query->free_result();	
				}
				return( $rows );

			
				
		}

		public function savesession($data)
		{
			
			
			if($this->db->insert( 'casttables', $data )){
				return true;
			}else{
				return false;
			}
				
				
				
			
		}
		public function deletesession($AgentId)
		{
			
			$this->db->where("AgentId",$AgentId);
			if($this->db->delete( 'casttables')){
				return true;
			}else{
				return false;
			}		
			
		}

		public function selectsession($AgentId)
		{
			

				$rows = [];
				$this->db->select('*' )
						->from('casttables')->where(array('Status'=>1,'AgentId'=>$AgentId))->order_by('id','ASC');
				$query = $this->db->get();
				if($query->result()){
					$rows = $query->row();	
					$query->free_result();	
				}
				return( $rows );

			
				
		}
		public function updatevotes($AspirantId,$AgentId,$data)
		{
			
			$this->db->where(array("AspirantId"=>$AspirantId,'AgentId'=>$AgentId));
			if($this->db->update( 'casttables',$data)){
				return true;
			}else{
				return false;
			}		
			
		}

		public function getallvotes($AgentId)
		{
			

				$rows = [];
				$this->db->select('*' )
						->from('casttables')->where(array('Status'=>2,'AgentId'=>$AgentId))->order_by('id','ASC');
				$query = $this->db->get();
				if($query->result()){
					$rows = $query->result();	
					$query->free_result();	
				}
				return( $rows );

			
				
		}
		public function savevotes($data,$table)
		{
			
		
			if($this->db->insert($table, $data )){
				return true;
			}else{
				return false;
			}
				
				
				
			
		}
		public function checkvotecasted($AgentId,$PollingCenterId,$PollingStream,$table)
		{
			
				$rows = [];
				$this->db->select('*' )
						->from($table)
						->where(array('Status'=>1,'AgentId'=>$AgentId,'PollingSationCode'=>$PollingCenterId,'StreamCode'=>$PollingStream));
				$query = $this->db->get();
				if($query->result()){
					$rows = $query->result();	
					$query->free_result();	
				}
				return( $rows );

			
				
		}
		
		
		
		



		
		
}