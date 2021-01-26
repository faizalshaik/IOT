<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="FlexAR">
		<meta name="author" content="Lance Bunch">

		<title>Digit.Localizator</title>

		<link href="{{ url('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/core.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/components.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

		<script src="{{ url('assets/js/modernizr.min.js')}}"></script>
	</head>
	<body>

		<div class="account-pages"></div>
		<div class="clearfix"></div>
		<div class="wrapper-page">
			<div class=" card-box" style="background-color: #3cfb8d8a !important;">
			<div class="panel-heading"> 
				<h3 class="text-center"> Sign In to <strong class="text-primary">Localizator</strong> </h3>
			</div> 


			<div class="panel-body">
			<form class="form-horizontal m-t-20" action="{{ url('/user/auth')}}" data-parsley-validate novalidate method="post">
				@csrf
				<div class="form-group ">
					<div class="col-xs-12">
						<input class="form-control" parsley-trigger="change"  type="text" required placeholder="Email or User id" 
						name="email" autocomplete="off" value="admin@admin.com">
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input class="form-control" type="password" required placeholder="Password" name="password"  autocomplete="off" value="123456">
					</div>
				</div>
				
				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
					</div>
				</div>
			</form> 
			</div>   
		</div>
		
		<script>
			var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="{{ url('assets/js/jquery.min.js')}}"></script>
		<script src="{{ url('assets/js/bootstrap.min.js')}}"></script>
		<script src="{{ url('assets/js/detect.js')}}"></script>
		<script src="{{ url('assets/js/fastclick.js')}}"></script>
		<script src="{{ url('assets/js/jquery.slimscroll.js')}}"></script>
		<script src="{{ url('assets/js/jquery.blockUI.js')}}"></script>
		<script src="{{ url('assets/js/waves.js')}}"></script>
		<script src="{{ url('assets/js/wow.min.js')}}"></script>
		<script src="{{ url('assets/js/jquery.nicescroll.js')}}"></script>
		<script src="{{ url('assets/js/jquery.scrollTo.min.js')}}"></script>


		<script src="{{ url('assets/js/jquery.core.js')}}"></script>
		<script src="{{ url('assets/js/jquery.app.js')}}"></script>

		<script type="text/javascript" src="{{ url('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('form').parsley();
		});
		</script>
	</body>
</html>