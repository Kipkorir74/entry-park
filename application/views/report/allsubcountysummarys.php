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
                                                
                    <h3 class="panel-title">All Subcounty Summary Report</h3>
                    <ul class="panel-controls">
                        <?php // if($this->session->userdata('othersubcounty')==1){ ?>
                    <a href="<?php echo base_url('report/allperformancesubcounty')?>" type="button" class="btn btn-success">  Filter Other Date  <span class="fa fa-plus"></span></a> 
                  <?php //} ?>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                    </div>

                   <div class="col-md-6">
                     
                       <h4>Date From : <?php echo  date('d-m-Y', strtotime( $date_from)); ?></h4>
                       <h4>Date To : <?php echo  date('d-m-Y', strtotime($date_to)); ?></h4>
                    </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Sub County</th>
                                <th  class="text-right">Billed(Kshs)</th>
                                <th  class="text-right">Receipted(KES)</th>
                                <th  class="text-right">collected(KES)</th>
                               
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0;
                            $billed=0; 
                            $collected=0;
                            $receipted=0;
                            for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i];
                               ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                 <td>  <a href=" <?php echo base_url('report/performancesinglesubcounty/'.$record->SubCountyID )?>">  <?php echo $record->SubCountyName;?>
                               </a></td> 
                                 <td  class="text-right" > <?php echo number_format($record->billed,2);?></td> 
                                 <td  class="text-right" > <?php echo number_format($record->receipted,2);?></td> 
                                <td  class="text-right"><?php echo number_format($record->collected,2);?></td>
                                <?php $total= $total + $record->billed ?>
                                 <?php $receipted= $receipted + $record->receipted ?>
                                  <?php $collected= $collected + $record->collected ?>
                              
                                  
                                                      
                             
                              </tr>
                            <?php endfor; ?>
                     



                            </tbody>
                            <tfoot>
                                <tr>
                                <td></td>
                              
                                 <td><b>Total</b></td> 
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                                <td class="text-right"><b><?php echo number_format($receipted,2);?><b></td>
                                <td class="text-right"><b><?php echo number_format($collected,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>

            
</div>
</div>
</div>