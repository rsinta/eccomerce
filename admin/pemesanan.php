<?php 
		$pemesanan='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting(0);

if(isset($_POST['btn_simpan_pen'])){

	$kode 		=$_POST['id_pemesanan'];
	$pelanggan 	=$_POST['nama_anggota'];
	$jasa		=$_post['nama_jasa_layanan_kirim'];
	$totbyr		=$_POST['total_bayar'];
	$uangmuka	=$_POST['DP'];
	$totberat	=$_POST['total_berat'];
	$tglpsn 	=$_POST['tgl_pemesanan'];
	$tgllunas	=$_POST['tgl_pelunasan'];
	$tglsls		=$_POST['tgl_selesai'];
	$noresi		=$_POST['no_resi'];

	if($pelanggan=='KOSONG'){
		echo "<table class='table table-hover'>
					<div class='container'>
						<tr calss='col-md-12'>
							<div class='alert alert-warning' id='myAlert'>
								<a href='#'' class='close'>&times;</a>
								<strong>Peringatan!</strong> Tambah Penjualan gagal disimpan sialhkan pilih nama pelanggan
							</div>
						</tr>
					</div>
				 </table>";
	}else{
	$mySql	= "CALL pemesanan('$kode','$tglpsn','$pelanggan', '$tgllunas', '$tglsls' '$noresi')";
	$myQry=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());
	if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.php?page=1'>";
		}
	}
}

 ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Pemesanan</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Transaksi</button>
<br/>
<br/>

<?php
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from pemesanan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	
	<a style="margin-bottom:10px" href="lihat_laporanpen.php" class="btn btn-default pull-right"><span class='glyphicon glyphicon-book'></span>  Laporan</a>
</div>
<div class="row">
<div class="col-md-12">
<form action="cari_penjualan.php" method="get">
	<div class="input-group col-md-3 col-md-offset-9">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari Tanggal 2016-01-01" aria-describedby="basic-addon1" name="cari">
	</div>
</form>
</div>
</div>
<br/>
<table class="table table-hover">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode Pemesanan</th>
		<th class="col-md-2">Pelanggan</th>
		<th class="col-md-2">Jasa Pengiriman</th>
		<th class="col-md-2">Tgl Penjualan</th>
		<th class="col-md-2">Uang Bayar</th>
		<th class="col-md-2">Total Berat</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select *, DATE_FORMAT(tgl_pemesanan, '%d-%b-%Y') as tgl_pemesanan from pemesanan where tgl_pemesanan like '%$cari%'");
	}else
	{
		$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_penjualan, '%d-%b-%Y') as tgl_pemesanan FROM pemesanan ORDER BY id_pemesanan DESC LIMIT $start, $per_hal");

	}
	$no=1;
	while($b=mysql_fetch_array($brg)){
	$pen=mysql_query("SELECT * FROM anggota");
	$jas=mysql_query("SELECT * FROM jasa_layanan_kirim")
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_penjualan']; ?></td>
			<td><?php while($c=mysql_fetch_array($pen)){if($b['id_anggota']==$c['id_anggota']){ echo $c['nama_anggota'];}}  ?></td>
			<td><?php while($c=mysql_fetch_array($jas)){if($b['id_jasa_layanan_kirim']==$c['id_jasa_layanan_kirim']){ echo $c['nama_jasa_layanan_kirim'];}}  ?></td>
			<td><?php echo $b['tgl_penjualan'] ?></td>
			<td><?php echo "Rp. "; echo number_format($b['total_bayar']); echo ",-"; ?></td>			
			<td><?php echo number_format($b['total_berat']); echo "kg"; ?></td>
			<td>

				<a href="p_penjualan.php?kd_pen=<?php echo $b['kd_pen']; ?>&&id_pelanggan=<?php echo $b['id_pelanggan'];?>&&tgl_pen=<?php echo $b['tgl_pen'] ?>" class="btn btn-info">Proses</a>
				<a href="edit_penjualan.php?kd_pen=<?php echo $b['kd_pen']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='delete_penjualan.php?kd_pen=<?php echo $b['kd_pen']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td colspan="5">Total Pembayaran</td>
		<td>
		<?php

			$x=mysql_query("select sum(total_bayar) as total from penjualan");
			$xx=mysql_fetch_array($x);
			echo "<b> Rp.". number_format($xx['total']).",-</b>";
		?>
		</td>
	</tr>
</table>
<ul class="pagination">
			<?php
			for($x=1;$x<=$halaman;$x++){
				?>
				<li <?php if($_GET['page']==$x){?> class="active"; <?php } ?> ><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>
		</ul>


<?php



?>
<?php
function buatKode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysql_fetch_array($qry);
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}

 	$angka++;
 	$angka	=strval($angka);
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";
	}
 	return $inisial.$tmp.$angka;
}


$dataKode	= buatKode("penjualan", "PN");
?>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Transaksi Pemesanan</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Kode Pemesanan</label>
						<input name="id_penjualan" type="text" class="form-control" value="<?php echo $dataKode; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Pelanggan</label>
						<select name="nama_anggota" class="form-control">
				        <option value="KOSONG">--- Silahkan Pilih Pelanggan ---</option>
				        <?php
						$mySql = "SELECT * FROM anggota ORDER BY nama_anggota";
						$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
						while ($myData = mysql_fetch_array($myQry)) {
						echo "<option value='$myData[id_anggota]'>$myData[nama_anggota] </option>";
						}
						?>
				      </select>
					</div>
					<div class="form-group">
						<label>Jasa Kirim</label>
						<select name="nama_jasa_layanan_kirim" class="form-control">
				        <option value="KOSONG">--- Silahkan Pilih Jasa Layanan Kirim ---</option>
				        <?php
						$mySql = "SELECT * FROM jasa_layanan_kirim ORDER BY nama_jasa_layanan_kirim";
						$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
						while ($myData = mysql_fetch_array($myQry)) {
						echo "<option value='$myData[id_jasa_layanan_kirim]'>$myData[nama_jasa_layanan_kirim] </option>";
						}
						?>
				      </select>
					</div>
				</div>
					<div class="form-group">
						<label>Tanggal</label>
						<input name="tgl_penjualan" type="date" class="form-control" value="<?php echo date('Y-m-d');?>">
					</div>
					
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_pen">
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include 'footer.php';

?>