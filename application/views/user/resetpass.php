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
                            <li class="breadcrumb-item"><a href="#!">UPDATE PASSWORD</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-md-6">
                <hr>
                <form class="row g-3 needs-validation" action="<?= BASEURL ?>user/resetpass" method="POST"
                    enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="pwd" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <?= form_error('pwd') ?>
                            <input type="password" class="form-control" name="pwd" id="pwd"
                                value="<?= $this->input->post('pwd'); ?>" placeholder="Enter Your Old Password">
                        </div>
                        <div class="col-sm-10">
                            <?= form_error('npwd') ?>
                            <input type="password" class="form-control" name="npwd" id="npwd"
                                value="<?= $this->input->post('npwd'); ?>" placeholder=" Enter Your New Password">
                        </div>
                        <div class="col-sm-10">
                            <?= form_error('cpwd') ?>
                            <input type="password" class="form-control" name="cpwd" id="cpwd"
                                value="<?= $this->input->post('cpwd'); ?>" placeholder=" Confirm Your New Password">
                        </div>
                    </div>
                    <div> <label>
                            <input type="checkbox" id="showpasswords"> Show Passwords
                        </label></div>
            </div>
        </div>

        <div class="form-group row ">
            <div class="col-sm-10">
                <button type="submit" name="submit" id='submit' class="btn  btn-primary">Update Password</button>
            </div>
        </div>
        </form>
        <!-- ------------------------------------------------------------------------------------------------>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

        <script>
            $(function () {
                $('#submit').submit(function (event) {
                    event.preventDefault();
                    var password = $('#pwd').val();
                    $.ajax({
                        url: '<?php echo site_url("user/resetpass"); ?>',
                        type: 'POST',
                        data: { password: pwd },
                        success: function (response) {
                            if (response == 'true') {
                                alert('Password exists.');
                            } else {
                                alert('Password does not exist.');
                            }
                        },
                        error: function () {
                            alert('An error occurred.');
                        }
                    });
                });
            });
        </script>



        <script>

            $(document).ready(function () {
                $("#pwd, #npwd, #cpwd").attr("type", "password");
                $("#showpasswords").click(function () {
                    var type = $("#pwd, #npwd, #cpwd").attr("type");
                    if (type === "password") {
                        $("#pwd, #npwd, #cpwd").attr("type", "text");
                        $(this).html("Hide Passwords");
                    } else {
                        $("#pwd, #npwd, #cpwd").attr("type", "password");
                        $(this).html("Show Passwords");
                    }
                });
            });








        </script>

        <?php include('footer.php') ?>