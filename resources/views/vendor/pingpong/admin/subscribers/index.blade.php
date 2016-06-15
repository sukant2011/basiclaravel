@extends($layout)

@section('content-header')
	
	<h1>
		All Subscribers ({!! $subscribers->count() !!})
	<span style="float:right;width: 24%;">
		<form role="form" action="{{ url('/admin/subscribers') }}" method="get"><input type="hidden" name="_token" value="{{ csrf_token() }}">	<div class="form-group"><span style="width: 30%; float: left;">Search:</span><input type=text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height: 26px;    height: 26px;width: 65%;"/></div></form>
		</span>
	</h1>
<div style="clear:both"></div>
	
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>Email</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@if($subscribers->count()!=0)
				@foreach ($subscribers as $subscriber)
				
				<tr>
					<td>{!! $no !!}</td>
					<td>{!! $subscriber->email !!}</td>
				
					<td>{!! $subscriber->created_at !!}</td>
					<td class="text-center">
						@include('admin::partials.modal', ['data' => $subscriber, 'name' => 'subscribers'])
					</td>
				</tr>
				<?php $no++ ;?>
				@endforeach
				@else
				<tr>
					<td></td>
					<td class="text-center">
							No Record Found.
					</td>
					<td></td>
					<td></td>
					
				</tr>
		
			@endif
		</tbody>
	</table>
		
	<div class="text-center">
		{!! pagination_links($subscribers) !!}
	</div>
@stop
