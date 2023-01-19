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
                    <h3 class="panel-title">Details Report</h3>
                    <ul class="panel-controls">
                      
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">


                                         
                      <a class="btn btn-info" href=" <?php echo base_url('report/get_wardsummary/'.$this->uri->segment(3).'/'.$this->uri->segment(4))?>"> Back</a>
                        
                
                   

                    </div>

                   <div class="col-md-4">
                      <h4> <b>Revenue Stream : <?php echo $sub_title; ?> </b></h4>
                       <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
                   

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>BillNumber</th>
                                <th>Customer</th>
                                <th>Description</th>
                                <th>Subcounty</th>
                                <th>Ward</th>
                               
                                <th class="text-right">Bill Total(KES)</th>
                                 <th class="text-right">Amount Paid(KES)</th>

                                <th class="text-right">Balance(KES)</th>
                                <th>Bill Date</th>
                                <th>Created By</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $BillTotal=0; $ReducingBalance=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>

                                <?php $paid= $record->BillTotal-$record->ReducingBalance; ?>
                                <?php $ReducingBalance += $record->ReducingBalance; ?>
                                <?php $BillTotal += $record->BillTotal ?>
                                <?php $total += $paid; ?>

                                <td><?php echo $record->BillNo;?></td>
                                <td><?php echo $record->Customer;?></td>
                                <td><?php echo $record->Description;?></td>
                                <td><?php echo $record->SubCountyName;?></td>
                                <td><?php echo $record->WardName;?></td>
                                <td class="text-right"><?php echo number_format($record->BillTotal,2);?></td> 
                                <td class="text-right"><?php echo number_format($paid,2);?></td>
                                <td class="text-right"><?php echo number_format($record->ReducingBalance,2);?></td> 
                                <td><?php echo $record->DateCreated;?></td>
                                <td><?php echo ucfirst(strtolower($record->FirstName ." ". $record->LastName ));?></td>
                                                            
                             
                              </tr>
                            <?php endfor; ?>
                            </tbody>
                             <tr>
                                <td><b>Total</b></td>

                               
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right"><b><?php echo number_format($BillTotal,2);?></b></td> 
                                <td class="text-right"><b><?php echo number_format($total,2);?></b></td>
                                <td class="text-right"><b><?php echo number_format($ReducingBalance,2);?></b></td> 
                                <td></td>
                                <td></td>
                                                            
                             
                              </tr>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>
</div>
</div>