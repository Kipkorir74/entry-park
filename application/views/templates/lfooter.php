
   <footer class="landing-footer">
            <div class="container">

                <!-- <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="mb-4 mb-lg-0">
                            <h5 class="mb-3 footer-list-title">Company</h5>
                            <ul class="list-unstyled footer-list-menu">
                                <li><a href="javascript: void(0);">About Us</a></li>
                                <li><a href="javascript: void(0);">Features</a></li>
                                <li><a href="javascript: void(0);">Team</a></li>
                                <li><a href="javascript: void(0);">News</a></li>
                                <li><a href="javascript: void(0);">FAQs</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="mb-4 mb-lg-0">
                            <h5 class="mb-3 footer-list-title">Resources</h5>
                            <ul class="list-unstyled footer-list-menu">
                                <li><a href="javascript: void(0);">Whitepaper</a></li>
                                <li><a href="javascript: void(0);">Token sales</a></li>
                                <li><a href="javascript: void(0);">Privacy Policy</a></li>
                                <li><a href="javascript: void(0);">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="mb-4 mb-lg-0">
                            <h5 class="mb-3 footer-list-title">Links</h5>
                            <ul class="list-unstyled footer-list-menu">
                                <li><a href="javascript: void(0);">Tokens</a></li>
                                <li><a href="javascript: void(0);">Roadmap</a></li>
                                <li><a href="javascript: void(0);">FAQs</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-sm-6">
                        <div class="mb-4 mb-lg-0">
                            <h5 class="mb-3 footer-list-title">Latest News</h5>
                            <div class="blog-post">
                                <a href="javascript: void(0);" class="post">
                                    <div class="badge badge-soft-success font-size-11 mb-3">Cryptocurrency</div>
                                    <h5 class="post-title">Donec pede justo aliquet nec</h5>
                                    <p class="mb-0"><i class="bx bx-calendar me-1"></i> 04 Mar, 2020</p>
                                </a>
                                <a href="javascript: void(0);" class="post">
                                    <div class="badge badge-soft-success font-size-11 mb-3">Cryptocurrency</div>
                                    <h5 class="post-title">In turpis, Pellentesque</h5>
                                    <p class="mb-0"><i class="bx bx-calendar me-1"></i> 12 Mar, 2020</p>
                                </a>

                            </div>
                        </div>
                    </div>
                </div> -->
                <!-- end row -->

                <hr class="footer-border my-5">

                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-4">
                            <!-- <img src="assets/images/logo-light.png" alt="" height="20"> -->
                        </div>
    
                        <p class="mb-2"><script>document.write(new Date().getFullYear())</script> © Nouveta</p>
                        <p>Maasai Mara is The World Cup of Wildlife viewing. One of the TOP safari destinations in Africa.</p>
                    </div>

                </div>
            </div>
            <!-- end container -->
        </footer>
        <!-- Footer end -->

        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>

        <script src="<?php echo base_url();?>assets/libs/jquery.easing/jquery.easing.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/select2/js/select2.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>

        <!-- Plugins js-->
        <script src="<?php echo base_url();?>assets/libs/jquery-countdown/jquery.countdown.min.js"></script>

        <!-- owl.carousel js -->
        <script src="<?php echo base_url();?>assets/libs/owl.carousel/owl.carousel.min.js"></script>

        <!-- ICO landing init -->
        <script src="<?php echo base_url();?>assets/js/pages/ico-landing.init.js"></script>
          <!-- jquery step -->
        <script src="<?php echo base_url();?>assets/libs/jquery-steps/build/jquery.steps.min.js"></script>

        <!-- dropzone js -->
        <script src="<?php echo base_url();?>assets/libs/dropzone/min/dropzone.min.js"></script>

        <!-- init js -->
        <script src="<?php echo base_url();?>assets/js/pages/crypto-kyc-app.init.js"></script>



      
       
     
       

        

        <!-- form advanced init -->
        <script src="<?php echo base_url();?>assets/js/pages/form-advanced.init.js"></script>

        <script src="<?php echo base_url();?>assets/js/app.js"></script>
          <script>
        jQuery(document).ready(function() {
    
        "use strict";
         $('#loader').hide();

        jQuery("#BillType").change(function(){ 

          $('#loader').show();
           var BillType = $("#BillType").val();  

            

            $.ajax({
             url: '<?php echo base_url(); ?>home/getamount',
             type: 'POST',
             dataType: 'json',
             cache: false,
             data: {'BillType':BillType},           
           success: function(data) {
              $('#loader').hide();
                $('#Charge').val(data);
              
           },
           error: function(err) {
               console.log(err)
           }
         });
         });
          });

        </script>
         <script>
        jQuery(document).ready(function() {
    
        "use strict";
         $('#loader').hide();

        jQuery("#BillType2").change(function(){ 

          $('#loader').show();
           var BillType = $("#BillType2").val();  

            

            $.ajax({
             url: '<?php echo base_url(); ?>home/getamount',
             type: 'POST',
             dataType: 'json',
             cache: false,
             data: {'BillType':BillType},           
           success: function(data) {
              $('#loader').hide();
                $('#Charge2').val(data);
              
           },
           error: function(err) {
               console.log(err)
           }
         });
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
                  console.log(data.responsedata.BillNo);
                  $('#BillNoV').html(data.responsedata.BillNo);
                  $('#BillNoP').val(data.responsedata.BillNo);
                  $('#PaymentAccV').html(data.responsedata.PaymentCode );
                  $('#PaymentCodeV').html(data.responsedata.PaymentCode );
                  $('#billingAmount').val(data.responsedata.ReducingBalance);
                  $('#BillTotalV').html(data.responsedata.ReducingBalance);

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



       


    </body>


</html>