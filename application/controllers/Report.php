<?php 
if( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );


class Report extends CI_Controller 
{
  

  public function __construct()
  {
      parent::__construct();

    

    if (!$this->session->userdata('is_logged_in')) {
            redirect('login');
     } 
    if($this->session->userdata('password_set')==0){
       redirect('login/setpassword');
    }
     $this->id=$this->session->userdata('UserID');
      $this->load->model("incomeTypes");
      $this->load->model("departments");
      $this->load->model("reports");
      $this->load->model("users");
      $this->load->model("subcountys");
    
    $this->data['parent_page'] = 'Report';
    $this->data['pagefor'] = 'Report';
    

    }
     public function index()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      /* ['field' => 'department_id', 'label' => 'Department', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],]   */                 
    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Select";
       $this->data['departments']=$this->departments->lists();
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/select' );   
       $this->load->view( "templates/footer" );
    else:
       /* if($this->input->post("department_id")=="All"){
            $this->data['sub_title']="All Departments";
        }else{
             $this->data['sub_title']=$this->departments->details($this->input->post("department_id"))->DepartmentName;
          }
*/
           $this->data['sub_title']="All Departments";
           if($this->data['records']=$this->reports->billingreport($this->input->post("date_from"),$this->input->post("date_to"))){
                    $this->data['date_from']=$this->input->post("date_from");
                    $this->data['date_to']=$this->input->post("date_to");
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/list' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report');

           }

           
    endif;  
      
  }
    


   public function details()
  {
            $this->data['title'] = "County|Report";
            $this->data['page'] = 'Report';


          if(!$this->uri->segment(3)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report');
          }
          if(!$this->uri->segment(4)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report');
          }
          if(!$this->uri->segment(5)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report');
          }
     
     
           if($this->data['records']=$this->reports->details($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(3))){
                      $record=$this->users->detail_user($this->uri->segment(3));
                      if($record){
                        $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
                      }else{
                        $this->data['sub_title']="";
                      }
                     
                    $this->data['date_from']=$this->uri->segment(4);
                    $this->data['date_to']=$this->uri->segment(5);
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/details' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report');

           }

           

      
  }

     public function subcountysummary()
        {

         
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
              $this->data['sub_title']="Revenue Reports > Subcounty Summary";
              $this->data['date_from']=date('Y-m-d');
             $this->data['date_to']=date('Y-m-d');

                  $newdata = array( 
                   'date_from1'  => $this->data['date_from'], 
                   'date_to1'     => $this->data['date_to'], 
                );  

               $this->session->set_userdata($newdata);
              
       
           if( $this->data['records']=$this->reports->subcountysummary1s( $this->session->userdata('date_from1'), $this->session->userdata('date_from1'))){

                      
                        $this->load->view( "templates/header", $this->data );
                        $this->load->view( 'report/allsubsummarys' );       
                        $this->load->view( "templates/footer" );

           }else{

                
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
                  redirect( 'report/selectsummarysubcounty');

          }

      }


 public function subcountysummarys()
  {
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Report';
       $this->data['sub_title']="Revenue Reports > Subcounty Summary";
       $this->load->model("subcountys");

        $this->data['date_from']=$this->session->userdata('date_from1');
       $this->data['date_to']=$this->session->userdata('date_to1');
      
       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
       
        $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['printedperwardreceipteds']=$this->reports->printedperwardreceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardbilleds']=$this->reports->perwardbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardtransactions']=$this->reports->perwardtransactions($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['records']=$this->reports->streamsummarys(  $this->data['date_from'],  $this->data['date_to'],$this->session->userdata('SubCounty'));
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/subcountysummary' );   
       $this->load->view( "templates/footer" );
  
  }


  public function wardsummary()
  {

   
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
       $this->data['sub_title']="Revenue Reports > Ward Summary";
       $this->data['date_from']=$this->session->userdata('date_from1');
       $this->data['date_to']=$this->session->userdata('date_to1');
        
        $this->data['subcount']= $this->subcountys->details($this->uri->segment(3))->SubCountyName;
 
     if( $this->data['records']=$this->reports->wardsummary1s( $this->uri->segment(3),$this->data['date_from'], $this->data['date_to'])){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/allwardssummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

           
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
            redirect( 'report/selectsummarysubcounty');

    }
}

public function revenue_streams()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
     $this->data['sub_title']="Revenue Reports > Revenue Streams Summary";
        $this->data['date_from']=$this->session->userdata('date_from1');
       $this->data['date_to']=$this->session->userdata('date_to1');
        
        $this->data['ward']= $this->subcountys->ward_details($this->uri->segment(3))->WardName;
        $this->data['ward_id']=$this->uri->segment(3);
 
     if( $this->data['records']=$this->reports->wardincomeTypes( $this->uri->segment(3),$this->data['date_from'], $this->data['date_to'])){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/per_streams' );       
                  $this->load->view( "templates/footer" );

     }else{

                 
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
                 redirect( 'report/selectsummarysubcounty');
    

    }
}


 public function selectsummarysubcounty()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
     $this->data['sub_title']="Summarys";
       $this->data['sub_title']="Revenue Reports > Revenue Streams Summary";
    $this->form_validation->set_rules( [

     
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']=" Summary";
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsummarysubcounty' );       
                $this->load->view( "templates/footer" );
    else :

           $this->data['date_from']=$this->input->post("date_from");
            $this->data['date_to']=$this->input->post("date_to");

            $newdata = array( 
             'date_from1'  => $this->data['date_from'], 
             'date_to1'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
         
            
               if( $this->data['records']=$this->reports->subcountysummary1s( $this->session->userdata('date_from1'), $this->session->userdata('date_to1'),$this->input->post("subcounty_id"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/allsubsummarys' );       
                    $this->load->view( "templates/footer" );

           }else{

               
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
              redirect( 'report/selectsummarysubcounty');

           }

              
   endif;



 }
 public function get_streams()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
      $this->data['sub_title']="Revenue Reports > Revenue Streams Summary";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');

         $newdata = array( 
             'date_from'  => $this->data['date_from'], 
             'date_to'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
          //$this->session->userdata('date_from');
     if( $this->data['records']=$this->reports->getincomeTypes($this->session->userdata('date_from'), $this->session->userdata('date_to'))){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/get_streams' );       
                  $this->load->view( "templates/footer" );

     }else{

                 
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
        
                  redirect( 'report/selectsummarystream');

    }
}

 public function get_subcountysummary()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
  
      $this->data['sub_title']="Revenue Reports > Revenue Streams Summary > Sub County";
        $this->data['date_from']=$this->session->userdata('date_from');
       $this->data['date_to']=$this->session->userdata('date_to');
        $this->data['stream']= $this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription;
 
     if( $this->data['records']=$this->reports->per_incomtypes( $this->uri->segment(3),$this->data['date_from'], $this->data['date_to'])){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/get_incomesub' );       
                  $this->load->view( "templates/footer" );

     }else{

             
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
            redirect( 'report/selectsummarystream');

    }
}



  public function get_wardsummary()
  {

   
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Wards';
          $this->data['sub_title']="Revenue Reports > Revenue Streams Summary > Ward";
       $this->data['date_from']=$this->session->userdata('date_from');
       $this->data['date_to']=$this->session->userdata('date_to');
       $this->data['subcount']= $this->subcountys->details($this->uri->segment(4))->SubCountyName;
       $this->data['stream']= $this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription;
 
     if( $this->data['records']=$this->reports->get_wardsummary1s( $this->uri->segment(3),$this->uri->segment(4),$this->data['date_from'], $this->data['date_to'])){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/get_incomeward' );       
                  $this->load->view( "templates/footer" );

     }else{

              
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
            redirect( 'report/selectsummarystream');

    }
}


public function detailswardstreamreport()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from');
          $this->data['date_to']=$this->session->userdata('date_to');
          $this->data['subcountid']=$this->uri->segment(3);
        
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->detailswardtreamreports( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3),$this->uri->segment(4))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/detailstreamsreport' );       
                    $this->load->view( "templates/footer" );

           }else{

                    
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
                   redirect( 'report/selectsummarystream');

           }

              
 }


public function detailswardtreamreports()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from1');
          $this->data['date_to']=$this->session->userdata('date_to1');
        
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->detailswardtreamreports( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3),$this->uri->segment(4))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/detailstreamreport1' );       
                    $this->load->view( "templates/footer" );

           }else{

                    
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
                   redirect( 'report/subcountysummarys');

           }

              
 }

 public function selectsummarystream()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
        $this->data['sub_title']="Revenue Reports > Revenue Streams Summary ";
     $this->load->library('session');
    $this->form_validation->set_rules( [

     
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
            
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsummarystream' );       
                $this->load->view( "templates/footer" );
    else :

           $this->data['date_from']=$this->input->post("date_from");
            $this->data['date_to']=$this->input->post("date_to");

            $newdata = array( 
             'date_from'  => $this->data['date_from'], 
             'date_to'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
          //$this->session->userdata('date_from');


    
         if($this->data['records']=$this->reports->getincomeTypes($this->session->userdata('date_from'), $this->session->userdata('date_to'))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/get_streams' );       
                    $this->load->view( "templates/footer" );

           }else{

                
                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
              redirect( 'report/selectsummarystream');

           }

              
   endif;



 }

 /* public function streamdetails()
  {
            $this->data['title'] = "County|Report";
            $this->data['page'] = 'Report';


          if(!$this->uri->segment(3)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/streamdetails');
          }
          if(!$this->uri->segment(4)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/streamdetails');
          }
          if(!$this->uri->segment(5)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/streamdetails');
          }
     
     
           if($this->data['records']=$this->reports->streamdetails($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(3))){
                     //  $this->data['incomeTypes']= $this->incomeTypes->lists();
                      $record=$this->incomeTypes->details($this->uri->segment(3));
                      if($record){
                        $this->data['sub_title']=ucwords(strtolower($record->incomeTypeDescription));
                      }else{
                        $this->data['sub_title']="";
                      }
                     
                    $this->data['date_from']=$this->uri->segment(4);
                    $this->data['date_to']=$this->uri->segment(5);
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamdetails' );       
                    $this->load->view( "templates/footer" );

           }else{

                $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
              redirect( 'report/streamdetails');

           }

           

      
  }
*/
   public function stream()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'stream_id', 'label' => 'Stream', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],]                    
    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Select";
       $this->data['incomeTypes']= $this->incomeTypes->lists();
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/revselect' );   
       $this->load->view( "templates/footer" );
    else:
        if($this->input->post("stream_id")=="All"){
            $this->data['sub_title']="All Streams";
        }else{
             $this->data['sub_title']=$this->incomeTypes->details($this->input->post("stream_id"))->incomeTypeDescription;
          }
              $this->data['date_from']=$this->input->post("date_from");
                    $this->data['date_to']=$this->input->post("date_to");
          if($this->data['records']=$this->reports->streamdetails($this->input->post("date_from"),$this->input->post("date_to"),$this->input->post("stream_id"))){
                
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamlist' );       
                    $this->load->view( "templates/footer" );

           }else{
              $this->session->set_flashdata( "error", "No result found from   ". $this->data['date_from'] ." to " .  $this->data['date_to'] );
            
              redirect( 'report/stream');

           }

           
    endif;  
      
  }

   public function performancepersubcounty()
  {
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Report';
       $this->data['sub_title']="Performance Reports > Subcounty Summary";
       $this->load->model("subcountys");
       $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');
   
        $newdata = array( 
           'date_from1'  => $this->data['date_from'], 
           'date_to1'     => $this->data['date_to'], 
        );  

       $this->session->set_userdata($newdata);
        $this->data['date_from']=$this->session->userdata('date_from1'); 
        $this->data['date_to']= $this->session->userdata('date_to1');
       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
       
       $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
   
       $this->data['onlinebilleds']=[];//$this->reports->onlinebilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['userbilleds']=$this->reports->userbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
     
      $this->data['receiptedbycashier']=$this->reports->receiptedbycashier($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
      
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/performancesummary' );   
       $this->load->view( "templates/footer" );
  
  }
   public function detailstreamreports()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
          $this->data['date_from']=$this->session->userdata('date_from1');
          $this->data['date_to']= $this->session->userdata('date_to1');
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
   
          if($this->data['records']=$this->reports->detailstreambillssummarys($this->uri->segment(3),$this->data['date_from'],$this->data['date_to'])){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/detailstreamreport' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/performancesummarys');

           }

              
 }
    public function performancesummarys()
  {
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Report';
       $this->data['sub_title']="Performance Reports > Subcounty Summary";
       $this->load->model("subcountys");

        $this->data['date_from']=$this->session->userdata('date_from1');
       $this->data['date_to']=$this->session->userdata('date_to1');
      
       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
        $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
   
       $this->data['onlinebilleds']=[];//$this->reports->onlinebilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['userbilleds']=$this->reports->userbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
     
      $this->data['receiptedbycashier']=$this->reports->receiptedbycashier($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
     
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/performancesummary' );   
       $this->load->view( "templates/footer" );
  
  }
    public function billsraisedreport()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from1');
          $this->data['date_to']=$this->session->userdata('date_to1');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->billsraisedreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/work1details' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/performancesummarys');

           }

              
 }

  public function printingperincome()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from1');
         $this->data['date_to']=$this->session->userdata('date_to1');
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->detailsprintedperincomereceipted( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3),$this->session->userdata('SubCounty'))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printed1list' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/performancesummarys');

           }

              
  }

     public function filterothers()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                          
    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Select";
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/selectfilterothers' );   
       $this->load->view( "templates/footer" );
    else:

        $this->data['title'] = "County|Report";
        $this->data['page'] = 'Report';
        $this->data['sub_title']="Performance Reports > Subcounty Summary";
        $this->load->model("subcountys");


        $this->data['date_from']=$this->input->post("date_from");;
        $this->data['date_to']=$this->input->post("date_to");;
   

          $newdata = array( 
             'date_from1'  => $this->data['date_from'], 
             'date_to1'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);


       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
       $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
     
        $this->data['onlinebilleds']=[];//$this->reports->onlinebilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['userbilleds']=$this->reports->userbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
     
       $this->data['receiptedbycashier']=$this->reports->receiptedbycashier($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
      
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/performancesummary' );   
       $this->load->view( "templates/footer" );    
     endif;  
      
  }


public function allsubcountysummary()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
      $this->data['sub_title']="Performance Reports >all Subcounty Summary";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');

            $newdata = array( 
             'date_from3'  => $this->data['date_from'], 
             'date_to3'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
        
 
     if( $this->data['records']=$this->reports->allsubcountysummary1s( $this->session->userdata('date_from3'), $this->session->userdata('date_to3'))){
                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/allsubcountysummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/allsubcountysummary');

    }

}

 public function detailsinglestreamreports()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
           $this->data['date_from']=$this->session->userdata('date_from3');
           $this->data['date_to']= $this->session->userdata('date_to3');
            $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
            $newdata = array( 
             'IncomeTypeDescription3'  => $this->uri->segment(3), 
           
          );  

         $this->session->set_userdata($newdata);
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
   
          if($this->data['records']=$this->reports->detailsinglestreambillssummarys($this->session->userdata('SubCountyseg3'), $this->uri->segment(3),$this->data['date_from'],$this->data['date_to'])){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/detailsinglestreamreport' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
    }
    public function billsraisedsinglereport()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from3');
          $this->data['date_to']=$this->session->userdata('date_to3');
          $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->billsraisedreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/work1singledetails' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
 }

/*
 public function allperformancesubcountysummary()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']=" Summary";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');

            $newdata = array( 
             'date_from3'  => $this->data['date_from'], 
             'date_to3'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
        
    
     if( $this->data['records']=$this->reports->allssubcountysummary1s( $this->session->userdata('date_from3'), $this->session->userdata('date_to3'))){
                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/allsubcountysummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/allsubcountysummary');

    }

}*/
public function performancesinglesubcounty()
  {
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Report';
       $this->data['sub_title']="Performance Reports > Subcounty Summary";
       $this->load->model("subcountys");
       $this->data['date_from']= $this->session->userdata('date_from3');
       $this->data['date_to']= $this->session->userdata('date_to3');

           $newdata = array( 
             'SubCountyseg3'  => $this->uri->segment(3), 
           
          );  

         $this->session->set_userdata($newdata);

       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCountyseg3'))->SubCountyName;
       
        $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCountyseg3'), $this->data['date_from'],  $this->data['date_to']);
    
       $this->data['onlinebilleds']=[];//$this->reports->onlinebilleds($this->session->userdata('SubCountyseg3'), $this->data['date_from'],  $this->data['date_to']);

       $this->data['userbilleds']=$this->reports->userbilleds($this->session->userdata('SubCountyseg3'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCountyseg3'), $this->data['date_from'],  $this->data['date_to']);
     
        $this->data['receiptedbycashier']=$this->reports->receiptedbycashier($this->session->userdata('SubCountyseg3'), $this->data['date_from'],  $this->data['date_to']);
      
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/performancesinglesummary' );   
       $this->load->view( "templates/footer" );
  
  }

  public function allperformancesubcountysummary()
  {

   
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->data['sub_title']="Performance Reports >all Subcounty Summary";
       $this->data['date_from']= $this->session->userdata('date_from3');
       $this->data['date_to']= $this->session->userdata('date_to3');
       

        
        
 
     if( $this->data['records']=$this->reports->allsubcountysummary1s( $this->session->userdata('date_from3'), $this->session->userdata('date_to3'))){
                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/allsubcountysummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/allsubcountysummary');

    }

}
  public function printingsigleperincome()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from3');
          $this->data['date_to']=$this->session->userdata('date_to3');
          $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->incomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->detailsprintedperincomereceipted( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3),$this->session->userdata('SubCountyseg3'))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printedsigle1list' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
  }

   public function allperformancesubcounty()
  {

   
         $this->data['title'] = "County|Report";
            $this->data['page'] = 'Report';
            $this->form_validation->set_rules( [

             ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
             ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                                
          ] );


          if( $this->form_validation->run() == FALSE ) :
             $this->data['sub_title']="Select";
             $this->load->view( "templates/header", $this->data );
             $this->load->view( 'report/selectsiglesummarys' );   
             $this->load->view( "templates/footer" );
          else:
                $this->data['title'] = "County|Report";
                $this->data['page'] = 'Report';
               // $this->data['sub_title']=" Summary";
                $this->data['sub_title']="Performance Reports >all Subcounty Summary";
            
                $this->data['date_from']=$this->input->post("date_from");
                $this->data['date_to']=$this->input->post("date_to");

                    $newdata = array( 
                     'date_from3'  => $this->data['date_from'], 
                     'date_to3'     => $this->data['date_to'], 
                  );  

                 $this->session->set_userdata($newdata);
                
            
             if( $this->data['records']=$this->reports->allsubcountysummary1s( $this->session->userdata('date_from3'), $this->session->userdata('date_to3'))){
                        
                          $this->load->view( "templates/header", $this->data );
                          $this->load->view( 'report/allsubcountysummarys' );       
                          $this->load->view( "templates/footer" );

             }else{

                    $this->session->set_flashdata( "error", "No Result Found" );
                    redirect( 'report/allsubcountysummary');

            }

        endif;

     }
      public function todayreport()
      {
      
           $this->data['sub_title']="All Departments";
           $this->data['date_from']=date('Y-m-d');
           $this->data['date_to']=date('Y-m-d');
           $this->data['page'] = 'Report';
               // $this->data['sub_title']=" Summary";
           $this->data['sub_title']="Performance Reports >Bill Raised";
           $this->data['records']=$this->reports->billingreport($this->data['date_from'],$this->data['date_to']);
          
           $this->load->view( "templates/header", $this->data );
           $this->load->view( 'report/list' );       
           $this->load->view( "templates/footer" );

          
      
      }
         public function todayreceipted()
        {
                 $this->data['date_from']=date('Y-m-d');
                 $this->data['date_to']=date('Y-m-d');
                 $this->data['records']=$this->reports->receiptedreport($this->data['date_from'],$this->data['date_to']);
                 $this->data['page'] = 'Report';
                  $this->data['sub_title']="Performance Reports >Printed Bill";
                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/receipt_lists' );       
                  $this->load->view( "templates/footer" );

                
            
        }
          public function receipted()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],              
    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Receipting";
      
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/receipted_select' );   
       $this->load->view( "templates/footer" );
    else:
     
           if($this->data['records']=$this->reports->receiptedreport($this->input->post("date_from"),$this->input->post("date_to"))){

              $this->data['sub_title']="Performance Reports > Bills Receipted";
                    $this->data['date_from']=$this->input->post("date_from");
                    $this->data['date_to']=$this->input->post("date_to");
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/receipt_lists' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/receipted');

           }

           
    endif;  
      
  }
    public function printdetails()
  {
            $this->data['title'] = "County|Report";
            $this->data['page'] = 'Report';


          if(!$this->uri->segment(3)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/receipted');
          }
          if(!$this->uri->segment(4)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/receipted');
          }
          if(!$this->uri->segment(5)){
              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/receipted');
          }
     
     
           if($this->data['records']=$this->reports->printdetails($this->uri->segment(4),$this->uri->segment(5),$this->uri->segment(3))){
                      $record=$this->users->detail_user($this->uri->segment(3));
                      if($record){
                        $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
                      }else{
                        $this->data['sub_title']="";
                      }
                     
                    $this->data['date_from']=$this->uri->segment(4);
                    $this->data['date_to']=$this->uri->segment(5);
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printeddetails' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "Error! Report with the parameters does not exist" );
              redirect( 'report/receipted');

           }

           

      
  }

 public function location()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
    $this->data['sub_title']="Performance Reports > Billing Location";
    $this->load->model("subcountys");
    $this->data['subcountys']= $this->subcountys->lists(); 
    $this->form_validation->set_rules( [

     
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
             
                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectlocation' );       
                $this->load->view( "templates/footer" );
    else :

          $this->data['date_from']=$this->input->post("date_from");
           $this->data['date_to']=$this->input->post("date_to");
           $newdata = array( 
             'date_from'  => $this->data['date_from'], 
             'date_to'     => $this->data['date_to'], 
           );  

          $this->session->set_userdata($newdata);

            
            
               if( $this->data['records']=$this->reports->billlocations($this->input->post("date_from"), $this->input->post("date_to"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/locationlist' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/location');

           }

              
   endif;



 }

 public function persubcountylocation()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
    $this->data['sub_title']="Performance Reports > Billing Location";
    $this->load->model("subcountys");
    $this->data['subcountys']= $this->subcountys->lists(); 

     $this->data['date_from']=$this->session->userdata('date_from');
           $this->data['date_to']= $this->session->userdata('date_to');
   

            
            
           if( $this->data['records']=$this->reports->persubcountylocations($this->session->userdata('date_from'), $this->session->userdata('date_to'),$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/locationlist' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/location');

           }

              



 }
 public function printedlocation()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Report';
     $this->data['sub_title']="Performance Reports > Printed Location";
     $this->load->model("subcountys");
    $this->data['subcountys']= $this->subcountys->lists(); 
    $this->form_validation->set_rules( [

     
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
            
                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectprinted' );       
                $this->load->view( "templates/footer" );
    else : 
            $this->data['date_from']=$this->input->post("date_from");
           $this->data['date_to']=$this->input->post("date_to");
           $newdata = array( 
             'date_from'  => $this->data['date_from'], 
             'date_to'     => $this->data['date_to'], 
           );  

          $this->session->set_userdata($newdata);
          if($this->data['records']=$this->reports->printedlocations($this->input->post("date_from"), $this->input->post("date_to"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printedlist' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/printedlocation');

           }

              
   endif;



 }



 






































































































































































 
 




  


   public function reversal()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],]

    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Select";

       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/reversalselect' );   
       $this->load->view( "templates/footer" );
    else:
     
            $this->data['sub_title']=" Reversal Report";
       
           if($this->data['records']=$this->reports->reversals($this->input->post("date_from"),$this->input->post("date_to"))){
                    $this->data['date_from']=$this->input->post("date_from");
                    $this->data['date_to']=$this->input->post("date_to");
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/reversal' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/reversal');

           }

           
    endif;  
      
  }

  


    public function summarypersubcounty()
  {
       $this->data['title'] = "County|Report";
       $this->data['page'] = 'Report';
       $this->data['sub_title']="Revenue Reports > Subcounty Summary";
       $this->load->model("subcountys");
       $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');
   

        $newdata = array( 
           'date_from1'  => $this->data['date_from'], 
           'date_to1'     => $this->data['date_to'], 
        );  

       $this->session->set_userdata($newdata);
       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
       
        $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['printedperwardreceipteds']=$this->reports->printedperwardreceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       //$this->data['userbilleds']=$this->reports->userbilleds($this->session->userdata('SubCounty'));
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardbilleds']=$this->reports->perwardbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardtransactions']=$this->reports->perwardtransactions($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['records']=$this->reports->streamsummarys(  $this->data['date_from'],  $this->data['date_to'],$this->session->userdata('SubCounty'));
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/subcountysummary' );   
       $this->load->view( "templates/footer" );
  
  }

   public function filterother()
  {
      $this->data['title'] = "County|Report";
      $this->data['page'] = 'Report';
      $this->form_validation->set_rules( [

       ['field' => 'date_from', 'label' => 'Date From', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
       ['field' => 'date_to', 'label' => 'Date To', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                          
    ] );


    if( $this->form_validation->run() == FALSE ) :
       $this->data['sub_title']="Select";
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/selectfilterother' );   
       $this->load->view( "templates/footer" );
    else:

        $this->data['title'] = "County|Report";
        $this->data['page'] = 'Report';
        $this->data['sub_title']="Revenue Reports > Subcounty Summary";
        $this->load->model("subcountys");


        $this->data['date_from']=$this->input->post("date_from");;
        $this->data['date_to']=$this->input->post("date_to");;
   

          $newdata = array( 
             'date_from1'  => $this->data['date_from'], 
             'date_to1'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);


       $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
       $this->data['printedperincomereceipteds']=$this->reports->printedperincomereceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['printedperwardreceipteds']=$this->reports->printedperwardreceipted($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
      
       $this->data['streambillssummarys']=$this->reports->streambillssummarys($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardbilleds']=$this->reports->perwardbilleds($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['perwardtransactions']=$this->reports->perwardtransactions($this->session->userdata('SubCounty'), $this->data['date_from'],  $this->data['date_to']);
       $this->data['records']=$this->reports->streamsummarys(  $this->data['date_from'],  $this->data['date_to'],$this->session->userdata('SubCounty'));
       $this->load->view( "templates/header", $this->data );
       $this->load->view( 'report/subcountysummary' );   
       $this->load->view( "templates/footer" );    
     endif;  
      
  }




































  public function resultsubcountylist()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Report";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');
         $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
             $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
 
     if( $this->data['records']=$this->reports->Billsubcountyraised( $this->data['date_from'], $this->data['date_to'],$this->session->userdata('SubCounty'))){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/subcountylist' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/selectsubcounty');

    }

              
}


   public function selectsubcounty(){
          
              
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Select";
                $this->load->model("subcountys");
                $this->data['subcountys'] = $this->subcountys->lists();


                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsubcounty' );       
                $this->load->view( "templates/footer" );

  }

  public function resultsubcounty()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Report";
    $this->form_validation->set_rules( [

      ['field' => 'subcounty_id', 'label' => 'subcounty', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Select";
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsubcounty' );       
                $this->load->view( "templates/footer" );
    else :

           $this->data['date_from']=$this->input->post("date_from");
            $this->data['date_to']=$this->input->post("date_to");
              $this->data['subcount']= $this->subcountys->details($this->input->post("subcounty_id"))->SubCountyName;
                $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
               if( $this->data['records']=$this->reports->Billsubcountyraised( $this->data['date_from'], $this->data['date_to'],$this->input->post("subcounty_id"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/subcountylist' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/selectsubcounty');

           }

              
   endif;



 }

 public function streamsummary()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Report";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');
         $this->data['subcount']= $this->subcountys->details($this->session->userdata('SubCounty'))->SubCountyName;
             $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
 
     if( $this->data['records']=$this->reports->streamsummarys( $this->data['date_from'], $this->data['date_to'],$this->session->userdata('SubCounty'))){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/streamsummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/summarysubcounty');

    }
}

public function summarysubcounty()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Stream Summarys";
    $this->form_validation->set_rules( [

      ['field' => 'subcounty_id', 'label' => 'subcounty', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Stream Summary";
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsummarys' );       
                $this->load->view( "templates/footer" );
    else :


            $newdata = array( 
             'date_from2'  => $this->input->post("date_from") =='' ? date('Y-m-d') : $this->input->post("date_from"), 
             'date_to2'     => $this->input->post("date_to") =='' ? date('Y-m-d') : $this->input->post("date_to"), 
             'subcounty_id'=>$this->input->post("subcounty_id")

               );  
//print_r($newdata);exit;
            $this->session->set_userdata($newdata);

            $this->data['date_from']=$this->session->userdata('date_from2');
            $this->data['date_to']=$this->session->userdata('date_to2');

          
          //$this->session->userdata('date_from');
              $this->data['subcount']= $this->subcountys->details($this->input->post("subcounty_id"))->SubCountyName;
                $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
               if( $this->data['records']=$this->reports->streamsummarys( $this->data['date_from'], $this->data['date_to'],$this->input->post("subcounty_id"))){
               // print_r($this->data['records']);exit();
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamsummarys' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/summarysubcounty');

           }

              
   endif;



 }


 public function summarywards()
  {


         $this->data['title'] = "County|Report";
       $this->data['page'] = 'Wards';
       $this->data['sub_title']=" Summary";
       $this->data['date_from']=$this->session->userdata('date_from2');//date('Y-m-d');
       $this->data['date_to']=$this->session->userdata('date_to2');//date('Y-m-d');
       $this->data['subcount']= $this->subcountys->details($this->session->userdata('subcounty_id'))->SubCountyName;
       $this->data['stream']= $this->incomeTypes->details($this->uri->segment(3))->IncomeTypeDescription;
 
     if( $this->data['records']=$this->reports->get_wardsummarys( $this->uri->segment(3),$this->session->userdata('subcounty_id'),$this->data['date_from'], $this->data['date_to'])){

                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/get_incomeward2' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/selectsummarystream');

    }
            
           //  $this->data['date_from']=$this->session->userdata('date_from2');
           //  $this->data['date_to']=$this->session->userdata('date_to2');
           //    $this->data['subcount']= $this->subcountys->details($this->uri->segment(3))->SubCountyName;
           //      $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
           //     if( $this->data['records']=$this->reports->wardstreamsummarys( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3))){
           //          $this->load->view( "templates/header", $this->data );
           //          $this->load->view( 'report/wardstreamsummarys' );       
           //          $this->load->view( "templates/footer" );

           // }else{

           //    $this->session->set_flashdata( "error", "No Result Found" );
           //    redirect( 'report/summarysubcounty');

           // }

              




 }
 





 


  

 




  


    public function selectsubcounty1(){
          
              
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Select";
                $this->load->model("subcountys");
                $this->data['subcountys'] = $this->subcountys->lists();


                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsubcounty1' );       
                $this->load->view( "templates/footer" );

  }

  public function resultsubcounty1()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Report";
    $this->form_validation->set_rules( [

      ['field' => 'subcounty_id', 'label' => 'subcounty', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Select";
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsubcounty1' );       
                $this->load->view( "templates/footer" );
    else :

              $this->data['date_from']=$this->input->post("date_from");
               $this->data['date_to']=$this->input->post("date_to");
              $this->data['subcount']= $this->subcountys->details($this->input->post("subcounty_id"))->SubCountyName;
                $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
               if( $this->data['records']=$this->reports->Billsubcountyraised( $this->data['date_from'], $this->data['date_to'],$this->input->post("subcounty_id"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/subcountylist' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/selectsubcounty1');

           }

              
   endif;



 }
 public function summarysubcounty1()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']="Stream Summarys";
    $this->form_validation->set_rules( [

      ['field' => 'subcounty_id', 'label' => 'subcounty', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_from', 'label' => 'date_from', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
      ['field' => 'date_to', 'label' => 'date_to', 'rules' => 'trim|required', 'errors' => ['required' => 'Please enter the %s.'],],
                      
    ] );
    if( $this->form_validation->run() == FALSE ) :
       
               $this->data['title'] = "County|Report";
               $this->data['page'] = 'Sub County';
               $this->data['sub_title']="Stream Summary";
               
                $this->data['subcountys'] = $this->subcountys->lists();

                $this->load->view( "templates/header", $this->data );
                $this->load->view( 'report/selectsummary1s' );       
                $this->load->view( "templates/footer" );
    else :

           $this->data['date_from']=$this->input->post("date_from");
            $this->data['date_to']=$this->input->post("date_to");
              $this->data['subcount']= $this->subcountys->details($this->input->post("subcounty_id"))->SubCountyName;
                $this->data['title'] = "County|Report for ".  $this->data['subcount'] ." Subcounty  from ".   $this->data['date_from'] . " to ".   $this->data['date_to'];
               if( $this->data['records']=$this->reports->streamsummarys( $this->data['date_from'], $this->data['date_to'],$this->input->post("subcounty_id"))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamsummarys' );       
                    $this->load->view( "templates/footer" );

           }else{

              $this->session->set_flashdata( "error", "No Result Found" );
              redirect( 'report/summarysubcounty1');

           }

              
   endif;



 }


  
 public function streamreports()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
          $this->data['date_from']=$this->session->userdata('date_from1');
          $this->data['date_to']= $this->session->userdata('date_to1');
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->IncomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->streamreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamreports' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
 }
 public function wardreports()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
          $this->data['date_from']=$this->session->userdata('date_from1');
           $this->data['date_to']= $this->session->userdata('date_to1');
          if(!$this->data['sub_title']=$this->subcountys->ward_details($this->uri->segment(3))->WardName){
              $this->data['sub_title']="";
           }
   
          if($this->data['records']=$this->reports->wardreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/wardreports' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
 }



 public function detailwardreports()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
           $this->data['date_from']=$this->session->userdata('date_from1');
           $this->data['date_to']= $this->session->userdata('date_to1');
          if(!$this->data['sub_title']=$this->subcountys->ward_details($this->uri->segment(3))->WardName){
              $this->data['sub_title']="";
           }
   
          if($this->data['records']=$this->reports->detailperwardbilleds($this->uri->segment(3),$this->data['date_from'],$this->data['date_to'])){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/detailstreamreport' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
 }

 public function receiptedreports()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
          $this->data['date_from']=date('Y-m-d');
          $this->data['date_to']= date('Y-m-d');
          if(!$this->data['sub_title']=$this->incomeTypes->details($this->uri->segment(3))->IncomeTypeDescription){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->receiptedreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/streamreports' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
 }
/* public function receiptedreports()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
      
          $this->data['date_from']=date('Y-m-d');
          $this->data['date_to']= date('Y-m-d');
          if(!$this->data['sub_title']=$this->subcountys->ward_details($this->uri->segment(3))->WardName){
              $this->data['sub_title']="";
           }
   
          if($this->data['records']=$this->reports->receiptedreports($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/wardreports' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
 }

*/


public function allsubcountysummaryx()
  {

   
    $this->data['title'] = "County|Report";
    $this->data['page'] = 'Sub County';
     $this->data['sub_title']=" Summary";
        $this->data['date_from']=date('Y-m-d');
       $this->data['date_to']=date('Y-m-d');

            $newdata = array( 
             'date_from1'  => $this->data['date_from'], 
             'date_to1'     => $this->data['date_to'], 
          );  

         $this->session->set_userdata($newdata);
        
 
     if( $this->data['records']=$this->report->allsubcountysummary3s( $this->session->userdata('date_from1'), $this->session->userdata('date_from1'))){
                
                  $this->load->view( "templates/header", $this->data );
                  $this->load->view( 'report/allsubcountysummarys' );       
                  $this->load->view( "templates/footer" );

     }else{

            $this->session->set_flashdata( "error", "No Result Found" );
            redirect( 'report/allsubcountysummary');

    }

}


 

 public function printingperward()
  {

          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
               $this->data['date_from']=$this->session->userdata('date_from1');//date('Y-m-d');
         $this->data['date_to']=$this->session->userdata('date_to1');//date('Y-m-d');
          if(!$this->data['sub_title']=$this->subcountys->ward_details($this->uri->segment(3))->WardName){
              $this->data['sub_title']="";
           }
          if($this->data['records']=$this->reports->detailsprintedperwardreceipted( $this->data['date_from'], $this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printed1list' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/subcountysummarys');

           }

              
  }

  







   


 

  public function receiptedperreport()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from1');
          $this->data['date_to']=$this->session->userdata('date_to1');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->detailsprintedperuserreceipted($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printed2list' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/performancesummarys');

           }

              
 }

 public function billerbills()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=date('Y-m-d');
          $this->data['date_to']=date('Y-m-d');
          if(!$record=$this->users->detail_user($this->id)){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->billsraisedreports($this->data['date_from'],$this->data['date_to'],$this->id)){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/workdetails' );       
                    $this->load->view( "templates/footer" );

           }else{

                   $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/workdetails' );       
                    $this->load->view( "templates/footer" );

           }

              
 }

  public function billerreceipted()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
           $this->data['date_from']=date('Y-m-d');
          $this->data['date_to']=date('Y-m-d');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->detailsprintedperuserreceipted($this->data['date_from'],$this->data['date_to'],$this->id)){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printed3list' );       
                    $this->load->view( "templates/footer" );

           }else{

                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printed3list' );       
                    $this->load->view( "templates/footer" );

           }

              
 }





 
 
  
  public function billsraisedsingonline()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from3');
          $this->data['date_to']=$this->session->userdata('date_to3');
          $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->billsraisedsingonlines($this->session->userdata('SubCountyseg3'),$this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/work1singledetails' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
 }

  public function billsraisedsingselfonline()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from3');
          $this->data['date_to']=$this->session->userdata('date_to3');
          $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->billsraisedsingonlines($this->session->userdata('SubCounty'),$this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/work1details' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
 }



  public function receiptedsigleperreport()
  {

   
          $this->data['title'] = "County|Report";
          $this->data['page'] = 'Report';
          $this->data['date_from']=$this->session->userdata('date_from3');
          $this->data['date_to']=$this->session->userdata('date_to3');
           $this->data['SubCountyseg3']= $this->session->userdata('SubCountyseg3');
          if(!$record=$this->users->detail_user($this->uri->segment(3))){
              $this->data['sub_title']="";
           }else{
            $this->data['sub_title']=ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));
           }
          if($this->data['records']=$this->reports->detailsprintedperuserreceipted($this->data['date_from'],$this->data['date_to'],$this->uri->segment(3))){
                    $this->load->view( "templates/header", $this->data );
                    $this->load->view( 'report/printedsingle2list' );       
                    $this->load->view( "templates/footer" );

           }else{

                  $this->session->set_flashdata( "error", "No Result Found" );
                   redirect( 'report/allperformancesubcountysummary');

           }

              
 }






 
           

      
  




















 

 
  
}
