<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_barang'])){
	$kd=$_GET['id_barang'];

	$hapus = mysql_query("delete from barang where id_barang = '$kd'") or die(mysql_error());
	// $mySql = "CALL bar_hapus('$kd')";
	// $myQry = mysql_query($mySql, $db) or die ("Eror hapus data".mysql_error());
	if($hapus){

		echo "<meta http-equiv='refresh' content='0; url=barang.php'>";
	}
	}else{

	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>