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
                    <h3 class="panel-title">Bill Report</h3>
                    <ul class="panel-controls">
                       <a href="<?php echo base_url('report')?>" type="button" class="btn btn-success"> Query New Report <span class="fa fa-plus"></span></a>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                    </div>

                   <div class="col-md-6">
                       <h3>Staff : <?php echo $sub_title; ?></h3>
                       <h4>Date From : <?php echo $date_from; ?></h4>
                       <h4>Date To : <?php echo $date_to; ?></h4>
                    </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Bill Number</th>
                                <th>Customer</th>
                                <th>Description</th>
                                <th>Subcounty</th>
                                <th>Ward</th>
                                <th class="text-right" >Amount (KES)</th>
                                <th>Date</th>
                                <th>Bill status</th>
                              
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
                                <td><?php echo $record->SubCountyName;?></td>
                                <td><?php echo $record->WardName;?></td>
                                <td class="text-right" ><?php echo number_format($record->BillTotal,2);?></td>
                                <td><?php echo $record->DateCreated;?></td>  
                                <td><?php echo $record->status;?></td> 
                                 <?php $total+=$record->BillTotal; ?>  

                             
                              </tr>
                            <?php endfor; ?>
                            </tbody>
                             <tr>
                                <th>#</th>
                                <th><b>Total</b></th>
                                <th></th>
                                <th></th>
                                  <th></th>
                                <th></th>
                                <th class="text-right"><b><?php echo number_format($total,2); ?> </b> </th>
                                <th></th>
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