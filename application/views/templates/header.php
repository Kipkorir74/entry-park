<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- META SECTION -->
        <title><?php echo $title?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="" type="image/x-icon" />
        <!-- END META SECTION -->
         <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
          <script src="<?php echo base_url()?>assets/Highcharts/js/highcharts.js"></script>
         <script src="<?php echo base_url()?>assets/Highcharts/js/highcharts-3d.js"></script>
         <script src="<?php echo base_url()?>assets/Highcharts/js/modules/exporting.js"></script> 
          <link href="<?php echo base_url()?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/js/select2/select2.min.css">
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>css/theme-default.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url()?>assets/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url()?>assets/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>assets/css/import.css"/>
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="<?php echo base_url('dashboard')?>">Voting System</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>

                <li class="xn-profile">
                        <a href="#" class="profile-mini">
                           <img src="<?php echo base_url(); ?>img/logo.jpg" alt="<?php echo ucwords(strtolower( $this->session->userdata('first_name') ." ". $this->session->userdata('lname')));  ?>"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="<?php echo base_url(); ?>img/logo.jpg" alt="<?php echo ucwords(strtolower( $this->session->userdata('first_name') ." ". $this->session->userdata('lname')));  ?>"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><b>Hi, <?php echo ucwords(strtolower( $this->session->userdata('first_name') ." ". $this->session->userdata('lname')));  ?> </b></div>
                                <div class="profile-data-title">Voting System</div>
                            </div>
                            <div class="profile-controls">
                                <a href="#" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="#" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>                                                                        
                    </li>

                  
                   <?php if($this->session->userdata('Dashboard')==1) { ?> 
                    
                    <li  <?php echo ($page=='Home')? " class='active'":''?>>
                        <a href="<?php echo base_url('dashboard')?>"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>                        
                    </li> 
                <?php } ?>

                   <?php if($this->session->userdata('VotingCast')==1) { ?> 
                    
                    <li  <?php echo ($page=='Voting')? " class='active'":''?>>
                        <a href="<?php echo base_url('casted')?>"><span class="fa fa-archive"></span> <span class="xn-text">Enter Votes</span></a>                        
                    </li> 
                <?php } ?>

                 <?php 
                   if($this->session->userdata('Reports')==1){ ?>


                     <li <?php echo ($page=='Votes')? " class='xn-openable active'":'class="xn-openable"'?>>
                    
                        <a href="#"><span class="fa fa-user"></span> <span class="xn-text">Votes</span></a>
                        <ul>
                             <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('vote')?>"
                                ><span class="fa fa-mail-forward"></span>President</a></li>
                             <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('vote/governor')?>"
                                ><span class="fa fa-mail-forward"></span> Governor </a></li>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('vote/senator')?>"
                                ><span class="fa fa-mail-forward"></span>Senator</a></li>

                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('vote/mp')?>"
                                ><span class="fa fa-mail-forward"></span>Mp</a></li>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('vote/mca')?>"
                                ><span class="fa fa-mail-forward"></span>MCA</a></li>   
                            
                           

                        </ul>
                    </li>
                     <?php } ?>



                 <?php 
                  if($this->session->userdata('Aspirant')==1){ ?>


                     <li <?php echo ($page=='Aspirant')? " class='xn-openable active'":'class="xn-openable"'?>>
                    
                        <a href="#"><span class="fa fa-user"></span> <span class="xn-text">Aspirants</span></a>
                        <ul>
                             <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('aspirant')?>"
                                ><span class="fa fa-mail-forward"></span>President</a></li>
                             <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('aspirant/governor')?>"
                                ><span class="fa fa-mail-forward"></span> Governor </a></li>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('aspirant/senator')?>"
                                ><span class="fa fa-mail-forward"></span>Senator</a></li>

                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('aspirant/mp')?>"
                                ><span class="fa fa-mail-forward"></span>Mp</a></li>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('aspirant/mca')?>"
                                ><span class="fa fa-mail-forward"></span>MCA</a></li>   
                            
                           

                        </ul>
                    </li>
                     <?php } ?>


                
                     
                     <?php 
                          if($this->session->userdata('Party')==1){ ?>


                     <li <?php echo ($page=='Party')? " class='xn-openable active'":'class="xn-openable"'?>>
                    
                        <a href="#"><span class="fa fa-group"></span> <span class="xn-text">Party</span></a>
                        <ul>
                             <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('party')?>"
                                ><span class="fa fa-mail-forward"></span> List </a></li>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('party/add')?>"
                                ><span class="fa fa-mail-forward"></span>Add Party</a></li>

                           
                           

                        </ul>
                    </li> 
                     <?php  } ?>




         <?php 
                          if($this->session->userdata('SystemUser')==1){ ?>
                    <li <?php echo ($page=='User')? " class='xn-openable active'":'class="xn-openable"'?>>
                    
                        <a href="#"><span class="fa fa-users"></span> <span class="xn-text">System Users</span></a>
                        <ul>
                            <li <?php echo ($sub_title=='lists')? " class='active'":''?>><a href="<?php echo base_url('user')?>"><span class="fa fa-mail-forward"></span> List System Users</a></li>
                            <li <?php echo ($sub_title=='Add')? " class='active'":''?>><a href="<?php echo base_url('user/add')?>"
                                ><span class="fa fa-mail-forward"></span> Add System Users</a></li>
                             <?php 
                          if($this->session->userdata('SetRole')==1){ ?>
                            <li <?php echo ($sub_title=='Add')? " class='active'":''?>><a href="<?php echo base_url('role')?>"
                                ><span class="fa fa-mail-forward"></span> Role </a></li>
                                 <?php } ?>
                        </ul>
                    </li>
                     <?php } ?>
               




    
                   
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
                    </li> 
                    <!-- END SIGN OUT -->
                    <!-- MESSAGES -->
                   
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                                           
                    </li>
                    <!-- END TASKS -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                     

                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#"><?php echo $page ?></a></li>                    
                    <li class="active"><?php echo $sub_title ?></li>
                </ul>