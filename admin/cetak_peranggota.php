<?php
	include "koneksi.php";
	require ('anggota.php');

	$kd=$_GET['id_penjualan'];
	$id=$_GET['id_anggota'];
	$tgl=$_GET['tgl_penjualan'];

	//create new PDF file

	$pdf = new FPDF('P','nm',array(185,297)); //L for landscape / P for Potrait
	$pdf->Addpage();

	//Menambahkan gambar
	//$pdf->image('.../foto');

	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,7,'Djono Silver','0','1','C',false);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,5,'Alamat','0','1','C',true);
	$pdf->Cell(0,5,'Telp : - Website: www.djonosilver.com','0','1','C',false);
	$pdf->Ln(3);
	$pdf->Cell(165,0.7,'','0','1','C',true);
	$pdf->Ln(5);

	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(50,5,'Nota Pembelian Pelanggan','0','1','L',false);
	$pdf->Ln(3);

	$sqlsupp=mysql_query("SELECT * FROM anggota WHERE id_anggota='$id'");
	$kdsupp=mysql_fetch_array($sqlsupp);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(50,5,"Nama Pelanggan   : ". $kdsupp['nama_anggota'],'0','1','L',false);
	$pdf->Cell(50,5,"Tanggal Pembelian: ". $tgl,'0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',13);
	$pdf->Ln(3);

	$pdf->SetFillColor(191,191,191);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,8,'No',1,0,'C',1);
	$pdf->Cell(70,8,'Nama Barang',1,0,'C',1);
	$pdf->Cell(30,8,'Harga Barang',1,0,'C',1);
	$pdf->Cell(20,8,'Jumlah',1,0,'C',1);
	$pdf->Cell(35,8,'Sub Total',1,0,'C',1);

	$pdf->Ln(2);


	$brg=mysql_query("select * from detail_penjualan where id_penjualan='$kd' order by id_barang ASC");
	$no=0;
	$total=0;
	while($row = mysql_fetch_array($brg)){
		$sqlkate=mysql_query("SELECT * FROM barang WHERE id_barang='$row[id_barang]'",$db);
		$kdkate=mysql_fetch_array($sqlkate);

	$no++;
	$pdf->Ln(6);
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10,6,$no,1,0,'C');
	$pdf->Cell(70,6,$kdkate['nm_barang'],1,0,'L');
	$pdf->Cell(30,6,"Rp. ".number_format($row['harga_jual']),1,0,'R');
	$pdf->Cell(20,6,$row['jumlah'],1,0,'C');
	$pdf->Cell(35,6,"Rp. ". number_format($sub=$row['harga_jual']*$row['jumlah']),1,0,'R',1);
	$total+=$sub;
	}

	$sqltampil=mysql_query("SELECT * FROM penjualan WHERE id_penjualan='$kd'",$db);
	$kdtampil=mysql_fetch_array($sqltampil);

	$pdf->Ln(6);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(130,6,'Total',1,0,'L',1);
	$pdf->Cell(35,6,"Rp. ". number_format($total),1,0,'R',1);
	$pdf->Ln(6);
	$pdf->Cell(130,6,'Potongan Harga',1,0,'L',1);
	$pdf->Cell(35,6,"Rp. ". number_format($kdtampil['diskon']),1,0,'R',1);
	$pdf->Ln(6);
	$pdf->Cell(130,6,'Dibayar',1,0,'L',1);
	$pdf->Cell(35,6,"Rp. ". number_format($kdtampil['uang_bayar']),1,0,'R',1);
	$pdf->Ln(6);
	$pdf->Cell(130,6,'Kembalian',1,0,'L',1);
	$pdf->Cell(35,6,"Rp. ". number_format(($kdtampil['uang_bayar']+$kdtampil['diskon'])-$total),1,0,'R',1);

	$pdf->Output();
?>