<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Homes extends CI_Model {
		
		public function __construct(){
			
			$this->table="users";
			$this->datetime=date("Y-m-d H:i:s");
		    $this->id=$this->session->userdata('id');
		    
		    $this->first_name=$this->session->userdata('first_name');
		    
		}

		public function regionals()
		{
			$rows = [];
			$this->db->select('*' )
					->from('regions');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}
		public function roles()
		{
			$rows = [];
			$this->db->select('*' )
					->from('roles')->where(array('Self'=>1,'Status'=>1),'AND');;
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
		}

		public function getcountys($id)
		{
			$rows = [];
			$this->db->select('*' )
					->from('countys')->where(array('RegionalId'=>$id),'AND');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );	
				
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












}
