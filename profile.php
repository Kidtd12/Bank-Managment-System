<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>

<section>
  <form method=" POST">
    <div class="container-md bg-primary">
      <h1 class="mb-3 text-light">Account Settings</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home.php" class="text-white">Home</a></li>
          <li class="breadcrumb-item active text-danger" aria-current="page">Profile</li>
        </ol>
      </nav>
      <div class="bg-white shadow rounded-lg d-block d-sm-flex">

        <div class="profile-tab-nav border-right">
          <div class="p-4">
            <div class="img-circle text-center mb-3">
              <!-- Profile Picture -->
              <img src="<?php echo isset($userData['profile']) ? $userData['profile'] : 'default-avatar.png'; ?>"
                alt="Profile Picture">

            </div>
            <h4 class="text-center"><?php echo $userData['name']; ?> </h4>
          </div>
          <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="account-tab" data-bs-toggle="pill" href="#account" role="tab"
              aria-controls="account" aria-selected="true">
              <i class="fa fa-home text-center mr-1"></i>
              Account
            </a>


          </div>
        </div>
        <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
            <h3 class="mb-4">Account Settings</h3>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value=" <?php echo $userData['name']; ?> " readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Date of Birthdate</label>
                  <input type="date" class="form-control" name="dob" value="<?php echo $userData['dob']; ?>" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="<?php echo $userData['email']; ?> "
                    readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Phone number</label>
                  <input type="text" class="form-control" name="phoneumber"
                    value="<?php echo $userData['phoneNumber']; ?> " readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Accounnt Number</label>
                  <input type="text" class="form-control" name="accountnumber"
                    value="<?php echo $userData['accountNo']; ?> " readonly>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>City</label>
                  <input type="text" class="form-control" name="city" value="<?php echo $userData['city']; ?> "
                    readonly>
                </div>
              </div>

            </div>


          </div>
        </div>
      </div>
    </div>
  </form>
</section>
<!-- style -->
<style>
.shadow {
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
}

.profile-tab-nav {
  min-width: 250px;
}

.tab-content {
  flex: 1;
}

.form-group {
  margin-bottom: 1.5rem;
}

.nav-pills a.nav-link {
  padding: 15px 20px;
  border-bottom: 1px solid #ddd;
  border-radius: 0;
  color: #333;
}

.nav-pills a.nav-link i {
  width: 20px;
}

.img-circle img {
  height: 100px;
  width: 100px;
  border-radius: 100%;
  border: 5px solid #fff;
}
</style>

</body>

</html>