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
                    <h3 class="panel-title">Ward(s) </h3>
                    <ul class="panel-controls">
                    <!--     <?php  if($this->session->userdata('othersubcounty')==1){ ?>
                      <a href="<?php echo base_url('report/selectsummarysubcounty')?>" type="button" class="btn btn-success">  Other Date  <span class="fa fa-plus"></span></a> 
                  <?php } ?> -->
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">

                                         
                      <a class="btn btn-info" href=" <?php echo base_url('report/subcountysummary')?>"> Back</a>
                        
                
                    </div>

                   <div class="col-md-6">
                        <h3>Subcounty : <?php echo $subcount; ?></h3>
                       <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Ward(s)</th>
                               
                                <th class="text-right">Total(KES)</th>
                               
                             
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i];
                               ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                 <td><a href="<?php echo base_url('report/revenue_streams/'.$record->WardID.'/'.$this->uri->segment(3));?>">  <?php echo $record->WardName;?></a> </td> 
                                <td class="text-right"><?php echo number_format($record->total,2);?></td>
                                <?php $total= $total + $record->total ?>
                              
                                  
                                                      
                             
                              </tr>
                            <?php endfor; ?>
                             <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                 <td><b>Total</b></td> 
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>



                            </tbody>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>

            
</div>
</div>
</div>