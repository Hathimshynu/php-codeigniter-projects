<?php include('header.php')?>

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


	<title>Investment</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="author" content="Phoenixcoded" />
	<!-- Favicon icon -->
	<link rel="icon" href="<?=BASEURL?>assets/images/favicon.ico" type="image/x-icon">

	<!-- vendor css -->
	<link rel="stylesheet" href="<?=BASEURL?>assets/css/style.css">
	


<!-- [ auth-signin ] start -->
<section>
<?php echo validation_errors(); ?>
 <form   action="<?=BASEURL?>user/transaction"  method="POST" enctype="multipart/form-data">
 
  <div class="form-group">
    <label for="amount">Amount</label>
    <input type="text" class="form-control" name="amount"   value="<?php set_value('amount');?>" id="amount">
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
    <label for="amount">UTR</label>
    <input type="text" class="form-control" value="<?php set_value('utr');?>" name="utr" id="utr">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</section>




<!----------------------------------------------------------------------------------------------------------------- -->




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
              url: "<?= BASEURL ?>user/pro_upload",
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










<?php include('footer.php')?>