<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_kategori'])){
	$kd=$_GET['id_kategori'];
	//$data = mysql_query("select * from kategori where id_kategori = '$kd'");

	$hapus = mysql_query("delete from kategori where id_kategori = '$kd'") or die(mysql_error());

	// $query = mysql_query('select * from kategori');
	// $data = mysql_fetch_array($query);
	if($hapus)
	{
		echo "<meta http-equiv='refresh' content='0; url=kategori.php'>";
	 }
	 }else{

	 echo "<b>Data yang dihapus tidak ada</b>";
	 }

?>