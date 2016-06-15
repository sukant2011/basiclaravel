@extends($layout)

@section('content-header')
	<h1>
		Edit
		&middot;
		
		@if(isset($user->id)=='1')
		<small>{!! link_to_route('admin.home', 'Back') !!}</small>
		@else
		<small>{!! link_to_route('admin.users.index', 'Back') !!}</small>
		@endif
	
	</h1>
@stop

@section('content')
	<div>
		@include('admin::users.form', array('model' => $user) + compact('role'))
	</div>

@stop
