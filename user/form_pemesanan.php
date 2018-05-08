<?php
error_reporting(0); 	
		$pemesanan='active';
		include "../header/header_anggota.php";
		include('../koneksi.php');
		if (isset($_POST['btn_simpan_user'])) {
			
			$kode 		= $_POST['id_pemesanan'];
			$banyak 	= $_POST['jumlah'];
			$berat 		= $_POST['total_berat'];
			$deskrip	= $_POST['deskripsi'];
			$cek 		= mysql_query("select * from pemesanan where id_pemesanan='$kode'");
		if(mysql_num_rows($cek)>0){
			echo '<div align="center"><script language = "javascript">alert("Silahkan Ulangi Kembali!");</script></div>';
		}else{
		$folder 	= '../img/pesan/';
		//type file yang bsa di upload
		$file_type 	= array('jpg','jpeg','JPEG','JPG','png');
		//ukuran max yg dapat di upload
		$max_size 	= 1000000;//5MB
		//mulai memories data
		$file_name 		= $_FILES['model']['name'];
		$tmp1			= $_FILES['model']['tmp_name'];
				// echo $file_name."<br>";
		// echo $tmp1."<br>";		
  		if(move_uploaded_file(($tmp1), $folder.$file_name)){ 
 
  			$query = mysql_query("insert into pemesanan (id_pemesanan, jumlah, total_berat,  deskripsi, model) value
		 ('$kode','$banyak','$berat','$deskripsi','$file_name')") or die(mysql_error());
				if ($query) {
					echo '<div id="msg"> Berhasil Ditambahkan ke Keranjang Belanja! '.$file_name.'</div>';
					echo "<meta http-equiv='refresh' content='0; url=index.php?page1'";
				}

			}
		}

		}
?>

<style type="text/css">
		.kotak{
		margin-top:1px;
	}
	.kotak ,input_grup{
		margin-bottom : 20px;
	}
	</style>

<?php
$query = mysql_query("SELECT max(id_pemesanan) as maxKode from pemesanan") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$angg = $data1['maxKode'];
$noUrut = (int) substr($angg,3,3);
$noUrut++;
$char = "PSN";
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
<!-- modal input -->
<div id="myModal" class="modal fade">				
				</div>
				<div class="modal-body">
				<form action="form_pemesanan.php" method="post" enctype="multipart/form-data">
					<div class="col-md-6 col-md-offset-3 kotak">
					<center><h4>Form Pemesanan Barang</h4></center>
					<div class="form-group">
							<td width="30%">No. Pemesanan</td>
							<input name="id_pemesanan" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<td>Banyak</td>
							<input name="jumlah" type="text" class="form-control">
						</div>
						<div class="form-group">
							<tr>
        					<td width="30%">Foto<p>*File Berupa Picture max size 1MB</p></td>
        					<td></td>
        					<td><input class="masuk" type="file" name="model" required oninvalid="this.setCustomValidity('Ini Harus Diisi terlebih Dahulu')"></input></td>
    					</tr>
						</div>
						<div class="form-group">
							<td>Deskripsi</td>
							<textarea type="text" name="deskripsi" class="form-control"></textarea>
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_user">
					</div>
					</center>
				</form>
	</div>


	<?php include 'footer.php'; ?>