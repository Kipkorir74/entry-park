<div class="page-content-wrap">
<div class="row">
    <?php if( $this->session->flashdata('error') != "" ) : ?>
                       <div class="row"><div class="col-xs-12"><div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div></div></div>
                    <?php endif; ?>
                    <?php if( $this->session->flashdata('success') != "" ) : ?>
                       <div class="row"><div class="col-xs-12"><div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div></div></div>
                    <?php endif; ?>
</div>                
                
    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">                                
                    <h3 class="panel-title">System Users</h3>
                    <ul class="panel-controls">
                       <a href="<?php echo base_url('user/add')?>" type="button" class="btn btn-success">Add System User <span class="fa fa-plus"></span></a>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <table class="table datatable">
                        <thead>
                           <tr>
                              
                                <th>#</th>
                               <!--  <th>Role</th> -->
                                <th>Edit</th>
                                <th>Action</th>
                                <th>Date Created</th>
                                <th>Name</th>
                                <th>Id Number</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>role</th>
                             
                                <th>County</th>
                                <th>Constituency</th>
                                <th>Ward</th>

                                 <th>Status</th>
                              
                            
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                 <!-- <td><a href=" <?php echo base_url('user/systemrole/'. $record->UserID )?>"><i class="btn btn-info fa fa-lock"> Set Role</a></td> -->
                                <td><a href=" <?php echo base_url('user/edit/'. $record->UserID )?>"><i class="btn btn-info fa fa-pencil"></a></td>

                                <td><?php   if($record->Status == 1) {   ?>
                                    <a href=" <?php echo base_url('user/delete/'. $record->UserID )?>"><i class="btn btn-danger fa fa-trash-o">&nbsp;Deactivate</i> </a>
                                    <?php } if($record->Status == 0){?>
                                    <a href=" <?php echo base_url('user/activate/'. $record->UserID )?>"><i class="btn btn-success fa fa-check-circle-o">&nbsp;Activate</i></a>

                                    <?php }?></td>
                                <td><?php echo $record->DateCreated;?></td>
                                <td><?php echo ucfirst(strtolower($record->FirstName ." ". $record->LastName ." ". $record->OtherName));?></td>
                                 <td><?php echo  $record->Idnumber ;?></td>
                                <td><?php echo $record->Email;?></td>
                                <td><?php echo $record->PhoneNumber;?></td>
                                <td><?php echo $record->role;?></td>
                                <td><?php echo $record->CountyName;?></td>
                                <td><?php echo $record->ConstituencyName;?></td>
                                <td><?php echo $record->WardName;?></td>
                                <td><?php if($record->Status == 1)
                                { echo 'Active';}
                                else if($record->Status == 0){
                                    echo "Inactive";}
                                    ?></td>
                               
                              </tr>
                            <?php endfor; ?>
                            </tbody>
                            
                          </table>
                     </div>
                   </div>
                            <!-- END DEFAULT DATATABLE -->
             </div>
 </div>
</div>
</div>