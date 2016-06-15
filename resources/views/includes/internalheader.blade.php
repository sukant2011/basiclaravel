<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

<style type="text/css">

.outer-inner-Pageheader{ width:100%; float:left; min-height:75px;}
.outer-inner-Pageheader .inner-Pageheader{ background:#ffffff; min-height:75px}
.outer-inner-Pageheader .affix{ z-index:9999;}
.gap{ width: 100%; float: left; min-height:78px;}
.user-profile-open > #user-profile-menu:focus {    color: #212121;}



</style>

<?php if(@$_GET['from']=='email' && Auth::user()){ ?>
<script>
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ) {
	window.location.href = ajax_url+'friendslist';
}
</script>
<?php } ?>
<div class="gap gap-cms">
<div class="outer-inner-Pageheader" >
<div class="inner-Pageheader" data-spy="affix">
  <div class="arrow-down"><img src="{{ asset('/public/img/dwn-arw.png') }}"></div>	
  <div clas="row" >
	
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-2 inner-logo">
		<a href="{{ url('/') }}"><img src="{{ asset('/public/img/inner_logo.png') }}"></a>
		
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9 col-xs-10 paddingTop15px">
		<ul class="pull-right drop-logo">
			
			<li class="{{ Request::segment(1) === 'connect' ? 'active' : null }}"><a href="{{ url('/connect') }}">Connect</a></li>
			  <li class="{{ Request::segment(1) === 'university' ? 'active' : null }}{{ Request::segment(1) === 'university-detail' ? 'active' : null }}"> <a href="{{ url('/university') }}">Univ. Guides</a></li>
			@if (Auth::guest())
				
				
				<li class="{{ Request::segment(2) === 'register' ? 'active' : null }}"><a href="{{ url('/auth/register') }}">Sign Up</a></li>
				<li class="{{ Request::segment(2) === 'login' ? 'active' : null }}"><a href="{{ url('/auth/login') }}">Log In</a></li>
			@else
			
				<!-- <li class=""><a href="{{ url('/friendslist') }}">{{ Auth::user()->fname.' '.Auth::user()->lname }} </a></li> 
				-->
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
    <ul class="dropdown-menu down-12">
    <div class="arrow-up"></div>
    <!-- class="{{ Request::segment(1) === 'home' || Request::segment(1) === 'edit-profile' ? 'active' : null }}" -->
    <li ><a href="{{ url('/home') }}"><i class="fa fa-user" aria-hidden="true"></i><!--<img class="ml5" src="http://www.flyingchalks.com/dev/public/img/profile-icon.png">-->Profile</a></li>
      <li><a href="#add-user-dialog" onclick="frnd_show_hide()" role="button" data-toggle="modal">
        <i class="fa fa-comments-o" aria-hidden="true"></i>
<!-- <img class="" src="http://www.flyingchalks.com/dev/public/img/chat-icon.png">--> Chat<span id="message_count"></span></a></li>
      <!--<li><a href="#"><i aria-hidden="true" class="fa fa-envelope-o m1"></i>Messages<span id="message_count"></span></a></li>-->
      <!---<li><a href="#"><i aria-hidden="true" class="fa fa-question-circle-o pr2"></i>Contact us</a></li>-->


      <li class="logout"><a href="javascript:void(0);" onclick="logout();"><i aria-hidden="true" class="fa fa-sign-out m2"></i>Log Out</a></li>
    </ul>
  </div>
  </li>
				

				

				


				
				
			@endif

		</ul>
		</div>
	
  </div>
</div>
</div>
</div>
<!-- end .top-bar -->