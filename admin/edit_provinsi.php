<?php 
	$provinsi='active'; 
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Kategori</h3>
<a class="btn" href="provinsi.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_provinsi']);
$det=mysql_query("SELECT * FROM provinsi WHERE id_provinsi='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="edit_provinsi.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Provinsi</td>
				<td><input type="text" class="form-control" name="provinsi" value="<?php echo $d['id_provinsi'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama Provinsi</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama_provinsi'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_provinsi"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_provinsi'])){
	$id 	= $_POST['provinsi'];
	$nama 	= $_POST['nama'];

		$myQry=mysql_query("update provinsi set nama_provinsi='$nama' where id_provinsi='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=provinsi.php?page=1'>";
		}
	}
?>