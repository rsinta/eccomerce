<?php 
	$kategori='active'; 
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Kategori</h3>
<a class="btn" href="bahan.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_bahan']);
$det=mysql_query("SELECT * FROM bahan WHERE id_bahan='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="edit_bahan.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Bahan</td>
				<td><input type="text" class="form-control" name="id_bahan" value="<?php echo $d['id_bahan'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama Bahan</td>
				<td><input type="text" class="form-control" name="nama_bahan" value="<?php echo $d['nama_bahan'] ?>"></td>
			</tr>
			<tr>
				<td>Harga Bahan</td>
				<td><input type="text" class="form-control" name="harga_bahan" value="<?php echo $d['harga_bahan'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_bhn"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_bhn'])){
	$id 	= $_POST['id_bahan'];
	$nama 	= $_POST['nama_bahan'];
	$harga 	= $_POST['harga_bahan'];

		$myQry=mysql_query("update bahan set nama_bahan='$nama', harga_bahan='$harga' where id_bahan='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=bahan.php?page=1'>";
		}
	}
?>