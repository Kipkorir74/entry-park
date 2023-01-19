<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Dashboards extends CI_Model {
		
		public function __construct(){
			
	         
			$this->datetime=date("Y-m-d H:i:s");
			$this->table="transactions";
			$this->today=date("Y-m-d");
		  
		   
		}

		public function mpesatransactions(){
			
			$rows = 0;
			$this->db->select('sum(TransactionAmount) as total' )
					->from($this->table)
					->where( array('TransactionDate'=>$this->today,"Source"=>"Mpesa"),'AND');;
            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->row()->total;	
				$query->free_result();	
			}

			return $rows;

		}

		public function todaytransactions(){		
			$rows =[];
			$this->db->select('PaymentSource as Source,sum(TransactionAmount) as total' )
					->from($this->table)
					->where( array('TransactionDate'=>$this->today),'AND')
					//->where('PaymentSource IS NOT NULL')
					->group_by('PaymentSource')
					->order_by("total","DESC");	
            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}
				 // echo '<pre>';print_r($rows); exit;	
			return $rows;

		}

		public function banktransactions(){

			$rows = 0;
			$this->db->select('sum(TransactionAmount) as total' )
					->from($this->table)
					->where( array('TransactionDate'=>$this->today,"Source"=>"Bank"),'AND');;
            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->row()->total;	
				$query->free_result();	
			}

			return $rows;

		}

		public function thisweeks()
		{

			$week = date( 'W' );
		    $year = date( 'Y' );	
		    $start_date = date( 'Y-m-d', strtotime( $year . "W$week" ) );
		    $end_date = date( 'Y-m-d', strtotime( $year . "W$week" . "7" ) );


			$rows = 0;
			$this->db->select('sum(TransactionAmount) as total' )
					->from($this->table)
					->where( array('TransactionDate>='=>$start_date,"TransactionDate <="=>$end_date),'AND')
				    ->where('PaymentSource IS NOT NULL');;
            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->row()->total;	
				$query->free_result();	
			}

			return $rows;

				
				
		}
		public function thismonth()
		{
			
		    $start_date = date( 'Y-m-01');
		    $end_date = date('Y-m-d');


			$rows = 0;
			$this->db->select('sum(TransactionAmount) as total' )
					->from($this->table)
					->where( array('TransactionDate>='=>$start_date,"TransactionDate <="=>$end_date),'AND');;
            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->row()->total;	
				$query->free_result();	
			}

			return $rows;
				
		}


		
		 public function Perincometypes()
		{
		
			$rows = [];
			$this->db->select('c.IncomeTypeDescription,sum(TransactionAmount) as total' )
					->from($this->table .' t')
					->join('incometypes c','c.IncomeTypeID=t.IncomeTypeID')
					->where( array('TransactionDate'=>$this->today),'AND')
					/*->where('PaymentSource IS NOT NULL')*/
					->group_by('t.IncomeTypeID')
					->order_by("total","DESC");	;

            $query = $this->db->get();
			
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}


			if(!empty($rows)){
			
				for( $i=0; $i<count($rows); $i++ ) :
					$row = &$rows[$i];
					 
						  $records[$row->IncomeTypeDescription] = $row->total;
					
				  endfor;
				  //echo '<pre>';print_r($records); exit;	
		
			   return($records);
			}else{

			}

			

			return $rows;
				
		}

		public function payment_receiveds ()
	   {


	   	 $today=date('Y-m-d');
	   	 $time = strtotime($today.' -7 days');
         $date = date("Y-m-d", $time);
		
			for( $j=1; $j<=8; $j++ ) :


				$records[date("M-d",strtotime($date))] =$this->payments($date) ;

				 $time = strtotime($date.' +1 day');
                 $date = date("Y-m-d", $time);
 
		 	
		  endfor;


		

	
					
		
		return($records); 
		
	}
		
	

	public function payments($date){

			$this->table = 'transactions';
			
			$StartDate=$date.' 00:00:00';
			$EndDate=$date.' 23:59:59';
			$row =[];
			$this->db->select('sum(TransactionAmount) as total')->from($this->table);
			$this->db->where(array("DateCreated>="=>$StartDate, "DateCreated<="=>$EndDate),"AND");
						//->where('PaymentSource IS NOT NULL');
            $query = $this->db->get();
			if($query->result()){
				$row = $query->row()->total;	
				$query->free_result();	
			}
			if($row ){
			     return $row;
			}else{
				return 0;
			}

		}



	public function subcountys(){

			
			$rows =[];
			$this->db->select('SubCountyName,sum(TransactionAmount) as total' )
					->from($this->table .' t')
					->join('subcountys s','s.SubCountyID=t.SubCountyID')
					->where( array('t.TransactionDate'=>$this->today),'AND')
					/*->where('PaymentSource IS NOT NULL')*/
					->group_by('s.SubCountyID')
					->order_by("total","DESC");	
            $query = $this->db->get();
			if($query->result()){
				$rows = $query->result();	
				$query->free_result();	
			}

			 //echo '<pre>';print_r($rows); exit;	
				
			return $rows;

		}



		
		
		
		

}