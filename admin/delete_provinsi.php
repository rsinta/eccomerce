<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_provinsi'])){
	$kd=$_GET['id_provinsi'];

	$hapus = mysql_query("delete from provinsi where id_provinsi = '$kd'") or die(mysql_error());

	if($hapus){

		echo "<meta http-equiv='refresh' content='0; url=provinsi.php'>";
	}
	}else{

	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>