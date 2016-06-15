<header id="myCarousel" class="carousel slide home-header" data-interval="5000" data-ride="carousel">
	<!-- Indicators -->
	<!-- <ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol> -->
	<div class="top-bar">
	  <div clas="row">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
		<a href="{{ url('/') }}"><img src="{{ asset('/public/img/newlogo.png') }}"></a>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
		
			@if (Auth::guest())
				<ul class="pull-right">
				  <!--<li class="h-about"><a href="#ourmisiionsec">About</a></li>-->
				  <li><a href="{{ url('/connect') }}">Connect</a></li>
				   <li><a href="{{ url('/university') }}">Univ. Guides</a></li>
				  <li><a href="{{ url('/auth/register') }}">Sign Up</a></li>
				  <li><a href="{{ url('/auth/login') }}">Log In</a></li>
				</ul>
			@else 	
			<ul class="pull-right loginul">
		     
			 <li><a href="{{ url('/connect') }}">Connect</a></li>
			 <li><a href="{{ url('/university') }}">Univ. Guides</a></li>
			 
		  	 <li class="">
		  	 	<div class="btn-group user-profile-open">
				    <a class="btn dropdown-toggle" id="user-profile-menu" data-toggle="dropdown" href="{{ url('/friendslist') }}">
				        <div style="position:relative;">
				      <?php 
				      	if(Auth::user()->avatar!=''){ 
							if((strpos(Auth::user()->avatar,'http://')!== false || strpos(Auth::user()->avatar,'https://')!== false)) {
						?>
								<img src="<?php echo str_replace('=normal','=large&width=200&height=200',Auth::user()->avatar) ?> ">
						<?php	
						}else { 
						?>
								<img src="{{ asset('/public/img/memberImages/')}}/{{ Auth::user()->avatar }}">
						<?php	} 
						}else{ 
						?>
						<img src="{{ asset('public/img/dummy-head.png') }}"  >
						<?php } ?>
						<sup id="message_notify" class="msg1" style="display:none;"></sup>
						{{ Auth::user()->fname }}
				      <!-- <img src="http://www.flyingchalks.com/dev/public/img/dummy.jpg"> -->
				      <!-- <sup id="message_notify"></sup> -->
				    </div>
				    </a>
				    <ul class="dropdown-menu down-12" style="background-color:rgba(0, 0, 0,0.6)">
				    <div class="arrow-up"></div>
				    <!-- class="{{ Request::segment(1) === 'home' || Request::segment(1) === 'edit-profile' ? 'active' : null }}" -->
				    <li ><a href="{{ url('/home') }}"><i class="fa fa-user" aria-hidden="true" style="margin-right: 12px;"></i><!--<img class="ml5" src="http://www.flyingchalks.com/dev/public/img/profile-icon.png">-->Profile</a></li>
				      <li><a href="#add-user-dialog" onclick="frnd_show_hide()" role="button" data-toggle="modal">
				        <i class="fa fa-comments-o" aria-hidden="true" style="margin-right: 5px;"></i>
				<!-- <img class="" src="http://www.flyingchalks.com/dev/public/img/chat-icon.png">--> Chat<span id="message_count"></span></a></li>
				      <!--<li><a href="#"><i aria-hidden="true" class="fa fa-envelope-o m1"></i>Messages<span id="message_count"></span></a></li>-->
				      <!---<li><a href="#"><i aria-hidden="true" class="fa fa-question-circle-o pr2"></i>Contact us</a></li>-->


				      <li class="logout"><a href="javascript:void(0);" onclick="logout();"><i aria-hidden="true" class="fa fa-sign-out m2" style="margin-right: 10px;"></i>Log Out</a></li>
				    </ul>
				  </div>


		  	 </li>
		  

			@endif
		</ul>
		</div>
	  </div>
	</div><!-- end .top-bar -->
	
	<!-- Wrapper for Slides -->
	<div class="carousel-inner">
		<div class="item active">
			<!-- Set the first background image using inline CSS below. -->
			<div class="fill" style="background-image:url('{{ asset('/public/img/img1132.jpg') }}');"></div>
			
		</div>
		<div class="item">
			<!-- Set the second background image using inline CSS below. -->
			<div class="fill" style="background-image:url('{{ asset('/public/img/img1122.jpg') }}');"></div>
			<!--<div class="carousel-caption">
				<h2>GOING FOR OVERSEAS STUDIES?</h2>
				<span>We have more than <u><b>{{App\User::getTotalUsers()}}</b></u>  students who are going or have returned.</span>
				<a href="{{ url('/connect') }}">Connect with  Students Now</a>
			</div>-->
		</div>
		<div class="item">
			<!-- Set the third background image using inline CSS below. banner3-->
			<div class="fill" style="background-image:url('{{ asset('/public/img/img1112.jpg') }}');"></div>
			<!--<div class="carousel-caption">
				<h2>GOING FOR OVERSEAS STUDIES?</h2>
				<span>We have more than <u><b>{{App\User::getTotalUsers()}}</b></u>  students who are going or have returned.</span>
				<a href="{{ url('/connect') }}">Connect with  Students Now</a>
			</div>-->
		</div>
		<div class="carousel-caption">
				<h2>GOING FOR OVERSEAS STUDIES?</h2>
				<span>We have more than <u><b>{{App\User::getTotalUsers()}}</b></u> students who are going or have returned.</span>
				<a href="{{ url('/connect') }}">Connect with  Students Now</a>
			</div>
	</div>
 


	<!-- Controls -->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"><img src="{{ asset('/public/img/left-arw.png') }}"></span>
	</a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next">
		<span class="icon-next"><img src="{{ asset('/public/img/right-arw.png') }}"></span>
	</a>
	
<?php //print_r($universities); exit;?> 
	<div class="header-bottom">
   <div class="dropdown">
		  <button class="btn btn-primary dropdown-toggle extra" type="button" data-toggle="dropdown">Check Out our <strong>University Guides</strong>!
		 <!--  <span class="caret"></span> --></button>
		  <ul class="dropdown-menu">
			@foreach($universities as $university)
				<li><a href="{{url('/university-detail')}}/{{$university->id}}/university">{{$university->universityName}}</a></li>
			@endforeach
		
			
		  </ul>
		</div>
	</div>

</header>
<style>
.msg1{
	left:29px;
	top: -4px;
}
.down-12 span{
	right:20px;
}
</style>