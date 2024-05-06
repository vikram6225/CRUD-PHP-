<?php

   include 'connect.php';
   if(isset($_GET['updateid'])) {
    $id = $_GET['updateid'];
   
     $sql="SELECT * FROM `blog`WHERE id='$id'";
     $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($result);
     $title=$row['title'];
     $description=$row['description'];
     $category=$row['category'];

   if(isset($_POST['submit'])){
         $title=$_POST['title'];
         $description=$_POST['description'];
         $category=$_POST['category'];

         $sql = "UPDATE `blog` SET id='$id',title='$title',description='$description',category='$category' WHERE id='$id'";


         $result=mysqli_query($conn,$sql);
         if($result){
          // echo "updated successfully";
           header('location:display.php');
         }
         else{
            die(mysqli_error($conn));
         }
   }}


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
                <input type="text" class="form-control" placeholder="enter title" name="title" autocomplete="off" value=<?php echo $title; ?>>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <input type="text" class="form-control" placeholder="enter desc" name="description" autocomplete="off" value=<?php echo $description; ?>>
            </div>
            <div class="mb-3">
                <label>category</label>
                <input type="text" class="form-control" placeholder="enter desc" name="category" autocomplete="off" value=<?php echo $category; ?>>
            </div>
            


            <button type="submit" class="btn btn-primary" name="submit">update</button>
        </form>
    </div>

</body>

</html>