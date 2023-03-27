<?php require('inc/config.php'); ?>

<!Doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <?php require('inc/header.php');
  ?>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center my-3">
        <h3 class="h3">Latest News</h3>
      </div> 
      <?php
      $sql = "SELECT * FROM `blogs`";
      $data = mysqli_query($con, $sql);
      if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_array($data)) {
      ?>
          <div class="col-sm-12 col-md-3 my-2">
            <div class="card">
              <img src="https://images.pexels.com/photos/270348/pexels-photo-270348.jpeg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?php echo $row['blog_title']; ?></h5>
                <p class="card-text"><?php echo $row['blog_shortdesc']; ?> <br>
                <a href="blog-details.php?id=<?php echo $row['blog_id']; ?>">Read More...</a></p>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><b>Author : </b><?php echo $row['blog_author']; ?></li>
                <li class="list-group-item"><B>Date :</b> <?php echo $row['blog_postdate']; ?></li>
              </ul>
            </div>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
  </div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>