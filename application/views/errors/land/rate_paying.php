<div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                <h1 class="page-header">Land Payment</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="row">
							<?php echo form_open( 'index.php/rate/payment/'. $record->plot_no , array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
							
                        <div class="col-lg-6 ">
							<div class="panel panel-info">
							<div class="panel-heading">
											Plot Details
										</div>
							  <div class="panel-body">
									<span><b>Plot Number&nbsp;:&nbsp;</b> <?php echo $record->plot_no; ?> </span><br>
									<span ><b>Plot Owner&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo ucwords($record->fname .' '. $record->lname .' '. $record->oname ); ?></span><br>
									<br><br><br><br><br><br><br>
									
								</div>
							</div>
						</div>
						
							
						<div class="col-lg-6">
							<div class="panel panel-danger">
							<div class="panel-heading">
								Payment 
							</div>
							  <div class="panel-body">
									   <div class="row">
											<div class="col-lg-4">
												<label for="desc_id">Description</label>
											</div>
											<div class="col-lg-8">
												<?php echo $rating->description ?>
											</div>
											</div>
									
									<div class="row">
										<div class="col-lg-5"><br>
											<label for="rates">Rate and Number of unit/section	</label>
										</div>
										<div class="col-lg-7"><br>
											<?php echo $rating->charge .' x '. $unit ?>
												
										</div>
									</div>
									<div class="row">
										<div class="col-lg-5"><br>
													<label for="unit">Amount payable</label>
										</div>
										<div class="col-lg-7"><br>
												<p style="font-size: 20px "><b><?php echo $rating->charge * $unit ?></b><p>
										</div>
									</div>										
								</div>
								<center>
									<input type="hidden" name="desc_id"  value="<?php echo $rating->id ?>" />
									<input type="hidden" name="rate"  value="<?php echo $rating->charge ?>" />
									<input type="hidden" name="title"  value="<?php echo $rating->description ?>" />
									<input type="hidden" name="code"  value="<?php echo $rating->code ?>" />
									<input type="hidden" name="amount"  value="<?php echo $rating->charge * $unit ?>" />
									<input type="hidden" name="quantity"  value="<?php echo $unit ?>" />
									<input type="hidden" name="part_id"  value="<?php echo $part_id ?>" />
									<input type="hidden" name="county_id"  value="<?php echo $county_id ?>" />
									<input type="hidden" name="plot_no"  value="<?php echo $record->plot_no; ?>" />
									<button type="submit" class="btn btn-success">Pay</button>
									 <button type="reset" class="btn btn-default" onclick="self.location='<?php echo base_url('index.php/land/index/' . $record->plot_no); ?>'">Cancel</button>
								 </center>
							</div>
							
						</div>
					
							
								
							</div>	
							
						</div>
			</div> 
                        </div>
                    </div>
                   	  
                </div>
       
       
