<?php 
	$cincin='active';
	include "../header/header.php";
	include'../koneksi.php';

	
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Cincin</h3>
<button style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Cincin</button>
<br/>
<br/>

<?php  
	$per_hal=10;
	$jumlah_record=mysqli_query("SELECT COUNT(*) FROM cincin");
	$jum=mysql_result($jumlah_record);
	$halaman=ceil($jum/$per_hal);
	$page =(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1)* $per_hal;


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

<form action="cincin.php" method="get">
	<div class="input-group col-md-5 col-md-offset">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari cincin disini" aria-describedly="basic-addon1" name="cari">
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th>NO</th>
		<th class="col-md-1">Kode Cincin</th>
		<th class="col-md-2">Ukuran</th>
		<th class="col-md-2">Foto</th>
		<th class="col-md-3">Deskripsi</th>
		<th class="col-md-3">Opsi</th>
	</tr>
<?php 
	$ang=mysql_query("SELECT * FROM cincin");
	
	while ( $b=mysql_fetch_array($ang)){
	$b=1;
?>
	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $b['id_cincin']; ?></td>
		<td><?php echo $b['ukuran_cincin']; ?></td>
		<td><?php echo $b['model']; ?></td>
		<td><?php echo $b['deskripsi']; ?></td>
		<td>
		<a href="edit_cincin.php?id_cincin=<?php echo $b['id_cincin']; ?>" class="btn-warning" >Edit</a>
		<a onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { location.href='delete_cincin.php?id_cincin=<?php echo $b['id_cincin']; ?>' }" class="btn-danger" >Hapus</a>
		</td>
	</tr>
	<?php
	}
	?>
</table>
<ul class="pagination">
	<?php 
		for ($x=1; $x<$halaman; $x++) { 
			?>	
			<li <?php if ($_GET['page']==$x){?> class="active"; <?php } ?> >
			<a href="?page=<?php echo $x ?>"> <?php echo $x ?> </a>
			</li>
			<?php
				}
			?>
</ul>
<?php
$query = mysql_query("SELECT max(id_cincin) as maxKode from cincin") or die(mysql_error());
$data = mysql_fetch_array($query);
$id_cincin = $data['maxKode'];
$noUrut = (int) substr($id_cincin,3,3);
$noUrut++;
$char = "CIN";
$newID = $char. sprintf("%03s",$noUrut);

?>
<!--Modal Input-->
<!-- <div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hiden="true">&times;</button>
				<h4 class="modal-title">Tambah Cincin Baru</h4>
			</div>
			<div class="modal-body">
				<form action="cincin.php" method="post"> 
					<div class="form-group">
						<label>Kode Cincin</label>
						<input type="text" name="id_cincin" class="form-control" value="<?php echo $newID; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Ukuran Cincin</label>
						<select name="ukuran_cincin" class="form-control">
						<option value="KOSONG">-Pilih-</option>
						<?php
							/*$dt_q = enum_values( 'cincin', 'ukuran_cincin');
							foreach ($dt_q as $value) {
							$html .= '<option value="'.$value.'">'.$value.'</option>';	
								}
							echo $html;*/
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
						<label>Deskripsi</label>
						<textarea name="deskripsi" class="form-control" placeholder="Deskripsi" rows="6" cols="70"></textarea>
						</div>
						<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_cin">
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>
 -->
<?php
include 'footer.php';
?>