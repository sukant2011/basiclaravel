@extends('layouts.default')
@section('content')
<style>
.pro-left img.profileImg {
	width:100%;
	height:100%;
	border-radius:50%;
}
.pro-left img {
	border-radius:0;
}
</style>
 	<div class="exchange">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-xs-12">
                  <h2>Looking for buddies / seniors for your overseas studies?</h2>
                  <p>You have come to the right place!</p>
                  <p>Flying Chalks is a platform where you can easily discover and connect with <span class="tagbold">peers</span> who are going to the same country / university, as well as <span class="tagbold">seniors</span> who have embarked on this journey before.</p>
                  <p>Simply register an account to be part of our growing international student community of over <u><b>{{App\User::getTotalUsers()}}</b></u> students! </p>
                  <p>Connecting has never been this easy, let it take flight!</p>
				@if (Auth::guest())
                 	<a href="{{ url('/auth/register') }}">Connect!</a>
			 	@else
				  <!--<a href="{{ url('connect') }}">Connect!</a>-->
			  	 @endif
               </div>
               <img src="{{ asset('/public/img/img78.png') }}">
            </div>
         </div>
      </div>
	@if (Auth::guest())
	<div style="margin-bottom: 10px;" class="container">
	    <div class="row">
	       <div class="col-lg-12 col-xs-12">
	       <img style="max-width: 100%" src="{{ asset('/public/img/preview_v3.png') }}">
	       </div>
	    </div>
	</div>
	@elseif($isUserAddedExchange>0)
  <div class="three-sectionpro">
   <div class="container">
      <div class="row">
         <div class="search-section">
            <form class="form-horizontal" role="form">
               <div class="row">
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="control-label col-sm-4" for="">Search Keyword</label>
                        <div class="col-sm-8">
                           <input type="text" class="form-control" id="exchangeKeyword" placeholder="Enter Keyword">
                        </div>
                     </div>
					 <div class="form-group">
                        <label class="control-label col-sm-4" for="">Host University</label>
                        <div class="col-sm-8">
                            {!! Form::select('hostUniv', array(""=>"Please select") + $hostUnivList,Input::old('hostUniv'), array('id' =>
											'hostUniv','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                        </div>
                     </div>
                     
                  </div>
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label class="control-label col-sm-4" for="">Home University</label>
                        <div class="col-sm-8">
                           {!! Form::select('homeUniv', array(""=>"Please select") + $homeUnivList,Input::old('homeUniv'), array('id' =>
											'homeUniv','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="control-label col-sm-4" for="">Host Country</label>
                        <div class="col-sm-8">
                          {!! Form::select('hostCountryC', array(""=>"Please select") + $countryList,Input::old('hostCountryC'), array('id' =>
															'hostCountryC','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                        </div>
                     </div>
                  </div>
            </form>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="tab-section">
   <div class="container">
      <ul class="nav nav-tabs">
         <li class="active"><a data-toggle="tab" href="#home">Peers</a></li>
         <li><a data-toggle="tab" href="#menu1">Seniors</a></li>
      </ul>
      <div class="tab-content">
         <div id="home" class="tab-pane fade in active">
            <!-- start of peers-->
            <div class="row"  id="listdatah">
				 @if(count($peerExchanges)>0)
			     @foreach ($peerExchanges as $exchangeDetail)
					  <?php $name = $exchangeDetail['fname'].' '.$exchangeDetail['lname']; ?>	
					  <div id="gridId{{$exchangeDetail['eId']}}" class="col-lg-6 gridView pd" data-homeuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['homeUniversity']))}}" data-hostuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostUniversity']))}}" data-going="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostCountry']))}}" data-student="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['exchangeTerm']))}}" data-name="{{str_replace(array('(',')'),array('',''),strtolower($name))}}">
						  <div class="peers-area">
							 <div class="pro-left">
								<div class="pro-img user-img-broder">
								   <?php if($exchangeDetail['avatar']!=''){ 
				
											if((strpos($exchangeDetail['avatar'],'http://')!== false || strpos($exchangeDetail['avatar'],'https://')!== false)) {
											$imgSrc = str_replace('=normal','=large',$exchangeDetail['avatar']);
									?>
											<img src="<?php echo str_replace('=normal','=large&width=200&height=200',$exchangeDetail['avatar']) ?> " class="profileImg">
											
											
									<?php /*<img src="{{ Image::resize('$imgSrc', 200, 200) }}" class="profileImg">*/ ?>
									<?php	}else { ?>
									
												<img src="{{ asset('/public/img/memberImages/')}}/{{ $exchangeDetail['avatar'] }}"  class="profileImg">
									<?php	} 
									}else{ ?>
										<img src="{{ asset('/public/img/Flying_profile.png') }}">
									<?php } ?>
								</div>
							 </div>
							 <div class="hedaing-area">
								<h2 class="text-center">{{$exchangeDetail['fname']}} {{$exchangeDetail['lname']}}</h2>
								<div class="user-info-area">
								   <ul>
									  <li><strong>Home University :</strong>  <span>{{$exchangeDetail['homeUniversity']}} </span> </li>
									  <li><strong>Going :</strong>  <span>{{$exchangeDetail['hostCountry']}} </span> </li>
									  <li><strong>Host University :</strong>  <span>{{$exchangeDetail['hostUniversity']}}  </span> </li>
									  <li><strong>School Term :</strong>  <span>{{$exchangeDetail['exchangeTerm']}} </span> </li>
								   </ul>
								   <?php if( Auth::user()->id==$exchangeDetail['userId']){
										echo '<p class="pro-button"><a href="javascript:void(0);" onclick="return loggedinUser();">Chat</a></p>';
								   }else{
									   ?>
									   
								   <p class="pro-button"><a href="javascript:void(0);" onclick="openModalPop(this);" data-type="1" data-userid="{{Auth::user()->id}}" data-toid="{{$exchangeDetail['userId']}}" data-personalizedMsg="Hi {{$exchangeDetail['fname']}} {{$exchangeDetail['lname']}}, I am {{Auth::user()->fname}} {{Auth::user()->lname}} and we are both going for our overseas exchange program! Would like to hear more about your plans :)">Start a chat!</a></p>
									 <?php }?>
								</div>
							 </div>
						  </div>
				       </div>
				      
				 @endforeach	
                  @else
					<div class="col-lg-12 text-center noRecordFound">No record found!</div>
				 @endif
               
            </div>
         </div>
         <!-- end of peers -->
         <!-- start seniours area -->
         <div id="menu1" class="tab-pane fade">
            <div class="row" id="listdata">
				@if(count($seniorsExchanges)>0)
				@foreach ($seniorsExchanges as $exchangeDetail)
					<?php $name = $exchangeDetail['fname'].' '.$exchangeDetail['lname']; ?>
					   <div id="gridId{{$exchangeDetail['eId']}}" class="col-lg-6 gridView pd" data-homeuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['homeUniversity']))}}" data-hostuniv="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostUniversity']))}}" data-going="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['hostCountry']))}}" data-student="{{str_replace(array('(',')'),array('',''),strtolower($exchangeDetail['exchangeTerm']))}}" data-name="{{str_replace(array('(',')'),array('',''),strtolower($name))}}">
						  <div class="peers-area">
							 <div class="pro-left">
								<div class="pro-img user-img-broder">
								   <?php if($exchangeDetail['avatar']!=''){ 
				
											if((strpos($exchangeDetail['avatar'],'http://')!== false || strpos($exchangeDetail['avatar'],'https://')!== false)) {
									?>
											<img src="<?php echo str_replace('=normal','=large&width=200&height=200',$exchangeDetail['avatar']) ?> " class="profileImg">
									<?php	}else { ?>
									
												<img src="{{ asset('/public/img/memberImages/')}}/{{ $exchangeDetail['avatar'] }}"  class="profileImg">
									<?php	} 
									}else{ ?>
										<img src="{{ asset('/public/img/Flying_profile.png') }}">
									<?php } ?>
								</div>
							 </div>
							 <div class="hedaing-area">
								<h2 class="text-center">{{$exchangeDetail['fname']}} {{$exchangeDetail['lname']}}</h2>
								<div class="user-info-area">
								   <ul>
									  <li><strong>Home University :</strong>  <span>{{$exchangeDetail['homeUniversity']}} </span> </li>
									  <li><strong>Returned from :</strong>  <span>{{$exchangeDetail['hostCountry']}} </span> </li>
									  <li><strong>Host University :</strong>  <span>{{$exchangeDetail['hostUniversity']}}  </span> </li>
									  <li><strong>School Term :</strong>  <span>{{$exchangeDetail['exchangeTerm']}} </span> </li>
								   </ul>
								   <?php if( Auth::user()->id==$exchangeDetail['userId']){
										echo '<p class="pro-button"><a href="javascript:void(0);" onclick="return loggedinUser();">Seek Advice!</a></p>';
								   }else{
									   ?>
									
									<p class="pro-button"><a href="javascript:void(0);" onclick="openModalPop(this);" data-type="2" data-userid="{{Auth::user()->id}}" data-toid="{{$exchangeDetail['userId']}}" data-personalizedMsg="Hi {{$exchangeDetail['fname']}} {{$exchangeDetail['lname']}}, I am {{Auth::user()->fname}} {{Auth::user()->lname}} and I have some questions about {{$exchangeDetail['hostUniversity']}}. Please advise!">Seek Advice!</a></p>
								    <?php }?>
								</div>
							 </div>
						  </div>
				       </div>
				 @endforeach
				 @else
					<div class="col-lg-12 text-center noRecordFound">No record found!</div>
				 @endif
            </div>
           
         </div>
      </div>
      <!-- End of senoirs area -->
   </div>
</div>
<!-- Modal -->
<div id="requestPopUp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Flying Chalks is about to send an automated email on your behalf to notify the user of your friend request. The email will include your personalized message, public profile and contact email.
</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('route' => 'requestsend.store','id'=>'requestForm','tokan'=>csrf_token())) !!}
        	{!! Form::hidden('_tokan',null,array('id'=>'tokan','class'=>'form-control')) !!}
			 {!! Form::hidden('uId',null,array('id'=>'uId','class'=>'form-control')) !!}
			 {!! Form::hidden('toId',null,array('id'=>'toId','class'=>'form-control')) !!}
			 {!! Form::hidden('reqType',null,array('id'=>'reqType','class'=>'form-control')) !!}
			 <label>Message:</label>
			 {!! Form::textarea('message',null,array('id'=>'message','class'=>'form-control required','maxlength'=>'400')) !!}
			 <p style="float:left;font-size: 11px;"><span id="countChar">Total:400 char</span></p>
		{!! Form::close() !!}
      </div>
      <div class="modal-footer">
		<button type="button" class="btn btn-default" onclick="return sendRequest(this);">Submit</button>
        <button type="button" class="btn btn-default closeModal" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>


	  @endif
	  
@stop
