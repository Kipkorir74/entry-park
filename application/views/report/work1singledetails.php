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
                    <h3 class="panel-title">Bills Report</h3>
                                                  
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                        <a class="btn btn-info" href=" <?php echo base_url('report/performancesinglesubcounty/'.$SubCountyseg3)?>"> Back</a>
                    </div>

                   <div class="col-md-6">
                       <h3>Staff : <?php echo $sub_title; ?></h3>
                       <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Bill Number</th>
                                <th>Customer</th>
                                <th>Description</th>
                                <th>Biller Subcounty </th>
                                <th>Biller Ward </th>
                                <th class="text-right">Amount(KES)</th>
                                <th>Date</th>
                              
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                 <td><?php echo $record->BillNo;?></td>
                                <td><?php echo strtoupper($record->Customer);?></td>
                                <td><?php echo $record->Description;?></td>
                                <td><?php echo $record->bsub;?></td>
                                <td><?php echo $record->bward;?></td>
                                <td class="text-right"><?php echo number_format($record->BillTotal,2);?></td>
                                <td><?php echo $record->DateCreated;?></td>  
                              
                                 <?php $total+=$record->BillTotal; ?>  

                             
                              </tr>
                            <?php endfor; ?>
                            </tbody>
                             <tr>
                                <th>#</th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                 <th></th>
                                <th></th>
                                <th class="text-right"><?php echo number_format($total,2); ?>  </th>
                                <th></th>
                             
                              
                            </tr>

                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>
</div>
</div>