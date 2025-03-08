<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>

<section class="container-xl bg-light mb-5">
  <h1 style="text-align:center; color:#CC3300;">Your Account Information</h1>
  <div class="table-responsive">
    <br>
    <table class="table table-bordered">
      <tbody>
        <tr>
          <td>Name</td>
          <th><?php echo $userData['name'] ?></th>
          <td>Account No</td>
          <th><?php echo $userData['accountNo'] ?></th>
        </tr>
        <tr>

          <td>Current Balance</td>
          <th><?php echo $userData['deposit'] ?></th>
          <td>Account Type</td>
          <th><?php echo $userData['accountType'] ?></th>
        </tr>
        <tr>
          <td>Gender</td>
          <th><?php echo $userData['gender'] ?></th>
          <td>E-mail</td>
          <th><?php echo $userData['email'] ?></th>
        </tr>
        <tr>
          <td>City</td>
          <th><?php echo $userData['city'] ?></th>
          <td>Address</td>
          <th><?php echo $userData['address'] ?></th>
        </tr>
        <tr>
          <td>Contact Number</td>
          <th><?php echo $userData['phoneNumber'] ?></th>

          <td>Created</td>
          <th><?php echo $userData['time'] ?></th>
        </tr>

      </tbody>
    </table>
  </div>
  </div>
  </body>

  </html>