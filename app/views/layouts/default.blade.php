<!doctype html>

<html>

<head>
	<title>Wash Safe Service Customers CRM</title>
	<meta charset="utf-8">

	{{ HTML::style('css/app.css') }}

	@yield('styles')


</head>

<body>
<nav class="navbar navbar-default navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{URL::to('/')}}">Wash Safe Service</a>
    </div>


    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{URL::to('customers')}}">Customers</a></li>
		<li><a href="{{URL::to('jobs')}}">Jobs</a></li>
		<li><a href="{{URL::to('advertisements')}}">Advertisements</a></li>
		<li><a href="{{URL::to('reports')}}">Reports</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


	<div class="container">
		@yield('content')
	</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment-with-locales.js"></script>

  @yield('scripts')

</body>

</html>