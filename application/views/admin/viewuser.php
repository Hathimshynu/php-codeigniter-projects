<?php include('header.php') ?>



<section class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12  sm-12 lg-12">
            <div class="page-header-title">
            </div>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>

            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-12">
      <h5 class="mb-3">Basic Pills</h5>
      <div class="card">
        <div class="card-body">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-bank-tab" data-toggle="pill" href="#pills-bank" role="tab" aria-controls="pills-bank" aria-selected="false">Bank</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="pills-kyc-tab" data-toggle="pill" href="#pills-kyc" role="tab" aria-controls="pills-kyc" aria-selected="false">kyc</a>
            </li>
          </ul>

          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <p class="mb-0">
              <form method='post' action="<?= BASEURL ?>admin/userupdate" method="POST" enctype="multipart/form-data">
                <div class="row-col-md-12"> <label for="username" class="col-sm-3 col-form-label">User Id</label>
                  <div class="col-sm-9">
                    <input type="text" readonly name="user_id" class="form-control" value="<?= $aa['user_id'] ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-3 col-form-label">User Name</label>
                  <div class="col-sm-9">
                    <input type="username" class="form-control" name="username" value="<?= $aa['username'] ?>" id="username" placeholder="Username">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email" class="col-sm-3 col-form-label">Email</label>
                  <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" value="<?= $aa['email'] ?>" id="email" placeholder="Email">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" name="mobile" value="<?= $aa['mobile'] ?>" id="mobile" placeholder="Email">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="dob" class="col-sm-2 col-form-label">Date Of Birth</label>
                  <div class="col-sm-10">
                    <input type="date" name="dob" class="form-control" placeholder="select your dob" value="<?= $aa['dob'] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="pwd" class="col-sm-3 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="pwd" id="pwd" value="<?= $aa['pwd'] ?>" placeholder="Password">
                  </div>
                </div>

                <fieldset class="form-group  ">
                  <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Gender </legend>
                    <div class="col-sm-10">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if ($aa['gender'] == 'male') {
                                                                                                            echo 'checked';
                                                                                                          } ?>>
                        <label class="form-check-label" for="male"> Male </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if ($aa['gender'] == 'female') {
                                                                                                                echo 'checked';
                                                                                                              } ?>>
                        <label class="form-check-label" for="female"> Female </label>
                      </div>
                      <div class="form-check ">
                        <input class="form-check-input" type="radio" name="gender" id="others" value="male" <?php if ($aa['gender'] == 'others') {
                                                                                                              echo 'checked';
                                                                                                            } ?>>
                        <label class="form-check-label" for="others">Others</label>
                      </div>
                    </div>
                  </div>

                </fieldset>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" id="formFile" value="<?= $this->input->post('image'); ?>">
                  </div>
                </div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Enter Your Country</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="country" value="<?= $aa['country'] ?>" aria-label="Default select example">
                      <option selected>Update Your Country</option>
                      <option value="united States" name="country" id="united States" <?php if ($aa['country'] == 'united States') {
                                                                                        echo 'selected';
                                                                                      } ?>>United States </option>
                      <option value="China" name="country" id="China" <?php if ($aa['country'] == 'China') {
                                                                        echo 'selected';
                                                                      } ?>>
                        China</option>
                      <option value="Pakistan" name="country" id="Pakistan" <?php if ($aa['country'] == 'Pakistan') {
                                                                              echo 'selected';
                                                                            } ?>>Pakistan</option>
                      <option value="India" name="country" id="India" <?php if ($aa['country'] == 'India') {
                                                                        echo 'selected';
                                                                      } ?>>
                        India </option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-md-2 col-form-label">Select Your Qualification</label>
                  <div class="col-md-10">
                    <select class="form-select" name="qualification" value="<?= $aa['qualification'] ?>" aria-label="Default select example">
                      <option selected>Qualification</option>
                      <option value="s.s.l.c" name="qualification" id="s.s.l.c" <?php if ($aa['qualification'] == 's.s.l.c') {
                                                                                  echo 'selected';
                                                                                } ?>>s.s.l.c</option>
                      <option value="H.S.c" name="qualification" id="H.S.c" <?php if ($aa['qualification'] == 'H.S.c') {
                                                                              echo 'selected';
                                                                            } ?>>H.S.c</option>
                      <option value="Diplomo" name="qualification" id="Diplomo" <?php if ($aa['qualification'] == 'Diplomo') {
                                                                                  echo 'selected';
                                                                                } ?>>Diplomo</option>
                      <option value="Any Degree" name="qualification" id="Any Degree" <?php if ($aa['qualification'] == 'Any Degree') {
                                                                                        echo 'selected';
                                                                                      } ?>>Any Degree </option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="address" class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="address" style="height: 100px"><?= $aa['address']; ?></textarea>
                  </div>
                </div>




                <div class="col-sm-10">
                  <button type="submit" name="submit" class="btn  btn-primary">submit</button>
                </div>
            </div>

            </form>
            </p>

            <!-- BANK -->

            <div class="tab-pane fade" id="pills-bank" role="tabpanel" aria-labelledby="pills-bank-tab">
              <p class="mb-0">
              <form method='post' action="<?= BASEURL ?>admin/bank" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="user_id" class="col-sm-3 col-form-label">User Id</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" value="<?= $aa['user_id'] ?>" name="user_id" id="user_id" placeholder="user_id">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="username" class="col-sm-3 col-form-label">User name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $aa['username'] ?>" name="accountholder" id="username" placeholder="User name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="accountno" class="col-sm-3 col-form-label">Account No</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" value="<?= $aa['accountno'] ?>" name="accountno" id="username" placeholder="Account no">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="ifsc" class="col-sm-3 col-form-label">IFSC</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $aa['ifsc'] ?>" name="ifsc" id="ifsc" placeholder="IFSC">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bankname" class="col-sm-3 col-form-label">Bank Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $aa['bankname'] ?>" name="bankname" id="bankname" placeholder="Bank Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="branch" class="col-sm-3 col-form-label">Branch</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="branch" value="<?= $aa['branch'] ?>" id="branch" placeholder="Branch">
                  </div>
                </div>

                <div class="form-group row ">
                  <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn  btn-primary">submit</button>
                  </div>
                </div>
              </form>
              </p>
            </div>

            <!-- AADHAAR -->


            <div class="tab-pane fade" id="pills-kyc" role="tabpanel" aria-labelledby="pills-kyc-tab">
              <p class="mb-0">
              <form method='post' action="<?= BASEURL ?>admin/kyc" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" value="<?= $aa['user_id'] ?>" name="user_id" id="user_id" placeholder="user_id">
                  </div>
                </div>


                <div class="form-group row">
                  <label for="aadhar" class="col-sm-3 col-form-label">AADHAR</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" value="<?= $aa['aadhar'] ?>" name="aadhar" id="bankname" placeholder="AADHAR">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="branch" class="col-sm-3 col-form-label">Branch</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" name="pan" value="<?= $aa['pan'] ?>" id="pan" placeholder="PAN">
                  </div>
                </div>

                <div class="form-group row ">
                  <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn  btn-primary">submit</button>

                    </p>
                  </div>
                </div>
            </div>
          </div>









          <?php include('footer.php') ?>