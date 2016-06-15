@extends($layout)

@section('content-header')

	<h1>
		{!! $title or 'All Users' !!} 
		&middot;
		<small>{!! link_to_route('admin.users.create', 'Add New') !!}</small>
		<span style="float:right;width: 24%;">
		<form role="form"  id="searchform" action="{{ url('/admin/users') }}" method="get">	<input type="hidden" name="_token" value="{{ csrf_token() }}"><div  class="form-group"><span style="width: 30%; float: left;">Search:</span><input type="text" value="<?php echo (@$_REQUEST['search']); ?>" name="search" class="form-control" style="height:26px;height:26px;width: 65%;"/> </div>
		</span>
	</h1>
<div style="clear:both"></div>

		<div class="container">
	    

	

{!!@$message!!}
@stop

@section('content')
{!! Form::open( ['files' => true,'route' => 'massbulk' ]) !!}


	<table class="table">
		<thead>
			<!--<th><input type="checkbox" id="checkAll"></th>-->
			<th>No</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Created At</th>
			<th>Last Logged In</th>
			<th class="text-center">Action</th>
		</thead>
		<tbody>
			@if(count($users)!=0)
			
			@foreach ($users as $user)
			
			<tr>
				<!--<td><input type="checkbox" class="selectCheck" name="userid[]" value="{!! $user->id !!}"></td>-->
				<td>{!! $no !!}</td>
				<td>{!! $user->fname !!}</td>
				<td>{!! $user->lname !!}</td>
				<td>{!! $user->email !!}</td>
				<td>{!! $user->created_at !!}</td>
				<td>{!! $user->last_logged_in !!}</td>
				<td class="text-center">
					<a href="{!! route('admin.users.edit', $user->id) !!}"><span class="fa fa-fw fa-pencil"></span></a>
					&middot;
					<a data-toggle="modal" href="#modal-delete-{!! $user->id !!}">
  <span class="fa fa-fw fa-trash-o"></span>
</a>
					
				</td>
			</tr>
			<?php $no++ ;?>
			@endforeach
			@else
				<tr>
				<td></td>
				<td></td>
				<td class="text-center"></td>
				<td class="text-center">	No Record Found. </td>
				<td></td>
				<td></td>	
			</tr>
			@endif
		</tbody>
	</table>
	<!--<div>
		
			<select onchange="this.form.submit()"  id="userstatus" name="type">
				<option value="">Choose Option</option>
				<option value="1">Move to Peer</option>
				<option value="2">Move to Senior</option>
			</select>
			<noscript><input type="submit" value="Submit"></noscript>
	</div>
-->
	{!! Form::close() !!}
		@foreach ($users as $user)
	<div id="modal-delete-{!! $user->id !!}" class="modal text-left fade">
  <div class="modal-dialog">
    <div class="modal-content">
      {!! Form::open(['method' => 'DELETE', 'route' => ["admin.users.destroy", $user->id]])!!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h1 class="modal-title">Delete Data</h1>
      </div>
      <div class="modal-body">
        <p>
          Are you sure want to delete this data?
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
      {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
		@endforeach
	<div class="text-center">
		{!! pagination_links($users) !!}
	</div>
@stop
