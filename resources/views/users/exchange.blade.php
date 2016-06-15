@extends('layouts.default')
@section('content')


<div class="profile-details">
   <div class="container">
      <div class="profile-innerd exchange-page">
         <button class="pro-edit pull-right" onclick="goBack()"><i class="fa fa-arrow-left"></i>
         Go Back</button>
         <h2 class="text-center">My Exchange Details</h2>
         <div class="row">
            <div class="col-lg-offset-1 col-lg-10 pro-right exchange-profile">
               <div class="profile-bio">
                  <span class="asteriskMark">Fields marked with asterisk (*) are compulsory. </span>
				   
				  <form role="form" action="{{ url('/exchange-store') }}" method="post" class="form-horizontal">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{ Auth::user()->id }}">
					
					<div class="form-group">
                        <label for="" class="control-label col-sm-3 ">*Type of user: </label>
                        <div class="col-sm-9 col-xs-12">
						    
							{!! Form::hidden('type', Input::old('type')!=''?Input::old('type'):($exchangeDetail->type!=''?$exchangeDetail->type:'1'), array('id' => 'type')) !!}	
                           <ul class="nav nav-pills">
                              <li class="selectType {{ Input::old('type')=='1'?'active':($exchangeDetail->type=='1'?'active':'') }}" data-usertype="1"><a href="javascript:void(0);">Adventurer</a></li>
                              <li class="selectType {{ Input::old('type')=='2'?'active':($exchangeDetail->type=='2'?'active':'') }}" data-usertype="2"><a href="javascript:void(0);">Senior</a></li>
                              <li class="selectType {{ Input::old('type')=='3'?'active':($exchangeDetail->type=='3'?'active':'') }}" data-usertype="3"><a href="javascript:void(0);">The Undecided</a></li>
                              <li class="selectType {{ Input::old('type')=='4'?'active':($exchangeDetail->type=='4'?'active':'') }}" data-usertype="4"><a href="javascript:void(0);">Curious Onlooker</a></li>
                           </ul>
						   <label class="error pError">{{$errors->first('type')}}</label>
                        </div>
                     </div>
                   
                     <div class="form-group home-univ">
                        <label for="" class="control-label col-sm-3 ">*Home University:</label>
                        <div class="col-sm-9 col-xs-12">
                           {!! Form::select('homeUniversityID', array(""=>"Please select") + $homeUnivList,Input::old('homeUniversityID')!=''?Input::old('homeUniversityID'):($exchangeDetail->homeUniversity->id!=''?$exchangeDetail->homeUniversity->id:''), array('id' =>
											'homeUniversityID','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
                         <label class="error pError">{{$errors->first('homeUniversityID')}}</label>
						</div>
                     </div>
					 
					 <div id="newHomeUniversityDiv" class="form-group" style="display:{{ Input::old('homeUniversityID')=='1'?'block':'none'}};">
						 <label for="" class="control-label col-sm-3 "></label>
						<div class="col-sm-9 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="panel-title">New Home University</h4>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*Country:</label>
										<div class="col-sm-9 col-xs-12">
										   {!! Form::select('homecountry', array(""=>"Please select") + $countryList,Input::old('homecountry'), array('id' =>
															'homecountry','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
											<label class="error pError">{{$errors->first('homecountry')}}</label>				 
										</div>
									</div>
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*City:</label>
										<div class="col-sm-9 col-xs-12">
										    {!! Form::text('homecity',Input::old('homecity'),array('id'=>'homecity','class'=>'form-control')) !!}
											<label class="error pError">{{$errors->first('homecity')}}</label>				 
										</div>
									</div>
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*University Name:</label>
										<div class="col-sm-9 col-xs-12">
										   {!! 	Form::text('homeuniversityName',Input::old('homeuniversityName'),array('id'=>'homeuniversityName','class'=>'form-control')) !!}
										   <label class="error pError">{{$errors->first('homeuniversityName')}}</label>					 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					 
                     <div class="form-group">
                        <label class="control-label col-sm-3 t0" for="pwd">Matriculation Year (format: YYYY) : </label>
                        <div class="col-sm-9 col-xs-12">
                           {!! Form::text('matriculationYear',Input::old('matriculationYear')!=''?Input::old('matriculationYear'):($exchangeDetail->matriculationYear!=''?$exchangeDetail->matriculationYear:''),array('id'=>'matriculationYear','class'=>'form-control')) !!}
						    <label class="error pError">{{$errors->first('matriculationYear')}}</label>
                        </div>
                     </div>
                     <div class="form-group type3-4" {{ Input::old('type')=='3' || Input::old('type')=='4' || $exchangeDetail->type=='3' || $exchangeDetail->type=='4' ?'style=display:none;':''}}>
                        <label for="" class="control-label col-sm-3 ">*Exchange Term: </label>
                        <div class="col-sm-9 col-xs-12">
                            {!! Form::select('exchangeTerm', array(""=>"Please select", "Spring 2016"=>"Spring 2016", "Summer 2016"=>"Summer 2016", "Fall 2016"=>"Fall 2016", "Winter 2016"=>"Winter 2016", "Spring 2017"=>"Spring 2017", "Summer 2017"=>"Summer 2017", "Fall 2017"=>"Fall 2017", "Winter 2017"=>"Winter 2017"),Input::old('exchangeTerm')!=''?Input::old('exchangeTerm'):($exchangeDetail->exchangeTerm!=''?$exchangeDetail->exchangeTerm:''), array('id' =>
											'exchangeTerm','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
							 <label class="error pError">{{$errors->first('exchangeTerm')}}</label>				
                        </div>
                     </div>
					 
                     <div class="form-group type3-4" {{ Input::old('type')=='3' || Input::old('type')=='4' || $exchangeDetail->type=='3' || $exchangeDetail->type=='4'?'style=display:none;':''}}>
                        <label for="" class="control-label col-sm-3 ">*Host University: </label>
                        <div class="col-sm-9 col-xs-12">
						   {!! Form::select('hostUniversityID', array(""=>"Please select") + $hostUnivList,Input::old('hostUniversityID')!=''?Input::old('hostUniversityID'):($exchangeDetail->hostUniversity->id!=''?$exchangeDetail->hostUniversity->id:''), array('id' =>
											'hostUniversityID','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
						   <label class="error pError">{{$errors->first('hostUniversityID')}}</label>			 				
											
                        </div>
                     </div>
					 
                     <div class="form-group type3-4 hostCountryBlk" {{ Input::old('type')=='3' || Input::old('type')=='4' || $exchangeDetail->type=='3' || $exchangeDetail->type=='4'?'style=display:none;':''}}>
                        <label class="control-label col-sm-3" for="pwd">Host Country : </label>
                        <div class="col-sm-9 col-xs-12">
                             {!! Form::text('hostCountry',Input::old('hostCountry')!=''?Input::old('hostCountry'):($exchangeDetail->hostUniversity->city->country->countryName!=''?$exchangeDetail->hostUniversity->city->country->countryName:''),array('id'=>'hostCountry','class'=>'form-control', 'readonly'=>'readonly')) !!}
							 
							 
                        </div>
                     </div>
					 
					  <div id="newHostUniversityDiv" class="form-group type3-4" style="display:{{ Input::old('hostUniversityID')=='1'?'block':'none'}};">
						 <label for="" class="control-label col-sm-3 "></label>
						<div class="col-sm-9 col-xs-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="panel-title">New Host University</h4>
								</div>
								<div class="panel-body">
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*Country:</label>
										<div class="col-sm-9 col-xs-12">
										   {!! Form::select('hostNewcountry', array(""=>"Please select") + $countryList,Input::old('hostNewcountry'), array('id' =>
															'hostNewcountry','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
											 <label class="error pError">{{$errors->first('hostNewcountry')}}</label>				 
										</div>
									</div>
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*City:</label>
										<div class="col-sm-9 col-xs-12">
										    {!! Form::text('hostcity',Input::old('hostcity'),array('id'=>'hostcity','class'=>'form-control')) !!}
											 <label class="error pError">{{$errors->first('hostcity')}}</label>					 
										</div>
									</div>
									<div class="form-group">
										<label for="" class="control-label col-sm-3 ">*University Name:</label>
										<div class="col-sm-9 col-xs-12">
										   {!! 	Form::text('hostuniversityName',Input::old('hostuniversityName'),array('id'=>'hostuniversityName','class'=>'form-control')) !!}
													 <label class="error pError">{{$errors->first('hostuniversityName')}}</label>			 
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					 <div class="form-group">
						<label class="control-label col-sm-3" for="pwd"></label>
						<div class="col-sm-9 col-xs-12">
						  <button type="submit" class="btn btn-default">Submit</button>
						  <a href="{{url('/home')}}" class="btn btn-default">Cancel</a>
						</div>
					 </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
    <img src="{{ asset('/public/img/cloud.png') }}" class="img-back">
</div>
<script>
function goBack() {
    window.history.back();
}
</script>

@stop
