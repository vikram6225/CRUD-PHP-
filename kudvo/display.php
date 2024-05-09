<?php
include 'connect.php';


// Retrieve unique categories from the database
$sql = "SELECT DISTINCT category FROM `blog`"; 
$results = mysqli_query($conn, $sql);
$category = array(); 

if ($results) {
    while ($row = mysqli_fetch_assoc($results)) {
        $category[] = $row['category'];
    }
} 


$records_per_page =5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $records_per_page;
 //Count total number of records
$sql_count = "SELECT COUNT(*) AS total FROM `blog`";
$result_count = mysqli_query($conn, $sql_count);
$total_records = mysqli_fetch_assoc($result_count)['total'];

 //Calculate total number of pages
$total_pages = ceil($total_records / $records_per_page);


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
    <!-- Add item -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <button class="btn btn-primary"><a href="user.php" class="text-light text-decoration-none">Add Item</a></button>
            </div>
        </div>
    </div> 

    <!-- Search -->
    <div class="container mt-5">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="search" name="search" class="form-control" placeholder="Search" autocomplete="off">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button class="btn btn-danger"><a href="display.php" class="text-light text-decoration-none">Clear</a></button>
                </div>
            </div>
        </form>
    </div>

    <!-- Dropdown -->
    <div class="container mt-5">
        <form method="GET" class="row align-items-end">
            <div class="col-md-6">
                <select id="category" class="form-select" name="status" >
                    <option value="">All Categories</option>
                    <?php foreach ($category as $categories): ?>
                        <option value="<?= $categories?>" <?php if(isset($_GET['status']) && $_GET['status'] == $categories) echo 'selected'; ?>>
                            <?= $categories ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button class="btn btn-danger"><a href="display.php" class="text-light text-decoration-none">Reset</a></button>
            </div>
        </form>
    </div>
    <br>
     <!-- 
    <div class="container mt-5">
    <form method="GET" action="">
    <label for="recordsPerPage">Records Per Page:</label>
    <select name="recordsPerPage" id="recordsPerPage">
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
    <input type="submit" class="btn btn-outline-dark btn-sm" value="Apply">
   
</form>
    </div> -->

    <!-- Table -->
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

                // Search
                if(isset($_POST['search']) && !empty($_POST['search'])) {
                    $search = $_POST['search'];
                    $sql = "SELECT * FROM `blog` WHERE title LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%'";
                }
                // Dropdown
                elseif (isset($_GET['status']) && !empty($_GET['status'])) {
                    $status = ($_GET['status']);
                    $sql = "SELECT * FROM `blog` WHERE category = '$status'";
                }
                
                
                // Add pagination
                $sql .= " LIMIT $offset, $records_per_page";

                $result = mysqli_query($conn, $sql);
              
                if($result) {
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

                              <!-- Pagination links -->
    <div class="container d-flex justify-content-end">
    <ul class="pagination">
        <?php
        $visible_pages = 3; 
        $start_page = max(1, $current_page - $visible_pages); 
        $end_page = min($total_pages, $start_page + $visible_pages - 1); 

        // Display "Previous" button 
        if ($current_page > 1) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page - 1) . '">Previous</a></li>';
        }

        // Display page link
        for ($i = $start_page; $i <= $end_page; $i++) {
            echo '<li class="page-item';
            if ($i == $current_page)
                 echo ' active';
            echo '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
        } 
        // Display "Next" button 
        if ($current_page < $total_pages) {
            echo '<li class="page-item"><a class="page-link" href="?page=' . ($current_page + 1) . '">Next</a></li>';
        }else {
            // If current page is last,
            echo '<li class="page-item disabled"><span class="page-link">Next</span></li>';
        }
        ?>
    </ul>
</div>


    <!-- Data tables -->
  <!--<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        }); 
    </script>  -->
</body>
</html>
