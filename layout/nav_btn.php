<?php require './includes/db_conn.php'; ?>
<?php require 'includes/function.php'; ?>
<?php
$con = new mysqli('localhost', 'root', '', 'habesha_bank');

$ar = $con->query("select * from useraccounts where id = '$_SESSION[userid]'");
$userData = $ar->fetch_assoc();

?>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top navMargin">
    <a href="home.php" class="navbar-brand">
      <img src="images/logo1.png" width="50" alt="" class="rounded-circle">
      <b>Habesha Bank</b>
    </a>

    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start ">
      <div class="navbar-nav ps-5">
        <a href="home.php" class="nav-item nav-link active">Home</a>
        <a href="account.php" class="nav-item nav-link">Accounts</a>
        <a href="statement.php" class="nav-item nav-link">Account Statements</a>
        <a href="./fundTransfer.php" class="nav-item nav-link">Funds Transfer</a>
      </div>
      <div class="navbar-nav ms-auto">
        <a href="#" class="btn btn-warning" data-bs-toggle="tooltip" title="Your current Account Balance">
          Account Balance: <?php echo $userData['deposit']; ?> Birr
        </a>

        <a href="notice.php">
          <button type="button" class="nav-item nav-link notifications">
            <i class="fa fa-bell-o"></i>
          </button>
        </a>
        <button type="button" class="nav-item nav-link notifications" data-bs-toggle="modal"
          data-bs-target="#exampleModal">
          <i class="fa fa-envelope-o"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Recipient:</label>
                    <input type="text" value="manager" class="form-control" id="recipient-name" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Message:</label>
                    <textarea class="form-control" name="msg" id="message-text" required></textarea>
                  </div>
              </div>

              <?php
              if (isset($_POST['send'])) {
                if ($con->query("INSERT INTO feedback (message, userid) VALUES ('$_POST[msg]', '$_SESSION[userid]')")) {
                  echo '<script>alert("Message sent successfully")</script>';
                } else {
                  echo "<div class='alert alert-danger'>Not sent. Error: " . $con->error . "</div>";
                }
              }
              ?>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="send" class="btn btn-primary">Send message</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="nav-item dropdown">
        <a href="#" class="nav-link dropdown-toggle user-action" data-bs-toggle="dropdown">
          <img src="<?php echo isset($userData['profile']) ? $userData['profile'] : './images/default_profile.jpg'; ?>"
            width="45" height="45px" alt="Profile Picture" class="rounded-circle">
          <?php
          $con = new mysqli('localhost', 'root', '', 'habesha_bank');
          $ar = $con->query("SELECT * FROM useraccounts WHERE id = '$_SESSION[userid]'");
          $userData = $ar->fetch_assoc();
          ?>
          <?php echo $userData['name']; ?> <b class=" caret"></b>
        </a>
        <div class="dropdown-menu">
          <a href="./profile.php" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a>
          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Logout</a>
        </div>
      </div>

    </div>
  </nav>