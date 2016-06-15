@extends($layout)

@section('content-header')
	
	<h1>
		All Reviews
		<span style="float:right;width: 24%;">
		<form role="form" action="{{ url('/admin/reviews') }}" method="get"><input type="hidden" name="_token" value="{{ csrf_token() }}">	<div class="form-group"><span style="width: 30%; float: left;">Search:</span><input type=text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height: 26px;    height: 26px;width: 65%;"/></div></form>
		</span>
	</h1>
	<div style="clear:both"></div>
@stop

@section('content')

	<table class="table">
		<thead>
			<th>No</th>
			<th>University Name</th>
			<th>Added By</th>
			<th>Review</th>
			<th>Created At</th>
			<th class="text-center">Action</th>
			
		</thead>
		<tbody>
			<?php //print_r($reviews);exit;?>
			@foreach ($reviews as $review)
			<tr>
				<td>{!! @$no !!}</td>
				<td>{!! @$review->univdetail->universityName !!}</td>
				<td>{!! @$review->userdetail->fname  !!} {!! $review->userdetail->lname  !!}</td>
				<td>{!! @$review->message !!}</td>
				<td>{!!@ $review->created_at !!}</td>
				<td class="text-center">
						
						@include('admin::partials.modal', ['data' => $review, 'name' => 'reviews'])
					</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
		</tbody>
	</table>

	<div class="text-center">
		{!! pagination_links($reviews) !!}
	</div>
@stop
