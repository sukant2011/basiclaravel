@extends('layouts.default')
@section('content')


<div class="profile-details">
  <div class="container">
	  <div class="profile-innerd">
		<div class="row">
		  <div class="col-lg-4 pro-left">
			 <h2><u>General Profile</u></h2>
			  	
				  <div class="pro-img" id="uploadImage" data-rel="{{Auth::user()->id}}">
					<?php if(Auth::user()->avatar!=''){ 
					
							if((strpos(Auth::user()->avatar,'http://')!== false || strpos(Auth::user()->avatar,'https://')!== false)) {
					?>
							<img src="<?php echo str_replace('=normal','=large&width=200&height=200',Auth::user()->avatar) ?> "   class="profileImg">
					<?php	}else { ?>
					
								<img src="{{ asset('/public/img/memberImages/')}}/{{ Auth::user()->avatar }}"   class="profileImg">
					<?php	} 
					}else{ ?>
						<img src="{{ asset('/public/img/Flying_profile.png') }}"  >
					<?php } ?>
					
				  </div>
				
			 
			   <div class="social-icon-pro">
				  <ul>
				  	<?php if(Auth::user()->provider_id!=''){ ?>
						<li class="facebook-pro"><a href="javascript:void(0);"><i class="fa fa-facebook"></i>Connected</a></li>
					<?php }else{ ?>
						<li class="facebook-pro"><a href="{!!URL::to('login/facebook')!!}"><i class="fa fa-facebook"></i>Sync with Facebook</a></li>
					<?php } ?>
				  </ul>
			  </div>
		  </div>
		  <div class="col-lg-8 pro-right">
			 <p class="pull-right"><a href="{{ url('/edit-profile') }}" class="pro-edit">Edit Profile <i class="icon-edit"></i></a></p>
			
		  <div class="profile-bio">
		   <form class="form-horizontal g-profile" role="form">
		   <input type="hidden" name="_token" value="{{ csrf_token() }}">
			  <div class="form-group">
              	<div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
				<label class="control-label lblExtr" for="email">First Name : </label>
                </div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			  
				  <p>{{ Auth::user()->fname }}</p>
				</div>
                </div>
			  </div>
			  <div class="form-group">
              	<div class="row">
              	 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
				<label class="control-label lblExtr" for="pwd">Last Name : </label>
                </div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">				 
				  <p>{{ Auth::user()->lname }}</p>

				</div>
                </div>
			  </div>
			   <div class="form-group">
               	<div class="row">
              	 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 rud_spa_1">
				<label class="control-label lblExtr" for="pwd">Email : </label>
                </div>
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				  
				  <p>{{ Auth::user()->email }}</p>
				</div>
                </div>
			  </div>
			  <!--
			   <div class="form-group">
				<label class="control-label col-sm-3" for="pwd">Contact : </label>
				<div class="col-sm-9">
			  
				  <p>{{ Auth::user()->contact }}</p>
				</div>
			  </div>
			 -->
			 
			</form>
		  </div>
		  </div>
		
		  <div class="col-lg-12 pro-right exchange-profile edit-area">
			
			<h2><u>Exchange / International Studies details</u></h2>
		  <div class="edit-area edit-area-2">
		   <form class="form-horizontal" role="form">
			  <div class="form-group">
              		<div class="row">
              		 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
					<label class="control-label" for="email">Type of user : </label>
                </div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
						  <p>{{@$userData->exchange->userType->title}}</p>
					</div>
			  		</div>
              </div>
			
			  <div class="form-group">
              	<div class="row">
              		 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
							<label class="control-label" for="pwd">Home University : </label>
               	 </div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				 
				  <p>{{@$userData->exchange->homeUniversity->universityName}}</p>

				</div>
                </div>
			  </div>
			   <div class="form-group">
               	<div class="row">
              		 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
				<label class="control-label" for="pwd">Matriculation Year : </label>
                </div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				  
				  <p>{{@$userData->exchange->matriculationYear}}</p>
				</div>
			  </div>
              </div>
			   @if(in_array(@$userData->exchange->type,array('1','2')))
			  
			 
			  <div class="form-group">
              		<div class="row">
              			 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
				<label class="control-label" for="pwd">Host University : </label>
                </div>
						<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				  
				  <p>{{@$userData->exchange->hostUniversity->universityName}}</p>
				</div>
			  		</div>
              </div>

			  <div class="form-group">
              	<div class="row">
              		 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
						<label class="control-label " for="pwd">Host Country : </label>
                	</div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				  
				  <p>{{@$userData->exchange->hostUniversity->city->country->countryName}}</p>
				</div>
			  </div>
              </div>
			   <div class="form-group">
               	<div class="row">
              		 <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 rud_spa">
				<label class="control-label" for="pwd">School Term : </label>
                </div>
					<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
				  
				  <p>{{@$userData->exchange->exchangeTerm}}</p>
				</div>
			  </div>
              </div>
			  @endif
			 
			 
			</form>
		  </div>
		  </div>
		</div>
	  </div>
</div>
  <img src="{{ asset('/public/img/cloud.png') }}" class="img-back">
</div>



@stop