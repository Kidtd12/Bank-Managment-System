<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>
<!-- form -->
<div className="mainContainer">
  <div class="container-xxl py-5">
    <div class="row">
      <div class="mx-auto">
        <div class="bg-white rounded-lg shadow-sm p-5">

          <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">

            <li class="nav-item">

              <h5> <i class="fa fa-university fa-lg">&nbsp;Bank Transfer</i> </h5>

            </li>
          </ul>

          <div class="tab-content">


            <div id="nav-tab-card" class="tab-pane fade show active">
              <!-- php  -->

              <form role="form" method="POST">

                <div class="form-group">
                  <label for='otherAcc'>Receiver Account number</label>
                  <div class="input-group">
                    <input type="text" name="otherNo" placeholder="Enter Receiver Account number" id="otherAcc"
                      class="form-control" />
                    <div class="input-group-append">
                      <button class="btn btn-secondary" type="submit" name="get">Get Account Info</button>
                    </div>
                  </div>
                </div>
            </div>
            <?php if (isset($_POST['get'])) {
              $array2 = $con->query("select * from otheraccounts where accountno = '$_POST[otherNo]'");
              $array3 = $con->query("select * from useraccounts where accountNo = '$_POST[otherNo]'"); {
                if ($array2->num_rows > 0) {
                  $row2 = $array2->fetch_assoc();
                  echo "
                  <form method='POST'>
                  <div class='form-group'>
                  <label > Account No.  <label > 
                    <input type='text' value='$row2[accountno]' name='otherNo' class='form-control ' readonly required>
                    </div>
                    <div class='form-group'>
                    <label >  Account Holder Name.  <label > 
                    <input type='text' class='form-control' value='$row2[holdername]' readonly required>
                    </div>
                    <div class='form-group'>
                    <label>
                    Account Holder Bank Name.</label>
                    <input type='text' class='form-control' value='$row2[bankname]' readonly required>
                    </div>
                    <div class='form-group'>
                    <label>
                    Enter Amount for tranfer.</label>
                    <input type='number' name='amount' class='form-control' min='3000' max='$userData[deposit]' required>
                    </div>
                     <button type='submit'  name='transfer'class='subscribe btn btn-primary btn-block rounded-pill shadow-sm'> Transfer  </button>
                  </form>
          ";
                } elseif ($array3->num_rows > 0) {
                  $row2 = $array3->fetch_assoc();
                  echo "
                  <form method='POST'>
                  <div class='form-group'>
                  <label >Account No.</label> 
                    <input type='text' value='$row2[accountNo]' name='otherNo' class='form-control ' readonly required>
                    </div>
                    <div class='form-group'>
                 <label >Account Holder Name.</label> 
                    <input type='text' class='form-control' value='$row2[name]' readonly required>
                    </div>
                    <div class='form-group'>
                    <label > Enter Amount for tranfer.</label> 
                    <input type='number' name='amount' class='form-control' min='3000' max='$userData[deposit]' required>
                    </div>
                    <button type='submit'  name='transferSelf'class='subscribe btn btn-primary btn-block rounded-pill shadow-sm'> Transfer  </button>
                    
                  </form>
                ";
                } else
                  echo "<div class='alert alert-danger'>Account No. $_POST[otherNo] Does not exist</div>";
              }
            }
            ?>
            <br>
            <h5>Transfer History</h5>
            <?php
            if (isset($_POST['transferSelf'])) {
              $amount = $_POST['amount'];
              setBalance($amount, 'debit', $userData['accountno']);
              setBalance($amount, 'credit', $_POST['otherNo']);
              makeTransaction('transfer', $amount, $_POST['otherNo']);
              echo "<script>alert('Transfer Successfully');window.location.href='./fundTransfer.php'</script>";
            }
            if (isset($_POST['transfer'])) {
              $amount = $_POST['amount'];
              setBalance($amount, 'debit', $userData['accountno']);
              makeTransaction('transfer', $amount, $_POST['otherNo']);
              echo "<script>alert('Transfer Successfull');window.location.href='funds_transfer.php'</script>";
            }
            $array = $con->query("select * from transaction where userid = '$userData[id]' AND action = 'transfer' order by date desc");
            if ($array->num_rows > 0) {
              while ($row = $array->fetch_assoc()) {
                if ($row['action'] == 'transfer') {
                  echo "<div class='transferHistory'> <div class='alert alert-warning'>Transfer have been made for  Birr. $row[debit] from your account at $row[date] in  account no.$row[otherAccount]</div>  </div>";
                  
                 
                }
              }
            } else
              echo "<div class='alert alert-info'>You have made no transfer yet.</div>";
            ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>