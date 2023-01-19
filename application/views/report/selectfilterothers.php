<div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">

                            <center>
                             <?php if( $this->session->flashdata('error') != "" ) : ?>
                               <div class="row"><div class="col-xs-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></div></div>
                            <?php endif; ?>
                          
                         </center>
                            
                         <?php echo form_open( 'report/filterothers',array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Summary Report</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                
                                <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        
                                        <div class="col-md-5">

                                      
                                             <div class="form-group">
                                                <label class="col-md-3 control-label">From</label>
                                               
                                                <div class="col-md-9 col-xs-12">                                            
                                                   
                                                      <input type="text" class="form-control datepicker" value="<?php echo date('Y-m-d');?>" name="date_from" required />
                    
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('date_from'); ?></span>      
                                                          
                                                        
                                                                                  
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-3 control-label">To</label>
                                               
                                                <div class="col-md-9 col-xs-12">                                            
                                                   
                                                        <input type="text" class="form-control datepicker" value="<?php echo date('Y-m-d');?>" name="date_to" required />
                            
                                                            <br><span style="color:red; font-size: 80%"><?php echo form_error('date_to'); ?></span>     
                                                          
                                                        
                                                                                  
                                                </div>
                                            </div>
                                     
                                            
                                            
                                            
                                            
                                        </div>
                                    
                                        
                                    </div>

                                </div>
                                
                                       <div class="panel-footer">
                                         <div class="col-md-4">
                                            </div>
                                             <div class="col-md-4">
                                                                         
                                                 <button class="btn btn-primary pull-right">Submit</button>
                                             </div>           
                                </div>
                               
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT --> 
              
             
        