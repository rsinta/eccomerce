<!DOCTYPE html>
<html>
<head>
<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:slogin.php');
	} else {
		$username = $_SESSION['username'];
	}
	include 'koneksi.php';
?>
	<title>Djono Silver</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
	<script type="text/javascript" src="bootstrap/js/jquery.maskMoney.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/jquery-ui/jquery-ui.js"></script>
</head>
<body>

<script>
$(document).ready(function(){
    $(".close").click(function(){
        $("#myAlert").alert("close");
    });
});

</script>

<?php
$periksa=mysql_query("select * from barang where stok <=3");
$q=mysql_fetch_array($periksa);
if($q['stok']<=3){
		?>
		<script>
			$(document).ready(function(){
				$('#pesan_sedia').css("color","red");
				$('#pesan_sedia').append(<?php $b=mysql_num_rows($periksa); echo $b; ?>);
			});
		</script>
<?php
} ?>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="/mitrajaya" class="navbar-brand">Djono Silver</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
				<li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan  </a></li>
					<li><a class="dropdown-toggle" data-toggle="dropdown" role="button" href="#">Hy , <?php echo $_SESSION['username']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a></li>
					<li><a class="dropdown-toggle" role="button" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
					$periksa=mysql_query("select * from barang where stok <=3");
					while($q=mysql_fetch_array($periksa)){
						if($q['stok']<=3){
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a> yang tersisa sudah kurang dari 3 . silahkan pesan lagi !!</div>";
						}
					}
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
						<img class="img-responsive" src="img/logo.png">
						
					</a>
				</div>
		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php echo $admin ?>"><a href="admin.php"><span class="glyphicon glyphicon-home"></span>  Admin</a></li>
			<li class="<?php echo $anggota ?>"><a href="anggota.php?page=1"><span class="glyphicon glyphicon-briefcase"></span> Anggota</a></li>
			<li class="<?php echo $barang ?>"><a href="barang.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</a></li>
			<li class="<?php echo $kategori ?>"><a href="kategori.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Data Kategori</a></li>
			<li class="<?php echo $pengrajin ?>"><a href="pengrajin.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Data Pengrajin</a></li>
			<li class="<?php echo $barang ?>"><a href="kota.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Kota</a></li>
			<li class="<?php echo $kategori ?>"><a href="provinsi.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Provinsi</a></li>
			<li class="<?php echo $pengrajin ?>"><a href="bahan.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Bahan</a></li>
			<li class="<?php echo $pengrajin ?>"><a href="cincin.php?page=1"><span class="glyphicon glyphicon-briefcase"></span>  Cincin</a></li>
			<li class="<?php echo $penjualan ?>"><a href="penjualan.php?page=1"><span class="glyphicon glyphicon-usd"></span>  Transaksi Penjualan</a></li>
			<li class="<?php echo $pembelian ?>"><a href="pembelian.php?page=1"><span class="glyphicon glyphicon-shopping-cart"></span>  Transaksi Pembelian</a></li>
			<li class="<?php echo $pemesanan ?>"><a href="pembelian.php?page=1"><span class="glyphicon glyphicon-shopping-cart"></span>  Transaksi Pemesanan</a></li>
			<li class="<?php echo $admin ?>"><a href="konfirmasi.php"><span class="glyphicon glyphicon-user"></span>  Konfirmasi</a></li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
		</ul>
	</div>
	<div class="col-md-10">
