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
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">



    <title>kudvo</title>
</head>
<body>

  <div class="container">
    <button class="btn btn-primary my-5"><a href="user.php" class="text-light">Add item</a></button>

  
  <table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>

    </tr>
  </thead>
  <tbody>


  <?php
   $sql="SELECT * FROM `blog`";
   $result=mysqli_query($conn,$sql);

   if($result){
   
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
          <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light">Edit</a></button>
          <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light">Delete</a></button>
        </td>
          
        </tr>';
        
      
   }

   }
  


  ?>
  


  </tbody>
</table>

</div>
<hr>



  <script src="https://code.jquery.com/jquery-3.7.1.js"integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
  <script>$(document).ready( function () {
    $('#myTable').DataTable();
} );</script>
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
    <script>
      edits=document.getElementsByClassName('edit');
      Array.from(edits).forEach((element)=>{
      element.addEventListener("click",(e)=>{
       console.log("edit",);
         tr=e.target.parentNode.parentNode;
       title=tr.getElementsByTagName("td")[0].innerText;
       description=tr.getElementsByTagName("td")[1].innerText;
       console.log(title,description);
       titleEdit.value=title;
       descriptionEdit.value=description;
       snoEdit.value=e.target.id;
       console.log(e.target.id)
       $('#editModal').modal('toggle');
      })
      })

       deletes=document.getElementsByClassName('delete');
      Array.from(deletes).forEach((element)=>{
      element.addEventListener("click",(e)=>{
       console.log("edit",);
        sno=e.target.id.substr(1,);

       if(confirm("Are you sure you want this delete the note!")){  
        console.log("yes");
        Window.location='/CRUDOPERATION/index.php?delete=${sno}';
       }
       else
       {
        console.log("no");
       }
     
    
      })
      })
     
     </script>
    
</body>
</html>
