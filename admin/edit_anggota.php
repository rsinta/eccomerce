<?php
	$anggota='active';
	include "../header/header.php";
	include "../koneksi.php";
?>
<h3><span class="glyphicon glyphicon-briefcase"></span> Edit Anggota</h3>
<a class="btn" href="anggota.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_anggota']);
$det=mysql_query("SELECT * FROM anggota WHERE id_anggota='$kd'")or die(mysql_error());
while ($d=mysql_fetch_array($det)) {
?>	
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Id Anggota</td>
				<td><input type="text" class="form-control" name="id_anggota" value="<?php echo $d['id_anggota'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama_anggota" value="<?php echo$d['nama_anggota'] ?>" ></td>
			</tr>
			
			<tr>
				<td>Jenis Kelamin</td>
				<td><input type="text" class="form-control" name="jenkel" value="<?php echo$d['jenkel'] ?>" ></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td><textarea name="alamat" class="form-control"><?php echo $d['alamat'] ?></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_anggota"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_anggota'])){
	$kd=$_GET['id_anggota'];
	$nama 	= $_POST['nama_anggota'];
	$jenkel 	= $_POST['jenkel'];
	$almat 	= $_POST['alamat'];
	

		$mySql  = mysql_query("update anggota set nama_anggota='$nama', jenkel='$jenkel', alamat='$almat' where id_anggota='$kd'") or die ("Gagal query".mysql_error());
		if($mySql){
			echo "<meta http-equiv='refresh' content='0; url=anggota.php?page=1'>";
		}
	}
?>
<?php include '../footer.php'; ?>