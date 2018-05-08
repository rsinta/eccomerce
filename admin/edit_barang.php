<?php 
	$barang='active'; 
	include ('../header/header.php'); 	
	include ('../koneksi.php');  
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class="btn" href="barang.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_barang']);
$data=mysql_query("SELECT * FROM barang WHERE id_barang='$kd'")or die(mysql_error());
while($d=mysql_fetch_array($data)){
?>
	<form action="edit_barang.php" method="post" enctype="multipart/form-data">
		<table class="table">
			<tr>
				<td>Kode Barang</td>
				<td><input type="text" class="form-control" name="id_barang" value="<?php echo $d['id_barang'] ?>" readonly></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama_barang" value="<?php echo $d['nama_barang'] ?>"></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td><select name="id_kategori" class="form-control">
					<option value="KOSONG">-Pilih-</option>
					<?php
					  
						$mySql = "SELECT id_kategori FROM kategori ORDER BY id_kategori";
						$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
						while ($myData = mysql_fetch_array($myQry)) {
						if ($myData['id_kategori']== $d['id_kategori']) {
							$cek = " selected";
							} else { $cek=""; }
							echo "<option value='$myData[id_kategori]' $cek>$myData[id_kategori] </option>";
						}
						?>
					        </select></td>
			</tr>
			<tr>
				<td>Harga Barang</td>
				<td><input type="text" class="form-control" name="harga_barang" value="<?php echo $d['harga_barang'] ?>"></td>
			</tr>
			<tr>
				<td>Berat Satuan</td>
				<td><input type="text" class="form-control" name="berat_satuan" value="<?php echo $d['berat_satuan'] ?>"></td>
			</tr>
			<tr>
				<td>
					<tr>
       					<td width="10%">Foto<p>*File Berupa Picture max size 1MB</p></td>
       					<td><img src="../img/barang/<?php echo $d['foto']; ?>" width="100" height="150p"></td>
        					<td><input class="masuk" type="file" name="foto"></input></td>
    					</tr>
					</div>
				</td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><input type="text" class="form-control" name="keterangan" value="<?php echo $d['keterangan'] ?>"></td>
			</tr>
			<tr>
				<td>Stok</td>
				<td><input type="text" class="form-control" name="stok" value="<?php echo $d['stok'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_brg"></td>
			</tr>
		</table>
	</form>
	<?php
}
if(isset($_POST['btn_simpan_brg'])){
		$kode		= $_POST['id_barang'];
		$namakategori= $_POST['id_kategori'];
		$namabarang	= $_POST['nama_barang'];
		$hargabarang= $_POST['harga_barang'];
		$beratsatuan= $_POST['berat_satuan'];
		$ktrg	= $_POST['keterangan'];
		$stokbarang	= $_POST['stok'];
		$file_name 		= $_FILES['foto']['name'];
		if ($file_name=="") {
					$myQry=mysql_query('update barang set id_kategori="'.$namakategori.'", nama_barang="'.$namabarang.'", harga_barang="'.$hargabarang.'",berat_satuan="'.$beratsatuan.'",keterangan="'.$ktrg.'", stok="'.$stokbarang.'" where id_barang="'.$kode.'"') or die (mysql_error());
		    echo '<script language = "javascript">alert("Data Telah Di Perbaharui.");document.location="barang.php";</script>';
		} else{
		$folder 	= '../img/barang/';
		//type file yang bsa di upload
		$file_type 	= array('jpg','jpeg','JPEG','JPG','png');
		//ukuran max yg dapat di upload
		$max_size 	= 1000000;//5MB
		//mulai memories data
		//$file_name 		= $_FILES['foto']['name'];
		$tmp1			= $_FILES['foto']['tmp_name'];
			if(move_uploaded_file(($tmp1), $folder.$file_name)){ 
  			$myQry=mysql_query("update barang set id_kategori='".$_POST['id_kategori']."', nama_barang='$namabarang', harga_barang='$hargabarang', 
			berat_satuan='$beratsatuan', foto='$file_name', keterangan='$ktrg', stok='$stokbarang' where id_barang='$kode'") or die ("Gagal query".mysql_error());	
			echo "<meta http-equiv='refresh' content='0; url=barang.php?page=1'>";
			}else{
				echo '<script language = "javascript">alert("Data Telah Di Perbaharui.");document.location="barang.php";</script>';
			}
		}
	}

		?>
<?php include 'footer.php'; ?>
