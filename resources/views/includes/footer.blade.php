<!-- Scripts -->	
	


    <div id="chatdata"> </div>





      <div class="container ">
        <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-4 col-xs-12 text-center ">
         <ul class="nav-botm">
           
            <li><a href="{{ url('/pages/privacy-policy') }}" target="_blank">Privacy policy</a></li>
            <li><a href="{{ url('/pages/terms-of-use') }}" target="_blank">Terms of use</a></li>


          </ul>
        
        </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
           <p>Copyright © 2016 Flying Chalks Pte. Ltd. <i> All rights reserved.</i></p>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
            <ul class="social-icon">
              <li><a href="https://www.facebook.com/flyingchalks" target="_blank"><i class="fa fa-facebook fc-custom"></i></a></li>
              <li><a href="https://www.instagram.com/flyingchalks" target="_blank"><i class="fa fa-instagram"></i></a></li>
             <!-- <li><a href="https://www.linkedin.com/company/flying-chalks"><i class="fa fa-linkedin"></i></a></li>-->

            </ul>
          </div>
        </div>
      </div>
   

	<script>		
	$( document ).ready(function() {			
		setTimeout(function(){ 			
			
		$("#custom_success").fadeOut("slow"); 	
		$("#custom_error").fadeOut("slow"); 	
		}, 10000);		
	});	
	</script>
	<script src="{{ asset('/public/js/jquery.validate.js') }}" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
                /*$("#two").mCustomScrollbar({
					
					keyboard:{
						enable:true,
						scrollType:"stepless",
						scrollAmount:"auto"
					}
				});*/
				$('#userlogin').validate();
				$('#usersignup').validate({
						rules: {
							password: "required",
							password_confirmation: {
							  equalTo: "#pwd"
							}
						  }
					
				});
				$('#resetpassword').validate();
				$('#resetform').validate({
						rules: {
							password: "required",
							password_confirmation: {
							  equalTo: "#password"
							}
						  }
					
				});
			});
		</script>
		
		<script>
		$('#message').bind('input propertychange', function() {
				
				var lett=this.value
				var count= lett.length;
				var left=400-count;
				$("#countChar").html(left+" Char Left");
				});
       
			/*#countChar*/
		</script>

<script src="http://www.flyingchalks.com:3000/socket.io/socket.io.js"></script>
<script src="{{ asset('/public/js/socket.js') }}"></script>
<script src="{{ asset('/public/js/chatpopup.js') }}"></script>
	
{!! option('tracking') !!} 
<div class="exchange-notify"></div>
<div class="chatbox-main"></div>

</body>
</html>
