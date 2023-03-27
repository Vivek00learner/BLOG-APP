<?php

require('inc/config.php');

?>
<nav class="navbar navbar-expand-lg bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand text-dark" href="#">Blog App</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" aria-current="page" href="#">Home</a>
          </li>
      
<?php

$sql="Select * from categories";
$data = mysqli_query($con , $sql);
if(mysqli_num_rows($data)>0)
{
  while($row =mysqli_fetch_array($data))
  {
    ?>
    
    <li class="nav-item">
            <a class="nav-link text-white" href=" blog-by-category.php ? category=<?php echo $row['cat_id']; ?> "><?php echo $row['cat_name']; ?></a>
          </li>
    <?php
  }
}
?>
        </ul>
      
       <form action="search-result.php" class="d-flex" role="search">
          <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-success" type="submit">Search</button>
        </form>
        <a href="login.php"><button class="btn btn-primary mx-2" type="submit" >Login/Register</button></a>
      </div>
    </div>
  </nav>










       