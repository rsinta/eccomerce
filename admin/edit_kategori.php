<?php 
	$kategori='active'; 
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Kategori</h3>
<a class="btn" href="kategori.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_kategori']);
$det=mysql_query("SELECT * FROM kategori WHERE id_kategori='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="edit_kategori.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Kategori</td>
				<td><input type="text" class="form-control" name="id_kategori1" value="<?php echo $d['id_kategori'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Stok</td>
				<td><input type="text" class="form-control" name="nama_kategori" value="<?php echo $d['nama_kategori'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_kate"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_kate'])){
	$id 	= $_POST['id_kategori1'];
	$nama 	= $_POST['nama_kategori'];

		$myQry=mysql_query("update kategori set nama_kategori='$nama' where id_kategori='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=kategori.php?page=1'>";
		}
	}
?>