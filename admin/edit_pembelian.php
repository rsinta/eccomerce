<?php $pembelian='active'; 
include '/header/header.php'; 	
include "koneksi.php"; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Pembelian</h3>
<a class="btn" href="pembelian.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_pembelian']);
$det=mysql_query("select * from pembelian where id_pembelian='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Kode Pembelian</td>
				<td><input type="text" class="form-control" name="id_pembelian" value="<?php echo $d['id_pembelian'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Tanggal Beli</td>
				<td><input type="date" class="form-control" name="tgl_masuk" value="<?php echo $d['tgl_masuk'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah Barang</td>
				<td><input type="text" class="form-control" name="jumlah" value="<?php echo $d['jumlah'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_pem"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_pem'])){
	$kd 		= $_POST['id_pembelian'];
	$tgl 		= $_POST['tgl_masuk'];
	$jml 		= $_POST['jumlah'];

		$mySql  = mysql_query("update pembelian set nama_anggota='$nama', tgl_masuk='$tgl' where id_pembelian='$kd'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=pembelian.php?page=1'>";
		}
	}
?>
<?php include 'footer.php'; ?>
