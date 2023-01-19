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
                    <h3 class="panel-title">List of Roles</h3>
                    <ul class="panel-controls">
                       <a href="<?php echo base_url('role/add')?>" type="button" class="btn btn-success"> Add System Role <span class="fa fa-plus"></span></a>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <table class="table datatable">
                        <thead>
                           <tr>
                              
                                <th>#</th>
                                <th>Role</th>
                                <th>Set</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><?php echo $record->Title;?></td>
                                 <td><a href=" <?php echo base_url('role/systemrole/'. $record->id )?>"><i class="btn btn-success"> Set Access Right</i></a></td>
                                                             
                              <td><a href=" <?php echo base_url('role/edit/'. $record->id )?>"><i class="btn btn-info  fa fa-pencil"> Edit</i></a></td>
                               <td><a href=" <?php echo base_url('role/delete/'. $record->id )?>"><i class="btn btn-danger  fa fa-trash-o"> Delete </i></a></td> 
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