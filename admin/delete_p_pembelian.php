<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "koneksi.php";

$kd=mysql_real_escape_string($_GET['id_pembelian']);

if(isset($_GET['id'])){
	$id=$_GET['id'];
	$jml=$_GET['jumlah'];
	$kodebar=$_GET['id_barang'];
	// Hapus data sesuai Kode yang didapat di URL
	$mySql = "CALL pem_p_delete('$id')";

	$myQry = mysql_query($mySql, $db) or die ("Eror hapus data".mysql_error());

	if($myQry){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=p_pembelian.php?id_pembelian=$kd'>";
	}
	}else{
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>