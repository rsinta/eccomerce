<?php 	$pengrajin='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting(0);


if (isset($_POST['btn_simpan_peng'])) {
	$id 	=$_POST['id_pengrajin'];
	$nama	=$_POST['nama_pengrajin'];
	$alamat	=$_POST['alamat'];
	$nohp	=$_POST['no_telp'];
	if ($nama=="" or $alamat=="" or $nohp=="") {

		echo "<table class='table table-hover'>
								<div class='container'>
	  								<tr calss='col-md-12'>
	  									<div class='alert alert-warning' id='myAlert'>
	    									<a href='#'' class='close'>&times;</a>
	    									<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan lengkapi
	  									</div>
	  								</tr>
								</div>
							 </table>";
	}else {
		$mySqlin	= "INSERT INTO pengrajin(id_pengrajin, nama_pengrajin, alamat, no_telp) VALUES ('$id','$nama','$alamat','$nohp')";
		$myQry		=mysql_query($mySqlin, $db) or die("Query Gagal".mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=pengrajin.php'>";
		}
	}

}

?>

<h3><span class="glyphicon glyphicon-user"></span>Data Pengrajin</h3>
<button style="margin-buttom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>Tambah</button>

</br>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-2">Kode Pengrajin</th>
		<th class="col-md-2">Nama</th>
		<th class="col-md-2">Alamat</th>
		<th class="col-md-1">No. Telpon</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php 
	$pgr=mysql_query("SELECT * FROM pengrajin");
	$no=1;
	while ($b=mysql_fetch_array($pgr)) {
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_pengrajin'] ?></td>
			<td><?php echo $b['nama_pengrajin'] ?></td>
			<td><?php echo $b['alamat'] ?></td>
			<td><?php echo $b['no_telp'] ?></td>
			<td>
				<a href="edit_pengrajin.php?id_pengrajin=<?php echo $b['id_pengrajin']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_pengrajin.php?id_pengrajin=<?php echo $b['id_pengrajin']; ?>'}" class="btn btn-danger">Hapus</a>
				
			</td>
		</tr>
		<?php
	}
	?>
	<?php	
	$query = mysql_query("SELECT max(id_pengrajin) as maxKode from pengrajin") or die(mysql_error());
	$data = mysql_fetch_array($query);
	$id_pnr = $data['maxKode'];
	$noUrut = (int) substr($id_pnr,3,3);
	$noUrut++;
	$char = "PNR";
	$newID = $char. sprintf("%03s",$noUrut);
	?>
</table>

<!-- Modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"> Tambah Pengrajin</h4>
			</div>
			<div class="modal-body">
				<form action="pengrajin.php" method="post">
					<div class="form-group">
					<label>Kode Bahan</label>
							<input name="id_pengrajin" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama_pengrajin" class="form-control" autocomplete="off">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label>No. Hp</label>
						<input type="text" name="no_telp" class="form-control" placeholder="No Hp" autocomplete="off">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" name="btn_simpan_peng" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>		
	</div>	
</div>
<?php include 'footer.php';?>