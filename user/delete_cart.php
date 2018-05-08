<?php
	include '../koneksi.php';
    include "../header/header_anggota.php";



if(isset($_GET['id_keranjang'])){
	$kd=$_GET['id_keranjang'];

	$hapus = mysql_query("delete from keranjang where id_keranjang = '$kd'") or die(mysql_error());

	if($hapus){

		echo "<meta http-equiv='refresh' content='0; url=cart.php'>";
	}
	}else{

	echo "<b>Data yang dihapus tidak ada</b>";
	}

?>