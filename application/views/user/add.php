<div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            
                         <?php echo form_open( 'user/add',array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add</strong>  System User</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                
                                <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">First Name <span style="color: red"> *</span></label>
                                               
                                                <div class="col-md-9 col-xs-12">                                            
                                                   
                                                       <input type="text" class="form-control" placeholder="First name" required='true' name='FirstName' value="<?php echo set_value('FirstName'); ?>">
                
                                                        <br><span style="color:red; font-size: 80%"><?php echo form_error('FirstName'); ?></span>
                                                                                    
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Last Name <span style="color: red"> *</span></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Last name" required='true' name='LastName' value="<?php echo set_value('LastName'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('LastName'); ?></span>     
                                                  
                                                </div>
                                            </div>
                                             <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Other Names</label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Other Names" name='OtherName' value="<?php echo set_value('OtherName'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('OtherName'); ?></span>     
                                                  
                                                </div>
                                            </div>
                                             <div class="form-group">                                        
                                                <label class="col-md-3 control-label">Id Number <span style="color: red"> *</span></label>
                                                <div class="col-md-9 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Id Number" required='true' name='IDNo' value="<?php echo set_value('IDNo'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('IDNo'); ?></span>     
                                                  
                                                </div>
                                            </div>

                                            <div class="form-group"> 
                                                <label class="col-md-3 control-label">Email <span style="color: red"> *</span></label>
                                                <div class="col-md-9">
                                                    <input type="email" class="form-control" placeholder="Email" required='true' name='EmailAddress' value="<?php echo set_value('EmailAddress'); ?>">
                                        
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('EmailAddress'); ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group"> 
                                                <label class="col-md-3 control-label">Mobile <span style="color: red"> *</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" placeholder="Phone number" required='true' name='Telephone' value="<?php echo set_value('Telephone'); ?>">
                                        
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('Telephone'); ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            
                                        
                                          
                                      
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="col-md-3 control-label">Role <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select" data-live-search="true" name="RoleId" required >
                                                  
                                                        <option value="">Select</option>
                                                        <?php foreach( $roles as $role ) : ?>
                                                            <option value="<?php echo $role->id; ?>"><?php echo ucwords(strtolower($role->Title)) ; ?></option>
                                                        <?php endforeach; ?>

                                                        
                                                    </select>
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('RoleId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">County <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select" data-live-search="true" name="CountyId" id="CountyId" required>
                                                  
                                                    <option value="">Select</option>
                                                        <?php foreach( $countys as $county ) : ?>
                                                          
                                                            <option value="<?php echo $county->CountyCode; ?>"><?php echo ucwords(strtolower($county->CountyName)) ; ?></option>
                                                        <?php  endforeach; ?>

                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('CountyId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Sub County <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="SubCountyId" id="SubCountyId" required>
                                                  
                                                    
                                                        
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('SubCountyId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                          <div class="form-group">
                                                <label class="col-md-3 control-label">Ward <span style="color: red"> *</span></label>
                                                <div class="col-md-9">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="WardId" id="WardId" required >
                                                
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"><?php echo form_error('WardId'); ?></span>     
                                                          
                                                </div>
                                            </div>

                                        
                                        <div class="form-group"> 
                                                <label class="col-md-3 control-label"> Password <span style="color: red"> *</span></label>
                                                <div class="col-md-9">
                                                    <input type="password" class="form-control" placeholder="Password" required='true' name='Password' value="<?php echo set_value('Password'); ?>">
                                        
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('Password'); ?></span>
                                                </div>
                                                
                                            </div>  
                                        </div>
                                        
                                    </div>

                                </div>
                                <div class="panel-footer">
                                    <a href="<?php echo base_url('user')?>"><button type="button" class="btn btn-default">Back</button>   </a>                                    
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
              
             
        