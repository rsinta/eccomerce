<?php 	
		$costume='active';
		include "../header/header_anggota.php";
		include('../koneksi.php');
		if (isset($_POST['btn_simpan_cin'])) {
			
			$id 		=$_POST['id_cincin'];
			$ukuran 	=$_POST['ukuran_cincin'];
			$deskrip 		=$_POST['deskripsi'];
			$cek 		= mysql_query("select * from cincin where id_cincin='$id'");
		if(mysql_num_rows($cek)>0){
			echo '<div align="center"><script language = "javascript">alert("Kode cincin yang anda inputkan telah terdaftar!");</script></div>';
		}else{
		$folder 	= '../img/cincin/';
		//type file yang bsa di upload
		$file_type 	= array('jpg','jpeg','JPEG','JPG','png');
		//ukuran max yg dapat di upload
		$max_size 	= 1000000;//5MB
		//mulai memories data
		$file_name 		= $_FILES['model']['name'];
		$tmp1			= $_FILES['model']['tmp_name'];

  		if(move_uploaded_file(($tmp1), $folder.$file_name)){ 
 
  			$query = mysql_query("insert into cincin (id_cincin, ukuran_cincin, model, deskripsi) value
		 ('$id','$ukuran','$file_name','$deskrip')") or die(mysql_error());
				if ($query) {
					echo '<div id="msg"> Berhasil Menambah Data '.$file_name.'</div>';
					echo "<meta http-equiv='refresh' content='0; url=pesanan_cincin.php?page1'";
				}

			}
		}

		}
?>
<style type="text/css">
		.kotak{
		margin-top:10px;
	}
	.kotak ,input_grup{
		margin-bottom : 20px;
	}
	</style>

<?php
$query = mysql_query("SELECT max(id_cincin) as maxKode from cincin") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$angg = $data1['maxKode'];
$noUrut = (int) substr($angg,3,3);
$noUrut++;
$char = "CIN";
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
				<form action="cincin_custom.php" method="post" enctype="multipart/form-data">
					<div class="col-md-6 col-md-offset-4 kotak">
					<center><h4>Cincin Custome</h4></center>
					<div class="form-group">
							<td width="30%">Kode Cincin</td>
							<input name="id_cincin" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
						<td width="30%">Ukuran Cincin</td>
						<select name="ukuran_cincin" class="form-control">
						<option value="KOSONG">-Pilih-</option>
						<?php
							$dt_q = enum_values( 'cincin', 'ukuran_cincin');
							foreach ($dt_q as $value) {
							$html .= '<option value="'.$value.'">'.$value.'</option>';	
								}
							echo $html;
								?>

								</select>
					</div>
					<div class="form-group">
						<tr>
        					<td width="30%">Model<p>*File Berupa Picture max size 1MB</p></td>
        					<td></td>
        					<td><input class="masuk" type="file" name="model" required oninvalid="this.setCustomValidity('Ini Harus Diisi terlebih Dahulu')"></input></td>
    					</tr>
					</div>
						<div class="form-group">
							<td width="30%">Deskripsi</td>
							<input name="deskripsi" type="textbox" class="form-control">
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_cin">
					</div>
					</center>
				</form>
	</div>


	<?php include 'footer.php'; ?>