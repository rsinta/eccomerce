<?php
	//error_reporting(0);
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php');
	} else {
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_cincin'])){
	$id=$_GET['id_cincin'];
	// Hapus data sesuai Kode yang didapat di URL
	$hapus = mysql_query("delete from cincin where id_cincin = '$id'") or die(mysql_error());
	if($hapus){
		// Refresh halaman
		echo "<meta http-equiv='refresh' content='0; url=cincin.php?page=1'>";
	}
	}else{
	// Jika tidak ada data Kode ditemukan di URL
	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>