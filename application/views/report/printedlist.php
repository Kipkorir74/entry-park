<div class="page-content-wrap">


 
              

<div class="row">
    <?php if( $this->session->flashdata('error') != "" ) : ?>
                       <div class="row"><div class="col-xs-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></div></div>
                    <?php endif; ?>
                    <?php if( $this->session->flashdata('success') != "" ) : ?>
                       <div class="row"><div class="col-xs-12"><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div></div></div>
                    <?php endif; ?>
</div>                
                
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Printed Location</h3>
                    <ul class="panel-controls">
                       <a href="<?php echo base_url('report/printedlocation')?>" type="button" class="btn btn-success"> Filter Other Date</a>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                    </div>

                   <div class="col-md-4">
                      
                         <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
        <!--              <div class="col-md-4">
                         <div class="form-group">
                                                <label class="col-md-4 control-label">Filter By SubCounty  </label>
                                               
                                                <div class="col-md-8 col-xs-12">                                            
                                                     <select  name="SubCounty" id="dynamic_select1"class="form-control select" data-live-search="true" data-placeholder=""  required="true">
                                                            <option value=""> Select </option> 


                                                                <?php //foreach( $subcountys as $subcounty1 ) : ?>
                                                                    <option value="<?php //echo $subcounty1->SubCountyID; ?>"><?php //echo $subcounty1->SubCountyName ; ?></option>
                                                                <?php //endforeach; ?>
                                                                </select> 
                                                    <br><span style="color:red; font-size: 80%"><?php //echo form_error('SubCounty'); ?></span>     
                                            
                                                </div>
                                              </div>
                                          
                  </div> -->
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>BillNumber</th>
                                <th>ReceiptNo</th>
                                 <th>Printing Office</th>
                                <th>Printing Site</th>
                                <th>Source</th>
                                <th>Print Count</th>
                                <th>Amount(KES)</th>
                                <th>Date Created</th>
                                <th>Date Receipted</th>
                                <th>Printed By</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                          
                                <td><?php echo $record->BillNo;?></td>
                                <td><?php echo $record->ReceiptNo;?></td>
                                      <td><?php echo $record->SubCountyName;?></td>
                                <td><?php echo $record->WardName;?></td>
                             
                                <td><?php echo $record->Source;?></td>
                                <td><?php echo $record->PrintCount;?></td>
                                <td><?php echo number_format($record->PaymentAmount,2);?></td> 
                              
                                <td><?php echo $record->DateCreated;?></td>
                                <td><?php echo $record->DateModified;?></td>
                                  <td><?php echo ucfirst(strtolower($record->FirstName ." ". $record->LastName ));?></td>
                                                            
                             
                              </tr>
                            <?php endfor; ?>
                            </tbody>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>
</div>
</div>