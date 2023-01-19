<?php
if( !defined('BASEPATH') ) exit('No direct script access allowed');

class Api extends CI_Controller 
{
	
	
	public function __construct()
	{
		parent::__construct();
		 $this->load->model("apis");
		 $this->response=[];
		 $this->datetime=date("Y-m-d H:i:s");
		 $this->date=date("Y-m-d H:i:s");
		 $this->id=1;
		 $this->GO_BACK = "0";        
         $this->GO_TO_MAIN_MENU = "00";
		
		
		
	}


     public function index()
	{	

		$GO_BACK = "0";        
        $GO_TO_MAIN_MENU = "00";
		$sessionId =$this->input->post("sessionId"); 
		$serviceCode =$this->input->post("serviceCode"); 
		$phoneNumber =$this->input->post("phoneNumber") ;
		$Telephone='0'.substr($this->input->post("phoneNumber"),-9,9 );
		$text = $this->input->post("text") ;

		if(!$results=$this->apis->checkregistations($Telephone)){


			$this->register($sessionId,$serviceCode,$phoneNumber,$text);

		}else{
			$this->castingvote($sessionId,$serviceCode,$phoneNumber,$text);

		}
	
	}

	public function castingvote($sessionId,$serviceCode,$phoneNumber,$text)
	{	

		$GO_BACK = "0";        
        $GO_TO_MAIN_MENU = "00";
		$level = 0;
		$ussd_string_exploded = explode ("*",$text);
		$level = count($ussd_string_exploded);
		if($ussd_string_exploded[0] ==""){
			$level = 0;
		}
		if($level >= 2){
			 $position=$level - 1;
			 $Telephone='0'.substr($phoneNumber,-9,9 );
			 $vote=$ussd_string_exploded[$position];
			if($account=$this->apis->checkregistations($Telephone)){
				$record=$this->apis->selectsession($account->id);

				$data=[
					'Vote'=>$vote,
					'Status'=>2
				];
				if($record){
					$this->apis->updatevotes($record->AspirantId,$record->AgentId,$data);
				}
				$record1=$this->apis->selectsession($account->id);
				if($record1){
					$response  = "CON ".$record1->FullName." Votes\n";
                                    $this->sendOutput($response);

				}else{
					     $record2=$this->apis->getallvotes($account->id);
						 $response  = "CON Confirm Votes . \n";
						 for( $i=0; $i<count($record2); $i++ ) :
						      $count=$i+1; 
					             $row = &$record2[$i];
					             $response .= "". $row->FullName ." : ". $row->Vote ." \n";

					      endfor;
					      if($position==$count){
					      		 $response .= "1. Save \n";
		    	                 $response .= "2. Cancel";
			                     $this->sendOutput($response);
					      }else{
					      	 if($vote==1){

					      	 	if(!$result=$this->apis->getstreamcodes($account->PollingStream,$account->PollingCenterId)){
					      	 		$response = "END Try Again.";
		        					$this->sendOutput($response);
					      	 	}

					      	 	for( $i=0; $i<count($record2); $i++ ) :
					             $row = &$record2[$i];

					             if($row->CandidateId==1){
					             	 $id="PresidentId";
					             	 $table="presidentvotes";
			        	   	
									}
									if($row->CandidateId==2){
										$id="GovernorId";
					             	    $table="governorvotes";
											
									 }
									 if($row->CandidateId==3){
									 	
										$id="SenatorId";
					             	    $table="senatorvotes";

									 }
									 if($row->CandidateId==4){
									 	
									 	$id="WomanrepId";
					             	    $table="womanrepvotes";

									 }
									 if($row->CandidateId==5){
									 	$id="MpId";
					             	    $table="mpvotes";

									 }
									 if($row->CandidateId==6){
									 	$id="McaId";
					             	    $table="mcavotes";

									 }
					           

					             $data2=array(
				                        'FullName'=>$row->FullName,
				                        ''.$id.''=>$row->AspirantId,
				                        'Vote'=>$row->Vote,
				                        'AgentId'=>$account->id,
				                        'CountyCode'=>$result->CountyCode,
				                        'CountyName'=>$result->CountyName,
				                        'ConstituencyCode'=>$result->ConstituencyCode,
				                        'ConstituencyName'=>$result->ConstituencyName,
				                        'WardCode'=> $result->WardCode,
				                        'WardName'=>$result->WardName,
				                        'PollingSationCode'=>$result->PollingSationCode,
				                        'PollingSationName'=>$result->PollingSationName,
				                        'StreamCode'=>$result->StreamCode,
				                        'StreamNumber'=>$result->StreamNumber,
				                        'DateCreated'=>$this->date,
				                        'DateModified'=>$this->date,
				                
				                    );
				                    $this->apis->savevotes($data2,$table);

					            endfor;
					            $this->apis->deletesession($account->id);
					            $response = "END Vote submitted successfully.";
		        				$this->sendOutput($response);

					      	 }else{
					      	 	$this->apis->deletesession($account->id);
					      	 	$response = "END Thankyou for using Voting System.";
		        				$this->sendOutput($response);

					      	 }

					      }

	

				}




			}else{
				$response = "END Try Again.";
		        $this->sendOutput($response);

			}




		}
        
		if($level == 0 ){
			$response  = "CON Select the Candidate.\n";
			$Telephone='0'.substr($phoneNumber,-9,9 );

			if($account=$this->apis->checkregistations($Telephone)){
				if($results=$this->apis->aspirants()){

				 for( $i=0; $i<count($results); $i++ ) : 
				             $row = &$results[$i];
				             if($i==0){
				             	
				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             
				             }
				             if($i==1){
				             	if($this->apis->checkgovernors($account->CountyId)){

				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             	}
				             }
				             if($i==2){
				             	if($this->apis->checksenators($account->CountyId)){

				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             	}
				             }
				              if($i==3){
				             	if($this->apis->checkwomanreps($account->CountyId)){

				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             	}
				             }
				              if($i==4){
				             	if($this->apis->checkmps($account->SubCountyId)){

				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             	}
				             }
				             if($i==5){
				             	if($this->apis->checkmcas($account->WardId)){

				             		$response .= "". $row->id .". ". $row->Titles ." \n";
				             	}
				             }
		
			      endfor;

			       $this->sendOutput($response);
			   }else{
			   	$response = "END Your account is not assigned to any aspirant. Contant admin.";
		        $this->sendOutput($response);

			   }

			  
			}else{

				$response = "END Your account has some issues. Kindy contact admin";
		        $this->sendOutput($response);



			}

			$response  = "CON Welcome to Voting System. Kindly register yourself\n";
            $response  .= "CON Enter Your First Name\n";
            $this->sendOutput($response);


		}


		 if($level == 1){

			      	$candidateid=$ussd_string_exploded[0];
			   	    $Telephone='0'.substr($phoneNumber,-9,9 );
			        if($account=$this->apis->checkregistations($Telephone)){

			        	   if($candidateid==1){
			        	   	
			        	   	    $records=$this->apis->checkpresidents();
			        	   	      $table="presidentvotes";
			        	   	      $Candidatename='President';

							}
							if($candidateid==2){
								$records=$this->apis->checkgovernors($account->CountyId);
								  $table="governorvotes";
								  $Candidatename='Governor';	
							 }
							 if($candidateid==3){
							 	$records=$this->apis->checksenators($account->CountyId);
							 	  $table="senatorvotes";
							 	  $Candidatename='Senator';
							 }
							 if($candidateid==4){
							 	$records=$this->apis->checkwomanreps($account->CountyId);
							 	  $table="womanrepvotes";
							 	   $Candidatename='Woman Rep';
							 }
							 if($candidateid==5){
							 	$records=$this->apis->checkmps($account->SubCountyId);
							 	  $table="mpvotes";
							 	   $Candidatename='MP';
							 }
							 if($candidateid==6){
							 	$records=$this->apis->checkmcas($account->WardId);
							 	 $table="mcavotes";
							 	 $Candidatename='MCA';

							 }

							 if($results=$this->apis->checkvotecasted($account->id,$account->PollingCenterId,$account->PollingStream,$table)){
							 	 $response  = "CON Your have already enter vote for " .$Candidatename ." \n";
							 		for( $i=0; $i<count($results); $i++ ) :

						                $row = &$results[$i];
						                $response .= "". $row->FullName ." : ". $row->Vote ." \n";

						            endfor;
					    
					      		 $response .= "Ok\n";
		    	               
			                     $this->sendOutput($response);
					      

							 }


							  
							 if($records){
							 	$this->apis->deletesession($account->id);

							 	 for( $i=0; $i<count($records); $i++ ) : 
				                 $record = &$records[$i];
				                 $count=$i + 1;

				                 $data=[
				                 	'AgentId'=>$account->id,
				                 	'CandidateId'=>$candidateid,
				                 	'FullName'=> $record->FullName,
				                 	'AspirantId'=> $record->id,

				                 ];
				                 $this->apis->savesession($data);
				                 endfor;



				                 	$response  = "CON ".$records[0]->FullName." Votes\n";
                                    $this->sendOutput($response);


				            
							 }else{

							 	$response = "END Try again.";
		                         $this->sendOutput($response);

							 }



							
			        	

			   	   }else{
			   	   	$response = "END Your account is not assigned to any aspirant. Contant admin.";
		             $this->sendOutput($response);

			   }





			   }



	}





	public function register($sessionId,$serviceCode,$phoneNumber,$text)
	{	

		$GO_BACK = "0";        
        $GO_TO_MAIN_MENU = "00";
		$level = 0;
		$ussd_string_exploded = explode ("*",$text);
		$level = count($ussd_string_exploded);
		if($ussd_string_exploded[0] ==""){
			$level = 0;
		}
        
		if($level == 0 ){
			$response  = "CON Welcome to Voting System. Kindly register yourself\n";
            $response  .= "CON Enter Your First Name\n";
            $this->sendOutput($response);


		}
		if ($level == 1)
		{
			$response  = "CON Enter Your Last Name\n";
            $this->sendOutput($response);

		}
		if($level == 2)
		{
			$response  = "CON Enter Your ID Number\n";
            $this->sendOutput($response);

		}
		if($level == 3)
		{
			$response  = "CON Enter Your email\n";
            $this->sendOutput($response);

		}
		if($level == 4)
		{
			$response  = "CON Enter Polling Stream Code\n";
			
            $this->sendOutput($response);

		}
		if($level == 5)
		{

			$StreamCode=$ussd_string_exploded[4];
			if($results=$this->apis->checkstreamcodes(strtoupper(str_replace(' ', '', $StreamCode)))){

		    		    $response  = "CON Select Stream Number. \n";
			        	 for( $i=0; $i<count($results); $i++ ) : 
				             $row = &$results[$i];

								$response .= "". $row->PollingSationCode .". ". $row->PollingSationName ." \n";
						 endfor;

			         $this->sendOutput($response);
		    	   
				     

		    	}else{
		    		$response  = "CON This stream code " . $StreamCode .  " is not found \n";

		    	     $response .= " Ok \n";
		    	  
				    $this->sendOutput($response);


		    	}

			

		}

		if($level == 6)
		{
			$FirstName=$ussd_string_exploded[0];
			$LastName=$ussd_string_exploded[1];
			$IdNumber=$ussd_string_exploded[2];
			$email=$ussd_string_exploded[3];
			$StreamCode=$ussd_string_exploded[4];
			$PollingSationCode=$ussd_string_exploded[5];
			
			if($results=$this->apis->getstreamcodes(strtoupper(str_replace(' ', '', $StreamCode)),$PollingSationCode)){

				if($getrecord=$this->apis->checkregisted(strtoupper(str_replace(' ', '', $StreamCode)),$PollingSationCode)){

				       $response  = "CON This polling center ". $results->PollingSationName ." stream ".$getrecord->StationId ." has being taken by  ". $getrecord->FirstName ." ". $getrecord->LastName . " (" . $getrecord->PhoneNumber. " ) \n\n";
		    	            $response .= "OK\n";
		    	        
			             $this->sendOutput($response);

			       }





						$response  = "CON Confirm Your Details . \n Name : ". $FirstName ." ". $LastName . " \n IdNO : " . $IdNumber. " \n Email : " . $email . " \n Polling Center: " . $results->PollingSationName . " \n Stream : " . $results->StreamNumber ." \n";
		    	         $response .= "1. Save \n";
		    	         $response .= "2. Cancel";
			             $this->sendOutput($response);
		    	   
				     

		    	}else{
		    		$response  = "CON This stream code " . $StreamCode .  " is not found \n";

		    	     $response .= " Ok \n";
		    	  
				    $this->sendOutput($response);


		    	}

			
		}

		if($level == 7)
		{

			if ($ussd_string_exploded[6] == 1)
		    {


		    	    $FirstName=$ussd_string_exploded[0];
					$LastName=$ussd_string_exploded[1];
					$IdNumber=$ussd_string_exploded[2];
					$email=$ussd_string_exploded[3];
					$StreamCode=$ussd_string_exploded[4];
					$PollingSationCode=$ussd_string_exploded[5];
					if($results=$this->apis->getstreamcodes(strtoupper(str_replace(' ', '', $StreamCode)),$PollingSationCode)){


								$data=[
									'DateCreated' => $this->datetime,
									'FirstName' =>  $FirstName,
									'LastName' => $LastName,
									'OtherName' => "",
									'PhoneNumber' => '0'.substr($phoneNumber,-9,9 ),
									'Email' => $email,
									'RoleId'=>1,
									'UserType'=>1,
									'Idnumber'=>$IdNumber, 
									'CountyId'=>$results->CountyCode,
									'SubCountyId'=>$results->ConstituencyCode, 
									'WardId'=>$results->WardCode,
									'PollingCenterId'=>$PollingSationCode,
									'PollingStream'=>$StreamCode, 
									'StationId'=>$results->StreamNumber,
									'DateModified'=>$this->datetime,
									'CreatedBy'=>1, 
									'ModifiedBy'=>1,   			
									'Password' =>  password_hash($IdNumber, PASSWORD_BCRYPT ),

								];
								if($this->apis->saveregistration($data)){
									$response = "END Your account has been created successfully";
					                $this->sendOutput($response);

								}else{
									$response = "END Your account was not created. Try again";
					                $this->sendOutput($response);

								}




							     
	
						     

				    	}else{
				    		$response = "END Your account was not created. Try again";
					         $this->sendOutput($response);
				    	  
						  


				    	}




		    }else{
		    	$response = "END Thankyou For using Voting System";
		        $this->sendOutput($response);

		    }




		}












	}











	 public function display_menu($phoneNumber){

       
        $results=$this->apis->checkregistations($phoneNumber);
        if($results){
        	 $response  = "CON Welcome to Voting System. \n";
        	 /*for( $i=0; $i<count($results); $i++ ) : 
	             $row = &$results[$i];

					$response .= "". $row->id .". ". $row->ServicesName ." \n";
			 endfor;

			 $this->sendOutput($response);*/

        }else{
        	

        }
      
       
    }

	public function sessioning($sessionId,$serviceCode,$phoneNumber,$text)
	{	

		$GO_BACK = "0";        
        $GO_TO_MAIN_MENU = "00";
		$level = 0;
		$ussd_string_exploded = explode ("*",$text);
		$level = count($ussd_string_exploded);
		if($ussd_string_exploded[0] ==""){
			$level = 0;
		}
        
		if($level == 0 ){


				 $results=$this->apis->checkregistations($phoneNumber);
		        if($results){
		        	 $response  = "CON Welcome to Voting System. \n";
		        	 /*for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];

							$response .= "". $row->id .". ". $row->ServicesName ." \n";
					 endfor;

					 $this->sendOutput($response);*/

		        }else{
		        	

             }
		        	

		   }


			 
		 





		if ($level == 1)
		{
		    if($ussd_string_exploded[0] == 1)
		    {
		        
		        $this->parkingservicing();

		    }elseif($ussd_string_exploded[0] ==2){
		    	$this->businessservices();
		    	
		    }elseif($ussd_string_exploded[0] ==3){
		    	$this->gethousestate();
		    }elseif($ussd_string_exploded[0] ==4){
		    	$this->Enterplotnumber();
		    }elseif($ussd_string_exploded[0] ==5){
		    	$this->Enterbillnumber();

		    }else{
		    	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);
		    }
		 
		}


		if ($level ==2)
		{
		    if ( $ussd_string_exploded[1] ==1||$ussd_string_exploded[1] ==2 )
		    {
		        $this->Vehicletype();

		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==3||$ussd_string_exploded[1] ==4){
		    	 
		    	$this->Enterplatenumbers();

		     }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==0){
		    	 
		    	$text = $this->goBack($text);
		    	$this->sessioning($sessionId,$serviceCode,$phoneNumber,$text);

		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 1){
		    	 
		    	 $this->selectyear();
		    	 
		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 2){
		    	$this->Enterbusinesid();
		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 3){
		    	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);

		    }elseif($ussd_string_exploded[0] ==3){
		    	$EstateId=$ussd_string_exploded[1];
		    	$this->gethousetype($EstateId); 
		    }elseif($ussd_string_exploded[0] ==4){
		    	$PlotNumber=$ussd_string_exploded[1];
		    	$this->searchplot($PlotNumber); 
		    }elseif($ussd_string_exploded[0] ==5){ 
		    	$Billnumber=$ussd_string_exploded[1];
		    	$this->searchbillnumber($Billnumber);
		  

		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}
		if ($level ==3)
		{
		    if ($ussd_string_exploded[1] ==1||$ussd_string_exploded[1] ==2)
		    {
		        $this->gettown();

		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==3){
		    	$Platenumber=$ussd_string_exploded[2];
		    	$this->checkvehiclecharge($Platenumber);
		      }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==4){
		    	$Platenumber=$ussd_string_exploded[2];

		    	if($results=$this->parkings->checkvehicles(strtoupper(str_replace(' ', '', $Platenumber)))){

		    		   $response  = "CON Valid Compliant . \n Plate Number : ". $results->VehicleRegistration ."\n Vehicle Type : ". $results->VehicleType . " \n Amount : " . $results->AmountPaid . " \n Start Date : " . $results->StartDate . " \n End Date : " . $results->EndDate . " \n Duration : " . $results->Duration ." \n";
		    	        $response .= " Ok \n";
		    	       /*  $response .= $GO_BACK . " Back\n";
                         $response .= $GO_TO_MAIN_MENU .  " Main menu\n";*/
		    	   
				      $this->sendOutput($response);

		    	}else{
		    		$response  = "CON Compliant  : false \n Plate Number : " . strtoupper(str_replace(' ', '', $Platenumber))." \n";

		    	     $response .= " Ok \n";
		    	   

				    $this->sendOutput($response);


		    	}


		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 1){

		    	$this->Enterbusinesid();

		     }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 2){
		    	
		    	 $BusinessID=$ussd_string_exploded[2];
		    	 $this->checkbusinessstatus($BusinessID);

		   }elseif($ussd_string_exploded[0] ==3){
		    	
		    	$EstateId=$ussd_string_exploded[1];
		    	$housetype=$ussd_string_exploded[2];
		    	$this->gethouseunit($EstateId,$housetype);
		   }elseif($ussd_string_exploded[0] ==4 && $ussd_string_exploded[2] == 1){
		   
		    	$this->Enteramounttopay();
		     }elseif($ussd_string_exploded[0] ==4 && $ussd_string_exploded[2] == 2){
		     	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);
		    }elseif($ussd_string_exploded[0] ==5 && $ussd_string_exploded[2] == 1){
		   
		    	$Billnumber=$ussd_string_exploded[1];
		    	$this->billpayment($Billnumber,$phoneNumber);

		    }elseif($ussd_string_exploded[0] ==5 && $ussd_string_exploded[2] == 2){ 
		    	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);
		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}
		if ($level==4)
		{
		    if ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 )
		    {
		        $this->Enterplatenumbers();
		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 2){
		    	 $this->getseasonal();

		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==4 && $ussd_string_exploded[3] ==0){

		    	$text = $this->goBack($text);
		    	$this->sessioning($sessionId,$serviceCode,$phoneNumber,$text);
		    	
		    	

            }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==3 && $ussd_string_exploded[3] ==1){
            		$Platenumber=$ussd_string_exploded[2];
            		$this->load->model("portals");
		    	    if($result=$this->portals->getothercharge(strtoupper(str_replace(' ', '', $Platenumber)))){
		    	    		$Billnumber=$result->BillNo;
		    	    		$this->billpayment($Billnumber,$phoneNumber);
		    	    }else{

		    	    	$response = "END This Vehicle ". $Platenumber ." has no addition charge \n";
        	           $this->sendOutput($response);
		    	    }


            }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] ==3 && $ussd_string_exploded[3] ==2){
            	
            	    $response = "END Session cancelled successfully";
		            $this->sendOutput($response);	

		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 1){

		      	 $year=$ussd_string_exploded[2];
		    	 $BusinessID=$ussd_string_exploded[3];
		    	 $this->checkbusiness($BusinessID);

		   }elseif($ussd_string_exploded[0] ==3){
		    	
		    	$EstateId=$ussd_string_exploded[1];
		    	$housetype=$ussd_string_exploded[2];
		    	$houseno=$ussd_string_exploded[3];
		    	$this->viewhouse($EstateId,$housetype,$houseno);
		    }elseif($ussd_string_exploded[0] ==4 && $ussd_string_exploded[2] == 1){
		    	$PlotNumber=$ussd_string_exploded[1];
		    	$amount=$ussd_string_exploded[2];
		    	$this->generatelandratebill($PlotNumber,$amount,$phoneNumber); 
		    	
		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}

		if($level==5)
		{
		     if ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 )
		    {
		        $DurationID=$ussd_string_exploded[1];
		    	$VehicleTypeID=$ussd_string_exploded[2];
		    	$Platenumber=$ussd_string_exploded[4];
		        $this->getcharges($DurationID,$VehicleTypeID,$Platenumber);
		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 2){

		    	 $this->Enterplatenumbers();

		    	
		   }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 1){
		   		 $year=$ussd_string_exploded[2];
		    	 $BusinessID=$ussd_string_exploded[3];
		    	 $this->generatebusiness($BusinessID,$year);

		   }elseif($ussd_string_exploded[0] ==3 && $ussd_string_exploded[4] ==1){
		   		$this->Enteramounttopay();
		    	
		    	/*$EstateId=$ussd_string_exploded[1];
		    	$housetype=$ussd_string_exploded[2];
		    	$houseno=$ussd_string_exploded[3];
		    	$this->viewhouse($EstateId,$housetype,$houseno);
		    */
		     }elseif($ussd_string_exploded[0] ==3 && $ussd_string_exploded[4] ==2){
		     	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);
		    
		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}

	   if($level==6)
		{
			//echo $ussd_string_exploded[5]; exit;
		     if ($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 &&$ussd_string_exploded[5]==1 )
		    {
		    	$DurationID=$ussd_string_exploded[1];
		    	$VehicleTypeID=$ussd_string_exploded[2];
		    	$town=$ussd_string_exploded[3];
		    	$Platenumber=$ussd_string_exploded[4];
		        $this->saveparking($DurationID,$VehicleTypeID,$town,$Platenumber,$phoneNumber);
		     }elseif($ussd_string_exploded[0] == 1 && $ussd_string_exploded[1] == 1 &&$ussd_string_exploded[5]==2 )
		    {

		    	$response = "END Session cancelled successfully";
		        $this->sendOutput($response);

		    }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 2){

		    	$DurationID=$ussd_string_exploded[4];
		        $Platenumber=$ussd_string_exploded[5];
		    	$VehicleTypeID=$ussd_string_exploded[2];
		        $this->getcharges($DurationID,$VehicleTypeID,$Platenumber);

		    }elseif($ussd_string_exploded[0] ==2 && $ussd_string_exploded[1] == 1){
		    	 $year=$ussd_string_exploded[2];
		    	 $BusinessID=$ussd_string_exploded[3];
		    	 $this->paybusiness($BusinessID,$year,$phoneNumber);
		    }elseif($ussd_string_exploded[0] ==3 && $ussd_string_exploded[4] ==1){
		    	$EstateId=$ussd_string_exploded[1];
		    	$housetype=$ussd_string_exploded[2];
		    	$houseno=$ussd_string_exploded[3];
		        $amount=$ussd_string_exploded[5];
		    	$this->gethousebill($EstateId,$housetype,$houseno,$amount,$phoneNumber);
		    

		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}
		if($level==7)
		{
			
		    if($ussd_string_exploded[0] ==1 && $ussd_string_exploded[1] == 2 && $ussd_string_exploded[6] == 1){
		    
		    	$DurationID=$ussd_string_exploded[4];
		    	$VehicleTypeID=$ussd_string_exploded[2];
		    	$town=$ussd_string_exploded[3];
		    	$Platenumber=$ussd_string_exploded[5];
		        $this->saveparking($DurationID,$VehicleTypeID,$town,$Platenumber,$phoneNumber);

		   }elseif($ussd_string_exploded[0] ==1 && $ussd_string_exploded[6] == 2){
		   		$response = "END Session cancelled successfully";
		        $this->sendOutput($response);

		    }else{
		    	$response = "END Nothing was selected";
		        $this->sendOutput($response);
		    }
		 
		}

		$response = "END Try again ";
		$this->sendOutput($response);



	}

  

    function parkingservicing(){

        $results=$this->parkings->parkingtypes();
		         if($results){
		         	$response  = "CON Select Services \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];

							$response .= "". $row->id .". ". $row->Types ." \n";
					 endfor;
					 //$response .= "\n0. Back \n";

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
      }
    function gethousestate(){

        $results=$this->houses->estates();
		         if($results){
		         	$response  = "CON Select the Estate \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];

							$response .= "". $row->EstateId .". ". $row->EstateName ." \n";
					 endfor;

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
       }
      function gethousetype($EstateId){

        $results=$this->houses->gethousetypes($EstateId);
		         if($results){
		         	$response  = "CON Select the House Type \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];

							$response .= "". $row->id .". ". $row->UnitType ." \n";
					 endfor;

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
       }
       function gethouseunit($EstateId,$Unittype){

           $results=$this->houses->gethouses($Unittype,$EstateId);
	         if($results){
	         	$response  = "CON Select the House Number \n";
	        	 for( $i=0; $i<count($results); $i++ ) : 
		             $row = &$results[$i];

						$response .= "". $row->UnitId .". ". $row->UnitName ." \n";
				 endfor;

				 $this->sendOutput($response);

	        }else{
	        	$response = "END Nothing was selected";
	        	$this->sendOutput($response);

	        }
   
       }

       function viewhouse($EstateId,$housetype,$houseno){

           $results=$this->houses->viewhouses($EstateId,$housetype,$houseno);
	         if($results){
	         	 $response  = "CON Confirm house details. \n Tenant : ". $results->FirstName ." ". $results->MiddleName  . " \n Units :" . $results->UnitName ." \n Monthly Rent : ". $results->Rent ." \n Balance : ". $results->balance ." \n";
		    	 $response .= "1. Ok \n";
		    	 $response .= "2. Cancel";

				$this->sendOutput($response);

	        }else{

	        	$response = "END No tenant attached ";
	        	$this->sendOutput($response);

	        }
   
       }

       public function Enteramounttopay(){

            $response  = "CON Enter amount to pay\n";
             $this->sendOutput($response);

       }
      function Vehicletype(){

        $results=$this->parkings->getvehicletypes();
		         if($results){
		         	$response  = "CON Select Vehicle Type \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];

							$response .= "". $row->VehicleTypeID .". ". $row->VehicleType ." \n";
					 endfor;

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
		
       
    }
      function gettown(){

        $results=$this->parkings->gettowns();
		         if($results){
		         	$response  = "CON Select the town \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];
							$response .= "". $row->TownId .". ". $row->Town ." \n";
					 endfor;

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
	
    }
     function getcharges($DurationID,$VehicleTypeID,$Platenumber){

          $results=$this->parkings->getcharges($DurationID,$VehicleTypeID);
          if($results){

          	if($DurationID==1){
          			 $this->load->model("portals");
          		if($record= $this->portals->getothercharge(strtoupper(str_replace(' ', '', $Platenumber)))){ 


          			$response  = "CON Confirm Charges. \n Vehicle Type : ". $results->VehicleType . " \n Amount:" . $results->Amount . " \n Other Charge:" . $record->accountDesc  . " \n Charge Amount:" . $record->amount ." \n Total :" . ($record->amount +  $results->Amount) ." \n";

          		}else{
          			 $response  = "CON Confirm Charges. \n Vehicle Type : ". $results->VehicleType . " \n Amount:" . $results->Amount ." \n";
          		}

          		

          	}else{
          		 $response  = "CON Confirm Charges. \n Vehicle Type : ". $results->VehicleType . " \n Amount:" . $results->Amount ." \n";
          	}
		      

		    	$response .= "1. Ok \n";
		    	$response .= "2. Cancel";

				$this->sendOutput($response);

		      }else{
		      	  $results=$this->parkings->getcharges($DurationID,$VehicleTypeID);

		      	  $response  = "END The charge is not set." ;

		      	  $this->sendOutput($response);

		    	  //$response .= ". Ok \n";
		    	  //$response .= "2. Wrong Info";

		      }

       
	
        }

          function checkbusinessstatus($BusinessId){

          $results=$this->businesses->valids($BusinessId);
          if($results){
		       $response  = "END The business ID - ' ". $BusinessId . " ' is valid until " . $results->EndDate ." \n";
				$this->sendOutput($response);

		      }else{
		      	

		      	  $response  = "END The business ID - ' ". $BusinessId . " ' is not being paid for current Year";

		      	  $this->sendOutput($response);
		      }

       
	
        }

        
      
    function getseasonal(){

        $results=$this->parkings->getseasonal();
		         if($results){
		         	$response  = "CON Select the duration \n";
		        	 for( $i=0; $i<count($results); $i++ ) : 
			             $row = &$results[$i];
							$response .= "". $row->DurationID .". ". $row->Duration ." \n";
					 endfor;

					 $this->sendOutput($response);

		        }else{
		        	$response = "END Nothing was selected";
		        	$this->sendOutput($response);

		        }
       
	
    }
     function businessservices(){

		       $response  = "CON Select the services on business Permit\n";

		    	$response .= "1. Renew \n";
		    	$response .= "2. Status \n";
		    	$response .= "3. Cancel \n";

				$this->sendOutput($response);

	
       }
         function searchplot($PlotNumber){
         	
            $results=$this->landrates->searchplotdetails($PlotNumber);
		         if($results){

				         	 $response  = "CON Confirm Plot Number Details. \n Owner : ". $results->OwnerFirstName ." ". $results->OwnerMiddleName ." ". $results->OwnerLastName  . " \n PlotNumber :" . $results->PlotNumber ." \n Total Annually : ". $results->TotalAnnualAmount ." \n Current Balance : ". $results->CurrentBalance ." \n";
					    	 $response .= "1. Ok \n";
					    	 $response .= "2. Cancel";

							$this->sendOutput($response);

				        }else{

				        	$response = "END This PlotNumber - ". $PlotNumber ." is not found.";
				        	$this->sendOutput($response);

				        }
		         
       
		
       
         } 

       function selectyear(){

		       $response  = "CON Select the year\n";

              $Start_yr=2019;
              $current_yr=date('Y') ; 
              $different=  $current_yr -  $Start_yr;                                      
              for( $i=1; $i<=$different; $i++ ) :
				$response .= "". $i .". ". $current_yr ." \n";
				 $current_yr-=1;
		       endfor;                                           
                                                          
		    	$response .= $i .". Cancel \n";

				$this->sendOutput($response);

	
        }
        public function Enterplatenumbers(){

            $response  = "CON Enter Plate Number\n";
             $this->sendOutput($response);

       }
       public function Enterbusinesid(){

          $response  = "CON Enter Business ID\n";
          $this->sendOutput($response);

       }

       public function Enterplotnumber(){

            $response  = "CON Enter Plot Number\n";
             $this->sendOutput($response);

       }
        public function Enterbillnumber(){

            $response  = "CON Enter Bill Number\n";
             $this->sendOutput($response);

       }

          
      function searchbillnumber($Billnumber){

        $results=$this->billings->getbillinfos($Billnumber);
         if($results){
         		 
         		$response  = "CON Confirm Bill Info . \n Bill Number : ". $results->BillNo . " \n Customer : " . $results->Customer ." \n Bill Amount : " . $results->BillTotal." \n Bill Balance : " . $results->ReducingBalance." \n";

		    	$response .= "1. Proceed to pay \n";
		    	$response .= "2. Cancel"; 

				$this->sendOutput($response);

        }else{
        	$response = "END This Bill Number ". $Billnumber ." is not found \n";
        	$this->sendOutput($response);

        }
       
	
       }

       function checkvehiclecharge($Platenumber){
       	 $this->load->model("portals");
        $results=$this->portals->getothercharge(strtoupper(str_replace(' ', '', $Platenumber)));
         if($results){
         		 
         		$response  = "CON Confirm Bill Info . \n Bill Number : ". $results->BillNo . " \n Plate Number : " . $results->IdentifyNo ." \n Charge Amount : " . $results->BillTotal." \n Charge Balance : " . $results->ReducingBalance." \n";

		    	$response .= "1. Proceed to pay \n";
		    	$response .= "2. Cancel"; 

				$this->sendOutput($response);

        }else{
        	$response = "END This Vehicle ". $Platenumber ." has no addition charge \n";
        	$this->sendOutput($response);

        }
       
	
       }

        function billpayment($Billnumber,$phoneNumber){

	        $results=$this->billings->getbillinfos($Billnumber);
	         if($results){

	         		          $PayBillNumber=$this->PayBillNumber;
			                  $Amount=(int)$results->ReducingBalance;
			                  $PhoneNumber=$phoneNumber;
			                  $AccountReference=$results->PaymentCode;
			                  $TransactionDesc="from biller";
			                   if($fields=$this->sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc)){  

			                             $checkprevisouspayment=$this->billings->checkprevisouspayments($AccountReference);
			                         if($checkprevisouspayment){

			                               $data = array(
			                    
			                                 'Marked' => $checkprevisouspayment->Marked + 1,
			                              );
			                              $this->db->where('PaymentCode',$AccountReference);
			                               $this->db->update("transactions",  $data);
			                         }

			                         $response  = "END Wait for payment from Mpesa." ;
			                            $this->sendOutput($response);

			                        
			                         
			                       
	                    
	                    }else{
	                    	$response  = "END STK Push was not sent." ;
	                            $this->sendOutput($response);

	                      
	                          
	                    }

	    

	        }else{
	        	$response = "END This Bill Number ". $Billnumber ." is not found \n";
	        	$this->sendOutput($response);

	        }
       
	
       }

      function checkbusiness($BusinessID){

        $results=$this->businesses->get_businesses($BusinessID);
         if($results){

         		 $response  = "CON Confirm Business  \n Business Name : ". $results->BusinessName . " \n Business ID: " . $results->BusinessID ." \n SBP Fee: " . $results->SBPFee." \n";

		    	$response .= "1. Ok \n";
		    	$response .= "2. Cancel";

				$this->sendOutput($response);

        }else{
        	$response = "END Business ID ". $BusinessID ." not found \n";
        	$this->sendOutput($response);

        }
       
	
       }

        function paybusiness($BusinessId,$year,$phoneNumber){

         $record= $this->businesses->get_businesses($BusinessId);
        if(empty($record)){
         		$response = "END Business ID ". $BusinessId ." not found \n";
	            $this->sendOutput($response);
                     
         }
          $Start_yr=2019;
              $current_yr=date('Y') ; 
              $different=  $current_yr -  $Start_yr;                                      
              for( $i=1; $i<=$different; $i++ ) :

              	  if($i==$year){
              	  	  $permityear=$current_yr;
              	   }
				
				 $current_yr-=1;
		       endfor;
         if($check=$this->businesses->checkpermit($BusinessId,$permityear,$record->ActivityCode)){
         	if($check->AmountPaid>=$check->AmountBilled){

                 		$response  = "END The Business is already paid for the year ". $permityear . " \n";

			    	   

					    $this->sendOutput($response);

               }else{
                 		



		         	   $this->load->model("receiptings");
		         	   if($this->data['record']=$this->receiptings->billinfos($check->BillNo)){
		         	   		  $PayBillNumber=$this->PayBillNumber;
			                  $Amount=(int)$this->data['record']->ReducingBalance;
			                  $PhoneNumber=$phoneNumber;
			                  $AccountReference=$this->data['record']->PaymentCode;
			                  $TransactionDesc="from biller";
			                   if($fields=$this->sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc)){  

			                             $checkprevisouspayment=$this->billings->checkprevisouspayments($AccountReference);
			                         if($checkprevisouspayment){

			                               $data = array(
			                    
			                                 'Marked' => $checkprevisouspayment->Marked + 1,
			                              );
			                              $this->db->where('PaymentCode',$AccountReference);
			                               $this->db->update("transactions",  $data);
			                         }

			                         $response  = "END Wait for payment from Mpesa." ;
			                            $this->sendOutput($response);

			                        
			                         
			                       
	                    
	                    }else{
	                    	$response  = "END STK Push was not sent." ;
	                            $this->sendOutput($response);

	                      
	                          
	                    }

         	   }else{
         	   	 $response = "END Billnumber was not found \n";
	             $this->sendOutput($response);
         	   }
         	}



         }else{
         	$response = "END Billnumber was not found \n";
	            $this->sendOutput($response);
         }

       
       
	
       }
      function generatebusiness($BusinessId,$year){


      		

      	      $Start_yr=2019;
              $current_yr=date('Y') ; 
              $different=  $current_yr -  $Start_yr;                                      
              for( $i=1; $i<=$different; $i++ ) :

              	  if($i==$year){
              	  	  $permityear=$current_yr;
              	   }
				
				 $current_yr-=1;
		       endfor;
		        $record= $this->businesses->get_businesses($BusinessId);
                if(empty($record)){
                 		$response = "END Business ID ". $BusinessId ." not found \n";
        	            $this->sendOutput($response);
                             
                 }
                 if($check=$this->businesses->checkpermit($BusinessId,$permityear,$record->ActivityCode)){

                 	if($check->AmountPaid>=$check->AmountBilled){

                 		$response  = "END The Business is already paid for the year ". $permityear . " \n";

			    	   

					    $this->sendOutput($response);

                 	}else{
                 		$response  = "CON Confirm Payment Details . \n Business Name : ". $record->BusinessName . " \n Business ID: " . $record->BusinessID ." \n Bill Number : " . $check->BillNo." \n Bill Amount : ". $check->AmountBilled." \n";

			    	    $response .= "1. Ok \n";
			    	    $response .= "2. Cancel";

					   $this->sendOutput($response);
                 		

                 	}
                 	

                       /* $this->session->set_flashdata( "error", 'There is already bill Number " '.$check->BillNo .' " For this selected year '. $this->input->post('year') );
                        redirect('business/view/'.$this->input->post('BusinessID')) ;*/

                  }else{

                  		$incometypesdetails = $this->billings->incometypes(3);
                       if(!$incometypesdetails){
                       		$response = "END Income type is not well defined  \n";
        	                $this->sendOutput($response);
                           

                         }

                             if(!$generatebill = $this->billings->generatebills( $incometypesdetails->incomeTypePrefix)){
                             		$response = "END Fail to generate bill. Try again  \n";
        	                        $this->sendOutput($response);

                         

                             }

                             $TrackNumber=$generatebill->TrackNumber;
                             $PaymentCode=$generatebill->PaymentCode;
                                     $intmon=(int)date('m');
                                    if($intmon <=6){

                                        $fiscalYear=date('Y')-1 ."". date('Y');
                                    }else{
                                        $fiscalYear=date('Y') ."". (date('Y')+1);
                                     }
                                    
                                    $effectiveDate=$permityear ."-01-01";
                                    $expirelydate=$permityear ."-12-31";

                                     
                                       $data=[
                                          'BillNo'=>$TrackNumber, 
                                          'PaymentCode'=>$PaymentCode, 
                                          'fiscalYear'=>$fiscalYear,
                                          'Customer'=>strtoupper($record->BusinessName ),
                                          'Description'=>"BusinessID - ". $BusinessId ,
                                          'BillStatus'=>2,
                                          'IncomeTypeID'=>3,
                                          'IdentifyNo'=>$BusinessId,
                                          'PeriodID'=>  1,
                                          'SubcountyID'=> $record->ZoneCode,
                                          'WardID'=> $record->WardCode,
                                           'ZoneId'=>$record->ZoneId,
                                          'BillTotal'=>$record->SBPFee,
                                          'ReducingBalance'=>$record->SBPFee,
                                           'CreatedFrom'=>"USSD",
                                          'SourceFromId'=>4,
                                          'DateIssued'=>date('Y-m-d'),
                                          'DateCreated'=>$this->date,
                                          'DateModified'=>$this->date,
                                          'CreatedBy'=>$this->id,
                                          'ModifiedBy'=>$this->id,
                                        ];
                                        if($infodetails= $this->billings->insertbillinfo($data)){

                                           $data21=[
                                              'BillNo'=>$TrackNumber, 
                                              'BusinessId'=>$BusinessId,
                                              'SBPFee'=>$record->SBPFee,
                                              'RegistrationFee'=>0,
                                              'AmountBilled'=>$record->SBPFee,
                                              'DateIssued'=>$this->date,
                                              'DateModified'=>$this->date,
                                              'CalenderYear'=>$permityear,
                                              'Period'=>1,
                                              'StartDate'=>$effectiveDate,
                                              'EndDate'=>$expirelydate,
                                              'ActivityCode'=>$record->ActivityCode
                                          ];
                                          $this->billings->permiteffectiveness($data21);

                                          $data22=[
                                              'BillNo'=>$TrackNumber, 
                                              'IncomeTypeID'=>3,
                                              'CostCenterNo'=>"0",
                                              'AccountNo'=>"473",
                                              'FeeID'=>473,
                                               'ZoneId'=>$record->ZoneId,
                                              'DetailAmount'=> $record->SBPFee,
                                              'Currency'=>'KES',
                                              'DateCreated'=>$this->date,
                                              'DateModified'=>$this->date,
                                              'CreatedBy'=>$this->id,
                                              'ModifiedBy'=>$this->id,
                                          ];
                                        
                                      
                                        if($infodetails= $this->billings->insertBillDetails($data22)){
                                      
                                           $response  = "CON Confirm Payment Details . \n Business Name : ". $record->BusinessName . " \n Business ID: " . $record->BusinessID ." \n Bill Number : " . $TrackNumber." \n Bill Amount : ". $$record->SBPFee." \n";


		    	                            $response .= "1. Ok \n";
		    	                            $response .= "2. Cancel";

                                            }else{
                                                  $response = "END Fail to generate bill. Try again  \n";
        	                                       $this->sendOutput($response);

                                                 }
                                 }else{
                                       $response = "END Fail to generate bill. Try again  \n";
        	                           $this->sendOutput($response);

                                   }
                                



                  }

                                                          
		       

				//$this->sendOutput($response);





      }

     function gethousebill($EstateId,$housetype,$houseno,$amount,$phoneNumber){



     			 $results=$this->houses->viewhouses($EstateId,$housetype,$houseno);
		         if(!$results){

		         	$response = "END No tenant attached ";
		        	$this->sendOutput($response);
		    

		          }


     			   if(!$incomedetails =$this->cesses->cessdetails(13994)){
                   	  $response  = "END FeeID was not found." ;
		      	      $this->sendOutput($response);
 
                    }
     	           $incometypesdetails = $this->billings->incometypes(2);
                   if(!$incometypesdetails){
                   	 $response  = "END Prefix is not set properly. Kindly Contact admin." ;
		      	      $this->sendOutput($response);
                      

                     }

                       if(!$generatebill = $this->billings->generatebills( $incometypesdetails->incomeTypePrefix)){
                       		 $response  = "END Fail to generate bill. Try again." ;
		      	             $this->sendOutput($response);
                       }

                       $TrackNumber=$generatebill->TrackNumber;
                       $PaymentCode=$generatebill->PaymentCode;
                       


                         $intmon=(int)date('m');
                          if($intmon <=5){

                            $fiscalYear=(date('Y')) -1 ."". date('Y');
                          }else{
                            $fiscalYear=(date('Y') ."". date('Y')) + 1;
                          }
                        
                       
                          $data=[
                            'BillNo'=>$TrackNumber, 
                            'PaymentCode'=>$PaymentCode, 
                            'fiscalYear'=>$fiscalYear,
                            'Customer'=>$results->FirstName ." ". $results->MiddleName ." ". $results->OtherNames,
                            'Description'=>'Rent Payment for unit. '. $results->UnitName ,
                            'IdentifyNo'=>  $results->PaymentAccount,
                            'BillStatus'=>2,
                            'IncomeTypeID'=>2,
                            'PeriodID'=>  1,
                            'WardID'=>$results->WardId,
                            'SubcountyID'=>$results->SubCountyId,
                             'ZoneId'=>$results->ZoneId,
                            'BillTotal'=>$amount,
                            'ReducingBalance'=>$amount,
                            'DateIssued'=>date('Y-m-d'),
                            'DateCreated'=>$this->date,
                            'DateModified'=>$this->date,
                            'CreatedFrom'=>"USSD",
                            'SourceFromId'=>4,
                            'CreatedBy'=> $this->id,
                             'ModifiedBy'=> $this->id,
                          ];
                          if($infodetails= $this->billings->insertbillinfo($data)){

                              $data22=[
                                  'BillNo'=>$TrackNumber, 
                                  'IncomeTypeID'=>2,
                                  'CostCenterNo'=>$incomedetails->costCenterNo,
                                  'AccountNo'=>$incomedetails->accountNo,
                                  'FeeID'=>$incomedetails->feeId,
                                  'ZoneId'=>$results->ZoneId,
                                  'DetailAmount'=>$amount,
                                  'Currency'=>'KES',
                                  'DateCreated'=>$this->date,
                                  'DateModified'=>$this->date,
                                  'CreatedBy'=> $this->id,
                                  'ModifiedBy'=> $this->id,
                              ];

                              if($infodetails= $this->billings->insertBillDetails($data22)){

                              		  $PayBillNumber=$this->PayBillNumber;
	                                  $Amount=(int)$amount;
	                                  $PhoneNumber=$phoneNumber;
	                                  $AccountReference=$PaymentCode;
	                                  $TransactionDesc="from biller";
	                                   if($fields=$this->sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc)){  

	                                             $checkprevisouspayment=$this->billings->checkprevisouspayments($PaymentCode);
	                                         if($checkprevisouspayment){

	                                               $data = array(
	                                    
	                                                 'Marked' => $checkprevisouspayment->Marked + 1,
	                                              );
	                                              $this->db->where('PaymentCode',$PaymentCode);
	                                               $this->db->update("transactions",  $data);
	                                         }

	                                         $response  = "END Wait for payment from Mpesa." ;
		      	                            $this->sendOutput($response);

	                                        
	                                         
	                                         
	                                    
	                                    }else{
	                                    	$response  = "END STK Push was not sent." ;
		      	                            $this->sendOutput($response);

	                                      
	                                          
	                                    }


                              }else{
                              	 $response  = "END An error occurred while created bill details. Try again." ;
		      	                     $this->sendOutput($response);
                              }
                          }else{
                          	 $response  = "END An error occurred while created bill details. Try again." ;
		      	                     $this->sendOutput($response);
                          }





      }


     function generatelandratebill($PlotNumber,$amount,$phoneNumber){



     			 $results=$this->landrates->searchplotdetails($PlotNumber);
		         if(!$results){

		         	$response = "END This PlotNumber -  ". $PlotNumber . " not found ";
		        	$this->sendOutput($response);
		    

		          }


     			   if(!$incomedetails =$this->cesses->cessdetails(100999)){
                   	  $response  = "END FeeID was not found." ;
		      	      $this->sendOutput($response);
 
                    }
     	           $incometypesdetails = $this->billings->incometypes(2);
                   if(!$incometypesdetails){
                   	 $response  = "END Prefix is not set properly. Kindly Contact admin." ;
		      	      $this->sendOutput($response);
                      

                     }

                       if(!$generatebill = $this->billings->generatebills( $incometypesdetails->incomeTypePrefix)){
                       		 $response  = "END Fail to generate bill. Try again." ;
		      	             $this->sendOutput($response);
                       }

                       $TrackNumber=$generatebill->TrackNumber;
                       $PaymentCode=$generatebill->PaymentCode;
                       


                         $intmon=(int)date('m');
                          if($intmon <=5){

                            $fiscalYear=(date('Y')) -1 ."". date('Y');
                          }else{
                            $fiscalYear=(date('Y') ."". date('Y')) + 1;
                          }
                        
                       
                          $data=[
                            'BillNo'=>$TrackNumber, 
                            'PaymentCode'=>$PaymentCode, 
                            'fiscalYear'=>$fiscalYear,
                            'Customer'=>$results->OwnerFirstName ." ". $results->OwnerMiddleName ." ". $results->OwnerLastName,
                            'Description'=>'Land Rate Payment for PlotNumber. '. $PlotNumber,
                            'IdentifyNo'=>  $results->Upn,
                            'BillStatus'=>2,
                            'IncomeTypeID'=>2,
                            'PeriodID'=>  1,
                            'WardID'=>$results->WardId,
                            'SubcountyID'=>$results->SubCountyId,
                            'BillTotal'=>$amount,
                            'ReducingBalance'=>$amount,
                            'DateIssued'=>date('Y-m-d'),
                            'DateCreated'=>$this->date,
                            'DateModified'=>$this->date,
                            'CreatedFrom'=>"USSD",
                            'SourceFromId'=>4,
                            'CreatedBy'=> $this->id,
                             'ModifiedBy'=> $this->id,
                          ];
                          if($infodetails= $this->billings->insertbillinfo($data)){

                              $data22=[
                                  'BillNo'=>$TrackNumber, 
                                  'IncomeTypeID'=>2,
                                  'CostCenterNo'=>$incomedetails->costCenterNo,
                                  'AccountNo'=>$incomedetails->accountNo,
                                  'FeeID'=>$incomedetails->feeId,
                                  'DetailAmount'=>$amount,
                                  'Currency'=>'KES',
                                  'DateCreated'=>$this->date,
                                  'DateModified'=>$this->date,
                                  'CreatedBy'=> $this->id,
                                  'ModifiedBy'=> $this->id,
                              ];

                              if($infodetails= $this->billings->insertBillDetails($data22)){

                              		  $PayBillNumber=$this->PayBillNumber;
	                                  $Amount=(int)$amount; 
	                                  $PhoneNumber=$phoneNumber; 
	                                  $AccountReference=$PaymentCode;
	                                  $TransactionDesc="from biller";
	                                   if($fields=$this->sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc)){  

	                                             $checkprevisouspayment=$this->billings->checkprevisouspayments($PaymentCode);
	                                         if($checkprevisouspayment){

	                                               $data = array(
	                                    
	                                                 'Marked' => $checkprevisouspayment->Marked + 1,
	                                              );
	                                              $this->db->where('PaymentCode',$PaymentCode);
	                                               $this->db->update("transactions",  $data);
	                                         }

	                                         $response  = "END Wait for payment from Mpesa." ;
		      	                            $this->sendOutput($response);

	                                        
	                                         
	                                         
	                                    
	                                    }else{
	                                    	$response  = "END STK Push was not sent." ;
		      	                            $this->sendOutput($response);

	                                      
	                                          
	                                    }


                              }else{
                              	 $response  = "END An error occurred while created bill details. Try again." ;
		      	                     $this->sendOutput($response);
                              }
                          }else{
                          	 $response  = "END An error occurred while created bill details. Try again." ;
		      	                     $this->sendOutput($response);
                          }



      }

     function saveparking($DurationID,$VehicleTypeID,$town,$Platenumber,$phoneNumber){
     	 $this->load->model("saccos");
     	 $this->load->model("cesses");
          $results=$this->parkings->getcharges($DurationID,$VehicleTypeID,$town,$Platenumber);

          if(!$sacco=$this->saccos->checkvehicleinsacco($Platenumber) ){
                        $this->parkings->addvehicles($VehicleTypeID,$Platenumber);
                        $SaccoId=3; 
                }else{

                   $SaccoId=$sacco->Id;
                } 

                if($getduration=$this->saccos->getdurations($DurationID) ){
                    $days=$getduration-1;
                    $StartDate=date('Y-m-d');
                    $time = strtotime($StartDate);
                    $datend = date("Y-m-d", strtotime("+ ".$days." days ", $time));

                       
                }else{
                	  $response  = "END The charge is not set." ;
		      	      $this->sendOutput($response);
                   
                 }



                  $getcharge =$this->parkings->getcharges($DurationID,$VehicleTypeID);
                
                  if(!$getcharge){
                  		$response  = "END The charge is not set." ;
		      	        $this->sendOutput($response);

                   }
                   if(!$gettown=$this->parkings->gettowndetails($town)){

                          $WardID=1; 
                          $SubcountyID=1;
                          $ZoneId=1; 
                    }else{
                               
                          $WardID=$gettown->WardID ; 
                          $SubcountyID=$gettown->SubcountID; 
                          $ZoneId=$gettown->ZoneId;  
                   }
             
                   if(!$incomedetails =$this->cesses->cessdetails($getcharge->FeeId)){
                   	  $response  = "END FeeID was not found." ;
		      	      $this->sendOutput($response);
 
                    }
                    $BillTotal=$getcharge->Amount ;
                     $BillTotal1=$getcharge->Amount ;
                    $Customer= "Identifaction Number - ". $Platenumber;
                    $Description= $incomedetails->feeDescription;
                    $incometypesdetails = $this->billings->incometypes(6);
                       $othercharge=0;
                      if($DurationID==1){
                      		 $this->load->model("portals");
                           if($record= $this->portals->getothercharge(strtoupper(str_replace(' ', '', $Platenumber)))){
                                  $BillTotal1=$BillTotal + $record->DetailAmount;
                                   $othercharge=1;

                           }
                         }
                   if(!$incometypesdetails){
                   	 $response  = "END Prefix is not set properly. Kindly Contact admin." ;
		      	      $this->sendOutput($response);
                      

                     }

                       if(!$generatebill = $this->billings->generatebills( $incometypesdetails->incomeTypePrefix)){
                       		 $response  = "END Fail to generate bill. Try again." ;
		      	             $this->sendOutput($response);
                       }

                       $TrackNumber=$generatebill->TrackNumber;
                       $PaymentCode=$generatebill->PaymentCode;
                       


                         $intmon=(int)date('m');
                          if($intmon <=5){

                            $fiscalYear=(date('Y')) -1 ."". date('Y');
                          }else{
                            $fiscalYear=(date('Y') ."". date('Y')) + 1;
                          }
                        
                       
                          $data=[
                            'BillNo'=>$TrackNumber, 
                            'PaymentCode'=>$PaymentCode, 
                            'fiscalYear'=>$fiscalYear,
                            'Customer'=>$Customer,
                            'Description'=>$Description,
                            'IdentifyNo'=> strtoupper(str_replace(' ', '', $Platenumber)),
                            'BillStatus'=>2,
                            'IncomeTypeID'=>6,
                            'PeriodID'=>  1,
                            'WardID'=>$WardID,
                            'SubcountyID'=>$SubcountyID,
                            'ZoneId'=>$ZoneId,
                            'BillTotal'=>$BillTotal1,
                            'ReducingBalance'=>$BillTotal1,
                            'CreatedFrom'=>"USSD",
                            'SourceFromId'=>4,
                            'DateIssued'=>date('Y-m-d'),
                            'DateCreated'=>$this->date,
                            'DateModified'=>$this->date,
                            'CreatedBy'=> $this->id,
                             'ModifiedBy'=> $this->id,
                          ];
                          if($infodetails= $this->billings->insertbillinfo($data)){

                          	  if($othercharge==1){
                                     $data21=[
                                    'BillNo'=>$TrackNumber, 
                                    'IncomeTypeID'=>6,
                                    'CostCenterNo'=>$record->CostCenterNo,
                                    'AccountNo'=>$record->AccountNo,
                                    'FeeID'=>$record->FeeID,
                                    'DetailAmount'=>$record->DetailAmount,
                                    'Currency'=>'KES',
                                    'DateCreated'=>$this->date,
                                    'DateModified'=>$this->date,
                                    'CreatedBy'=> $this->id,
                                    'ModifiedBy'=> $this->id,
                                ];
                                $this->billings->insertBillDetails($data21);

                             }

                              $data22=[
                                  'BillNo'=>$TrackNumber, 
                                  'IncomeTypeID'=>6,
                                  'CostCenterNo'=>$incomedetails->costCenterNo,
                                  'AccountNo'=>$incomedetails->accountNo,
                                  'FeeID'=>$incomedetails->feeId,
                                  'DetailAmount'=>$BillTotal,
                                   'ZoneId'=>$ZoneId,
                                  'Currency'=>'KES',
                                  'DateCreated'=>$this->date,
                                  'DateModified'=>$this->date,
                                  'CreatedBy'=> $this->id,
                                  'ModifiedBy'=> $this->id,
                              ];

                              if($infodetails= $this->billings->insertBillDetails($data22)){

                                   $rws = [];
                                  $this->db->select('*' )->from('sessiongenerators')->order_by('Id','DESC');;
                                  $query = $this->db->get();
                                  if($query->result()){
                                    $rws = $query->row()->SessionKey; 
                                    $query->free_result();  
                                  }

                                  if(!$rws){
                                   $session=1;
                                    $this->db->insert( "sessiongenerators", [
                                      'SessionKey' =>$session,
                                      'Bill_name' =>"bill_".$session,
                                      'SaccoId' =>  $SaccoId,
                                      'FeeId'=>$incomedetails->feeId,
                                      'DateCreated' => $this->datetime,
                                      'UserId'=>$this->id,
                                      'BillNumber'=>$TrackNumber,
                                      'PaymentCode'=>$PaymentCode, 
                                      'BillStatus'=>2
                                        ]);


                                    }else{
                                      $session=   $rws + 1;
                                        $this->db->insert( "sessiongenerators", [
                                          'SessionKey' =>$session,
                                          'Bill_name' =>"bill_".$session,
                                          'SaccoId' =>$SaccoId,
                                          'FeeId'=>$incomedetails->feeId,
                                          'DateCreated' => $this->datetime,
                                          'UserId'=>$this->id,
                                          'BillNumber'=>$TrackNumber,
                                          'PaymentCode'=>$PaymentCode, 
                                          'BillStatus'=>2
                                    
                                            ]);
                                    }

                                    //$category=$this->saccos->vehiclecategorys($this->input->post("vehicletypes"));
                                  



                                    $this->db->insert( "billingdetails", [
                                        'SessionKey' => $session,
                                        'SaccoId' => $SaccoId,
                                        'BillingInfo' =>strtoupper(str_replace(' ', '', $Platenumber)),
                                        'Category' => $getcharge->VehicleType,
                                        'Categoryid' => $getcharge->ChargeID,
                                        'Duration' => $this->input->post("durations"),
                                        'Amount' =>$BillTotal,
                                        'StartDate' => $StartDate,
                                        'EndDate' => $datend,
                                        'NetAmount'=>$BillTotal,
                                        'PartId'=>2,
                                        'Datecreated' => $this->datetime,
                                        'Datemodified'=>$this->datetime,
                                        'BillStatus'=>1
                                        
                                      ] );

                                      $info= $this->apimodels->getbillinfos($TrackNumber);
	                                  $PayBillNumber=$this->PayBillNumber;
	                                  $Amount=(int)$BillTotal;
                                      $PhoneNumber=$phoneNumber;
	                                  $AccountReference=$PaymentCode;
	                                  $TransactionDesc="from biller";
	                                  if($fields=$this->sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc)){  

	                                             $checkprevisouspayment=$this->billings->checkprevisouspayments($PaymentCode);
	                                         if($checkprevisouspayment){

	                                               $data = array(
	                                    
	                                                 'Marked' => $checkprevisouspayment->Marked + 1,
	                                              );
	                                              $this->db->where('PaymentCode',$PaymentCode);
	                                               $this->db->update("transactions",  $data);
	                                         }

	                                         $response  = "END Wait for payment from Mpesa." ;
		      	                            $this->sendOutput($response);

	                                        
	                                         
	                                         
	                                    
	                                    }else{
	                                    	$response  = "END STK Push was not sent." ;
		      	                            $this->sendOutput($response);

	                                      
	                                          
	                                    }





                              }else{
                              		 $response  = "END An error occurred while created bill details. Try again." ;
		      	                     $this->sendOutput($response);
                                    
                               

                              }
                            }else{
                            	 $response  = "END Error occurred while adding charge." ;
		      	                  $this->sendOutput($response);

                               

                            }
         

       
	
        }

    

    function sendOutput($response){

		header('Content-type: text/plain');
		echo $response;
		exit;
     
    }

    public function getLevel($text){

        if($text == ""){
          $response['level'] = 0;
        }else{
          $exploded_text = explode('*',$text);
          $response['level'] = count($exploded_text);
          $response['latest_message'] = end($exploded_text);
        }
        return $response;
      }


     public  function sendSTKPush($PayBillNumber,$Amount,$PhoneNumber,$AccountReference,$TransactionDesc){


     /*	echo $AccountReference;
     	exit;*/

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    set_time_limit(0);

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://payme.revenuesure.co.ke/index.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",



        CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"TransactionType\"\r\n\r\nCustomerPayBillOnline\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"PayBillNumber\"\r\n\r\n$PayBillNumber\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"Amount\"\r\n\r\n$Amount\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"PhoneNumber\"\r\n\r\n$PhoneNumber\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"AccountReference\"\r\n\r\n$AccountReference\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"TransactionDesc\"\r\n\r\n$TransactionDesc\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer UVZoQk9rcFhDcWxlR1RPSnJBa1RaRkZQSjdZdlVSRzdZTThHVldLUU1jZz06MTIzNDU6UTIydkozVll4RzFMWUV2MkViSDl5UVN3NFFRanZrNVJoVThQM0pXTXRIRT06MTk3LjI0OC4xNDkuNjI6MDQvMDAvMTcgMTIwMA",
            "Postman-Token: 6243c464-11fe-43a2-ab0b-6563f4c87b2c",
            "cache-control: no-cache",
            "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

   // echo '<pre>'; print_r($response); exit;

          return  $response;
   }


   public function goToMainMenu($text){  

	    
   		//$text="";

	    $explodedText = explode("*",$text);
	    while(array_search($this->GO_TO_MAIN_MENU , $explodedText) != false){
	        $firstIndex = array_search($this->GO_TO_MAIN_MENU , $explodedText);
	        $explodedText = array_slice($explodedText, $firstIndex + 1);
	    }
	    return join("*",$explodedText);
   } 

   public function goBack($text){           
            $explodedText = explode("*",$text);
            while(array_search($this->GO_BACK , $explodedText) != false){
                $firstIndex = array_search($this->GO_BACK , $explodedText);
                array_splice($explodedText, $firstIndex-1, 2);
            }

           /* echo join("*", $explodedText);
            exit;*/
            return join("*", $explodedText);

             //$this->sendOutput($response);
    }



     

	
	

	
	
}