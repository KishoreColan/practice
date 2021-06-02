<!DOCTYPE html>
<html>
	@include('layouts.partition.header')
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
	@include('layouts.partition.topnav')

	@include('layouts.partition.sidenav')



	<div class="content-wrapper">

<h1>This tha Main Page</h1>
		@yield('content')

	</div>
	
	@include('layouts.partition.footer')
	
</div>
</body>
</html>