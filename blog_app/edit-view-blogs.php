<?php
session_start();

require('inc/config.php');
if(isset($_SESSION['user_id']))
{
$user_id = $_SESSION['user_id'];
}
else
{
    header("Location:login.php");
    exit;
}



if(isset($_GET['blog']) && !empty($_GET['blog']) && isset($_GET['action']) && !empty($_GET['action']))
{
    // this is for the quich remainder that we want delete or not
    if($_GET['action'] == 'edit')
    {
    $blog_id = $_GET['blog'];
     $blog_title = $_GET['title'];
    $blog_category = $_GET['category'];
    $blog_shortdesc = $_GET['short_desc'];
    $blog_desc = $_GET['desc'];
    $blog_author = $_GET['author'];
    $blog_postdate = $_GET['blog_postdate'];
    
   $sql="SELECT * FROM `blogs` WHERE blog_id = '$blog_id' and user='$user_id'";
    // $sql = "SELECT  `blog_id` ,`blog_title`, `blog_category`, `blog_shortdesc`, `blog_desc`, `blog_author`, `blog_postdate`, `user` FROM `blogs` WHERE blog_id = '$blog_id' and user='$user_id'";
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if(mysqli_num_rows($data) > 0)
    {
    $row =mysqli_fetch_array($data);
    }
    else
    {
        header("Location:view-blogs.php");
    }
}


}



if(isset($_POST['update']))
{
   echo $blog_id = $_POST['blog'];
   echo $blog_title = $_POST['title'];
   echo  $blog_category = $_POST['category'];
   echo $blog_shortdesc = $_POST['short_desc'];
   echo $blog_desc = $_POST['desc'];
   echo $blog_author =$_POST['author'];
   echo $blog_postdate = $_POST['blog_postdate']; 

    $sql = "UPDATE `blogs` SET `blog_title`='$blog_title',`blog_category`='$blog_category',`blog_shortdesc`='$blog_shortdesc',`blog_desc`='$blog_desc',`blog_author`='$blog_author',`blog_postdate`='$blog_postdate' WHERE blog_id = '$blog_id' AND user='$user_id'";

    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($data)
    {
     echo "<script>alert('blog Updated  Successfully')</script>";
    }
   
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
                        <div class="card-header bg-primary text-white">Edit Blog Post</div>
                        <div class="card-body">
                           

                        <form method="post">
                                <div class="form-group my-2">
                                <div class="form-group my-2">
                                    <label>Blog Title</label>
                                    <input type="text" class="form-control" value="<?php  echo $row['blog_title'] ; ?>" name="title" >
                                </div>


                                    <label>Blog Category</label>
                                    <input type="text" class="form-control" value="<?php echo $row['blog_category']; ?>" name="category" >  
                                    
                                </div>
                               
                                <div class="form-group my-2">
                                    <label>Blog Short Description</label>
                                    <input type="text" class="form-control" value="<?php echo $row['blog_shortdesc']; ?>" name="short_desc" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Author</label>
                                    <input type="text" class="form-control" value="<?php echo $row['blog_author']; ?>" name="author" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Post date</label>
                                    <input type="text" class="form-control" value="<?php echo $row['blog_postdate']; ?>" name="postdate" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Description</label>
                                    <textarea type="text" rows="7" class="form-control" value="<?php echo $row['blog_desc']; ?>" name="desc" ></textarea>
                                </div>
                                <div class="form-group my-2 text-center">
                                    <button type="submit" class="btn btn-primary" name="update">EDIT BLOG POST</button>
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
<th>Title</th>
<th> blog-shortdesc</th>
<th>Author</th>
<th>Category</th>
<th>Post Date</th>
<th>Action</th>
</tr>




<?php 
$a=1;
$sql = "SELECT * FROM blogs INNER JOIN categories ON blogs.blog_category = categories.cat_id 

";
$data = mysqli_query($con,$sql);
if(mysqli_num_rows($data)>0)
{
while($row = mysqli_fetch_array($data))
{
?>

<tr>
<td><?php echo $a; ?></td>
<td> <?php echo $row['blog_title']; ?></td>
<td> <?php echo $row['blog_shortdesc']; ?></td>
<td> <?php echo $row['blog_category']; ?></td>
<td> <?php echo $row['blog_author']; ?></td>
<td> <?php echo $row['blog_postdate']; ?></td>
<td>
<a href="view-blogs.php?blog=<?php echo $row['blog_id'];?>&action=delete" onclick="return confirm('Are you sure want to Delete ?')">

<button class="btn btn-danger btn-sm mx-2">Delete</button></a>

</td>
<td>
 
<a href="edit-view-blogs.php?blog=<?php echo $row['blog_id'];?><&action=edit">   
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