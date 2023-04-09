
<?php include('header.php') ?>





	
	

<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">my team</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- [ Background-Utilities ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>User Details</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Reference ID</th>
                                    <th>Mobile</th>
                                    <th>Image</th>
                                   
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                            $count=1;
                            foreach($aa as $key =>$row){
                            ?>
                        <tr>
                            <th scope="row"><?=$count++;?></th>
                            <td><?=$row['user_id']?></td>
                            <td><?=$row['username']?></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['ref_id']?></td>
                            <td><?=$row['mobile']?></td>

                            <td><a target="_blank" href="<?=BASEURL?>assets/img/<?=$row['image']?>"><img width="50px" height="50px" src="<?=BASEURL?>assets/img/<?=$row['image']?>"></a></td>
                           

                            </tr>
                            <?php } ?>
                  
                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
       

    </div>
</section>



<?php include('footer.php') ?>