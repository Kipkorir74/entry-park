<div class="page-content-wrap">
                
        <div class="row">
            <div class="col-md-12">
                
             <?php echo form_open( 'user/edit/'. $record->UserID,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Edit</strong> User</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                    
                    <div class="panel-body">                                                                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">First name</label>
                                   
                                    <div class="col-md-9 col-xs-12">                                            
                                       
                                           <input type="text" class="form-control" placeholder="First name" required='true' name='FirstName'  value="<?php echo $record->FirstName; ?>">
    
                                            <br><span style="color:red; font-size: 80%"><?php echo form_error('FirstName'); ?></span>
                                                                        
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">Last name</label>
                                    <div class="col-md-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Last name" required='true' name='LastName'  value="<?php echo $record->LastName; ?>">
        
                                        <br><span style="color:red; font-size: 80%"><?php echo form_error('LastName'); ?></span>     
                                      
                                    </div>
                                </div>
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">Other names</label>
                                    <div class="col-md-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Last name"  name='OtherName'  value="<?php echo $record->OtherName; ?>">
        
                                        <br><span style="color:red; font-size: 80%"><?php echo form_error('OtherName'); ?></span>     
                                      
                                    </div>
                                </div>
                                   <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Id Number <span style="color: red"> *</span></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Id Number" required='true' name='IDNo'  value="<?php echo $record->Idnumber; ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('IDNo'); ?></span>     
                                                  
                                                </div>
                                            </div>
                                <div class="form-group">                                        
                                    <label class="col-md-3 control-label">Mobile</label>
                                    <div class="col-md-9 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Mobile Number" required='true' name='Telephone'  value="<?php echo $record->PhoneNumber; ?>">
        
                                        <br><span style="color:red; font-size: 80%"><?php echo form_error('Telephone'); ?></span>     
                                      
                                    </div>
                                </div>
                                     <div class="form-group"> 
                                    <label class="col-md-3 control-label">Email</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" placeholder="Email" required='true' name='EmailAddress'  value="<?php echo $record->Email; ?>" readonly >
                            
                                        <br><span style="color:red; font-size: 80%"><?php echo form_error('EmailAddress'); ?></span>
                                    </div>
                                    
                                </div>
                              
                            
                                
                            </div>
                            <div class="col-md-6">
                             <div class="form-group">
                                    <label class="col-md-3 control-label">Role</label>
                                    <div class="col-md-9">                                                                                            
                                        <select class="form-control select" data-live-search="true" name="RoleId" >
                                      
                                        
                                            <option value="">Select</option>
                                            <?php for( $i=0; $i<count( $user_roles ); $i++ ) : ?>
                                                <?php $role = &$user_roles[$i]; ?>                                                          
                                                <?php $selected = ( $role->id == $record->RoleId ) ? "selected=\"selected\"" : ""; ?>                          
                                                <option value="<?php echo $role->id; ?>" <?php echo $selected; ?>><?php echo $role->Title; ?></option>

                                            <?php endfor; ?>
                                                
                                       


        
                                        </select>
                                              
                                    </div>
                                </div>
                                
                           
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">County <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                      
                                                    <select class="form-control select" data-live-search="true" name="CountyId" id="CountyId" required>
                    

                                                      <option value="">Select</option>
                                                        <?php for( $i=0; $i<count( $countys ); $i++ ) : ?>
                                                            <?php $county = &$countys[$i]; ?>
                                                                                                                     
                                                            <?php $selected = ( $county->CountyCode == $record->CountyId ) ? "selected=\"selected\"" : ""; ?>                          
                                                            <option value="<?php echo $county->CountyCode; ?>" <?php echo $selected; ?>><?php echo $county->CountyName; ?></option>

                                                        <?php  endfor; ?>
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('CountyId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Sub County <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select" data-live-search="true" name="SubCountyId" id="SubCountyId" required>
                    

                                                      <option value="">Select</option>

                                                       <?php for( $i=0; $i<count( $subcountys ); $i++ ) : ?>
                                                       <?php $subcounty = &$subcountys[$i]; ?>  
                                                                                                                  
                                                            <?php $selected = ( $subcounty->ConstituencyCode == $record->SubCountyId ) ? "selected=\"selected\"" : ""; ?>                          
                                                            <option value="<?php echo $subcounty->ConstituencyCode; ?>" <?php echo $selected; ?>><?php echo $subcounty->ConstituencyName; ?></option>

                                                        <?php   endfor; ?>


                                                       
                                                          
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('SubCountyId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Ward <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="WardId" id="WardId" required >
                                                        <option value="">Select</option>

                                                          <?php for( $i=0; $i<count( $wards ); $i++ ) : ?>
                                                            <?php $ward = &$wards[$i]; ?>  
                                                                                                                  
                                                            <?php $selected = ( $ward->WardCode == $record->WardId ) ? "selected=\"selected\"" : ""; ?>                          
                                                            <option value="<?php echo $ward->WardCode; ?>" <?php echo $selected; ?>><?php echo $ward->WardName; ?></option>

                                                        <?php   endfor; ?>
                                                
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('WardId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                            
                                           <div class="form-group">
                                                <label class="col-md-3 control-label">Status </label>
                                               
                                                <div class="col-md-9 col-xs-12">                                            
                                                   <select  name="Status"  class="form-control select" data-live-search="true" data-placeholder="" required onchange='Checklevels(this.value) '  >

                                                       <option>Select</option>
                                                        <?php for( $i=0; $i<count( $statuses ); $i++ ) : ?>
                                                            <?php $status = &$statuses[$i]; ?>                                                          
                                                            <?php $selected = ( $status->status_id == $record->Status ) ? "selected=\"selected\"" : ""; ?>                          
                                                            <option value="<?php echo $status->status_id; ?>" <?php echo $selected; ?>><?php echo $status->titles; ?></option>

                                                        <?php endfor; ?>
                                                            
                                                    </select>   
                                                </div>
                                            </div>
                                       <br>


                                         
                                          
                                
                                    
                            </div>
                            
                        </div>

                    </div>
                    <div class="panel-footer">
                         <a href="<?php echo base_url('user')?>"><button type="button" class="btn btn-default">Back</button>   </a>                                   
                        <button class="btn btn-primary pull-right">Update</button>
                    </div>
                </div>
                </form>
                
            </div>
        </div>                    
        
    </div>
    <!-- END PAGE CONTENT WRAPPER -->                                                
</div>            
            <!-- END PAGE CONTENT --> 
              
             
        