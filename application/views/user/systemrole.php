<div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            
                         <?php echo form_open( 'user/systemrole/'.$record->userID,array('role'=>'form','data-toggle'=>"validator" ,'class'=>"form-horizontal")) ; ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Set</strong>User Role</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                              
                                <div class="panel-body">  

                                 <div class="col-md-4">                                                                      
                                    
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
                                                    Billing 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Billing" <?php if($record->Billing==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                  
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Receipting
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="Receipting" <?php if($record->Receipting==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Chart of Account 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="ChartOfAccount" <?php if($record->ChartOfAccount==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Income Type 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="IncomeType" <?php if($record->IncomeType==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Cost Center 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="CostCenter" <?php if($record->CostCenter==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Fee And Charge 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="FeeAndCharge" <?php if($record->FeeAndCharge==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Report
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="report" <?php if($record->report==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                        <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Report as per Assigned Subcounty
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="reportsubcounty" <?php if($record->reportsubcounty==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                         <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Report Other Subcountys
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox"  value="1"  name="othersubcounty" <?php if($record->othersubcounty==1) { echo "checked";} ?> class="pull-left"/>  
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Period 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="period" <?php if($record->period==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Income Type Period 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="IncomeTypePeriod" <?php if($record->IncomeTypePeriod==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Subcounty 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="Subcounty" <?php if($record->Subcounty==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Ward
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="ward" <?php if($record->ward==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div> 
                                    </div>

                          <div class="col-md-4"> 

                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    CoopBank Receipting
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="coopBank" <?php if($record->coopBank==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Bill Amendment
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="BillAmendment" <?php if($record->BillAmendment==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Department
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="Department" <?php if($record->Department==1) { echo "checked";} ?> class="pull-left"/>  
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
                                                        <input type="checkbox" value="1"  name="Systemuser" <?php if($record->Systemuser==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    HouseRent
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="HouseRent" <?php if($record->HouseRent==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>




                                                                                                      
                                    
                                    
                                     
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Business  Portal
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Busines_Permit" <?php if($record->Busines_Permit==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Sync Business Details 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Sync" <?php if($record->Sync==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Edit Business
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="EditBusiness" <?php if($record->EditBusiness==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Renew Business
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="RenewBusiness" <?php if($record->RenewBusiness==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Create Permit Bill Direct
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="CreateBillDirect" <?php if($record->CreateBillDirect==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Update Business Bill
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="UpdateBill" <?php if($record->UpdateBill==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Bill Business Other Year
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="OtherYear" <?php if($record->OtherYear==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                         <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Bill Business For 2021
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="BillFor2021" <?php if($record->BillFor2021==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                     
                                     




                               

                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Mpesa/Bank Correction
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="mpesa_correcting" <?php if($record->mpesa_correcting==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>




                                  </div>
                              <div class="col-md-4"> 

                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Health System
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Health" <?php if($record->Health==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>

                                          <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Food Hygiene Certificate
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Hygiene" <?php if($record->Hygiene==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Clinic 
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Clinic" <?php if($record->Clinic==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Printing Health Certificate
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Certificate" <?php if($record->Certificate==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                    Approving Certificate
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Approvals" <?php if($record->Approvals==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Assigning Applicant to Bill
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="AssignBill" <?php if($record->AssignBill==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Examination and Results
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Examination" <?php if($record->Examination==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Applicant
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Applicant" <?php if($record->Applicant==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Approve Prints
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="ApprovePrint" <?php if($record->ApprovePrint==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                       <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                  Land Rate
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Rate" <?php if($record->Rate==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Market
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1" name="Market" <?php if($record->Market==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>
                                        <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Commodity / Item
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="Commodity" <?php if($record->Commodity==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>


                                      <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                   Commodity of Price
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="CommodityPrice" <?php if($record->CommodityPrice==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                  Package
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                          <input type="checkbox" value="1"  name="Package" <?php if($record->Package==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div> 
                                         <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                 SendtoLiafom  
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="SendtoLiafom" <?php if($record->SendtoLiafom==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>  

                                       <div class="row">
                                       <div class="col-md-12">
                                            <div class="checkbox">
                                                
                                              <div class="col-md-6">
                                                 Support  
                                              </div>
                                              <div  class="col-md-6">
                                                     <label>
                                                         <input type="checkbox" value="1"  name="Support" <?php if($record->Support==1) { echo "checked";} ?> class="pull-left"/> 
                                                        </label>                           
                                                    </div>
                                            </div>
                                        </div>
                                      </div>                     
                                      
                                     




                                  </div>
                                         

                                          

                                </div>
                                <div class="panel-footer">
                                       <input type="hidden" value=" <?php echo $record->userID; ?>"  name="userID"  /> 
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
			  
             
	    