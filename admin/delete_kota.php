<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_kota'])){
	$kd=$_GET['id_kota'];
	//$data = mysql_query("select * from kot where id_kota = '$kd'");

	$hapus = mysql_query("delete from kot where id_kota = '$kd'") or die(mysql_error());

	// $query = mysql_query('select * from kot');
	// $data = mysql_fetch_array($query);
	if($hapus)
	{
		echo "<meta http-equiv='refresh' content='0; url=kot.php'>";
	 }
	 }else{

	 echo "<b>Data yang dihapus tidak ada</b>";
	 }

?>