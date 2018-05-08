<?php $penjualan='active'; 
	include '/header/header.php';
	include "koneksi.php"; 
	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Penjualan</h3>
<a class="btn" href="penjualan.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_penjualan']);
$det=mysql_query("select * from penjualan where id_penjualan='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Kode Penjualan</td>
				<td><input type="text" class="form-control" name="id_penjualan" value="<?php echo $d['id_penjualan'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Anggota</td>
				<td>
					<select name="nama_anggota" class="form-control">
					<option value="KOSONG">--- Silahkan Pilih Pelanggan ---</option>
				    <?php
					$mySql = "SELECT * FROM anggota ORDER BY nama_anggota";
					$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
					while ($myData = mysql_fetch_array($myQry)) {
						if($d['id_anggota']==$myData['id_anggota'])
						{ $cek = " selected";
						} else { $cek=""; }
						echo "<option value='$myData[id_anggota]' $cek>$myData[nama_anggota] </option>";
					}
					?>
				    </select>
				</td>
			</tr>
			<tr>
				<td>Tanggal Penjualan</td>
				<td><input type="date" class="form-control" name="tgl_penjualan" value="<?php echo $d['tgl_penjualan'] ?>"></td>
			</tr>
			<td>Jasa Layanan Kirim</td>
				<td>
					<select name="nama_jasa_layanan_kirim" class="form-control">
					<option value="KOSONG">--- Silahkan Pilih Jasa Layanan Kirim ---</option>
				    <?php
					$mySql = "SELECT * FROM jasa_layanan_kirim ORDER BY nama_jasa_layanan_kirim";
					$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
					while ($myData = mysql_fetch_array($myQry)) {
						if($d['id_jasa_layanan_kirim']==$myData['id_jasa_layanan_kirim'])
						{ $cek = " selected";
						} else { $cek=""; }
						echo "<option value='$myData[id_jasa_layanan_kirim]' $cek>$myData[nama_jasa_layanan_kirim] </option>";
					}
					?>
				    </select>
				</td>
			
			<tr>
				<td>Jumlah Beli</td>
				<td><input type="text" class="form-control" name="jumlah_beli" value="<?php echo $d['jumlah_beli'] ?>"></td>
			</tr>
			<tr>
				<td>Total Berat</td>
				<td><input type="text" class="form-control" name="total_berat" value="<?php echo $d['total_berat'] ?>"></td>
			</tr>
			<tr>
				<td>Total Bayar</td>
				<td><input type="text" class="form-control" name="total_bayar" value="<?php echo $d['total_bayar'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_pen"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_pen'])){
	$kd 				= $_POST['id_penjualan'];
	$pelang 			= $_POST['nama_anggota'];
	$tgl 				= $_POST['tgl_penjualan'];
	$jasa_layanan_kirim = $_POST['nama_jasa_layanan_kirim'];
	$totalberat 		= $_POST['total_berat'];
	$totalbayar 		= $_POST['total_bayar'];
	

		$mySql  = "CALL penjualan_edit('$tgl','$pelang','$jasa_layanan_kirim','$totalberat', '$totalbayar','$kd')";
		$myQry=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=penjualan.php?page=1'>";
		}
	}
?>
<?php include 'footer.php'; ?>
