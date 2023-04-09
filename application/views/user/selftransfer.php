
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
                        
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-6">
        <h5 class="mt-5">Self Transfer details</h5>
        <hr>
        <div>
        <div class="row-table">
                        
                        <div class="col-sm-9">
                            <h6>Account Balance</h6>
                        </div>
                    </div>
        <div class="card-body pb-0 ">
        <?php $aa=$this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id',$this->session->userdata('user_id'))->get('myaccount')->row()->balance+0; ?>

        <h1 class="text-c-yellow"><?="$".$aa?></h1>
        </div>
        <div class="col-sm-9">
                    <h6>wallet Balance</h6>
                    </div>
        <div class="card-body pb-0 ">
        <?php $aa=$this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id',$this->session->userdata('user_id'))->get('wallet')->row()->balance+0; ?>

        <h1 class="text-c-yellow"><?="$".$aa?></h1>
        </div>
        <form action="<?=BASEURL?>user/selftransfer" method="POST">
        <div class="form-group row">
        <label for="amount" class="col-sm-3 col-form-label" >Amount</label>
        <div class="col-sm-9">
        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount">
        <?=form_error('amount')?>
        </div>
        </div>
        <div class="col-sm-10">
        <button type="submit"  class="btn  btn-primary">Self Transfer</button>
        </div>
        </form>
        </div>

</div>
</div>
</div>


        <?php include('footer.php') ?>