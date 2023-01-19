<div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <center>
      

            <?php if( $this->session->flashdata('error') != "" ) : ?>
                       <div class="row"><div class="col-xs-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></div></div>
                    <?php endif; ?>
                    
    </center>       
                <?php echo form_open_multipart('subcounty/edit/'.$record->id,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Edit </strong> Subcounty</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                
                                <div class="panel-body">                                                                        
                                  <div class="col-md-2">
                                  </div>
                                        
                                  <div class="col-md-6">  
                                    <div class="row"> 
                                           <div class="form-group">
                                                <label class="col-md-5 control-label">Subcounty Name<span style="color: red">*</span></label>
                                               
                                                <div class="col-md-7 col-xs-12">                                            
                                                   <input type="text" class="form-control" name="SubCountyName" placeholder=" " value="<?php echo $record->SubCountyName?>" required />
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('SubCountyName'); ?></span>     
                                            
                                                </div>
                                            </div>     
                                     </div>
                                       <div class="row"> 
                                           <div class="form-group">
                                                <label class="col-md-5 control-label">Status </label>
                                               
                                                <div class="col-md-7 col-xs-12">                                            
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
                                        </div><br>
                                       
                                     </div> 
                                </div>
                            <div class="panel-footer">
                                      <div class="col-md-3">
                                        </div>
                                        
                                        <div class="col-md-5">
                                           <a class="btn btn-default" href=" <?php echo base_url('subcounty')?>">
                                            Back</a>
                                                                    
                                    <button class="btn btn-info pull-right">Update</button>
                                </div>
                            </div>
                            </div>
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
          