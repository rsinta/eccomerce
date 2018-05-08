<?php 
	$konfimasipemesanan='active'; 
	include ('../header/header_anggota.php'); 	
	include ('../koneksi.php');  


if(isset($_POST['btn_konpes'])){
		$kode		= $_POST['id_konfirmasi_pemesanan'];
		$pemesanan 	= $_POST['id_pemesanan'];
		$namabank	= $_POST['nama_bank_tujuan'];
		$cek 		= mysql_query("select * from konfirmasi_pemesanan where id_konfirmasi_pemesanan='$kode'");
		if(mysql_num_rows($cek)>0){
			echo '<div align="center"><script language = "javascript">alert("Kode barang yang anda inputkan telah terdaftar!");</script></div>';
		}else{
		$folder 	= '../img/bukti/';
		//type file yang bsa di upload
		$file_type 	= array('jpg','jpeg','JPEG','JPG','png');
		//ukuran max yg dapat di upload
		$max_size 	= 1000000;//5MB
		//mulai memories data
		$file_name 		= $_FILES['foto']['name'];
		$tmp1			= $_FILES['foto']['tmp_name'];
	
  		if(move_uploaded_file(($tmp1), $folder.$file_name)){ 
  			$query = mysql_query("insert into konfirmasi_pemesanan (id_konfirmasi_pemesanan, id_pemesanan, nama_bank_tujuan,foto) value ('$kode','$pemesanan','$namabank','$file_name')") or die(mysql_error());
				if ($query) {
					echo '<div id="msg"> Berhasil Menambah Data '.$file_name.'</div>';
					echo "<meta http-equiv='refresh' content='0; url=barang.php?page1'";
				}

			}
		}

		}
	
		?>

<style type="text/css">
		.kotak{
		margin-top:50px;
		margin-left: 250px;
	}
	.kotak ,input_grup{
		margin-bottom : 20px;
		
	}
	</style>

<?php
$query = mysql_query("SELECT max(id_konfirmasi_pemesanan) as maxKode from konfimasi_pemesanan") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$angg = $data1['maxKode'];
$noUrut = (int) substr($angg,3,3);
$noUrut++;
$char = "AGT";
$newID = $char. sprintf("%03s",$noUrut);
	function enum_values($table_name, $column_name) {
	$sql = "
		SELECT COLUMN_TYPE 
		FROM INFORMATION_SCHEMA.COLUMNS
		WHERE TABLE_NAME = '" . mysql_real_escape_string($table_name) . "' 
		AND COLUMN_NAME = '" . mysql_real_escape_string($column_name) . "'  ";
				   
		$result = mysql_query($sql) or die (mysql_error());
		$row = mysql_fetch_array($result);
		$enum_list = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
				    // die();
		return $enum_list;
		}
?>
<script type="text/javascript" src="../js/ajax.js"></script>
<!-- modal input -->
<div id="myModal" class="modal fade">				
				</div>
				<div class="modal-body">
				<form action="daftar.php" method="post" enctype="multipart/form-data">
					<div class="col-md-6 col-md-offset-4 kotak">
					<center><h4>Daftar Anggota</h4></center>
					<div class="form-group">
							<td width="30%">ID Pesanan</td>
							<input name="id_anggota" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<td width="30%">Nama</td>
							<input name="nama_annggota" type="text" class="form-control">
						</div>
						<div class="form-group">
							<td>Username</td>
							<input name="username_anggota" type="text" class="form-control">
						</div>
						<div class="form-group">
							<td>Password</td>
							<input name="password_anggota" type="password" class="form-control">
						</div>
					
						<div class="form-group" >
							<td>Tanggal Lahir</td>
							<input name="tgl_lahir" type="text" class="form-control">
						</div>
						<div class="form-group" >
						<td>Jenis Kelamin</td>
						<select name="jenkel" class="form-control">
						<option value="KOSONG">-Pilih-</option>
						<?php
							$dt_q = enum_values( 'anggota', 'jenkel');
							foreach ($dt_q as $value) {
							$html .= '<option value="'.$value.'">'.$value.'</option>';	
								}
							echo $html;
								?>
								</select>
					</div>
					<div class="form-group">
						<td>Provinsi</td>
						<select id="prop" name="id_provinsi" class="form-control" onchange="ajaxkota(this.value)">">
						<option value="KOSONG">-Pilih-</option>
						<?php
						$mySql ="SELECT * FROM provinsi ORDER BY nama_provinsi";
						$myQry = mysql_query($mySql) or die ("Query Gagal".mysql_error());
							while ($myData = mysql_fetch_assoc($myQry)) {
								echo "<option value='$myData[id_provinsi]'> $myData[nama_provinsi] </option>";
							}
							?>
						</select>
						</div>
					<div class="form-group">
						<td>Kota</td>
						<select id="kot" name="id_kota" class="form-control" onchange="ajaxkec(this.value)">
						<option value="KOSONG">-Pilih-</option>
						<?php 
							$sql_kota = mysql_query("SELECT * FROM kota WHERE id_provinsi= $prov");
							while ($row_kota = mysql_fetch_array($sql_kota)) {
								# code...
								echo '<option value = "'.$row_kota['id_kota'].'">'.$row_kota['nama_kota'].'</option>';
							}
						?>
						</select>
						</div>
					<div class="form-group">
							<td>Alamat</td>
							<input name="alamat" type="text" class="form-control">
						</div>
						<div class="form-group">
							<td>No. Telp</td>
							<input name="no_telp" type="text" class="form-control" format="number">
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_user">
					</div>
					</center>
				</form>
	</div>

	<?php
include '../footer.php';
?>
