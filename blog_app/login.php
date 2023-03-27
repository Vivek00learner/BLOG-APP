<?php
session_start();
require('inc/config.php');
if(isset($_POST['login']))
{
extract($_POST);
// this is for the password encryption
$password =md5($password);
$sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
$data =mysqli_query($con,$sql) or die(mysqli_error($con));
if (mysqli_num_rows($data)>0)
{
   
  $rec=mysqli_fetch_array($data);
  $_SESSION['user_id'] =$rec['user_id'];
  header("Location:dashboard.php");
}
else
{
  header("Location:login.php?msg=incorrect_credentials");
}
}
?>


<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User Login</title>
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
  if($_GET['msg']=='incorrect_credentials')
  {
    ?>
    <h5 class="alert alert-danger"> Incorrect Email or Password.</h5>
    <?php
  }
}

?>








       
        <div class="card">
            <div class="card-header">
                <h6>Registered User Login</h6>
            </div>
            <div class="card-body">
                <form method="post" autocomplete="off">
                    <div class="form-group my-1">
                        <label>Enter Email</label>
                        <input type="email" class="form-control" name="email"/>
                    </div>
                    <div class="form-group my-1">
                        <label>Enter Password</label>
                        <input type="password" class="form-control" name="password"/>
                    </div>
                    <div class="form-group my-2">
                        <input type="submit" class="btn btn-success w-100" name="login" value="LOGIN"/>
                    </div>

                    <div class="form-group my-2 text-center">
                       <p> Don't Have an accout ? <a href="register.php">Create Now</a></p>
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