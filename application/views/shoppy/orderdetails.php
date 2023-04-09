<?php include('header.php') ?>



<!-- Cart Start -->
<div class="container-fluid  pt-5 ">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <div class="card-body pb-0 ">
                <?php $aa = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0; ?>

                <h1> <span class="text-c-yellow  bg-info">
                        <?= 'Your Wallet Balance  '. "₹" . $aa ?>
                    </span></h1>
            </div>
            <table class="table table-hover table-primary  table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Order_id</th>
                        <th>product Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    <?php

                    foreach ($cartitems as $key => $row) {
                        ?>
                        <form action="<?= BASEURL ?>shoppy/cart_items" method="POST" enctype="multipart/form-data">
                            <tr>

                                <td class="align-middle">
                                    <?= $row['order_id'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['product_name'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['amount'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['status'] ?>
                                </td>
                            </tr>
                        </form>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Cart End -->



<?php include('footer.php') ?>