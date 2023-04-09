
<head>

	<title>Signin</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="<?=BASEURL?>assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?=BASEURL?>assets/css/style.css">
	
	


</head>

<!-- [ auth-signin ] start -->
<section>
	<?php echo $this->session->userdata('auser_type') ?>
 <form class="row g-3 needs-validation" method='post' action="<?=BASEURL?>admin/signinn"  method="POST" enctype="multipart/form-data">
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="<?=BASEURL?>assets/images/logo.png" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="mb-3 f-w-400">Signin</h4>
						<hr>
						<div class="form-group mb-3">
							<input type="text" class="form-control" name='username' id="Username" placeholder=" user name">
						</div>
						
						<div class="form-group mb-4">
							<input type="password" class="form-control" name="pwd" id="Password" placeholder="Password">
						</div>

						<div class="custom-control custom-checkbox text-left mb-4 mt-2">
							<input type="checkbox" class="custom-control-input" id="customCheck1">
							<label class="custom-control-label" for="customCheck1">Save credentials.</label>
						</div>
						<input type="submit" name="submit" class="btn btn-block btn-primary mb-4"> 
						<hr>

						<p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
						<p class="mb-0 text-muted">Don’t have an account? <a href="<?=BASEURL?>admin/signup" class="f-w-400">Signup</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
</section>
<!-- </form> -->
<!-- [ auth-signin ] end -->

<!-- Required Js -->
<script src="<?=BASEURL?>assets/js/vendor-all.min.js"></script>
<script src="<?=BASEURL?>assets/js/plugins/bootstrap.min.js"></script>

<script src="<?=BASEURL?>assets/js/pcoded.min.js"></script>



