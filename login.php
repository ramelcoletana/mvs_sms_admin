<?php
session_start();
//session_destroy();
//session_unset();
include "DAO/func_admin.php";
	if(isset($_SESSION['admin_username']) && isset($_SESSION['admin_password'])){
		header("location: index.php");
	}else{
		if(isset($_POST['login']) && isset($_POST['pass'])){
			$admin_username = $_POST['login'];
			$admin_password = $_POST['pass'];
			$validate = new func_admin();
			$adminExist = $validate->validate_admin_user($admin_username,$admin_password);
			$alertMsg = "";
			if($adminExist){
				$_SESSION['admin_username'] = $admin_username;
				$_SESSION['admin_password'] = $admin_password;
				$status = 1;
				$set = new func_admin();
				$set->setStatus($status);
				header("location: index.php");
			}else{
				$alertMsg = "invalid";
			}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pl" xml:lang="pl">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="Paweł 'kilab' Balicki - kilab.pl" />
<title>A D M I N  | L O G I N</title>
<link rel="stylesheet" type="text/css" href="css/login.css" media="screen" />
</head>
<body>
<div class="wrap">
	<div id="content">
		<div id="main">
			<div class="full_w">
				<?php
					if(isset($alertMsg)){
						echo "<div class=n_error><p>Incorrect username or password.</p></div>";
					}else{
						echo "";
					}
				?>
				<form action="" method="post">
					<label for="login">Username:</label>
					<input id="login" name="login" class="text" />
					<label for="pass">Password:</label>
					<input id="pass" name="pass" type="password" class="text" />
					<div class="sep"></div>
					<button type="submit" class="ok">Login</button> <a class="button" href="">Forgotten password?</a>
				</form>
			</div>
			<div class="footer">&raquo; <a href="">http://yourpage.com</a> | Admin Panel</div>
		</div>
	</div>
</div>

</body>
</html>
