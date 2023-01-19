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
                      
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                        <a class="btn btn-info" href=" <?php echo base_url('report/performancesummarys')?>"> Back</a>
                        
                    </div>

                   <div class="col-md-4">
                       <h4>Revenue Stream : <?php echo $sub_title; ?></h4>
                       <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
                     <div class="col-md-4">
                   
                                          
                  </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>BillNumber</th>
                                <th>ReceiptNo</th>
                                 <th>Biller Subcounty</th>
                                <th>Biller Ward</th>
                                <th>Source</th>
                                <th>Print Count</th>
                                <th class="text-right">Amount(KES)</th>
                                <th>Date</th>
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
                                <td class="text-right"><?php echo number_format($record->PaymentAmount,2);?></td> 
                              
                                <td><?php echo $record->DateCreated;?></td>
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