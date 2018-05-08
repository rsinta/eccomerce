<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php');
	} else {
		$username = $_SESSION['username'];
	}

include "koneksi.php";


if(isset($_GET['id_pembelian'])){
	$id=$_GET['id_pembelian'];
	// Hapus data sesuai Kode yang didapat di URL
	$sql = "CALL pem_hapus('$id')";
	$myQry = mysql_query($sql, $db) or die ("Eror hapus data".mysql_error());

	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=pembelian.php?page=1'>";
	}
	}else{
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>
