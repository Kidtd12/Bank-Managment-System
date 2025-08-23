<?php
session_start();
if (!isset($_SESSION['loginid'])) {
  header('location:adminLogin.php');
}
?>
<?php require '../includes/db_conn.php'; ?>
<?php

if (isset($_POST['submit'])) {


  if (!$conn->query("insert into useraccounts (name,gender,email,phoneNumber,city,address,password,profile,dob,accountNo,accountType,deposit) values('$_POST[name]','$_POST[gender]','$_POST[email]','$_POST[phonenumber]','$_POST[city]','$_POST[address]','$_POST[password]','$_POST[profile]','$_POST[dob]','$_POST[accountno]','$_POST[accounttype]','$_POST[deposit]')")) {

    echo "<div class='alert alert-success'>Failed. Error is:" . $conn->$error . "</div>";
  } else
    echo "<div class='alert alert-info text-center'>Account added Successfully</div>";
}



?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Habesha Bank</title>
  <link href="../images/logo.jpeg" rel="icon" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="../Css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top navMargin">
    <div class="container-fluid justify-content-between">
      <!-- Brand/logo -->
      <a href="./admin_home.php" class="navbar-brand">
        <img src="../images/logo1.png" width="50" alt="" class="rounded-circle">
        <b>Habesha Bank</b>
      </a>

      <!-- Toggler/collapsible Button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="./admin_home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./admin_Account.php">Accounts</a>
          </li>
          <li class="nav-item">
            <a href="./addNewAccount.php" class=" nav-link active" aria-current="page" href="#">Add new Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./admin_feedback.php">Feedback</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="../login.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>