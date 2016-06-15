@extends('layouts.default')
@section('content')

<style>
@media (min-width:526px) and (max-width:1600px){
	.gap-cms .inner-Pageheader ul li a{ padding:20px 14px;}
}

@media (min-width:526px) and (max-width:1920px){
	.gap-cms .inner-Pageheader ul li a{ padding:20px 14px;}
}

@media (min-width:320px) and (max-width:525px){	
.gap{ min-height:145px !important;}	
	}
	
</style>
<div class="container">
       <div class="about-us">
             <div class="row">
				  <div class="col-lg-12">
						 <h3 class="widget-title"><span class="title_inner">{{$pageData->title}}</span></h3>
			 			 {!!$pageData->body!!}	
				  </div>
      	     </div>
       </div>
</div>     
        
          
        </div>		 
@stop