<?php 
	session_start();
	if(isset($_SESSION['username'])) {
		header('location:index.php');
	};
	include ('koneksi.php');
	?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../bootstrap/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery.maskMoney.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery-ui/jquery-ui.js"></script>
	<script type= "javascript" src="../bootstrap/js/jquery-ui/jquery-ui.js"></script>
  	<style type="text/css">
		.kotak{
		margin-top:150px;
	}
	.kotak ,input_grup{
		margin-bottom : 20px;
	}
	</style>

</head>
<body>
	<div class="container">
	<?php
		if (isset($_POST['admin'])) {
			//include ('koneksi.php');
			$username	= $_POST['username'];
			$pass		= $_POST['pass'];
			
			$cekuser  = mysql_query("SELECT * FROM admin WHERE username='$username' and pass='$pass'");
			
			

			if (mysql_num_rows($cekuser)) {
				# code...
				
			$_SESSION['username'] = $username;
					header('location:index.php');
			} else {
				
					echo "<div style='margin-bottom:-55px' class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-warning-sign'></span>Username Belum Terdaftar</div>";
				
			}
		}
	?>
	<div>
		<form action="login.php" method="post">
			<div class="col-md-4 col-md-offset-4 kotak">
				<h3>Silahkan Login!</h3>
				<div class="input-grup">
				<span class="input-grup-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="text" class ="form-control" placeholder="Username" name="username">
				</div>
				<div class="input-grup">
				<span class="input-grup-addon"><span class="glyphicon glyphicon-user"></span></span>
				<input type="password" class="form-control" placeholder="Password" name="pass">
				</div>
				<input type="submit" class="btn btn-primary" value="Login" name="admin">
				<a href="index.php" class="btn btn-default pull-right"><span class="glyphicon glyphicon-index"></span> Halaman Utama</a>
			</div>
		</form>
	</div>
	</div>
</body>
</html>
