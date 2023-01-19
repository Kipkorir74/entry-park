   </div>
        </div> 

 <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> </div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="<?php echo base_url('login/log_out');?>" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="<?php echo base_url();?>assets/audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="<?php echo base_url();?>assets/audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                  
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

            <script type="text/javascript">
                                            $(document).ready(function() {
                                                $("input[name$='iradio']").click(function() {
                                                    var test = $(this).val();
                                                    $("div.desc").hide();
                                                    $("#Iradio" + test).show();
                                                });
                                            });
                                         </script>
        
       
      <script>
  $(function () {

    $(".select2").select2();
    /*$(".select1").select1();*/
  
  });
</script>
<script>

  $(".dt-buttons buttons-csv").hide()

</script>
<script src="<?php echo base_url();?>assets/js/select2/select2.full.min.js"></script>

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/icheck/icheck.min.js'></script>      
       
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!--  <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/dropzone/dropzone.min.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/smartwizard/jquery.smartWizard-2.0.min.js"></script>        
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery-validation/jquery.validate.js"></script>
        <!-- END PAGE PLUGINS -->
        
        <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/morris/raphael-min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/morris/morris.min.js"></script>   -->     
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/rickshaw/d3.v3.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/rickshaw/rickshaw.min.js"></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>                
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-datepicker.js'></script> 
         <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-timepicker.min.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-colorpicker.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-file-input.js"></script> 
          <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-file-input.js"></script> -->
         <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-select.js"></script>
          <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>                 
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/owl/owl.carousel.min.js"></script>               
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- END THIS PAGE PLUGINS-->        
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> 
      <?php  if($this->session->userdata('reportsubcounty')==1){ ?> 
      <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>   
    <?php } ?>
        <!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>  -->
       <!--  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>  
        <!-- START TEMPLATE -->
       <!-- <script type="text/javascript" src="<?php echo base_url();?>assets/js/settings.js"></script>-->
       <!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/summernote/summernote.js"></script>-->
        
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins.js"></script>        
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/actions.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/faq.js"></script>
      

         <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#SubCountyId").change(function(){ 
          $('#WardId').prop('disabled', true); 
            $('#loader1').show();

             jQuery.ajax({url:"<?php echo base_url(); ?>user/get_ward/"+$(this).val(), success:function(result){
            jQuery("#models_options").html(result);
            var newOptions = JSON.parse(result); 
            var $select = $("#WardId");
            $select.empty(); 
            $.each( newOptions, function( value, key ) {
               $('#WardId').prop('disabled', false);
           
                $('#loader1').hide();
              $select.append($("<option></option>").attr( "value", value ).text(key));
            });           
          }});
        });
          });
        </script>
         <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#CountyId").change(function(){ 
          $('#SubCountyId').prop('disabled', true); 
            $('#loader1').show();

             jQuery.ajax({url:"<?php echo base_url(); ?>user/getsubcountys/"+$(this).val(), success:function(result){
            jQuery("#models_options").html(result);
            var newOptions = JSON.parse(result); 
            var $select = $("#SubCountyId");
            $select.empty(); 
            $.each( newOptions, function( value, key ) {
               $('#SubCountyId').prop('disabled', false);
           
                                $('#loader1').hide();
              $select.append($("<option></option>").attr( "value", value ).text(key));
            });           
          }});
        });
          });
        </script>

          <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#SubCountyIdA").change(function(){ 
          $('#WardId').prop('disabled', true); 
            $('#loader1').show();

             jQuery.ajax({url:"<?php echo base_url(); ?>login/get_ward/"+$(this).val(), success:function(result){
            jQuery("#models_options").html(result);
            var newOptions = JSON.parse(result); 
            var $select = $("#WardId");
            $select.empty(); 
            $.each( newOptions, function( value, key ) {
               $('#WardId').prop('disabled', false);
           
                $('#loader1').hide();
              $select.append($("<option></option>").attr( "value", value ).text(key));
            });           
          }});
        });
          });
        </script>

      <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#WardId").change(function(){ 
          $('#PollingCenterId').prop('disabled', true); 
            $('#loader1').show();

             jQuery.ajax({url:"<?php echo base_url(); ?>login/polling/"+$(this).val(), success:function(result){
            jQuery("#models_options").html(result);
            var newOptions = JSON.parse(result); 
            var $select = $("#PollingCenterId");
            $select.empty(); 
            $.each( newOptions, function( value, key ) {
               $('#PollingCenterId').prop('disabled', false);
           
                $('#loader1').hide();
              $select.append($("<option></option>").attr( "value", value ).text(key));
            });           
          }});
        });
          });
        </script>

        <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#PollingCenterId").change(function(){ 
          $('#PollingStream').prop('disabled', true); 
            $('#loader1').show();
                    var WardId = $("#WardId").val(); 
                    var PollingCenterId = $("#PollingCenterId").val();   
                      var path ="<?php echo base_url(); ?>login/Stream/" + $("#WardId").val() +"/"+ $("#PollingCenterId").val();
                      jQuery.ajax({
                          url: path,
                          dataType: 'json',
                          success: function(result) {
                              var newOptions = result;
                            
                              var $select = $("#PollingStream");
                           
                              $select.empty();
                              $.each(newOptions, function(value, key) {
                                $('#PollingStream').prop('disabled', false);
           
                                $('#loader').hide();
                            
                                  $select.append($("<option></option>").attr("value", value).text(key));
                              });
                          }
                      });
                  });
              });            
                
  </script> 





         <script>
        jQuery(document).ready(function() {
        "use strict";
         $('#loader1').hide();
        jQuery("#CountyIdA").change(function(){ 
          $('#SubCountyIdA').prop('disabled', true); 
            $('#loader1').show();

             jQuery.ajax({url:"<?php echo base_url(); ?>login/getsubcountys/"+$(this).val(), success:function(result){
            jQuery("#models_options").html(result);
            var newOptions = JSON.parse(result); 
            var $select = $("#SubCountyIdA");
            $select.empty(); 
            $.each( newOptions, function( value, key ) {
               $('#SubCountyIdA').prop('disabled', false);
           
                                $('#loader1').hide();
              $select.append($("<option></option>").attr( "value", value ).text(key));
            });           
          }});
        });
          });
        </script>
   
      
       
 
 <script type="text/javascript">
       
$(document).ready(function(){ //Make script DOM ready
    
     $('#registerForm').submit(function(event){
        event.preventDefault();
        var proceed = true;

        if($('#FirstName').val() === "")
        {
          $('#FirstName').css('border-color', 'red');      
          $('.FirstName').html('Kindly enter the First Name.').css("color", "red").show(); 
          proceed = false;
        }
         if($('#LastName').val() === "")
        {
          $('#LastName').css('border-color', 'red');      
          $('.LastName').html('Kindly enter the Last Name.').css("color", "red").show(); 
          proceed = false;
        }
         if($('#EmailAddress').val() === "")
        {
          $('#EmailAddress').css('border-color', 'red');      
          $('.EmailAddress').html('Kindly enter the Email Address.').css("color", "red").show(); 
          proceed = false;
        }
        if($('#Telephone').val() === "")
        {
          $('#Telephone').css('border-color', 'red');      
          $('.Telephone').html('Kindly enter the Date Mobile').css("color", "red").show(); 
          proceed = false;
        }
         if($('#Countyid').val() === "")
        {
          $('#Countyid').css('border-color', 'red');      
          $('.Countyid').html('Kindly select the County.').css("color", "red").show(); 
          proceed = false;
        }
         if($('#SubCountyId').val() === "")
        {
          $('#SubCountyId').css('border-color', 'red');      
          $('.SubCountyId').html('Kindly select the SubCounty.').css("color", "red").show(); 
          proceed = false;
        }
        if($('#WardId').val() === "")
        {
          $('#WardId').css('border-color', 'red');      
          $('.WardId').html('Kindly select the Ward.').css("color", "red").show(); 
          proceed = false;
        }
        if($('#RoleId').val() === "")
        {
          $('#RoleId').css('border-color', 'red');      
          $('.RoleId').html('Kindly select  Register as what.').css("color", "red").show(); 
          proceed = false;
        }
        






        if(proceed === true)
        {

        $.ajaxSetup({ header:$('meta[name="_token"]').attr('content') });
        
        $.ajax({
          type:"POST",
          //enctype:"multipart/form-data",
          url:$(this).attr('action'),
          //data:$(this).serialize(),
           processData: false,
          contentType: false,
          async: false,
          cache: false,
          data:  new FormData(this),
          dataType:'json',
          success: function(result){
            console.log(result)

              if(result.status=="ERROR"){
              
                $("#message1").hide().html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+result.success+'</div>').slideDown();
                //$("#message").html(result.success);
              }else{
                
               $('#registerForm')[0].reset();
                 $("#documents, #Countyid").val("")

                 $('#Countyid').val("");//$('#jenis').prop('selectedIndex', 0);
              
              

                $("#message1").hide().html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> '+result.success+'</div>').slideDown();
                }
              
            },
          error: function(result){console.log(result)}
           });
      }else{
           
            $("create-message").slideUp();

      }
      });

 });



</script>
  <script type="text/javascript">    
    
    $(document).ready(function() {

     $('#bill_id').submit(function(event){
        event.preventDefault();
        var proceed = true;
    
         if($('#SessionKey').val() === "")
        {
          $('#SessionKey').css('border-color', 'red');      
          $('.SessionKey').html('Kindly enter the SessionKey.').css("color", "red").show(); 
          proceed = false;
        }
         if($('#UserID').val() === "")
        {
          $('#UserID').css('border-color', 'red');      
          $('.UserID').html('Kindly enter the UserID.').css("color", "red").show(); 
          proceed = false;
        }

        alert 'hi';
    
        if(proceed === true)
        {
        $('#checkout').prop('disabled', true);
         this.value = $('#checkout').val('Waiting For generation BillNumber.......');
      
         
        $.ajax({
        url : "<?php echo base_url(); ?>home/generate" ,
        type: "POST",
        url:$(this).attr('action'), data:$(this).serialize(), dataType:'json',
        cache: false,

        success: function(data)
        {

        try{
                 /* $('#BillNoV').html(data.responsedata.BillNo);
                  $('#PaymentAccV').html(data.responsedata.PaymentCode );
                  $('#PaymentCodeV').html(data.responsedata.PaymentCode );
                  $('#CustomerV').html(data.responsedata.Customer);*/
                  $('#myModal').modal('toggle');
                  $('#billgenerated').modal('show');

          }
       catch(err){

           window.location ="<?php echo base_url(); ?>home";



          }
                  

                 
            //checkagain(pay_id,recheck_count);
                   
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          //$("#checkout").value = 'Fold it'; 
           
          this.value = $('#checkout').val('Try to Regenerate Bill');
          $('#checkout').prop('disabled', false);
            $("#message").hide().html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Error occurs while creating bill. Try again </div>').slideDown();


        }

       
    }); 
     }else{
           
            $("create-message").slideUp();

      }

});

});
</script>





 

 

   
      

        
        <script type="text/javascript" src="<?php echo base_url();?>public/myapp.js"></script>
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>






