<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_anggota'])){
	$kd=$_GET['id_anggota'];
	//$data = mysql_query("select * from anggota where id_anggota = '$kd'");

	$hapus = mysql_query("delete from anggota where id_anggota = '$kd'") or die(mysql_error());

	// $query = mysql_query('select * from anggota');
	// $data = mysql_fetch_array($query);
	if($hapus)
	{
		echo "<meta http-equiv='refresh' content='0; url=anggota.php'>";
	 }
	 }else{

	 echo "<b>Data yang dihapus tidak ada</b>";
	 }

?>