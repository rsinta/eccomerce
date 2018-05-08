<?php
	$pengrajin='active';
	include '../header/header.php';
	include 'koneksi.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span> Edit Pengrajin</h3>
<a class="btn" href="pengrajin.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_pengrajin']);
$det=mysql_query("SELECT * FROM pengrajin WHERE id_pengrajin='$kd'")or die(mysql_error());
while ($d=mysql_fetch_array($det)) {
?>	
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Kode Pengrajin</td>
				<td><input type="text" class="form-control" name="id_pengrajin" value="<?php echo $d['id_pengrajin'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama_pengrajin" value="<?php echo$d['nama_pengrajin'] ?>" ></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea name="alamat" class="form-control"><?php echo $d['alamat'] ?></textarea></td>
			</tr>
			<tr>
				<td>No. Hp</td>
				<td><input type="text" class="form-control" name="no_telp" value="<?php echo$d['no_telp'] ?>" ></td>
			</tr>
			<tr>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_peng"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_peng'])){
	$id 		=$_GET['id_pengrajin'];
	$nama 		= $_POST['nama_pengrajin'];
	$alamat 	= $_POST['alamat'];
	$nohp 		= $_POST['no_telp'];

		mysql_query("update pengrajin set nama_pengrajin='$nama', alamat='$alamat', no_telp='$nohp' where id_pengrajin='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=pengrajin.php'>";
		}
	}
?>
<?php include 'footer.php'; ?>