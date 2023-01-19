      
<div class="page-content-wrap">

            <div class="row">
                    <div class="col-md-12">
                          <ul class="panel-controls">
                       <a href="<?php echo base_url('report/filterother')?>" type="button" class="btn btn-success">Filter Other Date <span class="fa fa-plus"></span></a>
                        
                    </ul> 
                        <center>

                             <div> 
                              <h3 style="font-size: 30px;"><b>Sub County Report For <?php echo ucwords(strtolower($subcount)) ?></b> </h3> 
                              <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                              <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>

                            </div><br>

                        </center>

                    </div>
                </div>

      



     <div class="row">
        <div class="col-md-6">

          
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title"> Revenue Streams Summary</h3>
                    <ul class="panel-controls">
                    
                    
                
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Revenue Streams</th>
                                <th class="text-right">Total Collection(KES)</th>
                               
                             
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                             <!-- <?php //echo $record->IncomeTypeDescription;?> -->
                                 
                                    <a href=" <?php echo base_url('report/streamreports/'.$record->IncomeTypeID  )?>"> <?php echo $record->IncomeTypeDescription;?></a>

                                  </td> 
                                <td class="text-right"><?php echo number_format($record->total,2);?></td>
                                <?php $total= $total + $record->total ?>
                              
                                  
                                                      
                             
                              </tr>
                            <?php endfor; ?>




                            </tbody>
                              <tfoot>
                             <tr>
                                <td></td>
                              
                                 <td><b>Total</b></td> 
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                              </tr>
                              </tfoot>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
        <div class="col-md-6">

          
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Wards Summary</h3>
                    <ul class="panel-controls">
                    
                    
                
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Ward</th>
                               
                                <th class="text-right">Total Collection(KES)</th>
                               
                             
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $perwardtransactions ); $i++ ) : ?>
                              <?php $perwardtransaction = &$perwardtransactions[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                            
                                   <a href=" <?php echo base_url('report/wardreports/'.$perwardtransaction->WardID  )?>"> 
                                    <?php echo $perwardtransaction->WardName;?> </a>

                                  </td> 
                                <td class="text-right"><?php echo number_format($perwardtransaction->total,2);?></td>
                                <?php $total= $total + $perwardtransaction->total ?>
                              
                                  
                                                      
                             
                              </tr>
                            <?php endfor; ?>




                            </tbody>
                              <tfoot>
                             <tr>
                                <td></td>
                              
                                 <td><b>Total</b></td> 
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
    </div>
 








