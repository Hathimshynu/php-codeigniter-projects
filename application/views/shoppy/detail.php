<?php include('header.php') ?>



<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
        </div>
        <div class="col-lg-7 pb-5 justify-content-center">
            <form action="<?= BASEURL ?>shoppy/cartview" method="post">
                <div class="row">

                    <img width="500px" height="500px" src="<?= BASEURL ?>assets/img/<?= $bb['image'] ?>"></a>
                </div>
                <h3 class="font-weight-semi-bold">
                    <?= $bb['product_name'] ?>
                </h3>
                <div class="d-flex mb-3">
                    <input type="hidden" class="form-control" name="product_id" value=<?= $bb['product_id']; ?>
                        id="product_id">
                    <input type="hidden" class="form-control" name="qty" value="<?= $bb['qty'] ?>" id="qty">
                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    <?= "RS  " . $bb['mrp'] ?>
                </h3>
                <p class="mb-4">Volup erat ipsum diam elitr rebum et dolor. Est nonumy elitr erat diam stet sit clita
                    ea. Sanc invidunt ipsum et, labore clita lorem magna lorem ut. Erat lorem duo dolor no sea nonumy.
                    Accus labore stet, est lorem sit diam sea et justo, amet at lorem et eirmod ipsum diam et rebum kasd
                    rebum.</p>
                <div class="d-flex mb-3">

                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type='button' name='qty' class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name='qty' value="1">
                        <div class="input-group-btn">
                            <button type='button' name='qty' class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add
                        To
                        Cart</button>
                </div>
                <?php $aa = $this->db->select("(SUM(amount) * SUM(qty)) as balance")
                    ->where('user_id', $this->session->userdata('user_id'))->where('product_id', $row['product_id'])
                    ->where('status', 'new')->get('cart')->row()->balance + 0; ?>
            </form>
        </div>
        </div>
        </div>



<?php include('footer.php') ?>