<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Foreign Exchange Rate Forecasts And Currency News - TorFX News</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<meta name="apple-mobile-web-app-title" content="TorFX News">
    <meta name="application-name" content="TorFX News">
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	{{-- <link rel="stylesheet" href="/css/rota.css"> --}}
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/rota.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-- templates.partial.styles -->
</head>
<body>
	<!-- templates.partials.sidebar -->
		<!-- templates.partials.nav -->
		<div class="container">

					@yield('content')

		</div>
		

		<!-- templates.partials.footer -->

</body class="site-boxed">
</html>