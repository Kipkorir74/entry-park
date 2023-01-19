<div id="page-wrapper">
            <div class="row">
                 <!-- page header -->
                <div class="col-lg-12">
             <nav class="breadcrumbs">
			<ul>	
				<li><a href="<?php echo base_url('land/index'); ?>">Land</a></li>
				<li class="sep">\</li>
				<li><b>Lists</b></li>
			</ul>
		</nav>
            </div>
		
		
		<div class="row">
			<div class="col-lg-12 text-right">		
				<button class="btn btn-success" onclick="self.location='<?php echo base_url('index.php/land/add')?>'"> Register</button>
				<button class="btn btn-primary" onclick="self.location='<?php echo base_url('index.php/land/selecting')?>'"> Payment Details</button>
				<button class="btn btn-default" onclick="self.location='<?php echo base_url('index.php/dashboard')?>'"> Back</button>
			</div>
		</div>	
	
		<?php echo form_open( 'business/add', array( 'id'=>'mvi_form', 'style'=>'' ) ); ?>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
			
					<!--<div class="panel-heading"><i class="fa fa-">&nbsp;</i>lists</div>-->
					<div class="panel-body">
						<center>
				
							<?php if( $this->session->flashdata('landerror') != "" ) : ?>
								<div class="row"><div class="col-lg-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('landerror'); ?></div></div></div>
							<?php endif; ?>
							<?php if( $this->session->flashdata('landsuccess') != "" ) : ?>
								<div class="row"><div class="col-lg-12"><div class="alert alert-success"><?php echo $this->session->flashdata('landsuccess'); ?></div></div></div>
							<?php endif; ?>
						</center>
						<table id="dt_basic" class="table table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Plot Number</th>
								<th>Owner</th>
								<th>Sub_county</th>
								<th>Section</th>
								<th>Address</th>
								<th>Telephone</th>
								<th>Date Posted </th>
							</tr>
						</thead>
						<tbody>
							<?php for( $i=0; $i<count( $records ); $i++ ) : ?>
							<?php $record = &$records[$i]; ?>
							<?php $count= $i + 1; ?> 
							<tr>
								<td><?php  echo $count ; ?></td>
								<td><a href="<?php echo base_url('index.php/land/details/' . $record->plot_no); ?>"><?php echo $record->plot_no; ; ?></a></td>
								
								<td><?php echo ucwords($record->fname .' '. $record->lname .' '. $record->oname) ; ?></td>
								<td><?php echo $record->titles; ?></td>
								<td><?php echo $record->section; ?></td>
								<td><?php echo $record->box .'-'.  $record->box .' '.  $record->town ; ?></td>
								<td><?php echo $record->tel_no; ?></td>
								<td><?php echo $record->date_created; ?></td>
								
							</tr>
							<?php endfor; ?>
						</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		</form>
		
	</div>
