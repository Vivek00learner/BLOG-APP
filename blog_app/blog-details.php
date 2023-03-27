<?php
session_start();
require('inc/header.php');
if(isset($_GET['id']) && !empty($_GET['id']))
{
$id =$_GET['id'];
$sql = "SELECT * FROM blogs INNER JOIN categories ON blogs.blog_category = categories.cat_id where blog_id='$id'";
$data = mysqli_query($con, $sql) or die (mysqli_error($con));

if(mysqli_num_rows($data)>0)
{
  $rec= mysqli_fetch_array($data);
}
else{
     header("Location : index.php");
    exit;
}
}

else{
  header("Location : index.php");
  exit;
}
?>




<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
  
  <div class="container">
    <div class="row mt-5">
<div class="col-md-4 col-sm-12 my-2">
<img src="images/2.jpg" class="img-fluid" style ="height : 200px"/>

</div>


<div class="col-md-8 col-sm-12 my-2">
<h1 class="h3 text-primary">
   <?php  echo $rec['blog_title']?>
</h1>
<p class=" mt-3"> <?php  echo $rec['blog_shortdesc']?></p>


<p class="mt-3"> <span> <br> Author : </br><?php  echo $rec['blog_author']?></span> |  <span> <br> Post Date  : </br> <?php  echo $rec['blog_postdate']?> </span> | <span> <br> Category : </br> <?php  echo $rec['cat_name']?> </span> </p>
</div>
<div class="contanier">

<div class="row">
  <div class="col-12 mb-3">
<hr>
  </div>
  <div class="col-12 mb-5">
<?php  echo $rec['blog_desc']?>
<br>
<a href="index.php"> Back To Home</a>
  </div>
</div>

</div>

    </div>

  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>