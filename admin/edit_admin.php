<?php
	$anggota='active';
	include '../header/header.php'; 	
	include "../koneksi.php"; 
?>
<h3><span class="glyphicon glyphicon-briefcase"></span> Edit Admin</h3>
<a class="btn" href="admin.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>Kembali</a>
<?php
$kd=mysql_real_escape_string($_GET['id_admin']);
$det=mysql_query("SELECT * FROM admin WHERE id_admin='$kd'")or die(mysql_error());

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
while ($d=mysql_fetch_array($det)) {
?>	
	<form action="edit_admin.php" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label>Kode Admin</label>
				<input name="id_admin" type="text" class="form-control" autocomplete="off" value="<?php echo $d['id_admin'] ?>" readonly>
		</div>
			<div class="form-group">
				<label>Nama Admin</label>
				<input name="nama_admin" type="text" class="form-control" value="<?php echo $d['nama_admin'] ?>">
			</div>
			<div class="form-group">
				<label>Username</label>
				<input name="username" type="text" class="form-control" value="<?php echo $d['username'] ?>">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input name="pass" type="password" class="form-control" value="<?php echo $d['pass'] ?>">
			</div>
		</div>
						<div class="form-group">
						<label>Pertanyaan</label>
						<select name="pertanyaan" class="form-control" value="<?php echo $d['pertanyaan'] ?>">
						<option value="KOSONG">-Pilih-</option>
						<?php
							$dt_q = enum_values( 'admin', 'pertanyaan');
							foreach ($dt_q as $value) {
							$html .= '<option value="'.$value.'">'.$value.'</option>';	
								}
							echo $html;
								?>
						</select>
					</div>
					<div class="form-group">
							<label>Jawaban pertanyaan</label>
							<input name="jawaban_pertanyaan" type="text" class="form-control" value="<?php echo $d['jawaban_pertanyaan'] ?>">
						</div>
						</div>
								<td><input type="submit" class="btn btn-info" value="Simpan" name="btn_simpan_admin"></td>
			</tr>
		</table>
	</form>
	<?php
}

if(isset($_POST['btn_simpan_admin'])){
	$id 	=$_POST['id_admin'];
	$nama	=$_POST['nama_admin'];
	$uname	=$_POST['username'];
	$pswd 	=$_POST['pass'];
	$ptny	=$_POST['pertanyaan'];
	$jwb	=$_POST['jawaban_pertanyaan'];

		$myQry=mysql_query("update admin set nama_admin='$nama', username='$uname', pass='$pswd', pertanyaan='$ptny', jawaban_pertanyaan='$jwb' where id_admin='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=admin.php?page=1'>";
		}
	}
?>
<?php include 'footer.php'; ?>