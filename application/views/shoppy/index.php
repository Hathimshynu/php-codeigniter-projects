<?php include('header.php') ?>





<!-- Products Start -->
<div class="container-fluid pt-5 ">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">PRODUCTS</span></h2>
    </div>


    <div class="row px-xl-5 pb-3 ">

        <?php
        foreach ($products as $key => $row) {
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1 ">

                <div class="card product-item border-0 mb-4">
                    <form action="<?= BASEURL ?>shoppy/cartview" method='post'>
                        <div class="card product-item border-0 mb-4">
                            <input type="hidden" class="form-control" name="product_id" value=<?= $row['product_id']; ?>
                                id="product_id">
                            <input type="hidden" class="form-control" name="qty" value="1" id="qty">

                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0"
                                scope="row">
                               
                                <a  href="<?= BASEURL ?>shoppy/detail/<?= $row['product_id'] ?>"> <img class="img-fluid w-100 " style=" width:300px ;height:300px;" src="<?= BASEURL ?>assets/img/<?= $row['image'] ?>" alt=""></a>
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">
                                    <?= $row['product_name'] ?>
                                </h6>
                                <div class="d-flex justify-content-center">

                                    <h6>
                                        <?= $row['mrp']; ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="<?= BASEURL ?>shoppy/detail/<?= $row['product_id'] ?>"
                                    class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                    Detail</a>

                                <button type="submit" class="fas fa-shopping-cart text-primary mr-1">Add To Cart
                                </button>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>


    </div>

</div>
<!-- Products End -->


<!-- Vendor Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-1.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-2.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-3.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-4.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-5.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-6.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-7.jpg" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="<?= BASEURL ?>assets/shoppy/img/vendor-8.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->



<?php include('footer.php') ?>