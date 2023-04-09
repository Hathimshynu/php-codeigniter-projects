
<?php include('header.php') ?>



<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">UPDATE</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-12">
				<div class="card">
					<div class="card-header">

            <form method='post' action="<?=BASEURL?>user/kyc"  method="POST" enctype="multipart/form-data">  
                                 <div class="form-group row">
                                <div class="col-sm-9">
                                <input type="hidden" class="form-control" value="<?=$aa['user_id']?>"   name="user_id" id="user_id" placeholder="user_id">
                                </div>
                            </div>
                            
                        
                            <div class="form-group row">
                                    <label for="aadhar" class="col-sm-3 col-form-label" >AADHAR</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=$this->input->post('aadhar')?>"   name="aadhar" id="bankname" placeholder="AADHAR">
                                        </div>
                                        </div>
                                <div class="form-group row">
                                    <label for="branch" class="col-sm-3 col-form-label" >Branch</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="pan" value="<?=$this->input->post('pan')?>"  id="pan" placeholder="PAN">
                                    </div>
                                </div>

                        <div class="form-group row ">
                        <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn  btn-primary">submit</button>
                        </div>
                        </div> 
                        </form>

                    </div>
                    </div>
                    </div>
                    </div>

        <?php include('footer.php') ?>