<div class="page-content-wrap">
 <?php if( $this->session->flashdata('error') != "" ) : ?>
                <div class="row">
                <div class="col-xs-12">
                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                </div>
                </div>
            <?php endif; ?>
            <?php if( $this->session->flashdata('success') != "" ) : ?>
                <div class="row">
                <div class="col-xs-12">
                <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?>
                  </div>  
                </div>
                </div>
            <?php endif; ?>
                <?php echo validation_errors(); ?>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo form_open_multipart('login/setpassword/',array('class'=>'form-horizontal'));?>
                            
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Change</strong> Password</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                
                                <div class="panel-body">                                                                        
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Old Password</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                
                                                <input type="password" class="form-control" required='true' name='password' value="<?php echo set_value('password');?>" />
                                            </div> 
                                            <span style="color:red; font-size: 80%"><?php echo form_error('password'); ?></span>                                           
                                            <span class="help-block">Add an old password</span>
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">New Password</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                
                                                <input type="password" class="form-control" required='true' name='newpassword' value="<?php echo set_value('newpassword');?>" />
                                            </div> 
                                            <span style="color:red; font-size: 80%"><?php echo form_error('newpassword'); ?></span>                                           
                                            <span class="help-block">Add a new password</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Confirm Password</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                
                                                <input type="password" class="form-control" required='true' name='conpassword' value="<?php echo set_value('conpassword');?>" />
                                            </div> 
                                            <span style="color:red; font-size: 80%"><?php echo form_error('conpassword'); ?></span>                                           
                                            <span class="help-block">Confirm new password</span>
                                        </div>
                                    </div>
                                   
                                   
                                    
                                <div class="panel-footer">
                                                                     
                                    <button class="btn btn-primary pull-right">Change Password</button>
                                </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
    </div>