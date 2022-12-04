<?php 

include "config.php";

$images_sql = "SELECT * FROM imagetb ORDER BY id desc limit 1";

$result = mysqli_query($connection,$images_sql);

$row = mysqli_fetch_array($result);

$filename = $row['imgname'];
$image = $row['image'];

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="common.css">
</head>
<body>

	<!-- Image -->
	<!-- <img src="upload/<?= $filename ?>" width="300px" height="300px" > -->

	<!-- Base64 image -->
	<img src="<?= $image ?>" width="300px" height="300px"  >
</body>
</html>