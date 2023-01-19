     <!-- hero section start -->
        <section class="section hero-section bg-ico-hero" id="home">
            <div class="bg-overlay" style="background-repeat: no-repeat; 
            background-size: cover; color: #0000FF; 
	        background-image: url(assets/images/elephants.jpg);"></div>
            <div class="container">
                <div class="row">
                 
                    <div class="col-lg-5">
                        <div class="card  mb-0 mt-5 mt-lg-0">
                            <div class="card-header text-center">
                                <h5 class="mb-0">Bill Entry Park</h5>
                                  <div class="row">
                                    <?php if( $this->session->flashdata('error') != "" ) : ?>
                                                       <div class="row"><div class="col-xs-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></div></div>
                                                    <?php endif; ?>
                                                    <?php if( $this->session->flashdata('success') != "" ) : ?>
                                                       <div class="row"><div class="col-xs-12"><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div></div></div>
                                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
                                <?php if($addvehicle==1){  ?>
                                      <?php echo form_open_multipart('home/billing',array('role'=>'form','data-toggle'=>"validator" ,'class'=>"")) ; ?>

                                             <div class="row">
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label for="formrow-number-input" class="form-label">Plate Number <span style="color: red">*</span> </label>
                                                      <input type="text"  class="form-control" placeholder="Plate Number " required='true' name='PlateNumber' value="<?php echo set_value('PlateNumber'); ?>">                                                                            
                                                       <br><span style="color:red; font-size: 80%"><?php echo form_error('PlateNumber'); ?></span>     
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label for="formrow-email-input" class="form-label">No of Passenger(s)</label>
                                                      <input type="number" min="1" class="form-control" placeholder="Total Number" required='true' name='NoOfPassenger' value="<?php echo set_value('NoOfPassenger'); ?>">
                                                       <br><span style="color:red; font-size: 80%"><?php echo form_error('NoOfPassenger'); ?></span>     
                                                  </div>
                                              </div>
                                          </div>

                                   <div class="row">
                                      
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-number-input" class="form-label">Vehicle Type <span style="color: red">*</span></label>
                                                   <select class="form-control select2" name="BillType"  id ="BillType" title="BillType " required value="<?php echo set_value('BillType'); ?>">

                                              <option value="">Vehicle Type Select</option>
                                                  <?php foreach( $vehicletypes as $vehicletype ) : ?>
                                                      <option value="<?php echo $vehicletype->id; ?>"><?php echo ucwords(strtolower($vehicletype->BillType)) ; ?></option>
                                                  <?php endforeach; ?>
                                             
                                          </select>
                                           <br><span style="color:red; font-size: 80%"><?php echo form_error('BillType'); ?></span>     
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-email-input" class="form-label">Charges <span style="color: red">*</span></label>
                                              <input type="number" min="0" class="form-control" placeholder="Amount"  id="Charge" required='true' name='Charge' value="<?php echo set_value('Charge'); ?>" Readonly> 
                                               <br><span style="color:red; font-size: 80%"><?php echo form_error('Charge'); ?></span>     

                                          </div>
                                      </div>
                                  </div>
                                   <div class="row">
                                      
                                   
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-email-input" class="form-label">Effective Date <span style="color: red">*</span></label>
                                              <div class="docs-datepicker">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control docs-date" 
                                                                placeholder="Pick a date" autocomplete="off" name="EffectiveDate" required>
                                                            <button type="button"
                                                                class="btn btn-secondary docs-datepicker-trigger"
                                                                disabled>
                                                                <i class="mdi mdi-calendar" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                        <div class="docs-datepicker-container"></div>
                                                    </div>
                                          
                                                    <br><span style="color:red; font-size: 80%"><?php echo form_error('EffectiveDate'); ?></span>      
                                                             

                                          </div>
                                      </div>
                                  </div>
                                     <div class="row">
                                     <div class="col-md-12">
                                      <div class="form-group"><br>

                                            <input type="hidden" name="userId" value="<?php echo $userId ;?>">
                                            <input type="hidden" name="PartType" value="1">
                                           
                                            <button class="btn btn-info pull-right">Add Vehicle</button>

                                      </div>
                                    </div>
                                  </div>

                                      </form> 
                                 <?php }else{ ?>

                                    <?php echo form_open( 'home/assigning/'.$userId,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>

                                             <div class="row">
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label for="formrow-number-input" class="form-label">Individual Type <span style="color: red">*</span> </label>
                                                      <select class="form-control select2" data-live-search="true" name="BillType" id="BillType2"  required>
                                                
                                                    <option value=""> Vehicle Type Select</option>
                                                    <?php foreach( $persontypes as $persontype ) : ?>
                                                             <option value="<?php echo $persontype->id; ?>"><?php echo $persontype->BillType ; ?></option>
                                                  <?php endforeach; ?>

                                                    
                                                </select>
                                                <span style="color:red; font-size: 80%"><?php echo form_error('BillType'); ?></span>     
                                                  </div>
                                              </div>
                                              <div class="col-md-6">
                                                  <div class="mb-3">
                                                      <label for="formrow-email-input" class="form-label">Charge</label>

                                                       <input type="number" min="0" class="form-control" placeholder="Amount"  id="Charge2" required='true' name='ChargeAmount' value="<?php echo set_value('ChargeAmount'); ?>" Readonly> 
                                                     
                                                       <br><span style="color:red; font-size: 80%"><?php echo form_error('ChargeAmount'); ?></span>     
                                                  </div>
                                              </div>
                                          </div>

                                   <div class="row">
                                      
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-number-input" class="form-label">ID/Passport Number <span style="color: red">*</span></label>
                                              <input type="text"  class="form-control" placeholder="ID/Passport Number " required='true' name='IdNumber' value="<?php echo set_value('IdNumber'); ?>">
                                                
                                           <br><span style="color:red; font-size: 80%"><?php echo form_error('IdNumber'); ?></span>     
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-email-input" class="form-label">Full Number <span style="color: red">*</span></label>
                                             <input type="text" min="0" class="form-control" placeholder="Full Name"  id="FullName" required='true' name='FullName' value="<?php echo set_value('FullName'); ?>" > 
                                               <br><span style="color:red; font-size: 80%"><?php echo form_error('FullName'); ?></span>     

                                          </div>
                                      </div>
                                  </div>
                                   <div class="row">
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-number-input" class="form-label">Total Passenger(s) <span style="color: red">*</span></label>
                                              <input type="text"  class="form-control"   value="<?php echo $NoOfPassenger ;?>" readonly >  
                                                
                                            
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="mb-3">
                                              <label for="formrow-email-input" class="form-label">Assigned Passenger(s)  <span style="color: red">*</span></label>
                                             <input type="text"  class="form-control"   value="<?php echo $TotalAssign ;?>" readonly > 
                                                 

                                          </div>
                                          <input type="hidden" name="userId" value="<?php echo $userId ;?>">
                                          <input type="hidden" name="SessionKey" value="<?php echo $SessionKey ;?>">
                                          <input type="hidden" name="PartType" value="2">
                                      </div>
                                      
                                   
                                     
                                  </div>
                                     <div class="row">
                                     <div class="col-md-12">
                                      <div class="form-group"><br>
                                            <button class="btn btn-info float-end ">Add Passenger</button>

                                      </div>
                                    </div>
                                  </div>

                                      </form> 




                                  <?php } ?>
            
                   </div>


                                   
                                </div>
                            </div>







                   </div>
                           <div class="col-lg-7">
                            <?php if($records){?>
                           <div class="card  mb-0 mt-5 mt-lg-0">
                        <div class="card-body">

                      <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                          <table class="table datatable1">
                              <thead>
                                 <tr> 

              
                                      <th>#</th>
                                      <th>For</th>
                                      <th>Identify No</th>
                                      <th>Charge</th>
                                      <th>Effective Date</th>
                                      <th>Date Created</th>
                                      <th>Remove</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                                    <?php $rec = &$records[$i]; ?>
                                  <tr>
                                      <td><?php echo $i + 1; ?></td>
                                      <td><?php echo strtoupper($rec->DescName);?></td>
                                      <td><?php echo $rec->IdentifyNo;?></td>
                                      <td><?php echo number_format( $rec->Charge,2);?></td>
                                      <td><?php echo $rec->EffectiveDate;?></td>
                                      <td><?php echo $rec->DateCreated;?></td>
                                      <?php if($rec->PartType==2){?>
                                   
                                      <td><a href="<?php echo base_url('entry/removepassenger/'. $rec->id )?>"><i class="fa fa-trash-o"> Remove Passenger </i></a></td>

                                      <?php }else{ ?>

                                         <td><a href="<?php echo base_url('entry/removevehile/'. $rec->id )?>"><i class="fa fa-trash-o"> Remove Vehicle </i></a> </td>
                                        <?php  } ?>
                                        <?php $total+=$rec->Charge; ?>
                                    </tr>
                                  <?php endfor; ?>
                                  </tbody>
                                  <tr> 
                                      <th>#</th>
                                      <th>Total</th>
                                      <th></th>
                                      <th><?php echo number_format($total,2)?></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                                  
                                </table>
                                  <div class="row">
                                   <div class="col-md-12">
                                              <div class="form-group">
                                                 <?php echo form_open( 'home/generate/'.$SessionKey,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal", 'id'=>'bill_id')) ; ?>
                                                    
                                                    <?php if($CompletedAssigns==1){ ?>
                                                      <input type="hidden" name="SessionKey" value="<?php echo $SessionKey ;?>">
                                                       <input type="hidden" name="UserID" value="<?php echo $userId ;?>">
                                                       <input type="submit"  id="checkout" class="btn btn-success w-md float-end" value="Generate Bill"  /> 

                                                       

                                                      <?php } ?>  
                                                </form>

                                        </div>
                                    </div>
                                  </div>
                           </div>
                         </div>
                       </div>
                   <?php }else{ ?>


                        <div class="text-white-50">

                             <div class="row">
                           <div class="col-md-3">
                           </div>
                            <div class="col-md-9">


                            <h1 class="text-white fw-semibold mb-3 hero-title">How The Registration Works</h1>
                             <p class="font-size-18 text-dark">1. Enter Vehicle Plate Number </p>
                             <p class="font-size-18 text-dark">2. Enter the Total Number of Passangers </p>
                             <p class="font-size-18 text-dark">3. Select the Type of the Vehicle </p>
                             <p class="font-size-18 text-dark">4. Enter the Effective Date </p>
                             <p class="font-size-18 text-dark">5. Assign Each Passanger to the Vehicle </p>
                           </div>
                         </div>


                            
                            <div class="d-flex flex-wrap gap-2 mt-4">
                               <!--  <a href="javascript: void(0);" class="btn btn-success">Get Whitepaper</a>
                                <a href="javascript: void(0);" class="btn btn-light">How it work</a> -->
                            </div>
                        </div>
                           <?php } ?>
                    </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- hero section end -->
      <!--  -->
        

        <!-- Footer start -->

               <div class="modal fade" id="signin" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Verify your Account</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div id="kyc-verify-wizard">
                                                            <!-- Personal Info -->
                                                            <h3>Personal Info</h3>
                                                            <section>
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="kycfirstname-input" class="form-label">First name</label>
                                                                                <input type="text" class="form-control" id="kycfirstname-input" placeholder="Enter First name">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="kyclastname-input" class="form-label">Last name</label>
                                                                                <input type="text" class="form-control" id="kyclastname-input" placeholder="Enter Last name">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="kycinput" class="form-label">Phone</label>
                                                                                <input type="text" class="form-control" id="kycphoneno-input" placeholder="Enter Phone number">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="kycbirthdate-input" class="form-label">Register as</label>
                                                                                 <select class="form-select" id="kycselectcity-input">
                                                                                    <option value="SF" selected>San Francisco</option>
                                                                                    <option value="LA">Los Angeles</option>
                                                                                    <option value="SD">San Diego</option>
                                                                                </select>
                                                                               
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="mb-3">
                                                                                <label for="kycselectcity-input" class="form-label">Business Name</label>
                                                                            
                                                                                      <input type="text" class="form-control" id="kycphoneno-input" placeholder="Enter Phone number">
                                                                              
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </section>
                
                                                            <!-- Confirm email -->
                                                            <h3>Location Info</h3>
                                                            <section>
                                                                <form>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-pancard-input">PAN Card</label>
                                                                                <input type="text" class="form-control" id="basicpill-pancard-input" placeholder="PAN Card No.">
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-vatno-input">VAT/TIN No.</label>
                                                                                <input type="text" class="form-control" id="basicpill-vatno-input" placeholder="VAT/TIN No">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-cstno-input">CST No.</label>
                                                                                <input type="text" class="form-control" id="basicpill-cstno-input" placeholder="CST No.">
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-servicetax-input">Service Tax No.</label>
                                                                                <input type="text" class="form-control" id="basicpill-servicetax-input" placeholder="Service Tax No.">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-companyuin-input">Company UIN</label>
                                                                                <input type="text" class="form-control" id="basicpill-companyuin-input" placeholder="Company UIN">
                                                                            </div>
                                                                        </div>
                
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                <label for="basicpill-declaration-input">Declaration</label>
                                                                                <input type="text" class="form-control" id="basicpill-Declaration-input" placeholder="Declaration">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </section>
                
                                                         
            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                             <div class="modal fade" id="verifyvehicle" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Verify Vehicle info and Pay </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                          <center>
                                                            <div class="row" id="message6" ></div>
                                                           
                                                          </center>

                                                        <div id="kyc-verify-wizard">
                                                            <!-- Personal Info -->
                                                            <!-- <h3>Client Info</h3> -->
                                                            <section>
                                                               <form class="form" method="POST" action="<?php echo base_url('tollTaker/tollpayment');?>" id="pay-toll">

                                                                      
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                           
                                                                            <label for="kycfirstname-input" class="form-label">Bill Number </label>
                                                                               </div>
                                                                              <div class="col-lg-8">   
                                                                                <input type="text" class="form-control" id="BillNumberv" name="BillNumberv" placeholder="Enter BillNumberv " required readonly >
                                                                                <br><span style="color:red; font-size: 80%" class="help-block BillNumberv create-error"><?php echo form_error('BillNumberv'); ?></span>
                                                                             </div>
                                                                        </div>
                                                                     <div class="row">
                                                                        <div class="col-lg-4">
                                                                           
                                                                             <label for="kycfirstname-input" class="form-label">Amount To Pay <strong class="text-danger">*</strong></label>
                                                                               </div>
                                                                              <div class="col-lg-8">   
                                                                                <input type="number" min="1" class="form-control" id="AmountToPayv" name="AmountToPayv" placeholder="Enter Amount to Pay" required readonly >
                                                                                <br><span style="color:red; font-size: 80%" class="help-block AmountToPayv create-error"><?php echo form_error('AmountToPayv'); ?></span>
                                                                             </div>
                                                                        </div>
                                                                         <div class="row">
                                                                        <div class="col-lg-4">
                                                                           
                                                                             <label for="kycfirstname-input" class="form-label">Mpesa Phone Number <strong class="text-danger">*</strong></label>
                                                                               </div>
                                                                              <div class="col-lg-8">   
                                                                                <input type="text"  class="form-control" id="MpesaNumber" name="MpesaNumber" placeholder="Enter Mpesa Phone Number" required readonly >
                                                                                <br><span style="color:red; font-size: 80%" class="help-block MpesaNumber create-error"><?php echo form_error('MpesaNumber'); ?></span>
                                                                             </div>
                                                                        </div>
                                                                       
                                                                     <div class="row justify-content-end">
                                                                            <div class="col-lg-10">
                                                                                <button type="submit" class="btn btn-primary w-100"><i class="fab fa-amazon-pay "></i> Pay Now</button>
                                                                            </div>
                                                                        </div>
                                                                 
                                                                </form>
                                                            </section>
                
                                                           
            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="billgenerated" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Bill Information </h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="self.location='<?php echo base_url('billing'); ?>'" ></button>
                                          </div>
                                          <div class="modal-body">
                                                <center>
                                                  <div class="row" id="message1" ></div>
                                                  <div class="row" id="create-message1"></div>   
                                                </center>

                                              <div id="kyc-verify-wizard">
                                                  <section>

                                                       <div class="card">
                                                  <div class="card-body">
                                                      <div class="">
                                                          <div class="row">
                                                              <div class="col-lg-12">
                                                               

                                                                   <table class="table table-striped mb-0">

                                                                    <thead>
                                                                        <tr>
                                                                         
                                                                             <th>Description</th>
                                                                             <th>Bill Details</th>
                                                                             
                                                                                       
                                                                        </tr>
                                                                    </thead>
                                                                     <tbody>
                                                                                   
                                                                        
                                                                           <td> <div>Bill No. </div></td>
                                                                            <td><div><strong><span id="BillNoV"></span></strong></div></td>

                                                                          </tr>
                                                                           <tr>
                                                                          
                                                                           
                                                                           <td> <div>Bill Total (KES) </div></td>
                                                                            <td><div><strong><span id="BillTotalV"></span></strong></div></td>

                                                                          </tr>
                                                                      
                                                                           <tr>
                                                                           <td> <div>Paybill Number </div></td>
                                                                            <td><div><strong><span id="">XXXXXXXX</span></strong></div></td>

                                                                          </tr>
                                                                           <td> <div>Account Number </div></td>
                                                                            <td><div><strong><span id="PaymentAccV"></span></strong></div></td>

                                                                          </tr>
                                                                        </tbody>
                                                                      </table>
                                                                                
                                                                                      


                                                                    <form class="form" method="POST" action="<?php echo base_url('billing/pay_ajax');?>" id="billids">
                                                                       <div class="mt-4">
                                                                               <div class="row">

                                                                           <div class="col-md-7">
                                                                              <label for="formrow-number-input" class="form-label">Phone Number <span style="color: red">*</span> </label>
                                                                           </div>
                                                                            <div class="col-md-5">
                                                                              <input type="text" class="form-control" id="PhoneNumberMpesa" name="PhoneNumberMpesa" placeholder=" MPESA Phone Number">
                                                                              <br><span style="color:red; font-size: 80%" class="help-block PhoneNumberMpesa create-error"><?php echo form_error('PhoneNumberMpesa'); ?></span>   
                                                                          </div>
                                                                         </div>

                                                                              <input type="hidden" name="amount" id="billingAmount" >
                                                                              <input type="hidden" class="form-control" id="BillNoP" name="BillNoP" >
                                                                              
                                                                             
                                                                          </div>

                                                                   

                                                                           <div class="row col-md-12">
                                      
                                                                            <div class="col-md-6">
                                                                               
                                                                           
                                                                             <button type="button" class="btn btn-primary btn-rounded waves-effect waves-light mb-2 me-2" data-bs-toggle="modal" data-bs-target=".printbill" ><i class="fas fa-print"></i> Print Bill</button> </div>
                                                                             
                                                                            
                                     
                                                                            <div class="col-md-6">

                                                                             
                                                                               <button type="submit" class="btn btn-success btn-rounded float-end"><i class="fas fa-money-bill-alt "></i> MPESA</button>
                                                                           
                                                                            </div>
                                                                             </div>

                                                                        
                                                                      
                                                                     
                                                                  </form>
                                                              </div>
                                                          </div>

                                                      </div>
                                                  </div>
                                              </div>
                                                     
                                                  </section>
      
                                                 
  
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>


     
