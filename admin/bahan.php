<?php 
		$bahan='active'; 
		include "../header/header.php";
		include '../koneksi.php';
		
if (isset($_POST['btn_simpan_bahan'])) {
	$id 	=$_POST['id_bahan'];
	$nama	=$_POST['nama_bahan'];
	$harga 	=$_POST['harga_bahan'];

	if ($nama=="") {
		echo "<table class='table table-hover'>
				<div class='container'>
					<tr class='col-md-12'>
						<div class='alert alert-warning' id='myAlert'>
							<a href='#' class='close'>&times;</a> 
							<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan masukkan nama kategori</div>
						</tr>
					</div>
				</table>";
	}else {
		
		$myQry		=mysql_query('INSERT INTO bahan (id_bahan, nama_bahan, harga_bahan) value ("'.$id.'","'.$nama.'","'.$harga.'")') or die("Query Gagal!".mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=bahan.php?page1'";
		}
	}
}
?>

<h3><span class="glyphicon plyphicon-briefcase"></span>Data Bahan</h3>
<button style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span></span>Tambah</button>

<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM bahan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
</br>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode Bahan</th>
		<th class="col-md-2">Nama Bahan</th>
		<th class="col-md-2">Harga Bahan</th>
		<th class="col-md-6">Opsi</th>
	</tr>
	<?php 
	$bahan=mysql_query("SELECT * FROM bahan");
	$no=1;
	while ($b=mysql_fetch_array($bahan)) {
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_bahan'] ?></td>
			<td><?php echo $b['nama_bahan'] ?></td>
			<td><?php echo $b['harga_bahan'] ?></td>
			<td>
				<a href="edit_bahan.php?id_bahan=<?php echo $b['id_bahan']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_bahan.php?id_bahan=<?php echo $b['id_bahan']; ?>'}" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php
	}
	?>
</table>

<ul class="pagination">
		<?php 
			for ($x=1; $x<=$halaman ; $x++) { 
				?>
				<li <?php if ($_GET['page']==$x) { ?> class="active"; <?php } ?> ><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
	?>

</ul>

<?php	
	$query = mysql_query("SELECT max(id_bahan) as maxKode from bahan") or die(mysql_error());
$data = mysql_fetch_array($query);
$id_bahan = $data['maxKode'];
$noUrut = (int) substr($id_bahan,3,3);
$noUrut++;
$char = "BHN";
$newID = $char. sprintf("%03s",$noUrut);
?>

<!--modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Bahan
				</div>
				<div class="modal-body">
					<form action="bahan.php" method="post">
						<div class="form-group">
							<label>Kode Bahan</label>
							<input name="id_bahan" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Bahan</label>
							<input name="nama_bahan" type="text" class="form-control">
							

						</div>
					</div>
					<div class="form-group">
							<label>Harga Bahan</label>
							<input name="harga_bahan" type="text" class="form-control">
						

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_bahan">
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>	