<!DOCTYPE html>
<html>
<head>
<?php
	session_start();
	error_reporting(0);
	if(!isset($_SESSION['username_anggota'])) {
		header('location:../login.php');
	} else {
		$username = $_SESSION['username_anggota'];
	}
	include ('../koneksi.php');
?>
	<title>Djono Silver</title>
	<link rel="stylesheet" type="text/css" href="/djonosilver/bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="../bootstrap/js/jquery.maskMoney.min.js"></script>
	<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
	<script>
$(document).ready(function(){
    $(".close").click(function(){
        $("#myAlert").alert("close");
    });
});

</script>
</head>
<body>




	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="/djonosilver/user/index.php" class="navbar-brand">Djono Silver</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php"><span class='glyphicon glyphicon-home'></span>  Home  </a></li>
				<li><a href="cart.php"><span class='glyphicon glyphicon-shopping-cart'></span>  Cart  </a></li>
				<li><a id="pesan_sedia" href="chat.php" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan  </a></li>
				<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="edit_akun.php">Hy , <?php echo $_SESSION['username_anggota']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
				<li><a class="dropdown-toggle" role="button" href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</div>
	</div>

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notification</h4>
				</div>
				<div class="modal-body">
					<?php
					$periksa=mysql_query("SELECT * FROM barang");
					
            ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
				</div>

			</div>
		</div>
	</div>
	<div class="col-md-2">
		<div class="row">
				<div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="../img/logo.jpg">
					</a>
				</div>
		</div>
		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php echo $anggota ?>"><a href="../user/profil.php?page=1"><span class="glyphicon glyphicon-user"></span>  Profil</a></li>
			<li class="<?php echo $pemesanan ?>"><a href="../user/form_pemesanan.php?page=1"><span class="glyphicon glyphicon-briefcase"></span> Pemesanan</a></li>
			
			<li><a href="../user/riwayat_pesanan.php"><span class="glyphicon glyphicon-briefcase"></span>  Riwayat Pesanan  </a></li>
		</ul>
	</div>
	<div class="col-md-10">
