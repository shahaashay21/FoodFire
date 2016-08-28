<!DOCTYPE html>
<html lang="en" ng-app="foodfireadmin" ng-controller="foodfireadminController">
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
<!-- {{ HTML::style('https://fonts.googleapis.com/css?family=Work+Sans') }} -->
  
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> -->
{{ HTML::style('font-awesome-4.3.0/css/font-awesome.min.css') }}

{{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css') }}<!-- 3.2.0 -->

<!-- START SOCIAL BUTTON -->
{{ HTML::style('css/bootstrap-social-gh-pages/bootstrap-social-gh-pages/bootstrap-social.css') }}
<!-- {{ HTML::style('css/bootstrap-social-gh-pages/bootstrap-social-gh-pages/assets/css/font-awesome.css') }} -->
<!-- END SOCIAL BUTTON -->

{{ HTML::style('css/adminstyle.css') }}

{{ HTML::script('https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0-rc.2/angular.min.js') }}


</head>
<body>


	@include('vendor.header')
	@include('vendor.sidebar')
	@yield('content')
	<div class="container-fluid ffa-container">
	  <h3>Right Aligned Navbar</h3>
	  <p>The .navbar-right class is used to right-align navigation bar buttons.</p>
	</div>
	





	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js') }}<!-- 1.8.3 --><!-- 2.1.4 -->

	{{ HTML::script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js') }}

	{{ HTML::script('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') }}<!-- 3.2.0 -->
	
	
	
	{{ HTML::script('js/admin/angular.js') }}
	{{ HTML::script('js/admin/foodfireadmin.js') }}
	
	
@yield('javascr')
	
	
	
	


</body>
</html>