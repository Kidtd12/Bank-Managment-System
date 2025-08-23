<?php
// Start session at the very beginning of the script
session_start();

// Database connection
$con = new mysqli('localhost', 'root', '', 'habesha_bank');

// Check for database connection errors
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

// Handle login form submission
if (isset($_POST['login'])) {
  $user = $_POST['email'];
  $pass = $_POST['password'];

  // Use prepared statements to prevent SQL injection
  $stmt = $con->prepare("SELECT * FROM admin WHERE email = ? AND password = ? AND type = 'admin'");
  $stmt->bind_param("ss", $user, $pass);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $_SESSION['loginid'] = $data['id'];
    header('Location: admin_home.php');
    exit(); // Ensure no further code is executed after redirection
  } else {
    echo '<script>alert("Username or password wrong. Try again!");</script>';
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin || Habesha Bank</title>
  <link href="../Images/logo.jpeg" rel="icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="../Css/home.css" rel="stylesheet">
  <style>
  .text-center1 {
    text-align: center !important;
    color: red;
  }

  h6 {
    overflow: hidden;
    text-align: center;
  }

  h6:before,
  h6:after {
    background-color: #000;
    content: "";
    display: inline-block;
    height: 1px;
    position: relative;
    vertical-align: middle;
    width: 30%;
  }

  h6:before {
    right: 0.5em;
    margin-left: -50%;
  }

  h6:after {
    left: 0.5em;
    margin-right: -50%;
  }
  </style>
</head>

<body scroll="no" style="overflow: hidden;">
  <!-- Background Image -->
  <div class="image">
    <img src="../images/images.jpeg" alt="Habesha Bank">
  </div>

  <!-- Login Form Container -->
  <div class="container">
    <div class="row">
      <div class="col-md-4 offset-md-4 form login-form">
        <form method="POST" autocomplete="on">
          <!-- Login Title -->
          <h2 class="text-center1">Manager Login</h2>
          <p class="text-center1">Login with your email and password.</p>

          <!-- Email Input -->
          <div class="form-group">
            <input class="form-control" type="email" name="email" placeholder="Email Address" autocomplete="email"
              required value="">
          </div>

          <!-- Password Input -->
          <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Password" required>
          </div>

          <!-- Login Button -->
          <div class="form-group1">
            <input class="form-control button" type="submit" name="login" value="Login">
          </div>

          <!-- Link to User Login -->
          <br>
          <div class="link login-link text-center">
            Not a member? <a href="../login.php">User Login</a>
          </div>

          <!-- Separator -->
          <h6>or</h6>

          <!-- Cashier Login Link -->
          <center>
            <a href="../cashier.php">Cashier Login</a>
          </center>
        </form>
      </div>
    </div>
  </div>
</body>

</html>