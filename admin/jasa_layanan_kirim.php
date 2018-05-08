<?php 	$jasakirim='active';
		include "../header/header.php";
		include "../koneksi.php";
		//error_reporting(0);

		if (isset($_POST['btn_simpan_jasakirim'])) {
			
			$id 	=$_POST['id_jasakirim'];
			$nama 	=$_POST['nama_jasakirim'];
			

			if ($id=="" or $nama=="") {
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
				$mySqlin	="INSERT INTO jasa_layanan_kirim (id_jasa_layanan_kirim, nama_jasa_layanan_kirim) VALUES ('$id','$nama')";
				$myQry		=mysql_query($mySqlin, $db) or die ("Query Gagal".mysql_error());
				if ($myQry) {
					//echo "<metahttp-equiv='refresh' content='0; url=jasa_layanan_kirim.php?page=1'>";
				}
			}
		}
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Jasa Layanan Kirim</h3>
<button style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>Tambah</button>

<!-- <?php 
//$per_hal=10;
//$jumlah_record=mysql_query("SELECT COUNT(*) FROM kota");
//$jum=mysql_result($jumlah_record, 0);
//$halaman=ceil($jum / $per_hal);
//$page	= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
//$start	= ($page - 1) * $per_hal;
?> -->
<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-3">ID Jasa Layanan Kirim</th>
		<th class="col-md-4">Nama Jasa Layanan Kirim</th>
		<th class="col-md-4">Opsi</th>	
	</tr>
	<?php $krm=mysql_query("SELECT * FROM jasa_layanan_kirim");
	$no=1;
	while ( $b=mysql_fetch_array($krm)) {
		?>
		<tr>
			<td><?php echo $no++ ?>;</td>
			<td><?php echo $b['id_jasa_layanan_kirim'] ?></td>
			<td><?php echo $b['nama_jasa_layanan_kirim'] ?></td>
			<td>
				<a href="edit_jasakirim.php?id_jasa_layanan_kirim=<?php echo $b['id_jasa_layanan_kirim']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_jasakirim.php?id_jasa_layanan_kirim=<?php echo $b['id_jasa_layanan_kirim']; ?>'}" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	<?php	
	}
	?>
</table>
<ul class="pagination">
	<?php
	for ($x=1; $x<=$halaman; $x++) { 
		?>
		<li <?php if ($_GET['page']==$x) { ?> class="active"; <?php } ?> ><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
		<?php
	}
	?>
</ul>

<?php
$query = mysql_query("SELECT max(id_jasa_layanan_kirim) as maxKode from jasa_layanan_kirim") or die(mysql_error());
$data = mysql_fetch_array($query);
$id_jasa = $data['maxKode'];
$noUrut = (int) substr($id_jasa,4,4);
$noUrut++;
$char = "JASA";
$newID = $char. sprintf("%03s",$noUrut);

?>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Jasa Layanan Kirim
				</div>
				<div class="modal-body">
					<form action="jasa_layanan_kirim.php" method="POST">
						<div class="form-group">
							<label>Kode Jasa Layanan Kirim</label>
							<input name="id_jasakirim" type="text" class="form-control" autocomplete="off" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Jasa Layanan Kirim</label>
							<input name="nama_jasakirim" type="text" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_jasakirim">
					</div>
				</form>
			</div>
		</div>
	</div>

	<?php include 'footer.php'; ?>