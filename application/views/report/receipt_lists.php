<div class="page-content-wrap">


  <script type="text/javascript">

   
         $(function () {
            var chart = Highcharts.chart('container1', { 

                title: {
                    text: 'Bills receipt printed '
                },

                subtitle: {
                    text: '<b>  </b>'
                },
                
                 yAxis: {
                    title: {
                        text: '<b> Total </b>'
                    }

                },
                legend: {
                    //enabled: false
                },
                plotOptions: {
                    series: {
                        cursor: 'pointer',
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        },
                        point: {
                                events: {
                                    click: function () {

                                   // window.location =("<?php echo base_url(); ?>dashboard/servicing_per_day/" + this.x); 
                                      
                                    }
                                }
                            } 
                    },
                     column: {
                       /*  stacking: 'normal', */
                      
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span>: <b>{point.x}</b> <br/><br>',
                    pointFormat: '<span style="color:{point.color}">Total . </span>: <b>{point.y}</b> <br/>'
                },  
                xAxis: {
                     categories: [<?php  for( $i=0; $i<count( $records ); $i++ ) { 
             $record = &$records[$i]; 

                 echo "'". $record->FirstName ."',";
                 
             }?>] 
                },
                 

                series: [{
                    type: 'column',
                    name: 'day',
                    colorByPoint: true,
                    data: [<?php  for( $i=0; $i<count( $records ); $i++ ){
             $record = &$records[$i]; 

                 echo "". $record->total .",";
                 
             }?>],
                    //showInLegend: false
                }]

            });


          

        });
 

   

  </script>
  <script>
        $(function () {
          Highcharts.chart('staff_pie', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
           colors: [ '#3c8dbc','#FF0000','#EFF217','#B0F217','#CA17F2','#AD9FA5'  ],
            title: {
                text: 'Percentage of Bills receipt printed'
            },
            subtitle: {
                    text: ''
                },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                }
            },
            series: [{
                name: 'Pumps',
                colorByPoint: true,
                data: [<?php  for( $i=0; $i<count( $records ); $i++ ) { 
             $record = &$records[$i]; 

            

                   echo "['".$record->FirstName." ',". (int)$record->total ."],"; 
                 
             }?>]
            }]
        });});
</script>
      

           <div class="row">
                        <div class="col-md-6">
                            <!-- START USERS ACTIVITY BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Bills receipt printed from  <?php echo date("d-m-Y", strtotime($date_from)); ?> to  <?php echo date("d-m-Y", strtotime($date_to)); ?></h3>
                                           <span>Staff  vs Bill Total raised</span>
                                    </div>                                    
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>                                    
                                </div>                                
                                <div class="panel-body padding-0">
                                    <div class="chart-holder" id="container1" style="height: 300px;"></div>
                                </div>                                    
                            </div>
                        </div>
                         <div class="col-md-6">
                            
                            <!-- START USERS ACTIVITY BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                         <h3> Percentage of Bill receipt printed from  <?php echo date("d-m-Y", strtotime($date_from)); ?> to  <?php echo date("d-m-Y", strtotime($date_to)); ?></h3>
                                        <span>Staff  vs Bill Total raised</span>
                                    </div>                                    
                                    <ul class="panel-controls" style="margin-top: 2px;">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>                                        
                                            <ul class="dropdown-menu">
                                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                                            </ul>                                        
                                        </li>                                        
                                    </ul>                                    
                                </div>                                
                                <div class="panel-body padding-0">
                                    <div class="chart-holder" id="staff_pie" style="height: 300px;"></div>
                                </div>                                    
                            </div>
                        </div>
                </div>

              

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
                    <h3 class="panel-title">Bills receipt printed Report</h3>
                    <ul class="panel-controls">
                       <a href="<?php echo base_url('report/receipted')?>" type="button" class="btn btn-success"> Query New Report <span class="fa fa-search"></span></a>
                        
                    </ul>                                
                </div>
                <div class="panel-body" style="display: block;overflow-x: auto; white-space: nowrap;">
                    <div class="row">
                    <div class="col-md-4">
                    </div>

                   <div class="col-md-6">
                      <!--  <h3>Department : <?php echo $sub_title; ?></h3> -->
                       <h4>Date From : <?php echo date("d-m-Y", strtotime($date_from)); ?></h4>
                       <h4>Date To : <?php echo date("d-m-Y", strtotime($date_to)); ?></h4>
                    </div>
                  </div>

                    <table class="table datatable">
                        <thead>
                           <tr>
                                <th>#</th>
                                <th>Staff</th>
                                <th> Biller SubCounty</th>
                                <th>Biller Ward</th>
                                <th>Number of Bill</th>
                                <th class="text-right">Total Amount(KES)</th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php $total=0; for( $i=0; $i<count( $records ); $i++ ) : ?>
                              <?php $record = &$records[$i]; ?>
                            <tr>
                                <td><?php echo $i + 1; ?></td>
                                <td><a href=" <?php echo base_url('report/printdetails/'.$record->printed_by."/". $date_from."/".$date_to )?>"><?php echo ucwords(strtolower($record->FirstName ." ".$record->LastName." ".$record->OtherName));?></a></td>
                                <td><?php echo $record->SubCountyName;?></td>
                                <td><?php echo $record->WardName;?></td>
                                <td><?php echo $record->totalNumber;?></td>
                                <td class="text-right"><?php echo number_format($record->total,2);?></td>                                
                             
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