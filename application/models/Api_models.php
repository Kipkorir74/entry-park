<?php
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Api_models extends CI_Model 
{

	function get_titles()
    {
     	$rows = array();		
			$this->db->select('*');
			$this->db->from('Title');
			$query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}		
			return( $rows );


      
	}
	



	

}