
<?php
session_start();

	if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
        header("Location: index.php");
        exit;
    }

    include_once "config.php";

	$errors = array();

	if (isset($_POST) && !empty($_POST)) {
		if (!isset($_POST['username']) && empty($_POST['username'])) {
			$errors[] = "Chưa nhập username";
		}
        if (!isset($_POST['password']) && empty($_POST['password'])) {
            $errors[] = "Chưa nhập password";
        }

        if (is_array($errors) && empty($errors)) {
        	$username = $_POST['username'];
        	$password = $_POST['password'];
		}

		if (is_array($errors) && empty($errors)) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$sqlLogin = "SELECT * FROM users WHERE username = ? AND password = ?";

			//chuẩn bị cho sqlLogin

			$stmt = $connect->prepare($sqlLogin);
			// bind dữ liệu vào
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();

			$res = $stmt->get_result();

			$row = $res->fetch_array(MYSQLI_ASSOC);

			if (isset($row['id']) && ($row['id'] > 0)) {
				/*
				 * Nếu tồn tại bản ghi tạo ra 2 session để đăng nhập
				 * */

				$_SESSION['loggedin'] = true;
				$_SESSION['username'] = $row['username'];

                header("Location: index.php");
                exit;
			}else {
                $errors[] = "Dữ liệu đăng nhập không đúng";
            }

		}
	}
	if (is_array($errors) && !empty($errors)) {
        $errors_string = implode("<br>", $errors);
        echo "<div class='alert alert-danger'>";
        echo $errors_string;
        echo "</div>";
	}

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
    <div class="container" style="margin-top: 150px;">
        <div class="row">
            <div class="col-md-12">
                <h1>Đăng nhập người dùng</h1>
                <form name="login" action="" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" autocomplete="off">
                    </div>
                    <div class="form-group form-check">
                        <p><a href="register.php">Đăng ký</a></p>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
            </div>
        </div>

    </div>
</body>
</html>