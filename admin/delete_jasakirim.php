<?php
	session_start();
	if(!isset($_SESSION['username'])) {
		header('location:login.php'); 
	} else { 
		$username = $_SESSION['username'];
	}

include "../koneksi.php";


if(isset($_GET['id_jasa_layanan_kirim'])){
	$kd=$_GET['id_jasa_layanan_kirim'];
	//$data = mysql_query("select * from jasa_layanan_kirim where id_jasa_layanan_kirim = '$kd'");

	$hapus = mysql_query("delete from jasa_layanan_kirim where id_jasa_layanan_kirim = '$kd'") or die(mysql_error());

	// $query = mysql_query('select * from jasa_layanan_kirim');
	// $data = mysql_fetch_array($query);
	if($hapus)
	{
		echo "<meta http-equiv='refresh' content='0; url=jasa_layanan_kirim.php'>";
	 }
	 }else{

	 echo "<b>Data yang dihapus tidak ada</b>";
	 }

?>