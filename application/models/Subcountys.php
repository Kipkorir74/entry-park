<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Subcountys extends CI_Model {
		
		public function __construct(){
			
			$this->table="subcountys";
			$this->datetime=date("Y-m-d H:i:s");
		    $this->id=$this->session->userdata('id');
		   
		    $this->first_name=$this->session->userdata('first_name');
		   
		   
		}

		public function creates()
		{
			
			$this->db->trans_begin();
			if($this->db->insert( $this->table, [
				'SubCountyName' => $this->input->post("SubCountyName"),
			
				'DateCreated' => $this->datetime,
				'DateModified' => $this->datetime,
                'CreatedBy' => $this->id,
                'ModifiedBy' => $this->id,
                	
			] )){
				  $id = $this->db->insert_id();
                  
                  $this->db->where('Id', $id);
                  $data=array('SubCountyID'=>$id);
                  $this->db->update($this->table, $data); 

				  $this->db->insert('audit', [
						'Description' =>  $this->first_name ." added subcounty ".  $this->input->post("SubCountyName"),
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
				] );

				       
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

		
		public function lists()
		{
			$rows = [];
			$this->db->select('t.*,u.FirstName' )
					->from($this->table .' t')  
					->join('users u', 't.CreatedBy=u.UserID')  
					->order_by('id','desc');
			/*$this->db->where( array('t.Status'=>1),'AND');*/
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
			return( $rows );
		}
		
		public function details($id){
			$row = array();		
			$this->db->select('*');
			$this->db->from( $this->table);	
            $this->db->where('id',$id);
            $query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}
			
			return( $row );
		}


		public function ward_details($id){
	
			$row = array();		
			$this->db->select('*');
			$this->db->from('wards');	
            $this->db->where('WardID',$id);
            $query = $this->db->get();
			if($query->result()){
				$row = $query->row();	
				$query->free_result();	
			}

			
			return( $row );
		}

		
		
		
		public function deletee($id)
		{
			$data = array(
				'DateModified' => $this->datetime,
				'Status' => 0 ,	
				'ModifiedBy' => $this->id,
			);

			$this->db->where('id',$id);
			if($this->db->update($this->table,  $data)){
				
					$this->db->insert('audit', [
						'Description' => $this->first_name ." Deleted subcounty ",
						'SourceTable' =>$this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					return true;
			}else{
				return false;
			}	
		}
		
		public function edits($id)
		{
			 		
			 
			 $data = array(
			    'SubCountyName' => $this->input->post("SubCountyName"),
				'Status' => $this->input->post("Status"),
				'DateModified' => $this->datetime,
                'ModifiedBy' => $this->id,
				
			  );

			  $this->db->where('id',$id);
			  
			  if($this->db->update($this->table,  $data)){
			  		$this->db->insert('audit', [
			  			'Description' => "Updated subcounty",
						'SourceTable' => $this->table,
						'RecordKey'=> $id,
						'UserKey'=>  $this->id
						
					] );
					 return true;
			  }else{
				 return false;
			  }	
		}

	 
}