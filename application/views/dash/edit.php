<div class="page-content-wrap">
                
        <div class="row">
            <div class="col-md-12">
                
             <?php echo form_open( 'route/edit/'. $record->RouteKey,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Edit</strong> Route Details</h3>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                    </div>
                    
                    <div class="panel-body">                                                                        
                        
                        <div class="row">
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Route Name</label>
                                   
                                    <div class="col-md-9 col-xs-12">                                            
                                       
                                           <input type="text" class="form-control" placeholder="Route Name" required='true' name='RouteName'  value="<?php echo $record->RouteName; ?>">
    
                                            <br><span style="color:red; font-size: 80%"><?php echo form_error('RouteName'); ?></span>                         
                                        
                                    </div>
                                </div>
                                                                              
                                    
                            </div>
                            
                        </div>

                    </div>
                    <div class="panel-footer">
                         <a href="<?php echo base_url('route ')?>"><button type="button" class="btn btn-default">Back</button>   </a>                                   
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
              
             
        