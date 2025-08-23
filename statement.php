<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>

<div class="container-lg bg-success">
  <div class="card">
    <div class="card-header text-center">
      Transaction made against you account
    </div>
    <div class="card-body">
      <?php
      $array = $con->query("select * from transaction where userid = '$userData[id]' order by date desc");
      if ($array->num_rows > 0) {
        while ($row = $array->fetch_assoc()) {
          if ($row['action'] == 'withdraw') {
            echo "<div class='alert alert-secondary'>You withdraw Birr .$row[debit] from your account at $row[date]</div>";
          }
          if ($row['action'] == 'deposit') {
            echo "<div class='alert alert-success'>You deposit Birr .$row[credit] in your account at $row[date]</div>";
          }
          if ($row['action'] == 'deduction') {
            echo "<div class='alert alert-danger'>Deduction have been made for  Birr .$row[debit] from your account at $row[date] in case of $row[other]</div>";
          }
          if ($row['action'] == 'transfer') {
            echo "<div class='alert alert-warning'>Transfer have been made for  Birr .$row[debit] from your account at $row[date] in  account no.$row[otherAccount]</div>";
          }
        }
      }
      ?>
    </div>
    <div class="card-footer text-muted">
    </div>
  </div>

</div>
</body>

</html>