<?php 	
		$daftar='active';
		include "header/header_user.php";
		include('koneksi.php');
		if (isset($_POST['btn_simpan_user'])) {
			
			$id 	=$_POST['id_anggota'];
			$nama	=$_POST['nama_anggota'];
			$jenkel	=$_POST['jenkel'];
			$alm	=$_POST['alamat'];
			$uname	=$_POST['username_anggota'];
			$pass 	= md5($_POST['password_anggota']);
			

			if ($id=="" or $nama=="" or $jenkel=="" or $alm=="" or $uname=="" or $pass=="") {
				echo "<table class='table table-hover'>
								<div class='container'>
	  								<tr calss='col-md-12'>
	  									<div class='alert alert-warning' id='myAlert'>
	    									<a href='#' class='close'>&times;</a>
	    									<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan lengkapi
	  									</div>
	  								</tr>
								</div>
							 </table>";
							}else{
				$myQry		=mysql_query("insert into anggota (id_anggota, nama_anggota, jenkel, alamat, username_anggota, password_anggota) value ('$id', '$nama', '$jenkel', '$alm', '$uname', '$pass')") or die(mysql_error());
				if ($myQry) {
					echo "<metahttp-equiv='refresh' content='0; url=user/home.php'>";
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
$query = mysql_query("SELECT max(id_anggota) as maxKode from anggota") or die(mysql_error());
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
<!-- modal input -->
<div id="myModal" class="modal fade">				
				</div>
				<div class="modal-body">
				<form action="daftar.php" method="post">
					<div class="col-md-6 col-md-offset-3 kotak">
					<center><h4>Daftar Anggota</h4></center>
					<div class="form-group">
							<td width="30%">ID Anggota</td>
							<input name="id_anggota" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<td width="30%">Nama</td>
							<input name="nama_anggota" type="text" class="form-control">
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
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_user">
					</div>
					</center>
				</form>
	</div>


	<?php include 'footer.php'; ?>