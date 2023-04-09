
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

            <form method='post' action="<?=BASEURL?>user/bankk"  method="POST" enctype="multipart/form-data">  
                                 <div class="form-group row">
                                <div class="col-sm-9">
                                <input type="hidden" class="form-control" value="<?=$aa['user_id']?>"   name="user_id" id="user_id" placeholder="user_id">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                    <label for="accountno" class="col-sm-3 col-form-label" >Account No</label>
                                        <div class="col-sm-9">
                                        <input type="number" class="form-control" value="<?=$this->input->post('accountno')?>"   name="accountno" id="accountno" placeholder="Account no">
                                        </div>
                                        </div>
                            <div class="form-group row">
                                    <label for="ifsc" class="col-sm-3 col-form-label" >IFSC</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=$this->input->post('ifsc')?>"   name="ifsc" id="ifsc" placeholder="IFSC">
                                        </div>
                                        </div>
                            <div class="form-group row">
                                    <label for="bankname" class="col-sm-3 col-form-label" >Bank Name</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" value="<?=$this->input->post('bankname')?>"   name="bankname" id="bankname" placeholder="Bank Name">
                                        </div>
                                        </div>
                                <div class="form-group row">
                                    <label for="branch" class="col-sm-3 col-form-label" >Branch</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="branch" value="<?=$this->input->post('branch')?>"  id="branch" placeholder="Branch">
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