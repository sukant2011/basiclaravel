<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0' >
<meta property="fb:app_id" content="158824664483310" /> 
<meta property="og:url"                content="{{ url('') }}" />
<meta property="og:image"  	             content="{{ asset('/public/img/logo200.png') }}" />
<meta name="_token" content="{{ csrf_token() }}">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title> {!! option('site.name') !!}</title>
<link rel="icon" href="{{ asset('/public/img/demo_icon.gif') }}" type="image/gif">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/3.2.1/assets/font-awesome/css/font-awesome.css">

{!! HTML::style('/public/css/style.css', array('media' => 'all')) !!}
{!! HTML::style('public/libraries/bootstrap/css/bootstrap.min.css', array('media' => 'all')) !!}
{!! HTML::style('public/libraries/tablesorter/css/theme.bootstrap.min.css', array('media' => 'all')) !!}
{!! HTML::style('public/libraries/comboBox/css/bootstrap-combobox.css', array('media' => 'all')) !!}
{!! HTML::style('/public/css/full-slider.css', array('media' => 'all')) !!}
{!! HTML::style('/public/css/developer.css', array('media' => 'all')) !!}


{!! HTML::script('public/js/jquery-2.1.4.min.js') !!}
{!! HTML::script('public/libraries/bootstrap/js/bootstrap.min.js') !!}
{!! HTML::script('public/js/front.js') !!}

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
		

