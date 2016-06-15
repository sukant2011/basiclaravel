@extends($layout)

@section('content-header')
	<h1>
		Add New
		&middot;
		
		<small>{!! link_to_route('admin.universities.index', 'Back') !!}</small>
		
	</h1>
@stop

@section('content')

	<div>
	{!! Form::model($countryList, ['method' => 'PUT', 'files' => true, 'route' => ['addUniversity']]) !!}
	
	<div class="form-group">
		{!! Form::label('country', 'Country:') !!}
		{!! Form::select('country', array(""=>"Please select") + $countryList,$countryList, array('id' =>
															'countryHome','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
		{!! $errors->first('country', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('cityName', 'City:') !!}
		{!! Form::text('cityName',null, ['class' => 'form-control']) !!}
		{!! $errors->first('cityName', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('university', 'University:') !!}
		{!! Form::text('university',null, ['class' => 'form-control']) !!}
		{!! $errors->first('university', '<div class="text-danger">:message</div>') !!}
	</div>


		<div class="form-group">
			{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
	</div>

@stop
