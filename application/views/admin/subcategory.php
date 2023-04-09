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
                            
                        </div>
                    </div>

                  <?php $aa= $this->db->get('main')->result_array();?>
 <form action="<?=BASEURL?>admin/subcategory"  method="POST" enctype="multipart/form-data">
 
 <div class="form-group">
    <label for="name">Sub Category Name</label>
    <input type="text" class="form-control" name="name"   value="<?php ('name');?>" id="name">
    <?=form_error('user_id')?>
  </div>

   
  <div class="form-group">
            <div class="col-md-12">
              <select class="form-control" name="main_id">
               <option value="">Select a category</option>
            <?php foreach ($aa as $category=>$s): ?>
                <option value="<?=  $s['main_id']; ?>"> <?=$s['name']; ?></option>
            <?php endforeach; ?>
        </select>
             
        </div>
        </div>
  
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</section>





<?php include('footer.php')?>