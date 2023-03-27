
<?php
session_start();
require('inc/config.php');

if(isset($_POST['register']))
{
    extract($_POST);
    $password = md5($password);
    $sql = "SELECT * FROM users WHERE email='$email'";
    $data = mysqli_query($con,$sql) or die(mysqli_error($con));

    if (mysqli_num_rows($data) > 0)
    {
       
        header("Location:register.php?msg=already_exists");
    }
    else
    {
        $sql = "INSERT INTO users(name,email,password) VALUES ('$name' , '$email' ,'$password')";
        $data = mysqli_query($con,$sql) or die(mysqli_error($con));

        if ($data)
        {
           
            header("Location:register.phpmsg=success");
        }
        else 
        {
          
            header("Location:register.php?msg=failed");
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <?php require('inc/header.php');?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 my-5">
                <?php
                if(isset($_GET['msg']) && !empty($_GET['msg']))
                {
                    if($_GET['msg'] == 'success')
                    {
                ?>
                <h5 class="alert alert-success">Registration Successful!! Please Login to your Account</h5>
                <?php
                    }
                    else if($_GET['msg'] == 'failed')
                    {
                ?>
                <h5 class="alert alert-danger">Registration failed!! Please try again</h5>
                <?php
                    }
                    else if($_GET['msg']=='already_exists')
                    {
                ?>
                <h5 class="alert alert-warning">Sorry!! This email already exists</h5>
                <?php
                    }
                  
                }
                ?>


        <div class="card">
            <div class="card-header">
                <h6>Create A New Acoount </h6>
            </div>
            <div class="card-body">
                <form method="post" autocomplete="off">
                <div class="form-group my-1">
                        <label>Enter Name</label>
                        <input type="text" class="form-control" name="name" required/>
                    </div>
                    <div class="form-group my-1">
                        <label>Enter Email</label>
                        <input type="email" class="form-control" name="email" required/>
                    </div>
                    <div class="form-group my-1">
                        <label>Enter Password</label>
                        <input type="password" class="form-control" name="password" required/>
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-success w-100" name="register" value="REGISTER"/>
                    </div>

                    <div class="form-group my-2 text-center">
                       <p> Don't Have an accout ? <a href="login.php">Login Now</a></p>
                       <p> Forget Password?<a href="#" > Reset Now</a></p>
                    </div>

                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</html>