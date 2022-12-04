<?php

include("./config/config.php");

$name = "";
$email = "";
$phone = "";
$address = "";
$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if( empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "All the fields are required";
            break;
        }

        

        //add clients to database

        // $sql = "INSERT INTO imagetb (name, email, phone, address, imgname, image) " .
        // "VALUES ('$name', '$email', '$phone', '$address', '".$name."','".$image."')";
        // $result = $connection->query($sql);

        // upload images 

        if(isset($_POST['but_upload'])){
            $imgname = $_FILES['file']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
            // Select file type
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif");
    
            // Check extension
            if( in_array($imageFileType,$extensions_arr) ){
                
                // Upload file
                if(move_uploaded_file($_FILES['file']['tmp_name'],'upload/'.$imgname)){
                    // Convert to base64 
                    $image_base64 = base64_encode(file_get_contents('upload/'.$imgname) );
                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
        
                    // Insert record

                    $sql = "INSERT INTO imagetb (name, email, phone, address, imgname, image) " .
                    "VALUES ('$name', '$email', '$phone', '$address', '".$imgname."','".$image."')";
                    $result = $connection->query($sql);
                    unlink('upload/'.$name);
                }
    
            }
        
        }

        if(!$result){
            die("Invalid query: ". $connection->error);
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";
        $successMessage = "Client added correctly";

        header("location: /myshop/image_server/index.php");
        exit;
        
    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shop</title>
    <link rel="stylesheet" href="./styles/common.css">
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        #choose {
            margin-top: -35px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h2 class="mx-5 my-5">New Location</h2>

        <?php
            if(!empty($errorMessage)){
                echo "
                    <div class='alert alert-warning allert-dismissible fade show' role='start'>
                        <strong>$errorMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        ?>
        <form method="post" enctype='multipart/form-data'>
        
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                </div>
            </div>

            <div class="row mb-3">
            <label class="col-sm-0 col-form-label">Image</label>
                <div id="choose" class="offset-sm-3 col-sm-3 d-grid">
                    <input type='file' name='file' class="form-control form-control-md" />
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="but_upload">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
            
        </form>
    </div>

</body>

</html>