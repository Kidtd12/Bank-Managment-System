<?php
// Include the header layout
require './layout/header.php';
?>
<div class="card-body up">
  <h1 style="text-align:center; color:#CC3300;">Accounts</h1>
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Profile Picture</th>
          <th>Holder Name</th>
          <th>Account No.</th>
          <th>Gender</th>
          <th>Current Balance</th>
          <th>Account Type</th>
          <th>Contact No.</th>
          <th>Time</th>
          <th>View</th>
          <th>Send Notice</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $con = new mysqli('localhost', 'root', '', 'habesha_bank');

        // // Delete account if delete parameter is set
        if (isset($_GET['delete'])) {
          if ($con->query("DELETE FROM useraccounts WHERE id = '$_GET[delete]'")) {
            echo "<script>alert('Account deleted successfully!')</script>";
          }
        }

        // Fetch all user accounts
        $array = $con->query("SELECT * FROM useraccounts");



        if ($array->num_rows > 0) {
          $i = 0;
          while ($row = $array->fetch_assoc()) {
            $i++;
        ?>
        <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td>
            <center>
              <!-- Profile Picture -->
              <img src="<?php echo isset($row['profile']) ? $row['profile'] : '../images/default_profile.jpg'; ?>"
                alt="Profile Picture" width="80px" height="80px">
            </center>
          </td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['accountNo']; ?></td>
          <td><?php echo $row['gender']; ?></td>
          <td><?php echo $row['deposit']; ?> Birr</td>
          <td><?php echo $row['accountType']; ?></td>
          <td><?php echo $row['phoneNumber']; ?></td>
          <td><?php echo $row['time']; ?></td>
          <td>
            <a href="../view.php?id=<?php echo $row['id'] ?>" class="btn btn-success btn-sm" data-bs-toggle="tooltip"
              title="View More Info">View</a>
          </td>
          <td>
            <a href="./admin_notice.php?id=<?php echo $row['id'] ?>" class="btn btn-primary btn-sm">Send
              Notice</a>
          </td>
          <td>
            <a href="./admin_home.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm"
              data-bs-toggle="tooltip" title="Delete this account">Delete</a>
          </td>
        </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
</body>

</html>