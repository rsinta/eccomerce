<?php
	include '../koneksi.php';
    include "../header/header_anggota.php";

	$isikeranjang = array();
	$qtybarang = array();
    $harga_barang = array();

	$sid = $_SESSION['id_anggota'];
	$sql = mysql_query("SELECT * FROM keranjang, barang WHERE id_anggota='$sid' AND keranjang.id_barang=barang.id_barang") or die(mysql_error());
    while ($r = mysql_fetch_array($sql)) {
        $isikeranjang[] = $r['id_barang'];
        $qtybarang[] = $r['jumlah'];
        $harga_barang[] = $r['harga_barang'];
    }

    $n = count($isikeranjang);
    $subtotal = array();
    $total = 0;

    for ($i=0; $i < $n; $i++) { 
        $subtotal[$i] =  $harga_barang[$i] * $qtybarang[$i].'<br/>';
        $total = $total + $subtotal[$i];
    }
    
    $query = mysql_query("SELECT max(id_penjualan) as maxKode from penjualan") or die(mysql_error());
    $data1 = mysql_fetch_array($query);
    $penj = $data1['maxKode'];
    $noUrut = (int) substr($penj,3,3);
    $noUrut++;
    $char = "PNJ";
    $newID = $char. sprintf("%03s",$noUrut);

    $tgl_skrg = date("Y-m-d h:m:s");
    mysql_query("INSERT INTO penjualan(id_penjualan, id_anggota, total_bayar, tgl_pembelian) VALUES ($newID,'$sid','$total','$tgl_skrg')");

    // get id penjualan
    $id_penjualan = mysql_insert_id();

    for ($i=0; $i < $n ; $i++) { 
    	mysql_query("INSERT INTO detail_penjualan(id_penjualan, id_barang, jumlah_beli) VALUES ('$id_penjualan','$isikeranjang[$i]', '$qtybarang[$i]')") or die(mysql_error());
    }

    mysql_query("DELETE FROM keranjang WHERE id_anggota='$sid'");
    
    header('Location:riwayat_pesanan.php');  
?>