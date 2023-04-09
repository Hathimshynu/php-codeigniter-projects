<?php include('header.php') ?>



<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <div class="card-body pb-0 ">
                <?php $aa = $this->db->select("(SUM(credit) - SUM(debit)) as balance")->where('user_id', $this->session->userdata('user_id'))->get('wallet')->row()->balance + 0; ?>

                <h1> <span class="text-c-yellow  bg-info">
                        <?= 'Your Wallet Balance  ' . "₹" . $aa ?>
                    </span></h1>
            </div>
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Id</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Accept</th>
                        <th>Remove</th>
                    </tr>
                </thead>

                <tbody class="align-middle">
                    <?php
                    $count = 1;
                    foreach ($cartitems as $key => $row) {
                        ?>
                        <form action="<?= BASEURL ?>shoppy/cart_items" method="POST" enctype="multipart/form-data">
                            <tr>
                                <th scope="row">
                                    <?= $count++; ?>
                                </th>
                                <input type="hidden" class="form-control" name="product_id" value=<?= $row['product_id']; ?>
                                    id="product_id">

                                <td class="align-middle"><img src="img/product-1.jpg" alt="" style="width: 50px;">
                                    <?= $row['product_name'] ?>
                                </td>
                                <td class="align-middle">
                                    <?= $row['amount'] ?>
                                </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">

                                            <button type="button" class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="qty" id="qty"
                                            class="form-control form-control-sm bg-secondary text-center"
                                            value="<?= $row['qty'] ?>">
                                        <div class="input-group-btn">
                                            <button type="button" class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <?php $aa = $this->db->select("(SUM(amount) * SUM(qty)) as balance")
                                    ->where('user_id', $this->session->userdata('user_id'))->where('product_id', $row['product_id'])
                                    ->where('status', 'new')->get('cart')->row()->balance + 0; ?>
                                <td class="align-middle">
                                    <?= $aa; ?>
                                </td>
                                <td class="align-middle">
                                    <button type="submit" class="btn btn-success btn-md">
                                        <span class="fa fa-ok"></span>✔
                                    </button>
                                </td>
                                <td>

                                    <a href="<?= base_url(); ?>shoppy/remove_cart_item/<?= $row['product_id'] ?>"
                                        class="btn btn-danger btn-md">
                                        <span class="fa fa-times"></span>
                                    </a>
                                </td>
                                <td>
                            </tr>
                        </form>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <!-- <form class="mb-5" action=""> -->
            <div class="input-group">
                <input type="text" class="form-control p-4" placeholder="Coupon Code">
                <div class="input-group-append">
                    <button class="btn btn-primary">Apply Coupon</button>
                </div>
            </div>

            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <!-- <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$150</h6>
                        </div> -->
                    <!-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div> -->
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold"></h5>
                    </div>
                    <a href="<?= BASEURL ?>shoppy/checkout "><button type="submit"
                            class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button></a>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- Cart End -->



<?php include('footer.php') ?>