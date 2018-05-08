<?php 
session_start();
include "../koneksi.php";
$sid = $_SESSION['id_anggota'];
 
 
//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
$sql = mysql_query("SELECT id_barang FROM keranjang WHERE id_barang='$_GET[id]' AND id_anggota='$sid'");
    $ketemu=mysql_num_rows($sql);
    if ($ketemu==0){
        // kalau barang belum ada, maka di jalankan perintah insert
        mysql_query("INSERT INTO keranjang (id_barang, jumlah, id_anggota)
                VALUES ('$_GET[id]', 1, '$sid')");
    } else {
        //  kalau barang ada, maka di jalankan perintah update
        mysql_query("UPDATE keranjang
                SET jumlah = jumlah + 1
                WHERE id_anggota ='$sid' AND id_barang='$_GET[id]'");       
    }   
    header('Location:cart.php');
 
?>