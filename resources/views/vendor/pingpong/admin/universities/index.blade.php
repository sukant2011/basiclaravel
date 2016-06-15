@extends($layout)

@section('content-header')
	
	<h1>
		All Universities
	<span style="float:right;width: 24%;">
		<form role="form" action="{{ url('/admin/universities') }}" method="get"><input type="hidden" name="_token" value="{{ csrf_token() }}">	<div class="form-group"><span style="width: 30%; float: left;">Search:</span><input type=text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height: 26px;    height: 26px;width: 65%;"/></div></form>
		</span>
	</h1>
<div style="clear:both"></div>
	
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>University Name</th>
			<th>Country Name</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
				@if(count($universities)!=0)
			@foreach ($universities as $university)
			<tr>
				<td>{!! $no !!}</td>
				<td>{!! $university->universityName !!}</td>
				<td>{!! $university->city->country->countryName !!}</td>
				<td>{!! $university->created_at !!}</td>
				<td class="text-center">
						<a href="{!! route('admin.universities.edit', $university->id) !!}"><span class="fa fa-fw fa-pencil"></span></a>
						&middot;
						<a href="{!! route('admin.reviews.index', 'search='.$university->universityName) !!}"><span class="fa fa-fw fa-comments"></span></a>
					
						&middot;
						@include('admin::partials.modal', ['data' => $university, 'name' => 'universities'])
					
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
			@else
			<tr>
				<td></td>
				<td></td>
				<td class="text-center"> No Record Found.</td>
				<td></td>
				<td></td>
			</tr>
			@endif
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($universities) !!}
	</div>
@stop
