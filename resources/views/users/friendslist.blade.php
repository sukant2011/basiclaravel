@extends('layouts.default')
@section('content')
<style type="text/css">

.outer-inner-Pageheader {
    min-height: 43px;
}

.chat-sidebar-main {
    display: block;
    margin:23px auto 20px;
    width: 99%;
}
.chat-sidebar {
    float: left;
    position: relative;
    width: 100%;
    overflow: visible;
    height: auto !important;
    margin-bottom: 20px;
    width: 100% !important;
    bottom: 0 !important;
}

.name-cl {
    float: left;
    margin-left: 14px;
    margin-top: 9px;
    width: 70%;
}
.gap{ min-height:43px !important;}

	.chat-sidebar { position: relative;}
	.chat-friends.intro {display: none;}
	#chatdata {display: none;}

	@media screen and (max-width: 530px) {
		.chat-sidebar-main {margin-top:0px;}
		.chat-sidebar {width: 100%; margin-top: 40px;}
		.gap{ min-height:143px !important;}
	}

	@media screen and (max-width: 400px) {
		.chat-sidebar-main {margin-top: 90px;}
	}
	
	@media screen and (max-width: 397px) {
		.chat-sidebar-main {margin-top: 130px;}
        .chat-sidebar {margin-top: 0;}
	}
	@media  (min-width:1600px) and  (max-width:1920px) {		
		.gap{ min-height:60px !important;}
	}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#chatdata").html("");
	});

</script>
<?php 
if(@$_GET['toId']!=''){ ?>
<script>
	$(window).bind("load", function() {
		setTimeout(function(){ document.getElementById('regOpenMob_'+<?php echo $_GET['toId']; ?>).onclick();},500);
	   
	});
           
</script>
<?php }

?>
<div id="mobilechatView"></div>

<div id="modelmobilechatView"></div>

@stop

