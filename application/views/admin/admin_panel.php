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
                            <h5 class="m-b-10">User Datas</h5>
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
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Amount</th>
                                    <th>UTR</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Entry Date</th>
                                    <th>Accept|Reject</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($aa as $key => $row) {
                                    ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $count++; ?>
                                        </th>
                                        <td>
                                            <?= $row['user_id'] ?>
                                        </td>
                                        <td>
                                            <?= $row['amount'] ?>
                                        </td>
                                        <td>
                                            <?= $row['utr'] ?>
                                        </td>
                                        <td><a target="_blank" href="<?= BASEURL ?>assets/img/<?= $row['image'] ?>"><img
                                                    width="50px" height="50px"
                                                    src="<?= BASEURL ?>assets/img/<?= $row['image'] ?>"></a></td>
                                        <td>
                                            <?= $row['status'] ?>
                                        </td>
                                        <td>
                                            <?= $row['entry_date'] ?>
                                        </td>

                                        <td>
                                            <a href="<?= BASEURL ?>admin/accept/<?= $row['id'] ?>">Accept</a> |
                                            <a href="<?= BASEURL ?>admin/reject/<?= $row['id'] ?>">Reject</a>
                                        </td>

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