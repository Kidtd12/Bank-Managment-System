<?php require '../includes/db_conn.php'; ?>
<?php
// Include the header layout
require './layout/header.php';
?>

<div class="container-md form2">
  <div class="card w-100 text-center">
    <div class="card-header">
      <h4 style="text-align:center; color:#CC3300;">Feedback from Account Holder</h4>
    </div>
    <div class="card-body">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th scope="col">From</th>
            <th scope="col">Account No.</th>
            <th scope="col">Contact</th>
            <th scope="col">Message</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          $con = new mysqli('localhost', 'root', '', 'habesha_bank');

          $array = $con->query("SELECT * FROM useraccounts, feedback WHERE useraccounts.id = feedback.userid");

          if ($array->num_rows > 0) {
            while ($row = $array->fetch_assoc()) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['name']) . "</td>";
              echo "<td>" . htmlspecialchars($row['accountNo']) . "</td>";
              echo "<td>" . htmlspecialchars($row['phoneNumber']) . "</td>";
              echo "<td>" . htmlspecialchars($row['message']) . "</td>";
              echo "<td><a href='admin_feedback.php?delete=" . htmlspecialchars($row['feedbackid']) . "' class='btn btn-danger btn-sm' data-toggle='tooltip' title='Delete this Message'>Delete</a></td>";
              echo "</tr>";
            }
          }
          ?>
        </tbody>
      </table>
    </div>
    <div class="card-footer text-muted"></div>
  </div>
</div>
</body>

</html>