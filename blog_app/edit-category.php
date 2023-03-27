<?php
session_start();
require('inc/config.php');

if(isset($_SESSION['user_id']))
{
    $user_id = $_SESSION['user_id'];
}
else{
    header("Location:login.php");
    exit;
}


if(isset($_GET['category']) && !empty($_GET['category']) && isset($_GET['action']) && !empty($_GET['action']))
{
    // this is for the quich remainder that we want delete or not
    if($_GET['action'] == 'edit')
    {
    $category =$_GET['category'];
   
    $sql = "select * from categories where cat_id = '$category' and user='$user_id'";
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if(mysqli_num_rows($data) > 0)
    {
    $row =mysqli_fetch_array($data);
    }
    else{
        header("Location:categories.php");
    }
}

}










if(isset($_POST['update']))
{
   $cat_name = $_POST['cat_name'];
   
    $sql="update categories set cat_name='$cat_name' where user='$user_id' and cat_id='$category'";
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($data)
    {
     echo "<script>alert('categories Updated  Successfully')</script>";
    }
   
}







?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Add Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <style>
        label
        {
           font-weight:bold;
        }
    </style>
</head>

<body>
    <?php require('inc/dashboard-header.php'); ?>
    <div class="container-fluid">
        <div class="row">
            <?php require('inc/dashboard-sidebar.php'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="col-12">
                    <div class="card my-3">
                        <div class="card-header bg-primary text-white">Edit Category</div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group my-2">
                                    <label> Category Name</label>
                                   <input type="text" name="cat_name" value ="<?php  echo $row['cat_name']?>"class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2 text-center">
                            <button type="submit" class="btn btn-primary" name="update" >UPDATE</button>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>






<div class="col-sm-12 mt-5">
<div class="card">
<div class="card-header bg-sucess text-white">
Adde Categories
</div>
<div class="card-body">

<table class="table">
<tr>
<th>#</th>
<th>Category</th>
<th>Action</th>
</tr>




<?php 
$a=1;
$sql = "SELECT * FROM categories where user='$user_id'";
$data = mysqli_query($con,$sql);
if(mysqli_num_rows($data)>0)
{
while($row = mysqli_fetch_array($data))
{
?>

<tr>
<td><?php echo $a; ?></td>
<td> <?php echo $row['cat_name']; ?></td>
<td>


<a href="categories.php?category=<?php echo $row['cat_id'];?>&action=delete" onclick="return confirm('Are you sure want to Delete ?')">

<button class="btn btn-danger btn-sm mx-2">Delete</button> </a>

</td>
<td>
 
<a href="edit-category.php?category=<?php echo $row['cat_id'];?>&action=edit">   
<button class="btn btn-info btn-sm mx-2">Edit</button>

</td>
</tr>
<?php
$a++;
}
}

?>

</table>
</div>
</div>
</div>
</main>
</div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
</body>

</html>