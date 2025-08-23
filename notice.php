<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>

<div class="card  w-75 mx-auto">
  <div class="card-header text-center">
    Notification from Bank
  </div>
  <div class="card-body">
    <?php
    $array = $con->query("select * from notice where userid = '$_SESSION[userid]'order by time desc ");
    if ($array->num_rows > 0) {
      while ($row = $array->fetch_assoc()) {
        echo " <div class='alert alert-info alert-dismissible d-flex align-items-center fade show '>
      	<i class='bi-info-circle-fill'></i> <strong class='mx-2'>Info!</strong>&nbsp;$row[notice]&nbsp;&nbsp;&nbsp; <a href='deleteNotice.php' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i></a></div> ";
      }
    } else
      echo "<div class='alert alert-info'>Notice box empty</div>";
    ?>
  </div>
  <div class="card-footer text-muted">
  </div>
</div>


</body>