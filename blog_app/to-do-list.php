<?php
session_start();
require('inc/config.php');

if(isset($_POST['add']))
{
   $to_do_gym = $_POST['to_do_gym'];
   $to_do_bill = $_POST['to_do_bill'];
   $to_do_book = $_POST['to_do_book'];
   $to_do_vegetable = $_POST['to_do_vegetable'];
   $to_do_food = $_POST['to_do_food'];


   $sql = "INSERT INTO `to_do_list`(`to_do_gym`, `to_do_bill`, `to_do_book`, `to_do_vegetable`, `to_do_food`) VALUES ('$to_do_gym','$to_do_bill','$to_do_book','$to_do_vegetable','$to_do_food')";
   
    // $sql="insert into categories(cat_name)
    // values('$cat_name')";
    $data=mysqli_query($con,$sql) or die(mysqli_error($con));
    if($data)
    {
     echo "<script>alert('To-do-List  added  Successfully')</script>";
    }
    else
    {
        echo "<script>alert('To-do-List not inserted')</script>";
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>To-do-list</title>
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
                        <div class="card-header bg-primary text-white">Show To-do-List</div>
                        <div class="card-body">
                            <form method="post">
                                <div class="form-group my-2">
                                    <label> Hit The Gym</label>
                                   <input type="text" name="to_do_gym" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2">
                                    <label> Pay Bill</label>
                                   <input type="text" name="to_do_bill" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2">
                                    <label> Read a Book</label>
                                   <input type="text" name="to_do_book" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2">
                                    <label> Buy Vegetables</label>
                                   <input type="text" name="to_do_vegetable" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2">
                                    <label> Prepares Food</label>
                                   <input type="text" name="to_do_food" class="form-control"  required/>
                            
                                </div>
                                <div class="form-group my-2 text-center">
                            <button type="submit" class="btn btn-primary" name="add" >Add To To-do-List</button>
                                </div>
                               
                            </form>
                        </div>
                    </div>
                </div>






<div class="col-sm-12 mt-5">
<div class="card">
<div class="card-header bg-sucess text-white">
Add TO-DO-LIST
</div>
<div class="card-body">

<table class="table">
<tr>
<th>#</th>
<th>Gym</th>
<th>Bill</th>
<th>Book</th>
<th>Vegetable</th>
<th>Food</th>
<th>Action</th>
</tr>




<?php 
$a=1;
$sql = "SELECT * FROM `to_do_list` ";
$data = mysqli_query($con,$sql);
if(mysqli_num_rows($data)>0)
{
while($row = mysqli_fetch_array($data))
{
?>

<tr>
<td><?php echo $a; ?></td>
<td> <?php echo $row['to_do_gym']; ?></td>
<td> <?php echo $row['to_do_bill']; ?></td>
<td> <?php echo $row['to_do_book']; ?></td>
<td> <?php echo $row['to_do_vegetable']; ?></td>
<td> <?php echo $row['to_do_food']; ?></td>
<td>
<button class="btn btn-danger btn-sm mx-2">Delete</button>

</td>
<td>
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