<div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                <h1 class="page-header">Land Rating</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                          
							
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<?php echo form_open( 'index.php/rate/paying/'. $record->plot_no  , array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
							
                        <div class="col-lg-6 ">
							<div class="panel panel-info">
							<div class="panel-heading">
											Plot Details
										</div>
							  <div class="panel-body">
									<span><b>Plot Number&nbsp;:&nbsp;</b> <?php echo $record->plot_no; ?> </span><br>
									<span ><b>Plot Owner&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo ucwords($record->fname .' '. $record->lname .' '. $record->oname ); ?></span><br>
									<br><br><br><br><br>
									
								</div>
							</div>
						</div>
						
							
						<div class="col-lg-6">
							<div class="panel panel-danger">
							<div class="panel-heading">
								Biling 
							</div>
							  <div class="panel-body">
									   <div class="row">
											<div class="col-lg-5">
												<label for="desc_id" class="req">Select Description</label>
											</div>
											<div class="col-lg-6">
												<select id="desc_id" name="desc_id" class="form-control" required>
														<option value="">Select </option>
																<?php for( $i=0; $i<count( $item); $i++ ) : ?>
																	<?php $items = &$item[$i]; ?>
																									
																<option value="<?php echo $items->id; ?>"><?php echo $items->description; ?></option>
															<?php endfor; ?>
													</select>
												</div>
											</div>
											<!--<div class="col-lg-1">
											<select    class="form-control" name="amounts" id="amounts" required  >
													<option value="">Choose One</option>
																<?php for( $i=0; $i<count( $item); $i++ ) : ?>
																	<?php $items = &$item[$i]; ?>
																									
																<option value="<?php echo $items->id; ?>"><?php echo $items->charge; ?></option>
													<?php endfor; ?>
													
												<br><span style="color:red; font-size: 80%"><?php echo form_error('description'); ?></span>	
											</select>	
											</div>
										</div>
									<div class="row">
										<div class="col-lg-5"><br>
											
													<label for="rates">Rate</label>
										</div>
										<div class="col-lg-7"><br>
														<input type="text" class="form-control" name="rates" id="rates"  readonly />
												<br><span style="color:red; font-size: 80%"><?php echo form_error('rates'); ?></span>
												
										</div>
									</div>-->
									<div class="row">
										<div class="col-lg-5"><br>
											
													<label for="unit">Number of unit/section</label>
										</div>
										<div class="col-lg-7"><br>
														<input type="text" class="form-control" name="unit" id="unit" required />
												<br><span style="color:red; font-size: 80%"><?php echo form_error('unit'); ?></span>
												
										</div>
									</div>										
								</div>
								<center>
									<input type="hidden" name="part_id"  value="2" />
									<input type="hidden" name="plot_no"  value="<?php echo $record->plot_no; ?>" />
									<input type="hidden" name="county_id"  value="<?php echo $record->county_id; ?>" />
									<button type="submit" class="btn btn-success">Submit </button>
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
       
       
