<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_pengrajin'])){
	$kd=$_GET['id_pengrajin'];

	$hapus = mysql_query("delete from pengrajin where id_pengrajin = '$kd'") or die(mysql_error());

	if($hapus)
	{
		echo "<meta http-equiv='refresh' content='0; url=pengrajin.php'>";
	 }
	 }else{

	 echo "<b>Data yang dihapus tidak ada</b>";
	 }


?>