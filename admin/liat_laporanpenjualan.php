<?php 
	$penjualan='active'; 
	include '../header/header.php'; 
	include "../koneksi.php";	?>
<h3><span class="glyphicon glyphicon-book"></span>  Laporan Penjualan</h3>
<a class="btn" href="penjualan.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<br>

<form action="lihat_laporanpenjualan.php" method="POST">
<div class="col-md-12">
<table class="col-md-12">
	<tr>
		<td align="right"><b>Dari Tanggal</b></td>
		<td class="col-md-3"><input name="txt_tgl_sebe" type="date" class="form-control" value="<?php echo $sebelum=date("Y-m-d", mktime(0,0,0,date("m"),date("d")-30,date("Y"))); ?>"></td>
		<td class="col-md-1" align="center"><b>Sampai</b></td>
		<td class="col-md-3"><input name="txt_tgl_seka" type="date" class="form-control" value="<?php echo $sekarang=date('Y-m-d'); ?>"></td>
		<td align="left"><input type="submit" class="btn btn-primary" value="Proses" name="proses"></td>
	</tr>
</table>
</div>
</form>
<?php
if(isset($_POST['proses'])){ $sebelum=$_POST['txt_tgl_sebe'];}else{ $sebelum;}
if(isset($_POST['proses'])){ $sekarang=$_POST['txt_tgl_seka'];}else{ $sekarang;}
?>
<div class="col-md-12">
<br>
<a style="margin-bottom:10px" href="cetak_penjualan.php" class="btn btn-default pull-left"><span class='glyphicon glyphicon-print'></span>  Cetak</a>
</div>
<h3 align="center">Data Transaksi penjualan</h3>
<h3 align="center">Periode <b><?php echo date('d-F-Y',strtotime($sebelum)); ?></b> s/d <b><?php echo date('d-F-Y',strtotime($sekarang)); ?></b></h3>
<br>
<form action="lihat_laporanpenjualan.php" method="get">
	<div class="input-group col-md-4 col-md-offset-8">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari nama barang  " aria-describedby="basic-addon1" name="cari">
	</div>
</form>

<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode penjualan </th>
		<th class="col-md-2">Pelanggan </th>
		<th class="col-md-2">Jasa Kirim </th>
		<th class="col-md-2">TGL Penjualan</th>
		<th class="col-md-3">Uang Bayar </th>
		<th>Jumlah </th>
		<th class="col-md-2">Sub Total </th>
	</tr>
	<?php
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from penjualan like '%$cari%'");
	}else{
		$brg1=mysql_query("select *, DATE_FORMAT(tgl_masuk, '%d-%b-%Y') as tgl_masuk from penjualan (tgl_masuk between '$sebelum' and '$sekarang')");
	}
	$no=1;
	$total=0;
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
			$x=mysql_query("select sum(harga_beli*jumlah) as total_bayar from penjualan");
			$xx=mysql_fetch_array($x);
			echo "<b> Rp.". number_format($xx['total_bayar']).",-</b>";
		?></b></p>



<?php
if(isset($_POST['btn_simpan_pem'])){

		$kd 			=$_POST['txt_kodepem_pem'];
		$tgl 			=$_POST['txt_tgl_pem'];
		$keterangan 	=$_POST['txt_ket_pem'];

		//$mySql = "CALL in_pem('$kd','$tgl','$keterangan')";
		$mySql =mysql_query('INSERT INTO penjualan (id_penjualan, tgl_masuk, keterangan) value ("'.$id.'","'.$nama.'")') or die("Query Gagal!".mysql_error());
		$myQry2=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());


		if($myQry2){
			echo "<meta http-equiv='refresh' content='0; url=penjualan.php'>";
		}


		}
 ?>

<?php	
	$query = mysql_query("SELECT max(id_detail_penjualan) as maxKode from detail_penjualan") or die(mysql_error());
$data = mysql_fetch_array($query);
$aidi = $data['maxKode'];
$noUrut = (int) substr($aidi,3,3);
$noUrut++;
$char = "PROV";
$newID = $char. sprintf("%03s",$noUrut);
?>
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
							<label>Kode penjualan</label>
							<input name="txt_kodepem_pem" type="text" class="form-control" autocomplete="off" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>TGL penjualan</label>
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
	<?php include 'footer.php'; ?>
