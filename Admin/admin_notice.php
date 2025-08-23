<?php
session_start();

// Redirect to login page if session is not set
if (!isset($_SESSION['loginid'])) {
  header('location:adminLogin.php');
  exit();
}

// Database connection
$con = new mysqli('localhost', 'root', '', 'habesha_bank');

// Check for database connection errors
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Fetch user account details
$array = $con->query("SELECT * FROM useraccounts WHERE id = '" . intval($_GET['id']) . "'");
$row = $array->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Habesha Bank</title>
  <link href="./Images/logo.jpeg" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <!-- Compiled CSS from SCSS -->
  <link rel="stylesheet" href="../Css/style.css" />
</head>

<body>
  <!-- Disable F5 Key -->
  <script type="text/javascript">
  document.addEventListener("keydown", function(event) {
    if (event.keyCode === 116) { // F5 key
      event.preventDefault(); // Prevent default refresh behavior
    }
  });
  </script>

  <!-- Automatically Open Modal on Page Load -->
  <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    var modal = new bootstrap.Modal(document.getElementById('exampleModal'), {
      backdrop: 'static',
      keyboard: false
    });
    modal.show(); // Show modal on page load
  });
  </script>

  <!-- Modal for Sending Notice -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Notice to <?php echo htmlspecialchars($row['name']); ?>
          </h5>


          </a>
          <a href="./admin_home.php" class="btn text-danger fw-bold">
            <i class="bi bi-x-lg"></i>
          </a>

        </div>
        <div class="modal-body">
          <form method="POST" action="">
            <div class="mb-3">
              <input type="hidden" name="userid" value="<?php echo htmlspecialchars($row['id']); ?>">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name"
                value="<?php echo htmlspecialchars($row['name']); ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text" maxlength="50" name="notice" required></textarea>
            </div>
            <div class="modal-footer">
              <a href="./admin_home.php" class="btn btn-secondary">Close</a>

              <button type="submit" name="send" class="btn btn-primary">Send Notice</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Handle Notice Sending -->
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
    $userId = intval($_POST['userid']);
    $notice = trim($_POST['notice']);

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("INSERT INTO notice (notice, userid) VALUES (?, ?)");
    $stmt->bind_param("si", $notice, $userId);

    if ($stmt->execute()) {
      // Redirect after success without outputting HTML
      header('refresh:3; url=admin_home.php');
      exit();
    } else {
      echo "<div class='alert alert-danger' role='alert'>Not sent. Error is: " . htmlspecialchars($stmt->error) . "</div>";
    }

    $stmt->close();
  }
  ?>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>