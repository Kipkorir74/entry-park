<div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
					 <nav class="breadcrumbs">
					<ul>	
						<li><a href="">Land</a></li>
						<li class="sep">\</li>
						<li><b>Payment</b></li>
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
		<?php echo form_open( 'index.php/land/selecting', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">	
					<div class="panel-body">
					<div class="col-lg-3">
					</div>
						<div class="col-lg-6 ">
						<p style="text-align:center; font-size:20px;" ><b> Select Date</b> </p>
						<?php if( $this->session->flashdata('selecterror') != "" ) : ?>
							<div class="row"><div class="col-lg-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('selecterror'); ?></div></div></div>
						<?php endif; ?>
							<div class="panel panel-info">
								<div class="panel-body">
									 <div class="row">
											<div class="col-lg-3">
												<label>From</label>
											</div>	
											<div class="col-lg-6">
												<input class="form-control ts_datepicker" name="date_from" type="text" id="datepicker" value="<?php echo date('m/d/Y')?>"  data-date-autoclose="true" data-parsley-required="true" data-parsley-trigger="change" required>
											</div>	
									  </div>
									 <div class="row">
										<div class="col-lg-3"><br>
											<label>To</label>
										</div>
										<div class="col-lg-6"><br>
											<input class="form-control ts_datepicker"  name="date_to" type="text" id="datepicker" value="<?php echo date('m/d/Y')?>"  data-date-autoclose="true" data-parsley-required="true" data-parsley-trigger="change" required>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3"><br>
											<label>Sub_County</label>
											</div>
										<div class="col-lg-6"><br>
											<select id="county_id" name="county_id" class="form-control" required >
												<option value="">Select </option>
												<?php for( $i=0; $i<count( $county); $i++ ) : ?>
													<?php $counties = &$county[$i]; ?>
																					
												<b><option value="<?php echo $counties->id; ?>"><?php echo $counties->title; ?></option></b>
												<?php endfor; ?>
											</select>	
											
									</div>
								</div>
								<center><br>
									<input type="hidden" name="segment"  value="<?php echo $this->uri->segment(3) ?>" />	
									<button type="submit" class="btn btn-success"><i class=""></i> Submit</button>
									<button class="btn btn-default"><i class=""></i> Back</button>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		</form>
		
	</div>
