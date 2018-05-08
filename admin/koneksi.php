<?php 
	$hostname  = "127.0.0.1:3307";
	$username  = "root";
	$password  = "";
	$dbname    = "djonosilver";
	$db = mysql_connect($hostname, $username, $password) or die ('Koneksi Gagal! ');
	mysql_select_db($dbname);
	// $koneksi=mysql_connect("localhost","root","","djonosilver");
?>