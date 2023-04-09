<!DOCTYPE html>
<html lang="en">

<head>

	<title>Flat Able - Premium Admin Template by Phoenixcoded</title>
	<!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 11]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="<?= BASEURL ?>assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?= BASEURL ?>assets/css/style.css">




</head>

<!-- [ auth-signup ] start -->


<form class="row g-3 needs-validation" method='post' action="<?= BASEURL ?>user/signup" method="POST"
	enctype="multipart/form-data">
	<div class="auth-wrapper">
		<div class="auth-content text-center">
			<img src="<?= BASEURL ?>assets/images/logo.png" alt="" class="img-fluid mb-4">
			<div class="card borderless">
				<div class="row align-items-center text-center">
					<div class="col-md-12">
						<div class="card-body">
							<h4 class="f-w-400">Sign up</h4>
							<hr>
							<div class="form-group mb-3">
								<?= form_error('username') ?>
								<input type="text" class="form-control" name="username"
									value="<?= $this->input->post('username'); ?>" id="Username" placeholder="Username">
							</div>
							<div class="form-group mb-3">
								<?= form_error('email') ?>
								<input type="email" class="form-control" name="email"
									value="<?= $this->input->post('email'); ?>" id="Email" placeholder="Email address">
							</div>
							<div class="form-group mb-4">
								<?= form_error('pwd') ?>
								<input type="password" class="form-control" name="pwd"
									value="<?= $this->input->post('pwd'); ?>" id="Password" placeholder="Password">
							</div>
							<div class="form-group mb-4">
								<?= form_error('ref_id') ?>
								<input type="text" class="form-control" name="ref_id" value="<?= $ref_id; ?>" id="ref_id"
									placeholder="reference id">
							</div>
							<div class="form-group mb-4">
								<?= form_error('mobile') ?>
								<input type="number" class="form-control" name="mobile"
									value="<?= $this->input->post('mobile'); ?>" id="mobile" placeholder="Mobile">
							</div>

							<button type=" Submit" class="btn btn-primary btn-block mb-4">Sign up</button>
							<hr>
							<p class="mb-2">Already have an account? <a href="<?= BASEURL ?>user/usersignin"
									class="f-w-400">Signin</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</form>
<!-- [ auth-signup ] end -->

<!-- Required Js -->
<script src="<?= BASEURL ?>assets/js/vendor-all.min.js"></script>
<script src="<?= BASEURL ?>assets/js/plugins/bootstrap.min.js"></script>

<script src="<?= BASEURL ?>assets/js/pcoded.min.js"></script>



</body>

</html>
<script>
	if (window.performance && window.performance.navigation.type === window.performance.navigation.TYPE_BACK_FORWARD) {
		window.location.href = " <?php echo base_url('user/refresh'); ?>";
	}
</script>