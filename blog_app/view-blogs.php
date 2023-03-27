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


if(isset($_GET['blog']) && !empty($_GET['blog']) && isset($_GET['action']) && !empty($_GET['action']))
{
    $blog_id =$_GET['blog'];
    // this is for the quich remainder that we want delete or not
    if($_GET['action'] == 'delete')
    {
    $sql = "DELETE from blogs where blog_id = '$blog_id'";
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($data)
    {
     echo "<script>alert(' Deleted  Successfully')</script>";
     echo "<script>window.location.href='view-blogs.php'</script>";
    } 
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
                        <div class="card-header bg-primary text-white">Show Blog Post</div>
                        <div class="card-body">
                            <!-- <form method="post">
                                <div class="form-group my-2">
                                    <label> Blog POST TYPE</label>
                                   <input type="text" name="cat_name" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2 text-center">
                            <button type="submit" class="btn btn-primary" name="add" >Search Post</button>
                                </div>
                               
                            </form> -->
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
<th>Title</th>
<th>Thumbnail</th>
<th>Author</th>
<th>Category</th>
<th>Post Date</th>
<th>Action</th>
</tr>




<?php 
$a=1;
$sql = "SELECT * FROM blogs INNER JOIN categories ON blogs.blog_category = categories.cat_id 
-- where user='$user_id'
";
$data = mysqli_query($con,$sql);
if(mysqli_num_rows($data)>0)
{
while($row = mysqli_fetch_array($data))
{
?>

<tr>
<td><?php echo $a; ?></td>
<td><img src="uploads/<?php echo $row['blog_image'];?>"/></td>
<td> <?php echo $row['blog_title']; ?></td>
<td> <?php echo $row['blog_category']; ?></td>
<td> <?php echo $row['blog_author']; ?></td>
<td> <?php echo $row['blog_postdate']; ?></td>
<td>
<a href="view-blogs.php?blog=<?php echo $row['blog_id'];?>&action=delete" onclick="return confirm('Are you sure want to Delete ?')">

<button class="btn btn-danger btn-sm mx-2">Delete</button></a>

</td>
<td>
 
<a href="edit-view-blogs.php?category=<?php echo $row['cat_id'];?>&action=edit">   
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