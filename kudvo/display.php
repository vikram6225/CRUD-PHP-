<?php
include 'connect.php';

//---data retrieve from db in dropdown 
$sql = "SELECT DISTINCT category FROM `blog`"; 
$results = mysqli_query($conn, $sql);
$category = array(); 

if ($results) {
    while ($row = mysqli_fetch_assoc($results)) {
        $category[] = $row['category'];
    }
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.dataTables.css" />
    <title>kudvo</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary"><a href="user.php" class="text-light text-decoration-none">Add Item</a></button>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button class="btn btn-danger"><a href="display.php"  class="text-light text-decoration-none">Clear</a></button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-5">
    <form method="GET" class="row align-items-end">
        <div class="col-md-6">
            <select id="category" class="form-select" name="status" >
                <option value="" >All Categories</option>
                <?php foreach ($category as $categories): ?>
                <option value="<?= $categories?>" <?php if(isset($_GET['status']) && $_GET['status'] == $categories) echo 'selected'; ?>>
                        <?= $categories ?>
                    </option>
                    <?php endforeach; ?>
                  
               
            </select>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button   class="btn btn-danger"><a href="display.php"  class="text-light text-decoration-none">Reset</a></button>
        </div>
    </form>
</div>

<br>

    <div class="container">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `blog`";
                if(isset($_POST['search']) && !empty($_POST['search'])) {
                    $search = $_POST['search'];
                    $sql = "SELECT * FROM `blog` WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%'";
                }
                elseif (isset($_GET['status']) && !empty($_GET['status'])) {
                    $status = ($_GET['status']);
                    $sql = "SELECT * FROM `blog` WHERE category = '$status'";

                   
                   
                }
                $result = mysqli_query($conn, $sql);
                $id =0;
                if($result) {
                    $id += 1;
                    while($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $category = $row['category'];
                        echo '
                        <tr>
                            <th scope="row">'.$id.'</th>
                            <td>'.$title.'</td>
                            <td>'.$description.'</td>
                            <td>'.$category.'</td>
                            <td>
                                <button class="btn btn-primary"><a href="update.php?updateid='.$id.'" class="text-light text-decoration-none">Edit</a></button>
                                <button class="btn btn-danger"><a href="delete.php?deleteid='.$id.'" class="text-light text-decoration-none">Delete</a></button>
                            </td>
                        </tr>'; 
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        }); 
    </script>
    

</body>
</html>
