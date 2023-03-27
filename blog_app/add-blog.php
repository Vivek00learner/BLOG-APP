
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


if(isset($_POST['add']))
{
    $category=$_POST['category'];
    $title=$_POST['title'];
    $short_desc=$_POST['short_desc'];
    $author=$_POST['author'];
    $desc=mysqli_real_escape_string($con,$_POST['desc']);
    $date=date('Y-m-d');

    if(isset($_POST['upload']))
    {
    if(isset($_FILES['thumbnail']['name']) && !empty($_FILES['thumbnail']['name']))
    {
        $upload=1;
        $upload_dir="uploads/";
        $uploaded_file=$upload_dir.basename($_FILES['thumbnail']['name']);
        $uploaded_file_extension=strtolower(pathinfo($uploaded_file,PATHINFO_EXTENSION));
        $file_size=($_FILES['thumbnail']['size']/1024);
        if($file_size>1024)
        {
            echo "File size is greater than 1 MB";
            $upload=0;
        }
        if($uploaded_file_extension=="jpg" || $uploaded_file_extension=="jpeg" || $uploaded_file_extension=="png")
        {
           
        }
        else
        {
            echo "Invalid file format, Please upload a jpg/jpeg or png file only";
            $upload=0;
        }



        
        if($upload==1)
        {
            if(move_uploaded_file($_FILES['thumbnail']['tmp_name'],$uploaded_file))
            {
                // echo "File uploaded successfully";

                $sql="insert into blogs(blog_title,blog_category,blog_shortdesc,blog_desc,blog_author,blog_postdate,user,blog_image)
                values('$title','$category','$short_desc','$desc','$author','$date','$user_id','$filename')";
                $data=mysqli_query($con,$sql) or die(mysqli_error($con));
                if($data)
                {
                 echo "<script>alert('Blog Added Successfully')</script>";
                }
                else
                {
                echo "<script>alert('Failed to add Blog post')</script>";
                }
               
            }
        
            else
            {
                echo "File not uploaded";
            }
        }
    }
}

    else
    {
        echo "Please upload a file.";
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
                        <div class="card-header bg-primary text-white">Add Blog Post</div>
                        <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group my-2">
                                    <label>Blog Category</label>
                                    <select class="form-control" name="category" >
                                        <option value="">-Select Category-</option>
                                        <?php
                                        $sql = "select * from categories where user='$user_id'";
                                        $data=mysqli_query($con,$sql);
                                        if(mysqli_num_rows($data)>0)
                                        {
                                            while($row = mysqli_fetch_array($data))
                                            {
                                                ?>
                                                <option value="<?php echo $row['cat_id'];?>"><?php echo $row['cat_name'];?></option>";
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Title</label>
                                    <input type="text" class="form-control" name="title" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Short Description</label>
                                    <input type="text" class="form-control" name="short_desc" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Author</label>
                                    <input type="text" class="form-control" name="author" >
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Description</label>
                                    <textarea type="text" rows="7" class="form-control" name="desc" ></textarea>
                                </div>
                                <div class="form-group my-2">
                                    <label>Blog Thumbnail Image</label>
                                    <input type="file" name="thumbnail" accept=".jpg,.png,.jpeg">
                                     <input type="submit" value="Upload" name="upload">
                                   
                                </div>
                                <div class="form-group my-2 text-center">
                                    <button type="submit" class="btn btn-primary" name="add">ADD BLOG POST</button>
                                </div>
                            </form>
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