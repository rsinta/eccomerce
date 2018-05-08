<?php 
	$kota='active'; 
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Jasa Layanan Kirim</h3>
<a class="btn" href="kota.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_kota']);
$det=mysql_query("SELECT * FROM kota WHERE id_kota='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="edit_kota.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Jasa</td>
				<td><input type="text" class="form-control" name="kota" value="<?php echo $d['id_kota'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama Jasa</td>
				<td><input type="text" class="form-control" name="nama_kota" value="<?php echo $d['nama_kota'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_kota"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_kota'])){
	$id 	= $_POST['kota'];
	$nama 	= $_POST['nama_kota'];

		$myQry=mysql_query("update kota set nama_kota='$nama' where id_kota='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=kota.php?page=1'>";
		}
	}
?>