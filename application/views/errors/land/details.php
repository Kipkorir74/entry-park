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
                           Plot Owner <label > :  <?php echo ucwords($record->fname .' '. $record->lname .' '. $record->oname ); ?> </label>
							<div class=" text-right">
								<button type="submit" class="btn btn-primary" onclick="self.location='<?php echo base_url('index.php/rate/details/'. $record->plot_no ); ?>'">Payment Details</button>
								<button type="submit" class="btn btn-default" onclick="self.location='<?php echo base_url('index.php/rate/pays/' . $record->plot_no); ?>'">Land Survey</button>
								<button type="submit" class="btn btn-warning" onclick="self.location='<?php echo base_url('index.php/rate/pay/' . $record->plot_no); ?>'">Land Revenue</button>
								<button type="reset" class="btn btn-info" onclick="self.location='<?php echo base_url('index.php/rate/paying/' . $record->plot_no); ?>'">Land Rate</button> 
								<button type="submit" class="btn btn-success" onclick="self.location='<?php echo base_url('index.php/land/edits/' . $record->plot_no); ?>'">Edit </button>
								<button type="reset" class="btn btn-danger">Delete</button>
							</div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<?php echo form_open( 'business/add/', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
							<!--<?php echo form_open( 'index.php/business/', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>-->
                        <div class="col-lg-6 ">
							<div class="panel panel-info">
							<div class="panel-heading">
											Plot Details
										</div>
							  <div class="panel-body">
									<span><b>Plot Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b> <?php echo $record->plot_no; ?> </span><br>
									<span ><b>ID Document Type&nbsp;&nbsp;:&nbsp;</b><?php echo $record->doc_types; ?></span><br>
									<span ><b>Document Number&nbsp;&nbsp;:&nbsp;</b><?php echo $record->doc_no; ?></span><br><br><br><br><br><br><br>
									
								</div>
							</div>
						</div>
						
							
						<div class="col-lg-6">
							<div class="panel panel-danger">
							<div class="panel-heading">
								Location
							</div>
							  <div class="panel-body">
								<span ><b>Sub_County&nbsp;&nbsp;:&nbsp;</b><?php echo $record->titles; ?> </span><br>
								<span ><b>Section&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</b><?php echo $record->section; ?> </span><br>
								
								<hr>
								<label>Address</label><br>
								<center>
									<span> P.O Box <?php echo $record->box; ?>-<?php echo $record->postal_code; ?>,  </span><br>
									
									<span> <?php echo $record->town; ?>.<span><br>
									<span> <?php echo $record->tel_no; ?><span><br><br>
								<center>	
								</div>
							</div>
						</div>
					
							
								
							</div>	
							
						</div>
			</div> 
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
       
       
