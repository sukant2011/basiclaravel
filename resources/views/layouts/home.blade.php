<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  </head>
  <body>
  <div class="alert alert-danger response-msg" style="text-align: center;" id="custom_error_client"></div>
  <div class="alert alert-success response-msg" style="text-align: center;" id="custom_success_client"></div>
 
  @if (Session::has('custom_error') )
	<div class="alert alert-danger response-msg" style="text-align: center;" id="custom_error">
		{{ session('custom_error') }}
			{{Session::forget('custom_error')}}
	</div>
	@endif	
	@if (Session::has('custom_success'))
			<div class="alert alert-success response-msg" style="text-align: center;" id="custom_success">
				{{ session('custom_success') }}
			</div>
			{{Session::forget('custom_success')}}
	@endif	
	Coming Soon
	<?php /*@include('includes.carausalheader')

	@yield('content')
            
	<div class="footer-bottom padding-less">
		@include('includes.footer')
	</div>
*/?>