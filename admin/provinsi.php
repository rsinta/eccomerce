<?php 
		$provinsi='active'; 
		include "../header/header.php";
		include '../koneksi.php';
		
// if (isset($_POST['btn_simpan_provinsi'])) {
// 	$id 	=$_POST['id_provinsi'];
// 	$nama	=$_POST['nama_provinsi'];

// 	if ($nama=="") {
// 		echo "<table class='table table-hover'>
// 				<div class='container'>
// 					<tr class='col-md-12'>
// 						<div class='alert alert-warning' id='myAlert'>
// 							<a href='#' class='close'>&times;</a> 
// 							<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan masukkan nama kategori</div>
// 						</tr>
// 					</div>
// 				</table>";
// 	}else {
		
// 		$myQry		=mysql_query('INSERT INTO provinsi (id_provinsi, nama_provinsi) value ("'.$id.'","'.$nama.'")') or die("Query Gagal!".mysql_error());
// 		if ($myQry) {
// 			echo "<meta http-equiv='refresh' content='0; url=provinsi.php?page1'";
// 		}
// 	}
// }
?>

<h3><span class="glyphicon plyphicon-briefcase"></span>Data Provinsi</h3>


<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM provinsi");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
</br>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-3">Kode Provinsi</th>
		<th class="col-md-4">Nama Provinsi</th>
		<th class="col-md-4">Opsi</th>
	</tr>
	<?php 
	$provinsi=mysql_query("SELECT * FROM provinsi");
	$no=1;
	while ($b=mysql_fetch_array($provinsi)) {
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_provinsi'] ?></td>
			<td><?php echo $b['nama_provinsi'] ?></td>
			<td>
				<a href="edit_provinsi.php?id_provinsi=<?php echo $b['id_provinsi']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_provinsi.php?id_provinsi=<?php echo $b['id_provinsi']; ?>'}" class="btn btn-danger">Hapus</a>
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
	$query = mysql_query("SELECT max(id_provinsi) as maxKode from provinsi") or die(mysql_error());
$data = mysql_fetch_array($query);
$idprov = $data['maxKode'];
$noUrut = (int) substr($idprov,2,2);
$noUrut++;
$char = "PROV";
$newID = $char. sprintf("%03s",$noUrut);
?>

<!--modal input -->
<!-- <div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Provinsi
				</div>
				<div class="modal-body">
					<form action="provinsi.php" method="post">
						<div class="form-group">
							<label>Kode Provinsi</label>
							<input name="id_provinsi" type="text" class="form-control" value="<?php //echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Provinsi</label>
							<input name="nama_provinsi" type="text" class="form-control">
							</select>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_provinsi">
				</div>
			</form>
		</div>
	</div>
</div> -->
<?php include 'footer.php'; ?>	