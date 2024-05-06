<?php

   include 'connect.php';
   if(isset($_POST['submit'])){
         $title=$_POST['title'];
         $description=$_POST['description'];

         $sql = "INSERT INTO `blog` (title, description) VALUES ('$title', '$description')";


         $result=mysqli_query($conn,$sql);
         if($result){
           // echo "data was inserted";
           header('location:display.php');
         }
         else{
            die(mysqli_error($conn));
         }
   }




?>




<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>kudv</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="mb-3">
                <label>Title</label>
                <input type="text" class="form-control" placeholder="enter title" name="title" autocomplete="off">
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="enter desc" name="description" autocomplete="off">
            </div>
            


            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>