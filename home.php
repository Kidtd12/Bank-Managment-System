<?php require('./layout/header.php') ?>
<?php require('./layout/nav_btn.php') ?>


<!-- Nav btn -->
<section class="light">
  <article class="postcard light blue">
    <a class="postcard__img_link" href="#">
      <img class="postcard__img" src="images/home.jpeg" alt="Image Title" />
    </a>
    <div class="postcard__text t-dark">
      <h1 class="postcard__title blue"><a href="#">Welcome to Habesha Bank</a></h1>

      <div class="postcard__bar"></div>
      <div class="postcard__preview-txt"><b>Habesha Bank</b> is the biggest commercial bank in Ethiopia. It is a
        Private sector bank and has its headquarters in Kenya, Eritrea. It has a total of 16 regional hubs and 57
        zonal offices located at almost every city throughout Ethiopia.</div>
      <p><span class="lv">Latest Notification :</span>
        <style>
        .lv {
          font-weight: 600;
          color: #eb0202;
        }
        </style>
        <?php
        $con = new mysqli('localhost', 'root', '', 'habesha_bank');

        $array = $con->query("select * from notice where userid = '$_SESSION[userid]'order by time desc ");

        if ($array->num_rows > 0) {
          $row = $array->fetch_assoc();
          // {


          echo $row['notice'];
        }
        // }
        else
          echo "<div>Notice box empty</div>";
        ?>
      </p>
    </div>
  </article>
  </div>
</section>


</body>

</html>