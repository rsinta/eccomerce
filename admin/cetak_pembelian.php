<?php
include "koneksi.php";
require ('pembelian.php');

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
$pdf->Cell(0,5,'Alamat :  - Yogayakrta','0','1','C',false);
$pdf->Cell(0,5,'Telp :  - Website : www.djonosilver.com','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(277,0.7,'','0','1','C',true);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',14);
$pdf->Cell(50,5,'Laporan Pembelian Barang','0','1','L',false);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',13);
$pdf->Cell(0,5,"Periode ".date('d-F-Y',strtotime($sebelum))." s/d ".date('d-F-Y',strtotime($sekarang)),'0','1','C',false);
$pdf->Ln(5);

$pdf->SetFillColor(191,191,191);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->Cell(30,8,'Kode Pembelian',1,0,'C',1);
$pdf->Cell(45,8,'Pengrajin',1,0,'C',1);
$pdf->Cell(30,8,'TGL Pembelian',1,0,'C',1);
$pdf->Cell(85,8,'Nama Barang',1,0,'C',1);
$pdf->Cell(15,8,'Jumlah',1,0,'C',1);
$pdf->Cell(30,8,'Harga Beli',1,0,'C',1);
$pdf->Cell(33,8,'Sub Total',1,0,'C',1);
$pdf->Ln(2);


$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_masuk, '%d-%b-%Y') as tgl_masuk FROM pembelian WHERE tgl_pem BETWEEN '$sebelum' and '$sekarang' ");

$no=0;
$total=0;
while($row = mysql_fetch_array($brg)){
    $Sql = "SELECT * FROM barang, pengrajin WHERE barang.id_barang='$row[id_barang]' AND pengrajin.id_pengrajin='$row[id_pengrajin]'";
    $Qry = mysql_query($Sql, $db) or die ("Gagal Query".mysql_error());
    $c =mysql_fetch_array($Qry);

$no++;
$pdf->Ln(6);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,$no,1,0,'C');
$pdf->Cell(30,6,$row['id_pembelian'],1,0,'C');
$pdf->Cell(45,6,$c['nama_pengrajin'],1,0,'L');
$pdf->Cell(30,6,$row['tgl_masuk'],1,0,'C');
$pdf->Cell(85,6,$c['nama_barang'],1,0,'L');
$pdf->Cell(15,6,$row['jumlah'],1,0,'C');
$pdf->Cell(30,6,"Rp. ".number_format($row['harga_beli']),1,0,'R');
$pdf->Cell(33,6,"Rp. ".number_format($hasil=$row['jumlah']*$row['harga_beli']),1,0,'R',1);
$total+=$hasil;
}
$pdf->Ln(6);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(245,6,'Total',1,0,'C',1);
$pdf->Cell(33,6,"Rp. ". number_format($total),1,0,'R',1);
$pdf->Output();
?>