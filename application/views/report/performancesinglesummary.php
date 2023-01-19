     <div class="page-content-wrap">

            <div class="row">
                    <div class="col-md-12">
                        <a class="btn btn-info" href=" <?php echo base_url('report/allperformancesubcountysummary')?>"> Back</a>
                          <ul class="panel-controls">
                    <!--    <a href="<?php echo base_url('report/filterothers')?>" type="button" class="btn btn-success">Filter Other Date <span class="fa fa-plus"></span></a> -->
                     <!--    <a href="<?php //echo base_url('report/subcountysummary2')?>" type="button" class="btn btn-success">Back 
                   
                        </a> -->

                       
                        
                    </ul> 
                        <center>

                             <div> 
                              <h3 style="font-size: 30px;"><b>Performance Summary  For   <?php echo ucwords(strtolower($subcount)) ?> Sub County</b> </h3> 
                              <h4> From : <?php echo  date('d-m-Y', strtotime($date_from)); ?> <span> -  To : <?php echo  date('d-m-Y', strtotime($date_to)); ?></h4></span>  </h4>
                              <h4>

                            </div><br>

                        </center>

                    </div>
                </div>
 
      <div class="row">
           <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title"> Bill Raised Per Revenue Stream</h3>
                    <ul class="panel-controls">
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Revenue Streams</th>
                                <th>Counts</th>
                                <th class="text-right">Bills Total(KES)</th>
                               
                             
                    
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $count=0; for( $i=0; $i<count( $streambillssummarys ); $i++ ) : ?>
                              <?php $streambillssummary = &$streambillssummarys[$i]; ?>
                              <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                            
                                 
                                <a href=" <?php echo base_url('report/detailsinglestreamreports/'.$streambillssummary->IncomeTypeID )?>"> <?php echo $streambillssummary->IncomeTypeDescription;?></a>

                                  </td> 
                                <td><?php echo $streambillssummary->count;?></td>
                                <td class="text-right"><?php echo number_format($streambillssummary->total,2);?></td>
                                <?php $total= $total + $streambillssummary->total ?>
                                <?php $count= $count + $streambillssummary->count ?>

                              
                                  
                                                      
                             
                              </tr>
                            <?php endfor; ?>





                            </tbody>
                              <tfoot>
                             <tr>
                                <td></td>
                              
                                 <td><b>Total</b></td> 
                                <td><b><?php echo $count;?><b></td>
                                 <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                            
             </div>

        <div class="col-md-6">



          
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Bills Raised Per Biller</h3>
                    <ul class="panel-controls">
                
                    
                
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Name</th> 
                                <th>Counts</th> 
                                <th class="text-right">Bills Total(KES)</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $count=0; for( $i=0; $i<count( $userbilleds ); $i++ ) : ?>
                              <?php $userbilled = &$userbilleds[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                            
                                   <a href=" <?php echo base_url('report/billsraisedsinglereport/'.$userbilled->UserID )?>"> 
                                      <?php echo ucwords(strtolower($userbilled->FirstName ." ".$userbilled->LastName ));?> 
                                 </a>

                                  </td> 
                                    <td><?php echo $userbilled->count;?></td>
                                  <td class="text-right"><?php echo number_format($userbilled->total,2);?></td>
                                   <?php $total= $total + $userbilled->total ?>
                                    <?php $count= $count + $userbilled->count ?>
                              
                                  
                                                      
                             
                                   </tr>
                            <?php endfor; ?>
                        



                            </tbody>
                            <tfoot>
                                   <tr>
                                <td></td>
                              
                                <td><b>Total</b></td> 
                                <td><b><?php echo $count;?><b></td>
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                           
           
    </div>

          

    </div>

    <div class="row">
           <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title"> Bills receipted by Revenue Stream</h3>
                    <ul class="panel-controls">
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Revenue Streams</th>
                                <th>Counts</th> 
                                <th class="text-right">Bills Total(KES)</th>
                               
                          
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0;$count=0 ; for( $i=0; $i<count( $printedperincomereceipteds ); $i++ ) : ?>
                              <?php $printedperincomereceipted = &$printedperincomereceipteds[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                            
                                 
                                <a href=" <?php echo base_url('report/printingsigleperincome/'.$printedperincomereceipted->IncomeTypeID )?>"> <?php echo $printedperincomereceipted->IncomeTypeDescription;?></a>
                                  </td> 
                                <td><?php echo number_format($printedperincomereceipted->count); ?></td>
                                <td class="text-right" ><?php echo number_format($printedperincomereceipted->total,2);?></td>
                                <?php $total= $total + $printedperincomereceipted->total ?>
                                <?php $count= $count + $printedperincomereceipted->count ?>
                            
                              </tr>
                            <?php endfor; ?>





                            </tbody>
                              <tfoot>
                             <tr>
                                <td></td>
                              
                                <td><b>Total</b></td> 
                                <td><b><?php echo $count;?><b></td>
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                            
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                            
             </div>

              <div class="col-md-6">



          
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Bill receipted by Cashier</h3>
                    <ul class="panel-controls">
                
                    
                
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                          <thead>
                             <tr>
                                  <th>#</th>
                                  <th>Name</th> 
                                  <th>Counts</th> 
                                  <th class="text-right">Bills Total(KES)</th>
                                 
                              </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $count=0; for( $i=0; $i<count( $receiptedbycashier ); $i++ ) : ?>
                              <?php $receiptedbycashiers = &$receiptedbycashier[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                                   <a href=" <?php echo base_url('report/receiptedsigleperreport/'.$receiptedbycashiers->UserID )?>"> 
                                  
                                  <?php echo ucwords(strtolower($receiptedbycashiers->FirstName ." ".$receiptedbycashiers->LastName ));?> 
                                </a>
                                  </td> 
                                    <td><?php echo $receiptedbycashiers->count;?></td>
                                  <td class="text-right"><?php echo number_format($receiptedbycashiers->total,2);?></td>
                                   <?php $total= $total + $receiptedbycashiers->total ?>
                                    <?php $count= $count + $receiptedbycashiers->count ?>
                              
                                  
                                                      
                             
                                   </tr>
                            <?php endfor; ?>
                        



                            </tbody>
                            <tfoot>
                                   <tr>
                                <td></td>
                              
                                <td><b>Total</b></td> 
                                <td><b><?php echo $count;?><b></td>
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                           
           
    </div>

        
    </div>
   <!--  <div class=" row">
         <div class="col-md-6">



          
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">Bills Raised Online </h3>
                    <ul class="panel-controls">
                
                    
                
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                 
                    <table class="table datatable1">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Name</th> 
                                <th>Counts</th> 
                                <th class="text-right">Bills Total(KES)</th>
                               
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; $count=0; for( $i=0; $i<count( $onlinebilleds ); $i++ ) : ?>
                              <?php $onlinebilled = &$onlinebilleds[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                              
                                <td>
                            
                                   <a href=" <?php echo base_url('report/billsraisedsingonline/'.$onlinebilled->UserID )?>"> 
                                      <?php echo ucwords(strtolower($onlinebilled->FirstName ." ".$onlinebilled->LastName ));?> 
                                 </a>

                                  </td> 
                                    <td><?php echo $onlinebilled->count;?></td>
                                  <td class="text-right"><?php echo number_format($onlinebilled->total,2);?></td>
                                   <?php $total= $total + $onlinebilled->total ?>
                                    <?php $count= $count + $onlinebilled->count ?>
                              
                                  
                                                      
                             
                                   </tr>
                            <?php endfor; ?>
                        



                            </tbody>
                            <tfoot>
                                   <tr>
                                <td></td>
                              
                                <td><b>Total</b></td> 
                                <td><b><?php echo $count;?><b></td>
                                <td class="text-right"><b><?php echo number_format($total,2);?><b></td>
                           
                              
                                  
                                                      
                             
                              </tr>
                            </tfoot>
                            
                          </table>
                     </div>
                   </div>
                           
           
    </div>
    </div> -->











