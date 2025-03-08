<?php
// Include the header layout
require './layout/header.php';
?>

<!-- Main Content -->
<div class="container-xl">
  <!-- Form Container -->
  <div class="row justify-content-center form2">
    <div class="col-md-8">
      <div class="card">
        <!-- Card Header -->
        <div class="card-header bg-primary text-white">
          <h4 class="card-title text-uppercase text-center">New Account Form</h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          <form id="needs-validation" method="POST" novalidate>
            <!-- Row 1: Name and Profile Picture -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" id="name" name="name" pattern="[A-Za-z\s]+" placeholder="Enter Your Name"
                    class="form-control" required />
                  <div class="invalid-feedback">
                    Please Enter Your Full Name.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="validatedCustomFile" class="form-label">Profile Picture</label>
                  <input type="file" name="profile" class="form-control" id="validatedCustomFile" required />
                  <div class="invalid-feedback">
                    Choose file for upload.
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 2: Gender and Email Address -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="gender" class="form-label">Gender</label>
                  <select name="gender" id="gender" class="form-select" required>
                    <option value="">Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                  <div class="invalid-feedback">
                    Please choose gender.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email" class="form-label">Email Address</label>
                  <input type="email" name="email" id="email" class="form-control" pattern="^[a-zA-Z0-9]+@gmail\.com$"
                    placeholder="Email Address" required />
                  <div class="invalid-feedback">
                    Please provide a valid email.
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 3: Mobile Number and Password -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="phonenumber" class="form-label">Mobile Number</label>
                  <input type="number" name="phonenumber" id="phonenumber" pattern="[6789][0-9]{9}" class="form-control"
                    maxlength="10" placeholder="Mobile Number" required />
                  <div class="invalid-feedback">
                    Please enter a valid mobile number.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" maxlength="10" id="password"
                    placeholder="Enter Your Password" required />
                  <div class="invalid-feedback">
                    Please enter a password.
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 4: City and Address -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="city" class="form-label">City</label>
                  <input type="text" name="city" id="city" class="form-control" placeholder="Enter Your City"
                    required />
                  <div class="invalid-feedback">
                    Please Enter Your City.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" name="address" id="address" class="form-control" maxlength="50"
                    placeholder="Enter Your Address" required />
                  <div class="invalid-feedback">
                    Please provide a valid Address.
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 5: Deposit and Date Of Birth -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="deposit" class="form-label">Deposit</label>
                  <input type="number" name="deposit" id="deposit" class="form-control" min="3000" max="100000"
                    required />
                  <div class="invalid-feedback">
                    Minimum amount Rs 3000 and Maximum amount Rs 100000.
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="dob" class="form-label">Date Of Birth</label>
                  <input type="date" name="dob" id="dob" class="form-control" required />
                  <div class="invalid-feedback">
                    Please select your date of birth.
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 6: Account Number and Account Type -->
            <div class="row g-3">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="accountNo" class="form-label">Account Number</label>
                  <input type="text" name="accountno" id="accountNo" readonly value="<?php echo time(); ?>"
                    class="form-control" required />
                </div>
              </div>

              <div class="col-md-6">
                <div class="mb-3">
                  <label for="accounttype" class="form-label">Account Type</label>
                  <select name="accounttype" id="accounttype" class="form-select" required>
                    <option value="Saving">Saving</option>
                    <option value="student">Student</option>
                    <option value="children">Children</option>
                    <option value="women">Women</option>
                    <option value="interestFree">Interest Free</option>
                  </select>
                </div>
              </div>
            </div>

            <!-- Row 7: Action Buttons -->
            <div class="row mt-4">
              <div class="col-12 text-end">
                <a href="./admin_home.php" class="btn btn-danger rounded-0">Cancel</a>
                <button class="btn btn-primary rounded-0" name="submit" id="submit" type="submit">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>