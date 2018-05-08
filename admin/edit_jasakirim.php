<?php 
	$jasakirim='active'; 
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Jasa Layanan Kirim</h3>
<a class="btn" href="jasa_layanan_kirim.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_jasa_layanan_kirim']);
$det=mysql_query("SELECT * FROM jasa_layanan_kirim WHERE id_jasa_layanan_kirim='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="edit_jasakirim.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Jasa</td>
				<td><input type="text" class="form-control" name="id_jasakirim" value="<?php echo $d['id_jasa_layanan_kirim'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama Jasa</td>
				<td><input type="text" class="form-control" name="nama_jasa" value="<?php echo $d['nama_jasa_layanan_kirim'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_jasa"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_jasa'])){
	$id 	= $_POST['id_jasakirim'];
	$nama 	= $_POST['nama_jasa'];

		$myQry=mysql_query("update jasa_layanan_kirim set nama_jasa_layanan_kirim='$nama' where id_jasa_layanan_kirim='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=jasa_layanan_kirim.php?page=1'>";
		}
	}
?>