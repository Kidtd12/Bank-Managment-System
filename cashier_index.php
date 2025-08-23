<?php
$con = new mysqli('localhost', 'root', '', 'habesha_bank');
session_start();
if (!isset($_SESSION['cashid'])) {
  header('location:cashier_index.php');
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Habesha Bank</title>
  <link href="./Images/logo.jpeg" rel="icon">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap 5 Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="./Css/home.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <nav>
    <div class="logo">
      <img src="images/logo.jpeg" width="45" alt="" class="logo-img">
      Habesha Bank
    </div>
    <style>
    .logo-img {
      margin-bottom: -9px;
    }
    </style>
    <input type="checkbox" id="click">
    <label for="click" class="menu-btn">
      <i class="fas fa-bars"></i>
    </label>
    <ul>


      <li><a class="active" href="./logOut.php">Logout</a></li>
    </ul>
  </nav>


  <?php require 'includes/function.php'; ?>
  <?php $note = "";
  if (isset($_POST['withdrawOther'])) {
    $accountNo = $_POST['otherNo'];
    $checkNo = $_POST['checkno'];
    $amount = $_POST['amount'];
    if (setOtherBalance($amount, 'debit', $accountNo))
      $note = '<script>alert("successfully transaction done")</script>';

    else
      $note = '<script>alert("Failed transaction ")</script>';
  }
  if (isset($_POST['withdraw'])) {
    setBalance($_POST['amount'], 'debit', $_POST['accountNo']);
    makeTransactionCashier('withdraw', $_POST['amount'], $_POST['checkno'], $_POST['userid']);
    $note = '<script>alert("successfully transaction done")</script>';
  }
  if (isset($_POST['deposit'])) {
    setBalance($_POST['amount'], 'credit', $_POST['accountNo']);
    makeTransactionCashier('deposit', $_POST['amount'], $_POST['checkno'], $_POST['userid']);
    $note = '<script>alert("successfully transaction done")</script>';
  }
  ?>
  <div className="maincontainer">
    <div class="container py-5">
      <div class="row">
        <div class=" mx-auto">
          <div class="bg-white rounded-lg shadow-sm p-5">

            <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">

              <li class="nav-item">

                <h5> <i class="fa fa-university fa-lg">&nbsp;Account Information</i> </h5>
              </li>
            </ul>
            <div class="tab-content">
              <div id="nav-tab-card" class="tab-pane fade show active">
                <!-- php  -->
                <form role="form" method="POST">
                  <div class="form-group">
                    <label> Account number</label>
                    <div class="input-group">
                      <input type="text" name="otherNo" placeholder="Enter Your Account number" class="form-control" />
                      <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit" name="get">Get Account Info</button>
                      </div>
                    </div>
                  </div>
                </form>
                <?php if (isset($_POST['get'])) {
                  $array2 = $con->query("select * from otheraccounts where accountno = '$_POST[otherNo]'");
                  $array3 = $con->query("select * from userAccounts where accountno = '$_POST[otherNo]'"); {
                    if ($array2->num_rows > 0) {
                      $row2 = $array2->fetch_assoc();
                      echo "<div class='row'>
                  <div class='col'>
                  <form method='POST'>
                    Account No.
                    <input type='text' value='$row2[accountno]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[holdername]' readonly required>
                    Account Holder Bank Name.
                    <input type='text' class='form-control' value='$row2[bankname]' readonly required>                  
                  </div>
                  <div class='col'>
                    Bank Balance
                    <input type='text' class='form-control my-1'  value='Birr.$row2[deposit]' readonly required>
                    <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount' min='3000' max='$row2[deposit]' required>
                   <button type='submit' name='withdrawOther' class='btn btn-success '> Withdraw</button></form>
                  </div>
                </div>";
                    } elseif ($array3->num_rows > 0) {
                      $row2 = $array3->fetch_assoc();
                      echo "
            <div class='row'>
                  <div class='col'>
                  
                    Account No.
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    Balance.
                    <input type='text' class='form-control my-1'  value='Birr. $row2[deposit]' readonly required>
                     
                  
                  </div>
                  <div class='col'>
                    Transaction Process.
                    <form method='POST'>
                     
                    <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
                    <input type='hidden' value='$row2[id]' name='userid' class='form-control ' required>
                    <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for withdraw'min='3000' max='$row2[deposit]' required>
                   <button type='submit' name='withdraw' class='btn btn-primary btn-bloc btn-sm my-1'> Withdraw</button></form><form method='POST'> 
                    <input type='hidden' value='$row2[accountNo]' name='accountNo' class='form-control ' required>
                    <input type='hidden' value='$row2[id]' name='userid' class='form-control ' required>
                   <input type='number' class='form-control my-1' name='checkno' placeholder='Write Check Number' required>
                    <input type='number' class='form-control my-1' name='amount' placeholder='Write Amount for deposit'  required>

                   <button type='submit' name='deposit' class='btn btn-success'> Deposit</button></form>
                  </div>
                </div>
            ";
                    } else
                      echo "<div class='alert alert-success'>Account No. $_POST[otherNo] Does not exist</div>";
                  }
                }
                ?>
              </div>