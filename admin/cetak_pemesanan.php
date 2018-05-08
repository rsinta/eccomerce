<?php
include "koneksi.php";
require ('pemesanan.php');

$sebelum=$_GET['tglsebelum'];
$sekarang=$_GET['tglsekarang'];

//Create a new PDF file
$pdf = new FPDF('L','mm',array(210,297)); //L For Landscape / P For Portrait
$pdf->AddPage();

//Menambahkan Gambar
//$pdf->Image('../foto/logo.png',10,10,-175);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,7,'Djono Silver','0','1','C',false);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,'Alamat  - Yogayakrta','0','1','C',false);
$pdf->Cell(0,5,'Telp - Website : www.djonosilver.com','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(277,0.7,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(50,5,'Laporan Penjualan Barang','0','1','L',false);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,5,"Periode ".date('d-F-Y',strtotime($sebelum))." s/d ".date('d-F-Y',strtotime($sekarang)),'0','1','C',false);
$pdf->Ln(5);

$pdf->SetFillColor(191,191,191);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->Cell(25,8,'KD Pembelian',1,0,'C',1);
$pdf->Cell(24,8,'Pelanggan',1,0,'C',1);
$pdf->Cell(26,8,'TGL Penjualan',1,0,'C',1);
$pdf->Cell(73,8,'Nama Barang',1,0,'C',1);
$pdf->Cell(10,8,'Jml',1,0,'C',1);
$pdf->Cell(25,8,'Harga Beli',1,0,'C',1);
$pdf->Cell(25,8,'Harga Jual',1,0,'C',1);
$pdf->Cell(30,8,'Total Beli',1,0,'C',1);
$pdf->Cell(30,8,'Total Jual',1,0,'C',1);
$pdf->Ln(2);


$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_pemesanan, '%d-%b-%Y') as tgl_pemesanan FROM pemesanan, detail_pemesanan WHERE pemesanan.id_pemesanan=detail_pemesanan.id_pemesanan AND (tgl_pemesanan BETWEEN '$sebelum' and '$sekarang')");

$no=0;
$totalbel=0;
$totaljul=0;
$totaldiskon=0;
while($row = mysql_fetch_array($brg)){
    $Sql = "SELECT * FROM barang, anggota WHERE barang.id_barang='$row[id_barang]' AND anggota.id_anggota='$row[id_anggota]'";
    $Qry = mysql_query($Sql, $db) or die ("Gagal Query".mysql_error());
    $c =mysql_fetch_array($Qry);

$no++;
$pdf->Ln(6);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,$no,1,0,'C');
$pdf->Cell(25,6,$row['id_pemesanan'],1,0,'C');
$pdf->Cell(24,6,$c['nama_anggota'],1,0,'L');
$pdf->Cell(26,6,$row['tgl_pemesanan'],1,0,'C');
$pdf->Cell(26,6,$row['tgl_pelunasan'],1,0,'C');
$pdf->Cell(26,6,$row['tgl_selesai'],1,0,'C');
$pdf->Cell(73,6,$c['nama_barang'],1,0,'L');
$pdf->Cell(10,6,$row['jumlah'],1,0,'C');
$pdf->Cell(25,6,"Rp. ".number_format($row['estimasi_harga']),1,0,'R');
$pdf->Cell(25,6,"Rp. ".number_format($row['DP']),1,0,'R');
$pdf->Cell(10,6,"Rp.".number_format($row['total_berat']),1,0,'C');
$pdf->Cell(30,6,"Rp. ". number_format($hasilbel=$row['jumlah']*$c['estimasi_harga']),1,0,'R',1);
//$pdf->Cell(30,6,"Rp. ". number_format($pelunasan=$row['estimasi_harga']-$c['DP']),1,0,'R',1);

		$totalbel+=$hasilbel;
		//$totaljul+=$pelunasan;

}
	$hitungdis=mysql_query("SELECT * FROM pemesanan WHERE tgl_pemesanan BETWEEN '$sebelum' AND '$sekarang'",$db);
	while($dis=mysql_fetch_array($hitungdis)){
	$totaldiskon+=$dis['diskon'];
	}

$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(218,6,'Total',1,0,'C',1);
$pdf->Cell(30,6,"Rp. ". number_format($totalbel),1,0,'R',1);
$pdf->Cell(30,6,"Rp.". number_format($totaljul),1,0,'R',1);

$pdf->Ln(10);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(100,6,"Total Potongan = Rp. ".number_format($totaldiskon),1,0,'L',1);

$pdf->Ln();
$pdf->Cell(100,6,"Laba = (Total jual - Potongan Harga) - Total Beli ",1,0,'L',1);
$pdf->Ln();
$pdf->Cell(100,6,"Laba = ( Rp. ".number_format($totaljul)." - Rp. ".number_format($totaldiskon)." ) - Rp. ".number_format($totalbel),1,0,'L',1);
$pdf->Ln();
$pdf->Cell(100,6,"Keuntungan = Rp. ".number_format(($totaljul-$totaldiskon)-$totalbel),1,0,'L',1);
$pdf->Output();
?>