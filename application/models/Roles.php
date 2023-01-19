<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class Roles extends CI_Model {
    
    public function __construct(){
      
      $this->table="roles";
      $this->datetime=date("Y-m-d H:i:s");
        $this->id=$this->session->userdata('id');
       
        $this->first_name=$this->session->userdata('first_name');
       
       
    }

    public function creates()
    {
      
      $this->db->trans_begin();
      if($this->db->insert( $this->table, [
        'Title' => $this->input->post("Title"),
                  
      ] )){
          $id = $this->db->insert_id();

             $this->db->insert( "rolesettings", [
                'RoleID'=>$id,
                'DateCreated' => $this->datetime,
                'DateModified'=>$this->datetime,
                'CreatedBy'=>$this->id, 
                'ModifiedBy'=>$this->id,        
                
              ] );
                 
          $this->db->insert('audit', [
            'Description' =>  $this->first_name ." added System Role ".  $this->input->post("Title"),
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
      $this->db->select('t.*' )
          ->from($this->table .' t')
          ->order_by('id','ASC');
      $this->db->where( array('t.Status'=>1),'AND');
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


    
    
    
    public function deletee($id)
    {
      $data = array(
      
        'Status' => 0 , 
        
      );

      $this->db->where('id',$id);
      if($this->db->update($this->table,  $data)){
        
          $this->db->insert('audit', [
            'Description' => $this->first_name ." Deleted System Role ",
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
          'Title' => $this->input->post("Title"),
        
        
        );

        $this->db->where('id',$id);
        
        if($this->db->update($this->table,  $data)){
            $this->db->insert('audit', [
              'Description' => "Edited System role",
            'SourceTable' => $this->table,
            'RecordKey'=> $id,
            'UserKey'=>  $this->id
            
          ] );
           return true;
        }else{
         return false;
        } 
    }

     public function updateuserroles($id)
    {
      

      
       $data = array(

            'Dashboard' => $this->input->post("Dashboard"),
            'Adding' => $this->input->post("Adding"),
            'Edit' => $this->input->post("Edit"),
            'Deleting' => $this->input->post("Deleting"),
            'VotingCast' => $this->input->post("VotingCast"),
            'SetRole' => $this->input->post("SetRole"),
            'SystemUser' => $this->input->post("SystemUser"),
            'SystemSetting' => $this->input->post("SystemSetting"),
            'Reports' => $this->input->post("Reports"),
            'MyProfile'=>$this->input->post("MyProfiles"),
            'Party' => $this->input->post("Party"),
            'Aspirant'=>$this->input->post("Aspirant"),
            'DateModified'=>$this->datetime,
            'ModifiedBy'=>$this->id, 

        );
        $this->db->where('RoleID',$id);
        if($this->db->update("rolesettings",  $data)){
            $this->db->insert('audit', [
              'Description' => $this->first_name ." edited System role ",
            'SourceTable' =>"rolesettings ",
            'RecordKey'=> $id,
            'UserKey'=>  $this->id
            
          ] );
           return true;
        }else{
         return false;
        } 
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

   
}