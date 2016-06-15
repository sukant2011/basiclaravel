@if(isset($model))
{!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin.universities.update', $model->id]]) !!}
@else
{!! Form::open(['files' => true, 'route' => 'admin.universities.store']) !!}
@endif
	
	<div class="form-group">
		{!! Form::hidden('tab', 1, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('universityName', 'University Name:') !!}
		{!! Form::text('universityName', null, ['class' => 'form-control']) !!}
		{!! $errors->first('universityName', '<div class="text-danger">:message</div>') !!}
	</div>
	
	<div class="form-group">
		{!! Form::label('country', 'Country Name:') !!}
		{!! Form::select('country', array(""=>"Please select") + $countryList,$university->city->country->countryID, array('id' =>
															'countryHome','class'=>'form-control selectMenu', 'autocomplete'=>'off')) !!}
		{!! $errors->first('country', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('cityName', 'City:') !!}
		{!! Form::text('cityName', $cityData->cityName, ['class' => 'form-control']) !!}
		{!! $errors->first('cityName', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Overview', 'Overview:') !!}
		{!! Form::textarea('Overview', null,['class'=>'form-control','rows'=>'5', 'id' => 'ckeditor']) !!}
		{!! $errors->first('Overview', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Academics', 'Academics:') !!}
		{!! Form::textarea('Academics', null,['class'=>'form-control','rows'=>'5' , 'id' => 'ckeditor1']) !!}
		{!! $errors->first('Academics', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('My Campus', 'My Campus:') !!}
		{!! Form::textarea('MyCampus', null,['class'=>'form-control','rows'=>'5', 'id' => 'ckeditor2']) !!}
		{!! $errors->first('MyCampus', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Student life', 'Student life:') !!}
		{!! Form::textarea('Studentlife', null,['class'=>'form-control','rows'=>'5', 'id' => 'ckeditor3']) !!}
		{!! $errors->first('Studentlife', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Surrounding', 'Surrounding Environment :') !!}
		{!! Form::textarea('Surrounding', null,['class'=>'form-control','rows'=>'5', 'id' => 'ckeditor4']) !!}
		{!! $errors->first('Surrounding', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group">
		{!! Form::label('Accessibility', 'Accessibility :') !!}
		{!! Form::textarea('Accessibility', null,['class'=>'form-control','rows'=>'5', 'id' => 'ckeditor5']) !!}
		{!! $errors->first('Accessibility', '<div class="text-danger">:message</div>') !!}
	</div>
	<div class="form-group"> 
		{!! Form::label('Image', 'Logo :') !!}
		{!! Form::file('image', null,['class'=>'form-control']) !!}
		{!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
	</div>
	@if(isset($model))
	<div class="form-group">
		@if($model->image)
		<img class="img-responsive" src="{!! asset('public/images/universities/' . $model->image) !!}">
		@endif
	</div>
	@endif
	<div class="form-group">
		{!! Form::label('banner', 'Banner :') !!}
		{!! Form::file('banner_image', null,['class'=>'form-control']) !!}
		{!! $errors->first('banner_image', '<div class="text-danger">:message</div>') !!}
	</div>
	
	
	
	
	<?php /*?>
	<div class="form-group">
		{!! Form::label('image', 'Image:') !!}
		{!! Form::file('image', ['class' => 'form-control']) !!}
		{!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
	</div>
	<?php */?>
	@if(isset($model))
	
	<div class="form-group">
		@if($model->banner_image)
		<img class="img-responsive" src="{!! asset('public/images/banner/' . $model->banner_image) !!}">
		@endif
	</div>
	@endif
	<div class="form-group">
		{!! Form::submit(isset($model) ? 'Update' : 'Save', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}

@section('script')
	<script src="{!! admin_asset('vendor/ckeditor/ckeditor.js') !!}" type="text/javascript"></script>
	<script src="{!! admin_asset('vendor/ckfinder/ckfinder.js') !!}" type="text/javascript"></script>
	
	
	<script type="text/javascript">
		CKEDITOR.editorConfig = function( config ) {
			var prefix = '/{!! option("ckfinder.prefix") !!}';

		   config.filebrowserBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html';
		   config.filebrowserImageBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Images';
		   config.filebrowserFlashBrowseUrl = prefix + '/vendor/ckfinder/ckfinder.html?type=Flash';
		   config.filebrowserUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
		   config.filebrowserImageUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
		   config.filebrowserFlashUploadUrl = prefix + '/vendor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
		};

		var editor = CKEDITOR.replace( 'ckeditor' );
		var editor1 = CKEDITOR.replace( 'ckeditor1' );
		var editor2 = CKEDITOR.replace( 'ckeditor2' );
		var editor3 = CKEDITOR.replace( 'ckeditor3' );
		var editor4 = CKEDITOR.replace( 'ckeditor4' );
		var editor5 = CKEDITOR.replace( 'ckeditor5' );
		var editor6 = CKEDITOR.replace( 'Transportation' );
		var editor7 = CKEDITOR.replace( 'BankingServices' );
		var editor8 = CKEDITOR.replace( 'postoffice' );
		var editor9 = CKEDITOR.replace( 'medicalservices' );
		var editor10 = CKEDITOR.replace( 'Telecommunications' );
		var editor11 = CKEDITOR.replace( 'SurvivalGuide' );
		var editor12 = CKEDITOR.replace( 'Consolidated' );
		var editor13 = CKEDITOR.replace( 'Airlines' );
		var editor14 = CKEDITOR.replace( 'Accommodation' );
		var editor15 = CKEDITOR.replace( 'visaa' );
		var editor16 = CKEDITOR.replace( 'TravelInsurance' );
		var editor17 = CKEDITOR.replace( 'pck_cntn' );
		
		var prefix = '/{!! option("ckfinder.prefix") !!}';
		CKFinder.setupCKEditor( editor, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor1, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor2, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor3, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor4, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor5, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor6, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor7, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor8, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor9, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor11, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor12, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor13, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor14, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor15, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor16, prefix + '/vendor/ckfinder/') ;
		CKFinder.setupCKEditor( editor17, prefix + '/vendor/ckfinder/') ;
	</script>
@stop
