


      <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class=""> </div>
                <div class="login-body">

                        <center>
                            <div ><h2 style="color: #FFFFFF"><strong>E-</strong>Construction </h2></div>
                             <img style="border-radius: 20%;     width: 150px;" src="<?php echo base_url(); ?>img/logo.jpg" alt="logo"/>

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
                    
                    <div class="login-title"><strong>Resetting</strong>, Password</div>
                   </center>
                    <?php echo form_open( 'login/forget_password',array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                    <div class="form-group">
                        <div class="col-md-12">
                           <label  style="color: #FFFFFF" >Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" required />
                        </div>
                    </div>
                  
                    <div class="form-group">

                        <div class="col-md-6">   
                          
                            
                            <small class="text-muted text-center">
                Remember your password? <a href="<?php echo base_url('login');?>" style="color: #FFF;"> Log in</a>.
              </small>
                        </div>
                        <div class="col-md-6">     
                            <button  class="btn btn-info btn-block"> Reset Password</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy;<?php echo date('Y')?> Powered by Nouveta
                    </div>
                    <div class="pull-right">
                       <!--  <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a> -->
                    </div>
                </div>
            </div>
            
        </div>
        
  <!-- / .row -->