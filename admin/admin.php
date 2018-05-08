<?php
error_reporting(0); 	
		$admin='active';
		include "../header/header.php";
		include('koneksi.php');
		require_once('fungsi_admin.php');
		session_start();

		if (isset($_POST['btn_simpan_admin'])) {
			
			$id 	=$_POST['id_admin'];
			$nama	=$_POST['nama_admin'];
			$uname	=$_POST['username'];
			$pswd 	=$_POST['pass'];
			$ptny	=$_POST['pertanyaan'];
			$jwb	=$_POST['jawaban_pertanyaan'];

			if ($id=="" or $nama=="" or $uname=="" or $pswd=="" or $ptny=="" or $jwb=="") {
				echo "table class='table table-hover'>
								<div class='container'>
	  								<tr calss='col-md-12'>
	  									<div class='alert alert-warning' id='myAlert'>
	    									<a href='#'' class='close'>&times;</a>
	    									<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan lengkapi
	  									</div>
	  								</tr>
								</div>
							 </table>";
			}else{
				$myQry		=mysql_query('INSERT INTO admin (id_admin, nama_admin, username, pass, pertanyaan, jawaban_pertanyaan) value
						 ("'.$id.'","'.$nama.'","'.$uname.'","'.$pswd.'","'.$ptny.'","'.$jwb.'")') or die("Query Gagal!".mysql_error());
				if ($myQry) {
					echo "<metahttp-equiv='refresh' content='0; url=admin.php?page=1'>";
				}
			}
		}
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Admin</h3>


<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">ID Admin</th>
		<th class="col-md-3">Nama</th>
		<th class="col-md-3">Username</th>
		<th class="col-md-3">Password</th>
		<th class="col-md-4">Pertanyaan</th>
		<th class="col-md-4">Jawaban Pertanyaan</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
		$ang="SELECT * FROM admin";
		$data=mysql_query($ang);
		$no=1;
		while ($b=mysql_fetch_array($data)) {
		?>
		<tr>
			<td><?php echo $no++ ?>.</td>
			<td><?php echo $b['id_admin'] ?></td>
			<td><?php echo $b['nama_admin'] ?></td>
			<td><?php echo $b['username'] ?></td>
			<td><?php echo md5($b['pass']) ?></td>
			<td><?php echo $b['pertanyaan'] ?></td>
			<td><?php echo $b['jawaban_pertanyaan'] ?>;</td>
			<td>
				
				<a href="edit_admin.php?id_admin=<?php echo $b['id_admin']; ?>" class="btn-warning" >Edit</a>
				<a onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { location.href='delete_admin.php?id_admin=<?php echo $b['id_admin']; ?>' }" class="btn-danger" >Hapus</a>
			</td>
		</tr>
	<?php	
	}
	?>
</table>

<?php
$query = mysql_query("SELECT max(id_admin) as maxKode from admin") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$id_admin = $data1['maxKode'];
$noUrut = (int) substr($id_admin,3,3);
$noUrut++;
$char = "ADM";
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
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Admin
				</div>
				<div class="modal-body">
					<form action="" method="POST">
						<div class="form-group">
							<label>Kode Admin</label>
							<input name="id_admin" type="text" class="form-control" autocomplete="off" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Admin</label>
							<input name="nama_admin" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Username</label>
							<input name="username" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input name="pass" type="password" class="form-control">
						</div>
						</div>
						<div class="form-group">
						<label>Pertanyaan</label>
						<select name="pertanyaan" class="form-control">
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
							<input name="jawaban_pertanyaan" type="text" class="form-control">
						</div>
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_admin">
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include '../footer.php'; ?>