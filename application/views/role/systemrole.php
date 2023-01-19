<div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            
                         <?php echo form_open( 'role/systemrole/'.$record->RoleID,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Set</strong>User Role</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                              
                                <div class="panel-body">  

                                 <div class="col-md-6">                                                                      
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">

                                              
                                              <div class="col-md-6">
                                                    Dashboard
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="Dashboard" <?php if($record->Dashboard==1) { echo "checked";} ?> class="pull-left"/> 
                                                        
                                                       </label>
                                                                                   
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                        <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Add
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"   name="Adding" <?php if($record->Adding==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Edit
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"   name="Edit" <?php if($record->Edit==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                          <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Delete
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1" name="Deleting" <?php if($record->Deleting==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>


                                    
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Enter Casted Vote
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="VotingCast" <?php if($record->VotingCast==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Party
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="Party" <?php if($record->Party==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Aspirant
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="Aspirant" <?php if($record->Aspirant==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>

                                     


                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                  View My Profile
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="MyProfile" <?php if($record->MyProfile==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>

                                      
                                    </div>
                                     <div class="col-md-6">  
                                   

                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    View Casted Votes
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="Reports" <?php if($record->Reports==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     

                                      
                                     
                                     
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                  System User 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="SystemUser" <?php if($record->SystemUser==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Add Role 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="SetRole" <?php if($record->SetRole==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    SystemSetting
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="SystemSetting" <?php if($record->SystemSetting==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                       <input type="hidden" value=" <?php echo $record->RoleID; ?>"  name="RoleID"  /> 
                                    <a href="<?php echo base_url('role')?>"><button type="button" class="btn btn-default">Back</button>   </a>                                    
                                    <button class="btn btn-primary pull-right">Submit</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT --> 
        
             
      