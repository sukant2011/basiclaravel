@extends($layout)

@section('content-header')
	<h1>
		Dashboard
		<small>Control panel</small>
	</h1>
@stop

@section('content')

<!-- Small boxes (Stat box) -->
<div class="row">
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>
					 {!! user()->count() - 1 !!}
				
				</h3>

				<p>
					All Users
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-users"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
			
			<!--<a href="javascript:void(0);" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>-->
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-green">
			<div class="inner">
				<h3>
					{{Pingpong\Admin\Entities\Subscriber::getTotalSubs()}}
				</h3>

				<p>
					All Quote Requests
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-book"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
			<!----<a href="javascript:void(0);" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>-->
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3>
					{!! page()->count() !!}
				</h3>

				<p>
					All Pages
				</p>
			</div>
			<div class="icon">
				<i class="fa fa-flag"></i>
			</div>
			<a href="{!! route('admin.pages.index') !!}" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
			
				<!--<a href="javascript:void(0);" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>-->
			
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-xs-6">
		<!-- small box -->
		<div class="small-box bg-red">
			<div class="inner">
				<h3>
					0
				</h3>

				<p>
					Services
				</p>
			</div>
			<div class="icon">
				<i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">
				More info <i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Administrator Detail</h3>
			   
			</div><!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<thead><tr>
						<th>Name</th>
						<th>Email</th>
						<th>Status</th>
						<th>Created At</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
						@foreach ($adminUsers as $user)
						<tr>
							<td>{!! $user->fname !!} {!! $user->lname !!}</td>
							<td>{!! $user->email !!}</td>
							<td><span class="label label-success">Active</span></td>
							<td>{!! $user->created_at !!}</td>
							<td>
								<a href="{!! route('admin.users.edit', $user->id) !!}"><span class="fa fa-fw fa-pencil"></span></a>
								
								<?php /*@include('admin::partials.modal', ['data' => $user, 'name' => 'users']) */ ?>
							</td>
						</tr>
					
						@endforeach
					</tbody>
					
				</table>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
	</div>
		
				
</div>
<div class="row">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Tab 1</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Tab 2</a></li>
									<li><a href="#tab_3" data-toggle="tab">Tab 3</a></li>
                                   
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <b>How to use:</b>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<p>
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        The European languages are members of the same family. Their separate existence is a myth.
                                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                        new common language would be desirable: one could refuse to pay expensive translators. To
                                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                        words. If several languages coalesce, the grammar of the resulting language is more simple
                                        and regular than that of the individual languages.
                                    </div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_3">
                                        The European languages are members of the same family. Their separate existence is a myth.
                                        For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                        in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                        new common language would be desirable: one could refuse to pay expensive translators. To
                                        achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                        words. If several languages coalesce, the grammar of the resulting language is more simple
                                        and regular than that of the individual languages.
                                    </div><!-- /.tab-pane -->
                                </div><!-- /.tab-content -->
                            </div><!-- nav-tabs-custom -->
                        </div><!-- /.col -->

                    
                    </div> <!-- /.row -->

			<!-- /.row (main row) -->

			@stop

@section('script')
	<script src="{!! admin_asset('components/raphael/raphael-min.js') !!}"></script>
	<script src="{!! admin_asset('adminlte/js/plugins/morris/morris.min.js') !!}"></script>
	<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
	<script src="{!! admin_asset('adminlte/js/AdminLTE/dashboard.js') !!}" type="text/javascript"></script>
	<script>
	$( document ).ready(function() {
		var checkflag = "false";
			function check(field) {}		

			  
			
	});		
		
	</script>
@stop
