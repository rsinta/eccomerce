<?php 
		$kategori='active'; 
		include "../header/header.php";
		include '../koneksi.php';
		
if (isset($_POST['btn_simpan_kate'])) {
	$id 	=$_POST['id_kategori'];
	$nama	=$_POST['nama_kategori'];

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
		
		$myQry		=mysql_query('INSERT INTO kategori (id_kategori, nama_kategori) value ("'.$id.'","'.$nama.'")') or die("Query Gagal!".mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=kategori.php?page1'";
		}
	}
}
?>

<h3><span class="glyphicon plyphicon-briefcase"></span>Data Kategori</h3>
<button style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span></span>Tambah</button>

<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM kategori");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
</br>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-3">Kode Kategori</th>
		<th class="col-md-7">Nama Kategori</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
	$kategori=mysql_query("SELECT * FROM kategori");
	$no=1;
	while ($b=mysql_fetch_array($kategori)) {
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_kategori'] ?></td>
			<td><?php echo $b['nama_kategori'] ?></td>
			<td>
				<a href="edit_kategori.php?id_kategori=<?php echo $b['id_kategori']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_kategori.php?id_kategori=<?php echo $b['id_kategori']; ?>'}" class="btn btn-danger">Hapus</a>
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

	$query = mysql_query("SELECT max(id_kategori) as maxKode from kategori") or die(mysql_error());
$data = mysql_fetch_array($query);
$id_kategori = $data['maxKode'];
//$id_kategori=$data['id_kategori'];
$noUrut = (int) substr($id_kategori,3,3);
$noUrut++;
$char = "KTG";
$newID = $char. sprintf("%03s",$noUrut);
?>

<!--modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Kategori
				</div>
				<div class="modal-body">
					<form action="kategori.php" method="post">
						<div class="form-group">
							<label>Kode Kategori</label>
							<input name="id_kategori" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Ketegori</label>
							<input name="nama_kategori" type="text" class="form-control">
							</select>

						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_kate">
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>	