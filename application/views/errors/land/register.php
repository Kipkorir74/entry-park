       <div id="page-wrapper">
            
			<div class="col-lg-12">
					 <nav class="breadcrumbs">
					<ul>	
						<li><a href=""> Register</a></li>
						<li class="sep">\</li>
						<li><b>Add Plot</b></li>
					</ul>
				</nav>
            </div>
			<div class="row">
			<div class="col-lg-12 text-right">		
				<button class="btn btn-success" onclick="self.location='<?php echo base_url('index.php/land/add')?>'"> Register</button>
				<button class="btn btn-primary" onclick="self.location='<?php echo base_url('index.php/land/selecting')?>'"> Payment Details</button>
				<button class="btn btn-default" onclick="self.location='<?php echo base_url('index.php/land/index')?>'"> Back</button>
			</div>
		</div>	
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                       
                        <div class="panel-body">
                            <div class="row">
							<?php echo form_open( 'index.php/land/add/', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
						
                                <div class="col-lg-6">
                                 
									<div class="panel panel-default">
										<div class="panel-heading">
											Plot Details
										</div>
										<div class="panel-body">
										
											<div class="form-group">
											<div class="row">
												<div class="col-lg-6">
														<label for="plot_no" class="req">Plot Number</label>
														<input type="text" id="plot_no" name="plot_no" class="form-control" 
																	placeholder="Plot Number" value="<?php  echo set_value('plot_no'); ?>" required />
														<br><span style="color:red; font-size: 80%"><?php echo form_error('plot_no'); ?></span>
													
													</div>
												
													<div class="col-lg-6">
														<label for="doc_type" class="req">ID Document Type</label>
														<select id="doc_type" name="doc_type" class="form-control" required >
															<option value="">Select Document Type</option>
															<?php for( $i=0; $i<count( $doc); $i++ ) : ?>
																<?php $docs = &$doc[$i]; ?>
																								
															<option value="<?php echo $docs->id; ?>"><?php echo $docs->title; ?></option>
														<?php endfor; ?>
														</select>							
														<br><span style="color:red; font-size: 80%"><?php echo form_error('doc_type'); ?></span>						
													</div>
													<div class="col-lg-6">
														<label for="doc_no" class="req">Document Number</label>							
														<input type="text" id="doc_no" name="doc_no" class="form-control" 
																	placeholder="Document Number" value="<?php echo set_value('doc_no'); ?>" required />
														<br><span style="color:red; font-size: 80%"><?php echo form_error('doc_no'); ?></span>					
													</div>
												</div>
												<hr>
												 <div class="row">
										
											
												<div class="col-lg-6">
													<label for="fname" class="req">First Name</label>
														<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo set_value('fname'); ?>" required />
													<br><span style="color:red; font-size: 80%"><?php echo form_error('fname'); ?></span>
													
												</div>
											
												<div class="col-lg-6">
													<label for="lname" class="req">Last Name</label>
														<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo set_value('lname'); ?>" required />
													<br><span style="color:red; font-size: 80%"><?php echo form_error('lname'); ?></span>
												</div>
																		
										
													<div class="col-lg-6">
														<label for="oname" >Other Names</label>
															<input type="text" class="form-control" name="oname" id="oname" placeholder="Other Names" value="<?php echo set_value('oname'); ?>"  />
													<br><span style="color:red; font-size: 80%"><?php echo form_error('oname'); ?></span>
											</div>
												</div>
												
													
												</div>
											</div>
									</div>
										
                                        
                                      
                                </div>
								
                             <div class="col-lg-6">
								<div class="panel panel-success">
										<div class="panel-heading">
											Contact Details
										</div>
										<div class="panel-body">
										
                                        <div class="form-group">
											  
												<div class="row">						
												<div class="col-lg-6">
													<label for="county_id" class="req">Sub_County</label>
														<select id="county_id" name="county_id" class="form-control" required >
															<option value="">Select </option>
															<?php for( $i=0; $i<count( $county); $i++ ) : ?>
																<?php $counties = &$county[$i]; ?>
																								
															<b><option value="<?php echo $counties->id; ?>"><?php echo $counties->title; ?></option></b>
															<?php endfor; ?>
														</select>	
													<br><span style="color:red; font-size: 80%"><?php echo form_error('county_id'); ?></span>				
												</div>
												<div class="col-lg-6">
													<label for="section" class="req">Section</label>
													<input type="text" id="section" name="section" class="form-control"
															placeholder="Section" value="<?php echo set_value('section'); ?>" required />						
																
													<br><span style="color:red; font-size: 80%"><?php echo form_error('section'); ?></span>						
												</div>
												
											</div>
											<div class="row">
												<div class="col-lg-4">
													<label for="box" class="req">P.O. Box</label>							
													<input type="text" id="box" name="box" class="form-control" 
															placeholder="P.O. Box" value="<?php echo set_value('box'); ?>" required />						
													<br><span style="color:red; font-size: 80%"><?php echo form_error('box'); ?></span>						
												</div>
												<div class="col-lg-4">
													<label for="postal_code" class="req">Postal Code</label>
													<input type="text" id="postal_code" name="postal_code" class="form-control" 
															placeholder="Postal Code" value="<?php echo set_value('postal_code'); ?>" required />						
																
													<br><span style="color:red; font-size: 80%"><?php echo form_error('postal_code'); ?></span>						
												</div>
												<div class="col-lg-4">
													<label for="town">Town</label>
													<input type="text" id="town" name="town" class="form-control" 
															placeholder="Town" value="<?php echo set_value('town'); ?>" />						
													<br><span style="color:red; font-size: 80%"><?php echo form_error('town'); ?></span>		
												</div>
											</div>
											<div class="row">
												<div class="col-lg-6">
													<label for="tel_no" class="req">Telephone Number</label>
													<input type="text" class="form-control" name="tel_no" id="tel_no" 
														placeholder="Telephone Number" value="<?php echo set_value('tel_no'); ?>" required />
													<br><span style="color:red; font-size:80%"><?php echo form_error('tel_no'); ?></span>
												</div>
												
												
											</div>
                                        </div>
										</div>
										</div>
									<button type="submit" class="btn btn-success">Submit </button>
                                   <button type="reset" class="btn btn-default">Cancel</button>
								</div>
								  
                                    </form>
                                
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
        </div>
