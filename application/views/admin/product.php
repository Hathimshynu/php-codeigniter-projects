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
              <h5 class="m-b-10">Product Details</h5>
            </div>
          </div>
        </div>
      </div>
    </div>


    <title>Products</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?= BASEURL ?>assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?= BASEURL ?>assets/css/style.css">



    <?php $aa = $this->db->get('main')->result_array(); ?>
    <?php $bb = $this->db->get('sub')->result_array(); ?>
    <section>
      <?php echo validation_errors(); ?>
      <form action="<?= BASEURL ?>admin/product" method="POST" enctype="multipart/form-data">

        <div class="form-group">
          <label for="product_name">Product Name</label>
          <input type="text" class="form-control" name="product_name" value="<?php set_value('product_name'); ?>" id="product_name">
        </div>
        <div class="form-group">
          <label for="main_id">Main Category</label>

          <div class="form-group">
            <div class="col-md-12">
              <select class="form-control" id="main_menu" name="main_id">
                <option value="">Select a category</option>
                <?php foreach ($aa as $category => $s) : ?>
                  <option value="<?= $s['main_id']; ?>"> <?= $s['name']; ?></option>
                <?php endforeach; ?>
              </select>

            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="sub_id">Sub Category</label>
          <div class="form-group">
            <div class="col-md-12">
              <select class="form-control" id="sub_menu" name="sub_id">
                <option value="">Select a category</option>
            
              </select>

            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="mrp">MRP</label>
          <input type="text" class="form-control" name="mrp" value="<?php set_value('mrp'); ?>" id="mrp">
        </div>


        <div class="form-group">
          <div class="form-file">
            <div>
            <label class="form-label">Image</label>
              <a href="#" id="proclick">
                <img id="proimg" href="#" src="<?= BASEURL ?>assets/img/" style="height: 100px; width: 200px;border-radius:10px" accept="image/jpg" class="img-lg" alt="">
              </a>
            </div>
            <input style="display: none;" type="file" class="custom-file-input" name="profile" id="profile">
            <input class="form-control" type="hidden" id="pimage" name="image" value="<?php set_value('image'); ?>"  >
            <label><span id="pro_status" style="color:green; font-weight: bold;"></span></label>
          </div>
        </div>


        <div class="form-group">
          <label for="selling">Selling</label>
          <input type="text" class="form-control" name="selling" value="<?php set_value('selling'); ?>" id="selling">
        </div>
        <div class="form-group">
          <label for="gst">GST</label>
          <input type="text" class="form-control" name="gst" value="<?php set_value('gst'); ?>" id="gst">
        </div>
        <div class="form-group">
          <label for="delivery_charge">Delivery Charge</label>
          <input type="text" class="form-control" name="delivery_charge" value="<?php set_value('delivery_charge'); ?>" id="delivery_charge">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </section>




    <!----------------------------------------------------------------------------------------------------------------- -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" ></script>
    <script>
      $(document).ready(function() {
        $("#proclick").click(function() {
          $("#profile").trigger('click')

        });
        $(document).on('change', '#profile', function() {

          var name = document.getElementById("profile").files[0].name;
          var form_data = new FormData();
          var ext = name.split('.').pop().toLowerCase();

          var oFReader = new FileReader();
          oFReader.readAsDataURL(document.getElementById("profile").files[0]);
          var f = document.getElementById("profile").files[0];
          var fsize = f.size || f.fileSize;
          if (fsize > 3000000 || jQuery.inArray(ext, ['png', 'jpg', 'jpeg']) == -1) {
            $('.toast').text('Image File Size is very big / Invalid Image File');
            $('.toast').toast('show');
          } else {
            form_data.append("pro_upload", document.getElementById('profile').files[0]);
            $.ajax({
              url: "<?= BASEURL ?>admin/pro_upload",
              method: "POST",
              data: form_data,
              contentType: false,
              cache: false,
              processData: false,
              beforeSend: function() {
                $('#pro_status').html("Image Uploading...");
              },
              success: function(data) {
                alert(data);
                $('#pro_status').html("Uploaded");
                $('#pimage').val(data);
                $('#proimg').attr('src', '<?= BASEURL ?>assets/img/' + data);
              }
            });
          }
        });
      })
    </script>

<!-- ------------------------------------------------------------------------------------------------------- -->


   


  <script>  
 $('#main_menu').change(function(){
        $("#sub_menu").find("option:gt(0)").remove();
        var m_menu=$(this).val();
         //alert(m_menu);

        $.post('<?=BASEURL?>admin/get_sub_menus', {
        'm_menu_id': m_menu
        })
        .done(function(res) {
        //  console.log(res);
        if (res.length > 0) {
             var obj = JSON.parse(res);
            $.each(obj, function(index, value) {
                // console.log(value);
                $('#sub_menu').append($("<option></option>").attr("value", value).text(value));
            });
            
        } else {
             // alert(res);
             $('#sub_cat').html('No Data Found Check recheck Category');
            
        }
    });
    });
    </script> 
   



   <?php include('footer.php') ?>