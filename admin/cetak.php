<?php 
	include "../koneksi.php";
	include "../header/cetak_header.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body onload="print();">
<br/>
<a style="margin-bottom:10px" href="#" class="btn btn-default pull-left" onclick="print();"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode Pembelian </th>
		<th class="col-md-2">Pengrajin </th>
		<th class="col-md-2">TGL Pembelian</th>
		<th class="col-md-3">Barang </th>
		<th>Jumlah </th>
		<th class="col-md-2">Sub Total </th>
	</tr>
	<?php
	// 	$cari=mysql_real_escape_string($_GET['cari']);
	 	$brg = mysql_query("select * from pembelian, barang where pembelian.id_pembelian=pembelian.id_pembelian and pembelian.id_barang=barang.id_barang and barang.nama_barang") or die(mysql_error());
	while($b=mysql_fetch_array($brg)){
	$Sql = "SELECT * FROM barang, pengrajin WHERE barang.id_barang='$b[id_barang]' AND pengrajin.id_pengrajin='$b[id_pengrajin]'";
	$Qry = mysql_query($Sql, $db) or die ("Gagal Query".mysql_error());
	$c =mysql_fetch_array($Qry);
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_pembelian'] ?></td>
			<td><?php echo $c['nama_pengrajin'] ?></th><!--cc -->
			<td><?php echo $b['tgl_masuk'] ?></td>
			<td><?php echo $c['nama_barang']?></td>
			<td><?php echo $b['jumlah']?></td>
			<td><?php echo "<b> Rp.". number_format($hasil=$b['jumlah']*$b['harga_beli']).",-</b>"?></td>
		</tr>
		<?php
		$total+=$hasil;
	}
	?>
	<tr>
		<td colspan="6"><b>Total</b></td>
		<td>
		<b><?php  echo "<b> Rp.". number_format($total).",-</b>" ?></b>
		</td>
	</tr>
</table>
<p>Total Keseluruahan<b>
		<?php
			$x=mysql_query("select sum(harga_beli*jumlah) as total_bayar from pembelian");
			$xx=mysql_fetch_array($x);
			echo "<b> Rp.". number_format($xx['total_bayar']).",-</b>";
		?></b></p>


<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Supplier
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label>Kode Pembelian</label>
							<input name="txt_kodepem_pem" type="text" class="form-control" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							<label>TGL Pembelian</label>
							<input name="txt_tgl_pem" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<input name="txt_ket_pem" type="text" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_pem">
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>