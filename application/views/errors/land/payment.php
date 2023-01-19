<div id="page-wrapper">
            
	
            
            <div class="row">
				<nav class="breadcrumbs">
			<ul>	
				<li><a href=""><?php echo $title; ?></a></li>
				<li class="sep">\</li>
				<li><b><?php echo $sub_title ; ?></b></li>
			</ul>
		</nav>
	
			<div class="col-lg-12 text-right">		
				
				<button class="btn btn-success" onclick="self.location='<?php echo base_url('index.php/land/add')?>'"> Register</button>
				<button class="btn btn-primary" onclick="self.location='<?php echo base_url('index.php/land/selecting')?>'"> Payment Details</button>
				<button class="btn btn-default" onclick="self.location='<?php echo base_url('index.php/land/selecting')?>'"> Back</button>
			</div>
		
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         
						
						<!--Business Owner <label > <?php echo ucwords($records[0]->fname .' '. $records[0]->lname .' '. $records[0]->oname ); ?> </label>
							 div class=" text-right">
								<button type="reset" class="btn btn-default"onclick="self.location='<?php echo base_url('business/lists/all'); ?>'">Back</button>
							</div>-->
                        </div>
							<div class="panel-body">
						<table id="dt_basic" class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Plot No</th>
								<th>Receipt No</th>
								<th>Rate</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Date</th>
								<th>Posted By</th>
								
							
							</tr>
						</thead>
						<tbody>
							<?php for( $i=0; $i<count( $records ); $i++ ) : ?>
							<?php $record = &$records[$i]; ?>
							<?php $count= $i + 1; ?> 
							<tr>
								<td><?php  echo $count ; ?></td>
								<td><a href="<?php echo base_url('index.php/land/details/'. $record->plot_no ); ?>"><?php echo $record->plot_no ; ?></a></td>
								<td><a href="<?php echo base_url('index.php/receipt/reprint_land_receipt/' . $record->receipt_no ); ?>"><?php echo $record->receipt_no; ; ?></a></td>
								<td><?php echo $record->charge; ?></td>
								<td><?php echo $record->quantity; ?></td>
								<td><b><?php echo number_format($record->amount,0); ?></b></td>
								<td><?php echo $record->date_created ; ?></td>
								<td><?php echo $record->userdetails; ?></td>
								
							</tr>
							<?php endfor; ?>
						</tbody>
						</table>
					</div>
                    </div> 
                  </div>
            </div>
                    
 
      
   
