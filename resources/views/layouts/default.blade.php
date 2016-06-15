<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
		
  </head>
  <body onresize="calculate_popups()">
 <div class="alert alert-danger response-msg" style="text-align: center;" id="custom_error_client"></div>
  <div class="alert alert-success response-msg" style="text-align: center;" id="custom_success_client"></div>
  
  @if (Session::has('custom_error') )
	<div class="alert alert-danger response-msg" style="text-align: center;display:block;" id="custom_error_client">
		{{ session('custom_error') }}
			{{Session::forget('custom_error')}}
	</div>
	@endif	
	@if (Session::has('custom_success'))
			<div class="alert alert-success response-msg" style="text-align: center;display:block;" id="custom_success_client">
				{{ session('custom_success') }}
			</div>
			{{Session::forget('custom_success')}}
	@endif	

	<?php if(@$routeController == 'HomeController' && @$routeAction == 'index') {?>	
		@include('includes.carausalheader')
	<?php }else{ ?>
		@include('includes.internalheader')
	<?php } ?>
		@yield('content')
            
	<div class="footer-bottom padding-less">
		@include('includes.footer')
	</div>
