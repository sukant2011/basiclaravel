@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		
		<small>{!! link_to_route('admin.universities.index', 'Back') !!}</small>
		
	</h1>
@stop

@section('content')
<ul class="nav nav-tabs">
	<li class="active"><a href="#university" data-toggle="tab">University</a></li>
	<li><a href="#ai" data-toggle="tab">Additional information</a></li>
	<li><a href="#expense" data-toggle="tab">Expenses</a></li>
	<li><a href="#flight" data-toggle="tab">Flight</a></li>
	<li><a href="#accommodation" data-toggle="tab">Accommodation</a></li>
	<li><a href="#visa" data-toggle="tab">Visa</a></li>
	<li><a href="#ti" data-toggle="tab">Travel insurance</a></li>
	<li><a href="#packing" data-toggle="tab">Packing</a></li>
	<!--<li><a href="#backup" data-toggle="tab">Cache And Reset</a></li>
	<li><a href="#developers" data-toggle="tab">Developers</a></li>-->
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div class="tab-pane active" id="university">
		<h3></h3>
		
		@include('admin::universities.form', array('model' => $university))
	
	</div>
	<div class="tab-pane" id="ai">
		<h3></h3>

	{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}


	<div class="form-group">
		{!! Form::hidden('tab', 2, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('Transportation', 'Transportation:') !!}
		{!! Form::textarea('Transportation', @$university->universitycontent->Transportation,['class'=>'form-control','rows'=>'5', 'id' => 'Transportation']) !!}
		{!! $errors->first('Transportation', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Banking Services', 'Banking Services:') !!}
		{!! Form::textarea('BankingServices',@$university->universitycontent->BankingServices,['class'=>'form-control','rows'=>'5', 'id' => 'BankingServices']) !!}
		{!! $errors->first('BankingServices', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('post office Services', 'Post office Services:') !!}
		{!! Form::textarea('postoffice', @$university->universitycontent->postoffice,['class'=>'form-control','rows'=>'5', 'id' => 'postoffice']) !!}
		{!! $errors->first('postoffice', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('medical services', 'Medical services:') !!}
		{!! Form::textarea('medicalservices', @$university->universitycontent->medicalservices,['class'=>'form-control','rows'=>'5', 'id' => 'medicalservices']) !!}
		{!! $errors->first('medicalservices', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Telecommunications', 'Telecommunications:') !!}
		{!! Form::textarea('Telecommunications', @$university->universitycontent->Telecommunications,['class'=>'form-control','rows'=>'5', 'id' => 'Telecommunications']) !!}
		{!! $errors->first('Telecommunications', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Survival Guide', 'Survival Guide:') !!}
		{!! Form::textarea('SurvivalGuide', @$university->universitycontent->SurvivalGuide,['class'=>'form-control','rows'=>'5', 'id' => 'SurvivalGuide']) !!}
		{!! $errors->first('SurvivalGuide', '<div class="text-danger">:message</div>') !!}
	</div>


	<div class="form-group">
		{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}
		
	
	</div>
	<div class="tab-pane" id="expense">
		<h3></h3>
		
			{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 3, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Consolidated', 'Consolidated:') !!}
				{!! Form::textarea('Consolidated', null,['class'=>'form-control','rows'=>'5', 'id' => 'Consolidated']) !!}
				{!! $errors->first('Consolidated', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		
	
	</div>
	<div class="tab-pane" id="flight">
		<h3></h3>
			{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 4, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Airlines', 'Airlines:') !!}
				{!! Form::textarea('Airlines', null,['class'=>'form-control','rows'=>'5', 'id' => 'Airlines']) !!}
				{!! $errors->first('Airlines', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		
	
	</div>
	<div class="tab-pane" id="accommodation">
		<h3></h3>
		
		{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 5, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Accommodation', 'Accommodation:') !!}
				{!! Form::textarea('Accommodation', null,['class'=>'form-control','rows'=>'5', 'id' => 'Accommodation']) !!}
				{!! $errors->first('Accommodation', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
	
	</div>
	<div class="tab-pane" id="visa">
		<h3></h3>
		
		{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 6, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('visa', 'Visa:') !!}
				{!! Form::textarea('visa', null,['class'=>'form-control','rows'=>'5', 'id' => 'visaa']) !!}
				{!! $errors->first('visa', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
	
	</div>
	<div class="tab-pane " id="ti">
		<h3></h3>
		
			{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 7, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('Travel Insurance', 'Travel Insurance:') !!}
				{!! Form::textarea('TravelInsurance', null,['class'=>'form-control','rows'=>'5', 'id' => 'TravelInsurance']) !!}
				{!! $errors->first('TravelInsurance', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
	
	</div>
	<div class="tab-pane " id="packing">
		<h3></h3>
		{!! Form::model($university, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $university->id]]) !!}
			

			<div class="form-group">
				{!! Form::hidden('tab', 8, ['class' => 'form-control']) !!}
			</div> 
				<div class="form-group"> 
				{!! Form::label('pck_cntn', 'Packing :') !!}
				{!! Form::textarea('pck_cntn', null,['class'=>'form-control','rows'=>'5', 'id' => 'pck_cntn']) !!}
				{!! $errors->first('pck_cntn', '<div class="text-danger">:message</div>') !!}
			</div>
			<div class="form-group"> 
				{!! Form::label('PDF', 'PDF :') !!}
				{!! Form::file('Packing', null,['class'=>'form-control']) !!}
				{!! $errors->first('Packing', '<div class="text-danger">:message</div>') !!}
			</div>

	
			<div class="form-group">
				{!! Form::submit(isset($university) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}

	</div>
	</div>


@stop
