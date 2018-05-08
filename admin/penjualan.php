<?php 
		$penjualan='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting(0);

// if(isset($_POST['btn_simpan_pen'])){

// 	$kode 		=$_POST['id_penjualan'];
// 	$pelanggan 	=$_POST['nama_anggota'];
// 	$jasa		=$_post['nama_jasa_layanan_kirim'];
// 	$totbyr		=$_POST['total_bayar'];
// 	$totberat	=$_POST['total_berat'];
// 	$tgl 		=$_POST['tgl_penjualan'];
// 	$noresi		=$_POST['no_resi'];

// 	if($pelanggan=='KOSONG'){
// 		echo "<table class='table table-hover'>
// 					<div class='container'>
// 						<tr calss='col-md-12'>
// 							<div class='alert alert-warning' id='myAlert'>
// 								<a href='#'' class='close'>&times;</a>
// 								<strong>Peringatan!</strong> Tambah Penjualan gagal disimpan sialhkan pilih nama pelanggan
// 							</div>
// 						</tr>
// 					</div>
// 				 </table>";
// 	}else{
// 	$mySql	= "CALL penjualan('$kode','$tgl','$pelanggan','$noresi')";
// 	$myQry=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());
// 	if($myQry){
// 			echo "<meta http-equiv='refresh' content='0; url=penjualan.php?page=1'>";
// 		}
// 	}
// }

 ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Penjualan</h3>

<br/>
<br/>

<div class="col-md-12">
	
	<a style="margin-bottom:10px" href="liat_laporanpenjualan.php" class="btn btn-default pull-right"><span class='glyphicon glyphicon-book'></span>  Laporan</a>
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
		<th class="col-md-1">Kode Penjualan</th>
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
		$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_penjualan, '%d-%b-%Y') as tgl_penjualan from penjualan where tgl_penjualan like '%$cari%'");
	}else
	{
		$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_penjualan, '%d-%b-%Y') as tgl_penjualan FROM penjualan ORDER BY id_penjualan DESC LIMIT $start, $per_hal");

	}
	$no=1;

	// UPDATE LAPORAN PENJUALAN

	$sql = mysql_query("SELECT * FROM penjualan ");	
	while($b=mysql_fetch_array($sql)){
	$pen=mysql_query("SELECT * FROM anggota");
	$jas=mysql_query("SELECT * FROM jasa_layanan_kirim")
		?>

		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $b['id_penjualan'] ?></td>
			<td><?php echo $b['id_anggota'] ?></td>
			<td><?php echo $b['id_jasa_layanan_kirim'] ?></td>
			<td><?php echo $b['tgl_pembelian'] ?></td>
			<td><?php echo $b['total_bayar'] ?></td>
			<td><?php echo $b['total_berat'] ?></td>
		<td>
				<a href="edit_penjualan.php?id_penjualan=<?php echo $b['id_penjualan']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_penjualan.php?id_penjualan=<?php echo $b['id_penjualan']; ?>'}" class="btn btn-danger">Hapus</a>
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
				<h4 class="modal-title">Tambah Transaksi Penjualan</h4>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Kode Penjualan</label>
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