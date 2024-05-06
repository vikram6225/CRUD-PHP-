<?php
include 'connect.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>kudvo</title>
</head>
<body>

  <div class="container">
    <button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add item</a></button>

  
  <table class="table">
  <thead>
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Functions</th>
    </tr>
  </thead>
  <tbody>


  <?php
   $sql="SELECT * FROM `blog`";
   $result=mysqli_query($conn,$sql);
   if($result){
    $id = 1;
   while( $row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $title=$row['title'];
    $description=$row['description'];
    echo '
    <tr>
          <th scope="row">'.$id.'</th>
          <td>'.$title.'</td>
          <td>'.$description.'</td>
          <td>
          <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Update</a></button>
          <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
          
        </tr>';
   $id++;
   }
   }


  ?>
 

  </tbody>
</table>

</div>
</body>
</html>