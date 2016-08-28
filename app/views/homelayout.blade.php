<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="google-site-verification" content="2hXNy22zvn7HZk28Yohk3rOVHxL_kCXDG_--nkV7_lQ" />
  <title>@yield('title')</title>
  <meta name="csrf-token" content={{ csrf_token() }}>
  <meta charset="utf-8">
  @yield('metadesc')
  @yield('keywords')
  <meta name="author" content="Aashay Shah" />
  <meta name="revisit-after" content="3 days" />
  <meta name="googlebot" content="index, follow" />
  <meta name="robots" content="index, follow" />

  <link rel="icon" href="{{ URL::asset('public/images/favicon.ico') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1">

{{ HTML::style('https://fonts.googleapis.com/css?family=Varela+Round') }}
  
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
{{ HTML::style('public/font-awesome-4.3.0/css/font-awesome.min.css') }}

{{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') }}<!-- 3.2.0 -->

<!-- START SOCIAL BUTTON -->
{{ HTML::style('public/css/bootstrap-social-gh-pages/bootstrap-social-gh-pages/bootstrap-social.css') }}
<!-- {{ HTML::style('css/bootstrap-social-gh-pages/bootstrap-social-gh-pages/assets/css/font-awesome.css') }} -->
<!-- END SOCIAL BUTTON -->
<!-- FOR SLIDE ANIMATION -->
<!---- AS SMOOTHE LEFT AND RIGHT SLIDEBOUNCE REMOVED -->
<!-- {{ HTML::style('WOW-master/WOW-master/css/libs/animate.css') }} -->
<!---- AS SMOOTHE LEFT AND RIGHT SLIDEBOUNCE REMOVED -->
{{ HTML::style('public/css/style.css') }}

{{ HTML::style('public/css/jquery.autocomplete.css') }}
<!-- {{ HTML::style('css/w3full.css') }} -->
</head>
<body>

@include('menu')
@yield('content')
@include('footer')

<a class="scrollTop"></a>


<!-- <div style="margin-top:1000px">sdcds</div> -->


<!----------AS SMOOTHE LEFT AND RIGHT SLIDEBOUNCE REMOVED -->
<!-- {{ HTML::script('WOW-master/WOW-master/dist/wow.min.js') }} -->
<script>
//  	new WOW().init();
//  	// document.body.addEventListener('touchstart', function(e){ e.preventDefault(); });
 </script>
<!---------- END AS SMOOTHE LEFT AND RIGHT SLIDEBOUNCE REMOVED -->

	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js') }}<!-- 1.8.3 --><!-- 2.1.4 -->

	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') }}

	{{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}<!-- 3.2.0 -->
	
	<!-- CHANGE THE SEQUENCE TO BEFORE BOOTSTRAP -->
	<!-- {{ HTML::script('http://code.jquery.com/ui/1.11.2/jquery-ui.js') }} -->
	<!-- {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') }} -->

	<!-- TO FIND BOOTSTRAP BREAKPOINT USING JAVASCRIPT -->
	<!-- {{ HTML::script('js/responsive.bootstrap.toolkit.js') }} -->

	{{ HTML::script('public/js/jquery.autocomplete.js') }}
	{{ HTML::script('public/js/foodfire.js') }}
	{{ HTML::script('public/js/login.js') }}
	<!-- {{ HTML::script('https://apis.google.com/js/client.js?onload=handleClientLoad') }} -->
	<!-- FOR GOOGLE API -->
	<!-- {{ HTML::script('https://apis.google.com/js/client.js') }}
	{{ HTML::script('public/js/api.js') }} -->
	
@yield('javascr')
	
	
	
	


</body>
</html>