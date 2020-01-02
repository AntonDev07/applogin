<?php
session_start();
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

<?php
include_once "config.php";
 if (isset($_POST) && !empty($_POST)) {
 	$errors = array();


 	if (!isset($_POST['username']) || empty($_POST['username'])) {
 		$errors[] = "Username không hợp lệ";
	}
	if (!isset($_POST['password']) || empty($_POST['password'])) {
 		$errors[] = "Password không hợp lệ";
	}
	if (!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
 		$errors[] = "Confirm_password không hợp lệ";
	}
	if ($_POST['confirm_password'] !== $_POST['password']) {
		$errors[] = "Confirm password và password không khớp nhau";
	}

	if (empty($errors)) {
		/*
		 Nếu không có lỗi thì insert vào csdl
		 * */
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$created_at = date("Y-m-d H:i:s");

		$sqlInsert = "INSERT INTO users (username, password, created_at) VALUES (?,?,?)";
		//Chuẩn bị cho sqlInsert
        $stmt = $connect->prepare($sqlInsert);
		// Bind 3 biến dữ liệu vào;
		$stmt->bind_param("sss",$username,$password,$created_at);
		$stmt->execute();
		$stmt->close();


        echo "<div class='alert alert-success'>";
        echo "Đăng ký thành công. Hãy <a href='login.php'>đăng nhập</a> nào";
        echo "</div>";
	}
	else {
		$errors_string = implode("<br>", $errors);
		echo "<div class='alert alert-danger'>";
		echo $errors_string;
		echo "</div>";
	}
 }


?>

<div class="container" style="margin-top: 150px;">
	<div class="row">
		<div class="col-md-12">
			<h1>Đăng ký người dùng</h1>
			<form name="register" action="" method="post">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="username" autocomplete="off" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" autocomplete="off" placeholder="Enter Password">
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" class="form-control" name="confirm_password" placeholder="Enter Password">
				</div>

				<button type="submit" class="btn btn-primary">Đăng ký</button>
			</form>
		</div>
	</div>

</div>
</body>
</html>