<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>login | Fifera Hijab</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap" rel="stylesheet"> 
</head>
<body id="bg-login">
	<div class="box-login">
		<h2>Login</h2>
		<form action="" method="POST">
			<input type="text" name="user" placeholder="Username" class="input-control">
			<input type="password" name="pass" placeholder="Password" class="input-control">
		<li>
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">remember me</label>

		</li>
			<input type="submit" name="submit" value="Login" class="btn">
		</form>
		
		<?php 
			if(isset($_POST['submit'])){
				session_start();
				include 'db.php';

				// cek cookie v
				if( isset($_COOKIE['login']) ) {
					if( $_COOKIE['login'] == 'true' ) {
						$_SESSION['login'] = true;
					}
				}

				$user = mysqli_real_escape_string($conn, $_POST['user']);
				$pass = mysqli_real_escape_string($conn, $_POST['pass']);

				$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password = '".MD5($pass)."'");
				if(mysqli_num_rows($cek)>0){
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;

					// cek remember me
					if( isset($_POST['remember'])) {
						// Buat cookie
						setcookie('login', 'true', time() + 60);
					}
					echo '<script>window.location="dashboard.php"</script>';
				}else{
					echo '<script>alert("Username atau Password Anda Salah!")</script> ';
				}
			}
		 ?>
	</div>
</body>
</html>
