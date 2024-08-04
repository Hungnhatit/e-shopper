<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Home | E-Shopper</title>
	<link href="{{asset('/frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<!-- {{asset('/frontend/assets/images/ico/apple-touch-icon-57-precomposed.png')}} -->
	<link href="{{asset('/frontend/assets/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/custom.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/assets/css/responsive.css')}}" rel="stylesheet">
	<!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<link rel="shortcut icon" href="images/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('/frontend/assets/images/ico/apple-touch-icon-144-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('/frontend/assets/images/ico/apple-touch-icon-114-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('/frontend/assets/images/ico/apple-touch-icon-72-precomposed.png')}}">
	<link rel="apple-touch-icon-precomposed" href="{{asset('/frontend/assets/images/ico/apple-touch-icon-57-precomposed.png')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<!--/head-->

<body>
	@include('frontend.layouts.header')

	@if (!isset($slide))
	@include('frontend.layouts.slider')
	@endif
	
	<section>
		<div class="container">
			<div class="row">
				@if(!isset($sidebar))
				@include('frontend.layouts.sidebar')
				@endif

				@yield('content')
			</div>
		</div>
	</section>

	@include('frontend.layouts.footer')

	
	<script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/assets/js/price-range.js')}}"></script>
	<script src="{{asset('frontend/assets/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('frontend/assets/js/main.js')}}"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
		    $("a[rel^='prettyPhoto']").prettyPhoto();
			$('.choose').click(function(){
		    	var link = $(this).attr('src');
		    	var link_replace = link.replace('small_','');
		    	
		    	$('#img_zoom').attr('href',link_replace);
		    	$('#img_main').attr('src',link_replace);
		    })
		});
    </script>

</body>

</html>