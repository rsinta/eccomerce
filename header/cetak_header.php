<!DOCTYPE html>
<html>
<head>
<?php
	session_start();
	error_reporting(0);
	if(!isset($_SESSION['username'])) {
		header('location:../admin/login.php');
	} else {
		$username = $_SESSION['username'];
	}
	include ('../koneksi.php');
?>
	<title>Djono Silver</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
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

<?php
$periksa=mysql_query("SELECT stok FROM barang WHERE stok<=2",0);
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
} 
?>
	

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
					$periksa=mysql_query("SELECT * FROM barang WHERE stok <=2");
					while($q=mysql_fetch_array($periksa)){
						if($q['stok']<=3){
							echo "<div style='padding:4px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Stok  <a style='color:red'>". $q['nama_barang']."</a> yang tersisa sudah kurang dari 2 . silahkan pesan lagi !!</div>";
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
						<img class="img-responsive" src="../img/logo.jpg">
					</a>
				</div>
		</div>

		</ul>
	</div>
	<div class="col-md-10">
