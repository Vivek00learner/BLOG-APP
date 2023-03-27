<?php
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
                echo "File uploaded successfully";
            }
        
            else
            {
                echo "File not uploaded";
            }
        }
    
    else
    {
        echo "Please upload a file.";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload using PHP</title>
</head>
<body>
    <br><br>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="thumbnail" accept=".jpg,.png,.jpeg">
        <input type="submit" value="Upload" name="upload">
    </form>
</body>
</html>