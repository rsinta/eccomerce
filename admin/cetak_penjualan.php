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
	
	$sql = mysql_query("SELECT * FROM penjualan ");	
	while($b=mysql_fetch_array($sql)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $b['id_penjualan'] ?></td>
			<td><?php echo $b['id_anggota'] ?></td>
			<td><?php echo $b['id_jasa_layanan_kirim'] ?></td>
			<td><?php echo $b['tgl_pembelian'] ?></td>
			<td><?php echo $b['total_bayar'] ?></td>
			<td><?php echo $b['total_berat'] ?></td>
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