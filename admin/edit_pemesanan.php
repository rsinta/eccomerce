<?php $pemesanan='active'; 
	include '/header/header.php';
	include "koneksi.php"; 
	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Penjualan</h3>
<a class="btn" href="pemesanan.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_pemesanan']);
$det=mysql_query("select * from pemesanan where id_pemesanan='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>
	<form action="" method="post">
		<table class="table">
			<tr>
				<td>Kode Pemesanan</td>
				<td><input type="text" class="form-control" name="id_pemesanan" value="<?php echo $d['id_pemesanan'] ?>" readonly></td>
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
				<td>Tanggal Pemesanan</td>
				<td><input type="date" class="form-control" name="tgl_pemesanan" value="<?php echo $d['tgl_pemesanan'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal Pelunasan</td>
				<td><input type="date" class="form-control" name="tgl_pelunasan" value="<?php echo $d['tgl_pelunasan'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal Selesai</td>
				<td><input type="date" class="form-control" name="tgl_selesai" value="<?php echo $d['tgl_selesai'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah Beli</td>
				<td><input type="text" class="form-control" name="jumlah_beli" value="<?php echo $d['jumlah_beli'] ?>"></td>
			</tr>
			<tr>
				<td>Estimasi Harga</td>
				<td><input type="text" class="form-control" name="estimasi_harga" value="<?php echo $d['estimasi_harga'] ?>"></td>
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
				<td>Uang DP</td>
				<td><input type="text" class="form-control" name="DP" value="<?php echo $d['DP'] ?>"></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><input type="text" class="form-control" name="deskripsi" value="<?php echo $d['deskripsi'] ?>"></td>
			</tr>
			<tr>
				<td>Status</td>
				<select name="nama_jasa_layanan_kirim" class="form-control">
					<option value="KOSONG">--- Silahkan Pilih Status ---</option>
				    <?php
					$mySql = "SELECT * FROM pemesanan ORDER BY status";
					$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
					while ($myData = mysql_fetch_array($myQry)) {
						if($d['status']==$myData['status'])
						{ $cek = " selected";
						} else { $cek=""; }
						echo "<option value='$myData[id_pemesanan]' $cek>$myData[status] </option>";
					}
					?>
				    </select>
			</tr>	
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_pem"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_pen'])){
	$kd 			= $_POST['id_pemesanan'];
	$pelang 		= $_POST['nama_anggota'];
	$jasakirim 	 	= $_POST['nama_jasa_layanan_kirim'];
	$tglpesan 		= $_POST['tgl_pemesanan'];
	$tgllunas 		= $_POST['tgl_pelunasan'];
	$tglselesai 	= $_POST['tgl_selesai'];
	$totalberat 	= $_POST['total_berat'];
	$totalbayar 	= $_POST['total_bayar'];
	$uangmuka		= $_POST['DP'];
	$ket			=$_POST['deskripsi'];
	$status 		=$_POST['status'];

		$mySql  = "CALL pen_edit('$tgl','$pelang', '$jasakirim' , '$tglpesan','$tgllunas', '$tglselesai', '$totalberat', '$totalbayar', '$uangmuka', '$ket', '$status', '$kd')";
		$myQry=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=pemesanan.php?page=1'>";
		}
	}
?>
<?php include 'footer.php'; ?>
