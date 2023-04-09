<?php include('header.php')?>

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                    </div>
                </div>
            </div>
        </div>


	<title>MAIN CATEGORY</title>
	
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
	


<!-- [ auth-signin ] start -->
<section>

<div class="row-table">
            <div class="col-sm-9">
                 </div></div>


 <form   action="<?=BASEURL?>admin/maincategory"  method="POST" enctype="multipart/form-data">
 
  <div class="form-group">
  <label for="name">Main Category</label>
    <input type="text" class="form-control" name="name"   value="<?php ('name');?>" id="name">
    <?=form_error('name')?>
  </div>

		
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</section>


<!-- Required Js -->
<script src="<?=BASEURL?>assets/js/vendor-all.min.js"></script>
<script src="<?=BASEURL?>assets/js/plugins/bootstrap.min.js"></script>

<script src="<?=BASEURL?>assets/js/pcoded.min.js"></script>



<?php include('footer.php')?>