<?php
include "koneksi.php";
require ('bootstrap/pdf/fpdf.php');

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
$pdf->Cell(50,5,'Data Barang','0','1','L',false);
$pdf->Ln(5);

$pdf->SetFont('Arial','B',13);
$pdf->Ln(5);

$pdf->SetFillColor(191,191,191);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->Cell(20,8,'Kode Barang',1,0,'C',1);
$pdf->Cell(30,8,'Pengrajin',1,0,'C',1);
$pdf->Cell(65,8,'Nama Barang',1,0,'C',1);
$pdf->Cell(40,8,'Kategori',1,0,'C',1);
$pdf->Cell(15,8,'Satuan',1,0,'C',1);
$pdf->Cell(25,8,'Harga Beli',1,0,'C',1);
$pdf->Cell(25,8,'Harga Jual',1,0,'C',1);
$pdf->Cell(13,8,'Stok',1,0,'C',1);
$pdf->Cell(35,8,'Keterangan',1,0,'C',1);
$pdf->Ln(2);


$brg=mysql_query("SELECT * FROM barang order by nama_barang ASC");

$no=0;

while($row = mysql_fetch_array($brg)){
	$sqlkate=mysql_query("SELECT * FROM kategori WHERE id_kategori='$row[id_kategori]'",$db);
	$kdkate=mysql_fetch_array($sqlkate);
	$sqlsupp=mysql_query("SELECT * FROM pengrajin WHERE id_pengrajin='$row[id_pengrajin]'");
	$kdsupp=mysql_fetch_array($sqlsupp);

$no++;
$pdf->Ln(6);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,6,$no,1,0,'C');
$pdf->Cell(20,6,$row['id_barang'],1,0,'C');
$pdf->Cell(30,6,$kdsupp['nama_pengrajin'],1,0,'L');
$pdf->Cell(65,6,$row['nama_barang'],1,0,'L');
$pdf->Cell(40,6,$kdkate['nama_kategori'],1,0,'L');
$pdf->Cell(15,6,$row['harga_satuan'],1,0,'C');
$pdf->Cell(25,6,"Rp. ".number_format($row['harga_beli']),1,0,'R');
$pdf->Cell(25,6,"Rp. ".number_format($row['harga_barang']),1,0,'R');
$pdf->Cell(13,6,$row['stok'],1,0,'C',1);
$pdf->Cell(35,6,$row['keterangan'],1,0,'R',1);

}
$pdf->Output();
?>