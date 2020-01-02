<?php
session_start();


if(!isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] != true)) {
	header("Location: login.php");
	exit;
}
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>Đăng nhập thành công</h1>
					<p>Tên người dùng: <?php echo $_SESSION['username']?></p>
					<p><a href="logout.php">Đăng xuất</a></p>
				</div>
			</div>
		</div>
</body>
</html>