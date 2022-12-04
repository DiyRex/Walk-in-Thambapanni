<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <style>
        .container{
            margin-left: 150px;
            margin-right: 150px;
        }
        .table {
            width: 120%;
        }
    </style>
</head>
<body>

<div class="container my-5">
    <h2>List of Locations</h2>
    <a href="/pages/admin/create.php" class="btn btn-primary my-3" role="button">Add Location</a>
    <br>
    <table class="table table-hover my-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            include("./config/config.php");

            // read all rows from database table
            $sql = "SELECT * FROM imagetb";
            $result = $connection->query($sql);

            if(!$result){
                die("Invalid query: ". $connection->error);
            }

            //read data from each row
            while($row = $result->fetch_assoc()){
                echo "
                <thead class='table-warning'>
                <tr>
                <td>$row[id]</td>
                <td>$row[imgname]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                    <a href='/myshop/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='/myshop/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>
            </thead>
                ";

            }
            ?>

            
        </tbody>
    </table>
</div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>