<div class="login-container">
    <div class="row">

        <div class="col-md-4">
            
        </div>
        <div class="col-md-4">
             <div class="login-box animated fadeInDown">
                <div class=""> </div>
                <div class="login-body">

                        <center>
                            <div ><h2 style="color: #FFFFFF"><strong>Voting</strong> System </h2></div>
                             <img style="border-radius: 20%;     width: 120px;" src="<?php echo base_url(); ?>img/logo.jpg" alt="logo"/>

                             <br>
                        </center> <br>

                 
                   
                     <?php if( $this->session->flashdata('error') != "" ) : ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('error'); ?>
                                        
                                    </div>
                            </div>
                        </div>
                    <?php endif; ?> 
                    <?php if( $this->session->flashdata('message') != "" ) : ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('message'); ?>
                                        
                                    </div>
                        </div>
                    </div>
                    <?php endif; ?> 
                      <?php if( $this->session->flashdata('success') != "" ) : ?>
                    <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                        
                                    </div>
                        </div>
                    </div>
                    <?php endif; ?>   
                       <center>    
                    
                    <div class="login-title"><strong>Welcome</strong>, Please login</div>
                   </center>
                    <?php echo form_open( 'login',array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                    <div class="form-group">
                        <div class="col-md-12">
                           <label  style="color: #FFFFFF" >Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" autocomplete="off" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                           <label  style="color: #FFFFFF">Password</label>
                            <input type="password" class="form-control" placeholder="Password"  name="password" autocomplete="new-password" required/>
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-md-6">   
                          
                            
                            <a href="<?php  echo base_url('login/forget_password')?>" type="button" class="btn btn-link btn-block">Forgot your password?</a>
                        </div>
                        <div class="col-md-6">     
                            <button  class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    </form>
                           <div class="row">
                             <div class="form-group">
                                 <div class="col-xs-12 text-center">
                                      <p><span style=" color: rgba(255,255,255,1);">Don't have an account? </span> <span    style="color: #0aa89e" class="btn  btn-raised" data-toggle="modal" data-target="#modal_large">Sign Up</span></p>
                                 </div>
                                   
                                </div>
                            </div>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy;<?php echo date('Y')?> Powered by Payhive
                    </div>
                    <div class="pull-right">
                     
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="padding-top: 7%">
       
        </div>




        
    </div>
        
           
            
        </div>
           <div class="modal" id="modal_large" tabindex="-1" role="dialog" aria-labelledby="largeModalHead" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form class="form" method="POST" enctype="multipart/form-data" action="<?php echo base_url('login/register');?>" id="registerForm">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="largeModalHead"> Register (As Polling Agent Only)</h4>
                    </div>
                    <div class="modal-body">
                        <center>
                                            <div class="row" id="message1" ></div>
                                            <div class="row" id="create-message1"></div>   
                                        </center>

                         <div class="panel-body">                                                                        
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">First Name <span style="color: red"> *</span></label>
                                               
                                                <div class="col-md-8 col-xs-12">                                            
                                                   
                                                       <input type="text" class="form-control" placeholder="First name" required='true' name='FirstName' id="FirstName" value="<?php echo set_value('FirstName'); ?>">
                
                                                        <br> <span style="color:red; font-size: 80%" class="help-block FirstName create-error"><?php echo form_error('FirstName'); ?> </span>
                                                       
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">                                        
                                                <label class="col-md-4 control-label">Last Name <span style="color: red"> *</span></label>
                                                <div class="col-md-8 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Last name" required='true' name='LastName' id="LastName" value="<?php echo set_value('LastName'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"class="help-block LastName create-error"><?php echo form_error('LastName'); ?></span>     
                                                  
                                                </div>
                                            </div>
                                             <div class="form-group">                                        
                                                <label class="col-md-4 control-label">Other Names</label>
                                                <div class="col-md-8 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Other Names" name='OtherName' id="OtherName" value="<?php echo set_value('OtherName'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"class="help-block OtherName create-error"><?php echo form_error('OtherName'); ?></span>     
                                                  
                                                </div>
                                            </div>
                                             <div class="form-group">                                        
                                                <label class="col-md-4 control-label">Id Number <span style="color: red"> *</span></label>
                                                <div class="col-md-8 col-xs-12">
                                                    <input type="text" class="form-control" placeholder="Id Number" required='true' name='IDNo' id="IDNo" value="<?php echo set_value('IDNo'); ?>">
                    
                                                    <br><span style="color:red; font-size: 80%"class="help-block IDNo create-error"><?php echo form_error('IDNo'); ?></span>     
                                                  
                                                </div>
                                            </div>

                                            <div class="form-group"> 
                                                <label class="col-md-4 control-label">Email <span style="color: red"> *</span></label>
                                                <div class="col-md-8">
                                                    <input type="email" class="form-control" placeholder="Email" required='true' name='EmailAddress' id="EmailAddress" value="<?php echo set_value('EmailAddress'); ?>">
                                        
                                                    <br><span style="color:red; font-size: 80%"class="help-block EmailAddress create-error"><?php echo form_error('EmailAddress'); ?></span>
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="form-group"> 
                                                <label class="col-md-4 control-label">Mobile <span style="color: red"> *</span></label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Phone number" required='true' name='Telephone' id="Telephone" value="<?php echo set_value('Telephone'); ?>">
                                        
                                                    <br><span style="color:red; font-size: 80%"class="help-block Telephone create-error"><?php echo form_error('Telephone'); ?></span>
                                                </div>
                                                
                                            </div>
                                           
                                            
                                            
                                      
                                          
                                      
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">County <span style="color: red"> *</span></label>
                                                <div class="col-md-8">                                                                                            
                                                    <select class="form-control select" data-live-search="true" name="CountyId" id="CountyIdA" required>
                                                    <option value="">Select</option>
                                                        <?php foreach( $countys as $county ) : ?>
                                                          
                                                            <option value="<?php echo $county->CountyCode; ?>"><?php echo ucwords(strtolower($county->CountyName)) ; ?></option>
                                                        <?php  endforeach; ?>

                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"class="help-block Countyid create-error"><?php echo form_error('Countyid'); ?></span>     
                                                          
                                                </div>
                                            </div><br><br>
                                             <div class="form-group">
                                                <label class="col-md-4 control-label">Sub County <span style="color: red"> *</span></label>
                                                <div class="col-md-8"> 

                                                 <select class="form-control select1" data-live-search="true" name="SubCountyId" id="SubCountyIdA" required >                                                                                           
                                                   
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"class="help-block SubCountyId create-error"><?php echo form_error('SubCountyId'); ?></span>     
                                                          
                                                </div>
                                            </div><br><br>
                                          <div class="form-group">
                                                <label class="col-md-4 control-label">Ward <span style="color: red"> *</span></label>
                                                <div class="col-md-8">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="WardId" id="WardId" required >
                                                
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"class="help-block WardId create-error"><?php echo form_error('WardId'); ?></span>     
                                                          
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="col-md-4 control-label">Polling Center <span style="color: red"> *</span></label>
                                                <div class="col-md-8">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="PollingCenterId" id="PollingCenterId" required >
                                                
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"class="help-block WardId create-error"><?php echo form_error('WardId'); ?></span>     
                                                          
                                                </div>
                                             </div>
                                              <div class="form-group">
                                                <label class="col-md-4 control-label"> Polling Stream <span style="color: red"> *</span></label>
                                                <div class="col-md-8">                                                                                            
                                                    <select class="form-control select1" data-live-search="true" name="PollingStream" id="PollingStream" required >
                                                
                                                        
                                                    </select>
                                                     <br><span style="color:red; font-size: 80%"class="help-block WardId create-error"><?php echo form_error('PollingStream'); ?></span>     
                                                          
                                                </div>
                                             </div>


                                            <br><br>
                                             
                                            
                                              
                                            
                                        
                                        <!-- <center>
                                            Upload All required Document
                                            <hr>
                                        </center>
                                                 <div class="row uploadwrapper">
                                                    <div class="col-md-6">
                                                    <input type="file" class="document" name="documents[]" id="documents" accept="image/jpeg" onchange='Checkfiles(this.value)' >
                                                    </div>
                                                     
                                                        <div class="col-md-6"  id="level_id1" style='display:none;'>
                                                       
                                                             <button type="button" class="btn btn-default pull-right" onclick="uploadanother(this)"> + Upload another document</button>
                                                      
                                                    </div>
                                                </div> -->
                                           
                                         
                                        </div>
                                        
                                    </div>

                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         <button class="btn btn-primary pull-right">Submit</button>                        
                    </div>
                </div>
            </div>
        </div> 

        <script type="text/javascript">

                function uploadanother(elem)
                {
                var document    = $(elem).parent().prev().find('input[type="file"]').val();
                if(document!='')
                {
                        var clonewrap   = $(elem).parent().parent().clone();                
                        clonewrap.find('button').removeAttr('onclick');
                        clonewrap.find('button').attr('onclick','removeupload(this)');
                        clonewrap.find('button').html('- Remove document');
                        $(elem).parent().parent().before(clonewrap);
                        $(elem).parent().prev().find('input[type="file"]').val('');
                }
            }
                function Checkfiles(val){

                       var element=document.getElementById('level_id1');
                       
                        if(document!=''){

                             element.style.display='block';
                        }else{
                            element.style.display='block';
                            // element.style.display='none';
                        }
                 }  
                        

                function removeupload(elem)
                {
                $(elem).parent().parent().remove();
                }
    
    </script> 

     <script type="text/javascript">

          function Checklevels(val){

           var element=document.getElementById('level_id');
           
           if(val>='4')
             element.style.display='block';
           else  
             element.style.display='none';

           

          }
                                  

</script>


        
