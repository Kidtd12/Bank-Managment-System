<?php
// Include the header layout
require './layout/header.php';
?>
<?php require '../includes/function.php';
$con = new mysqli('localhost', 'root', '', 'habesha_bank');
?>

<?php if (isset($_GET['delete'])) {
  if ($con->query("delete from feedback where feedbackid = '$_GET[delete]'")) {
    header("location:admin_feedback.php");
  }
} ?>

<body>


  <style>
  nav ul li a.active,
  nav ul li a:hover {
    color: #111;
    background: #fff;
  }

  nav .menu-btn i {
    color: #fff;
    font-size: 22px;
    cursor: pointer;
    display: none;
  }

  input[type="checkbox"] {
    display: none;
  }

  @media (max-width: 1000px) {
    nav {
      padding: 0 40px 0 50px;
    }
  }

  @media (max-width: 920px) {
    nav .menu-btn i {
      display: block;
    }

    #click:checked~.menu-btn i:before {
      content: "\f00d";
    }

    nav ul {
      position: fixed;
      top: 80px;
      left: -100%;
      background: #111;
      height: 100vh;
      width: 100%;
      text-align: center;
      display: block;
      transition: all 0.3s ease;
    }

    #click:checked~ul {
      left: 0;
    }

    nav ul li {
      width: 100%;
      margin: 40px 0;
    }

    nav ul li a {
      width: 100%;
      margin-left: -100%;
      display: block;
      font-size: 20px;
      transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    #click:checked~ul li a {
      margin-left: 0px;
    }

    nav ul li a.active,
    nav ul li a:hover {
      background: none;
      color: cyan;
    }
  }

  .content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    z-index: -1;
    width: 100%;
    padding: 0 30px;
    color: #1b1b1b;
  }

  .content div {
    font-size: 40px;
    font-weight: 700;
  }

  dl,
  ol,
  ul {
    margin-top: 12px;
    margin-bottom: 1rem;
  }
  </style>
  <?php
  if (isset($_POST['saveAccount'])) {
    if (!$con->query("insert into login (email,password,type) values ('$_POST[email]','$_POST[password]','cashier')")) {
      echo "<div class='alert alert-success'>Failed. Error is:" . $con->error . "</div>";
    }
  }
  if (isset($_GET['del']) && !empty($_GET['del'])) {
    $con->query("delete from login where id ='$_GET[del]'");
  }
  $array = $con->query("select * from login where type='cashier'");

  ?>
  <div class="container-xl up">
    <div>
      <div class="card-header px-5">
        <h4 style="color:#CC3300;">All Staff Accounts
          <button class="btn btn-outline-danger btn-sm float-end" data-bs-toggle="modal"
            data-bs-target="#exampleModal">Add
            New
            Account</button>
      </div>
      </h4>
      <div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Email</th>
              <th>Password</th>
              <th>Account Type</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($array->num_rows > 0) {
              while ($row = $array->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td><a href='admin_Account.php?del=$row[id]' class='btn btn-danger btn-sm'>Delete</a></td>";
                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="card-footer text-muted">
      </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Cashier Account</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST">
              Enter Details
              <input class="form-control w-75 mx-auto" type="email" name="email" required placeholder="Email">
              <input class="form-control w-75 mx-auto" type="password" name="password" required placeholder="Password">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="saveAccount" class="btn btn-primary">Save Account</button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>