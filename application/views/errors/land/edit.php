      <div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                <h1 class="page-header">Plot Information</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<center>
                         <b>Edit</b>
						 </center>
                        </div>
		
			 <div class="panel-body">
			 <center>
				<?php if( $this->session->flashdata('sbperror') != "" ) : ?>
					<div class="row"><div class="col-lg-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('sbperror'); ?></div></div></div>
				<?php endif; ?>
				<?php if( $this->session->flashdata('sbpsuccess') != "" ) : ?>
					<div class="row"><div class="col-lg-12"><div class="alert alert-success"><?php echo $this->session->flashdata('sbpsuccess'); ?></div></div></div>
				<?php endif; ?>
			 </center>
                            <div class="row">
							<?php echo form_open( 'index.php/land/edits/', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
							
                                <div class="col-lg-6">
                                 
									<div class="panel panel-default">
										<div class="panel-heading">
											Plot Details
										</div>
										<div class="panel-body">
										
											<div class="form-group">
											<div class="row">
												<div class="col-lg-6">
												<label for="plot_no" >Plot Number</label>
													<input type="text" id="plot_no" name="plot_no" class="form-control" readonly
															placeholder="Plot Number" value="<?php echo $record->plot_no; ?>" />						
													<br><span style="color:red; font-size: 80%"><?php echo form_error('plot_no'); ?></span>		
													
													</div>
													
											
													<div class="col-lg-6">
														<label for="doc_type" class="req">ID Document Type</label>
														<select id="doc_type" name="doc_type" class="form-control" required >
															<option value="">Select </option>
															<?php for( $j=0; $j<count( $doc ); $j++ ) : ?>
																<?php $docs = &$doc[$j]; ?>	
																<?php $selected = ($docs->id==$record->doc_type )? "selected=\"selected\"" : ""; ?>								
																<option value="<?php echo $docs->id; ?>" <?php echo $selected; ?>><?php echo $docs->title; ?></option>
															<?php endfor; ?>
														</select>								
														<br><span style="color:red; font-size: 80%"><?php echo form_error('doc_type'); ?></span>						
													</div>
													<div class="col-lg-6">
														<label for="doc_no" class="req">Document Number</label>							
														<input type="text" id="doc_no" name="doc_no" class="form-control" 
																	placeholder="Document Number" value="<?php echo $record->doc_type; ?>" required />
														<br><span style="color:red; font-size: 80%"><?php echo form_error('doc_no'); ?></span>					
													</div>
												</div>
												<div class="row">
													
												<div class="col-lg-4">
													<label for="fname" class="req">First Name</label>
														<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" value="<?php echo $record->fname; ?>"  required />
													<br><span style="color:red; font-size: 80%"><?php   echo form_error('fname'); ?></span>
													
												</div>
											
												<div class="col-lg-4">
													<label for="lname" class="req">Last Name</label>
														<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" value="<?php echo $record->lname; ?>" required  />
													<br><span style="color:red; font-size: 80%"><?php echo form_error('lname'); ?></span>
												</div>
																		
										
													<div class="col-lg-4">
														<label for="oname" >Other Names</label>
															<input type="text" class="form-control" name="oname" id="oname" placeholder="Other Names" value="<?php echo $record->oname; ?>"  />
													<br><span style="color:red; font-size: 80%"><?php echo form_error('oname'); ?></span>
													</div>
												</div>
													
												</div>
											</div>
									</div>
									</div>
								
                                <div class="col-lg-6">
										<div class="panel panel-danger">
										<div class="panel-heading">
											Location
										</div>
										<div class="panel-body">
										
                                        <div class="form-group">
											   <div class="row">						
												<div class="col-lg-6">
													<label for="county_id" class="req">Sub_County</label>
														<select id="county_id" name="county_id" class="form-control" required>
															<option value="">Select </option>
															<?php for( $j=0; $j<count( $county ); $j++ ) : ?>
																<?php $countys = &$county[$j]; ?>	
																<?php $selected = ($countys->id==$record->county_id )? "selected=\"selected\"" : ""; ?>								
																<option value="<?php echo $countys->id; ?>" <?php echo $selected; ?>><?php echo $countys->title; ?></option>
															<?php endfor; ?>
														</select>		
													<br><span style="color:red; font-size: 80%"><?php echo form_error('county_id'); ?></span>				
												</div>
												<div class="col-lg-6">
													<label for="section" class="req">Section</label>
													<input type="text" id="section" name="section" class="form-control"
															placeholder="Section" value="<?php echo $record->section; ?>"  required />						
																
													<br><span style="color:red; font-size: 80%"><?php echo form_error('section'); ?></span>						
												</div>
												<div class="col-lg-4">
													
												</div>
											</div>
											<div class="row">						
												<div class="col-lg-4">
													<label for="box" class="req">P.O. Box</label>							
													<input type="text" id="box" name="box" class="form-control" 
															placeholder="P.O. Box" value="<?php echo $record->box; ?>" required />						
													<br><span style="color:red; font-size: 80%"><?php echo form_error('box'); ?></span>						
												</div>
												<div class="col-lg-4">
													<label for="postal_code" class="req">Postal Code</label>
													<input type="text" id="postal_code" name="postal_code" class="form-control" 
															placeholder="Postal Code" value="<?php echo $record->postal_code; ?>" required />						
																
													<br><span style="color:red; font-size: 80%"><?php echo form_error('postal_code'); ?></span>						
												</div>
												<div class="col-lg-4">
													<label for="town">Town</label>
													<input type="text" id="town" name="town" class="form-control" 
															placeholder="Town" value="<?php echo $record->town; ?>"/> 						
													<br><span style="color:red; font-size: 80%"><?php echo form_error('town'); ?></span>		
												</div>
											</div>
											<div class="row">
												<div class="col-lg-5">
													<label for="tel_no" class="req">Telephone Number</label>
													<input type="text" class="form-control" name="tel_no" id="tel_no" 
														placeholder="Telephone Number" value="<?php echo $record->tel_no; ?>" required /> 
													<br><span style="color:red; font-size:80%"><?php echo form_error('tel_no'); ?></span>
												</div>
												
												
											</div>
											
                                        </div>
										</div>
										</div>
									
                                      
									<button type="submit" class="btn btn-success">Update </button>
                                        <button type="reset" class="btn btn-default">Cancel</button>
								
									</div>
								</div>
								
										
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                      
                </div>
            </div>
	</div>
			  
        