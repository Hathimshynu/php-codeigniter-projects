

<head>

	<title>Welcome</title>
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
	<link rel="icon" href="<?=BASEURL?>assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?=BASEURL?>assets/css/style.css">
	
	


</head>

<!-- [ auth-signin ] start -->
<section>
 <form class="row g-3 needs-validation" action="<?=BASEURL?>user/signin"  method="POST" enctype="multipart/form-data">
<div class="auth-wrapper">
	<div class="auth-content text-center">
		<img src="<?=BASEURL?>assets/images/logo.png" alt="" class="img-fluid mb-4">
		<div class="card borderless">
			<div class="row align-items-center ">
				<div class="col-md-12">
					<div class="card-body">
						<h4 class="mb-3 f-w-400"><?php echo 'WELCOME  '. $username;?></h4>
						
						<div class="form-group mb-12" >
            
            <label for="dob" class="col-md-4 col-form-label text-md-right"></label> <?php echo 'your Name is '. $username;?> </div>
            <label for="dob" class="col-md-4 col-form-label text-md-right"></label> <?php echo 'your pasword is '. $pwd;?>
							
					
		<label for="dob" class="col-md-4 col-form-label text-md-right"></label><?php echo 'your Email is '. $email;?> </div></div>
  </div>
						<div><a class= 'btn btn-primary'href="<?php echo base_url('user/usersignin/' .$user_id); ?>">signin</a></div>
  
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



