<?php
include 'connect.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />



    <title>kudvo</title>
</head>
<body>

<div class="container">
    <button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add item</a></button>

    <form action="" method="POST">
    <div class="row my-3">
        <div class="col-md-6">
            <input type="text" id="search"  name="search" class="form-control" placeholder="Search" autocomplete="off">
            <button type="submit" class="btn btn-primary">Search</button>
            <button  class="btn btn-primary">clear</button>
           
               
        </div>
        </form>

        <form action="" method="GET">
        <div class="col-md-6">
            <select id="categoryFilter" name="status" class="form-select">
                <option value="">select category</option>
                <!-- Add your categories as options -->
                <option value="php" <?= isset($_GET['status'])==true?( $_GET['status']=='php'?'selected':''):''?>>php</option>
                <option value="java"<?= isset($_GET['status'])==true? ( $_GET['status']=='java'?'selected':''):''?>>java</option>
                <option value="laravel" <?= isset($_GET['status'])==true?( $_GET['status']=='laravel'?'selected':''):''?>>laravel</option>
                <option value="seo"<?= isset($_GET['status'])==true? ( $_GET['status']=='seo'?'selected':''):''?>>seo</option>
                <!-- Add more options if needed -->
            </select>
        </div>
        <div class="col-md-4">

        <button type="submit" class="btn btn-primary">filter</button>
        <a href="" class="btn btn-danger">reset</a>
        </div>
    </div>
</form>

    <table class="table" id="myTable" >
      <!--<?= isset($_GET['status']) ? '' : 'style="display: none;"' ?>-->
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">category</th>
      <th scope="col">Actions</th>
 </tr>
  </thead>
  <tbody>

  <?php
   $sql="SELECT * FROM `blog`";
   if(isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    $sql = " SELECT * FROM `blog` WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%'";
}
elseif (isset($_GET['status']) && !empty($_GET['status'])) {

  $status = ($_GET['status']);
  $sql = "SELECT * FROM `blog` WHERE category = '$status' ";

}
   $result=mysqli_query($conn,$sql);
   if($result){
    $id = 1;
    
   while( $row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $title=$row['title'];
    $description=$row['description'];
    $category=$row['category'];
    echo '
    <tr>
          <th scope="row">'.$id.'</th>
          <td>'.$title.'</td>
          <td>'.$description.'</td>
          <td>'.$category.'</td>
          <td>
          <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Edit</a></button>
          <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
          
    </tr>'; 
   
   }}



  ?>
  


  </tbody>
</table>

</div>
<!--
 <script src="https://code.jquery.com/jquery-3.7.1.js"integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
  <script>
  $(document).ready( function () {
    $('#myTable').DataTable();
});</script>-->




   
    
</body>
</html>