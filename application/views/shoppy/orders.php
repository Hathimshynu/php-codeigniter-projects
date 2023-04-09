<?php include('header.php') ?>


<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <div class="text-center my-4" style="background-color:violet;">
                <h2>Your Orders</h2>
            </div>

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <div class="card-body pb-0 ">
                <?php $aa = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0; ?>

                <h1 class="text-c-yellow">
                    <span style="background-color:grey;">
                        <?= "$" . $aa ?>
                    </span>
                </h1>
            </div>
            <?php $bb = $this->db->where('user_id', $this->session->userdata('user_id'))
                ->where('status', 'processing')->get('purchase')->result_array(); ?>

            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr style="background-color: green;">
                        <!-- <th>Id</th> -->
                        <th>Product Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Entry date</th>

                    </tr>
                </thead>

                <tbody class="align-middle">
                    <?php
                    foreach ($bb as $key => $row) {
                        ?>
                        <form action="<?= BASEURL ?>shoppy/orders" method="POST" enctype="multipart/form-data">
                            <tr>
                                </th>

                                <td class="align-middle">
                                    <?= $row['product_name'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['amount'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['status'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['entry_date'] ?>
                                </td>

                            </tr>
                        </form>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>



































<?php include('footer.php') ?>