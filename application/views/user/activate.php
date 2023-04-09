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


	<title>PEER</title>
	
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
                            <h6>Wallet Balance</h6>
                        </div>
                    </div>
<div class="card-body pb-0 ">
<?php $aa=$this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id',$this->session->userdata('user_id'))->get('wallet')->row()->balance+0; ?>

<h1 class="text-c-yellow"><?="$".$aa?></h1>
</div>


<?php if ($this->session->flashdata('message')) : ?>
    <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

 <form   action="<?=BASEURL?>user/activate"  method="POST" enctype="multipart/form-data">
 
  <div class="form-group">
    <label for="amount">USER_ID</label>
    <input type="text" class="form-control" name="user_id"   value="<?php ('user_id');?>" id="user_id">
    <?=form_error('user_id')?>
  </div>

		  <div class="form-group">
    <label for="amount">AMOUNT</label>
    <input type="text" class="form-control" value="<?php set_value('amount');?>" name="amount" id="amount">
    <?=form_error('amount')?>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</section>





<?php include('footer.php')?>