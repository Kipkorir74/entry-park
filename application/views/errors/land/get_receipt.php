<div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
                <h1 class="page-header">Land</h1>
                </div>
                <!--end page header -->
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
						<center>
							Print Receipt
						</center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
							<?php echo form_open( 'index.php/receipt/get_land_receipt', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
									
								<div class="col-lg-12 ">
									<div class="panel panel-info">
									<div class="panel-heading">
													
									</div>
									  <div class="panel-body">
										<center>
											<?php if( $this->session->flashdata('landsuccess') != "" ) : ?>
												<div class="row"><div class="col-lg-12"><div class="alert alert-success"><?php echo $this->session->flashdata('landsuccess'); ?></div></div></div>
											<?php endif; ?>
											<input type="hidden" name="receipt_no"  value="<?php echo $records->receipt_no  ?>" />
											<input type="hidden" name="plot_no"  value="<?php echo $records->plot_no  ?>" />
											<button type="submit" class="btn btn-success">Print Receipt</button>
											<button type="reset" class="btn btn-default"onclick="self.location='<?php echo base_url('index.php/rate/paying/' . $records->plot_no); ?>'">Back</button>
										 </center>
													
										</div>
									</div>
								</div>
							</form>
							</div>
						</div> 
                     </div>
                  </div>
          </div>
 </div>
       
