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
                    <h5>Purchase Details</h5>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Amount</th>
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
                                            <?= $row['order_id'] ?>
                                        </td>
                                        <td>
                                            <?= $row['product_name'] ?>
                                        </td>
                                        <td>
                                            <?= $row['amount'] ?>
                                        </td>
                                        <td>
                                            <?= $row['status'] ?>
                                        </td>
                                        <td>
                                            <?= $row['entry_date'] ?>
                                        </td>

                                        <td>
                                            <a href="<?= BASEURL ?>admin/accept_order/<?= $row['order_id'] ?>">Accept</a>
                                            |
                                            <a href="<?= BASEURL ?>admin/reject_order/<?= $row['order_id'] ?>">Reject</a>
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