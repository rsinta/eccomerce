<?php 	$kota='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting(0);

		// if (isset($_POST['btn_simpan_kota'])) {
			
		// 	$id 	=$_POST['id_kota'];
		// 	$nama 	=$_POST['nama_kota'];
		// 	$idprov=$_POST['id_provinsi'];
			

		// 	if ($id=="" or $idprov=="" or $nama=="") {
		// 		echo "table class='table table-hover'>
		// 						<div class='container'>
	 //  								<tr calss='col-md-12'>
	 //  									<div class='alert alert-warning' id='myAlert'>
	 //    									<a href='#'' class='close'>&times;</a>
	 //    									<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan lengkapi
	 //  									</div>
	 //  								</tr>
		// 						</div>
		// 					 </table>";
		// 	}else{
		// 		$myQry		=mysql_query("insert into kota (id_kota, id_provinsi, nama_kota) value ('$id', '$idprov','$nama')") or die ("Query Gagal".mysql_error());
		// 		if ($myQry) {
		// 			echo "<metahttp-equiv='refresh' content='0; url=kota.php?page=1'>";
		// 		}
		// 	}
		// }
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Kota</h3>


<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM kota");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page	= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start	= ($page - 1) * $per_hal;
?>
<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">ID Kota</th>
		<th class="col-md-1">Nama Kota</th>
		<th class="col-md-1">Provinsi</th>
				
	</tr>
	<?php 
	
	$ang=mysql_query("SELECT * FROM kota");
	$no=1;
	while ( $b=mysql_fetch_array($ang)) {
		?>
		<tr>
			<td><?php echo $no++ ?>;</td>
			<td><?php echo $b['id_kota'] ?>;</td>
			<td><?php echo $b['nama_kota'] ?>;</td>
			<td><?php echo $b['id_provinsi'] ?>;</td>
			<td>
				<a href="edit_kota.php?id_kota=<?php echo $b['id_kota']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_kota.php?id_kota=<?php echo $b['id_kota']; ?>'}" class="btn btn-danger">Hapus</a>
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
		<li <?php if ($_GET['page']==$x) { ?> class="active"; <?php } ?> ><a href="kota.php<?php echo $x ?>"><?php echo $x ?></a></li>
		<?php
	}
	?>
</ul>

// <?php
// $query = mysql_query("SELECT max(id_kota) as maxKode from kota") or die(mysql_error());
// $data = mysql_fetch_array($query);
// $id_kota = $data['maxKode'];
// $noUrut = (int) substr($id_kota,3,3);
// $noUrut++;
// $char = "KT";
// $newID = $char. sprintf("%03s",$noUrut);
/*
function buatKode($tabel, $inisial){
	$struktur	= mysql_query("SELECT * FROM $tabel");
	$field		= mysql_field_name($struktur,0);
	$panjang	= mysql_field_len($struktur,0);

 	$qry	= mysql_query("SELECT MAX(".$field.") FROM ".$tabel);
	$row	= mysql_fetch_array($qry);
	if ($row[0]=="") {
		$angka=0;
	} else {
		$angka = substr($row[0], strlen($inisial));
	}

	$angka++;
	$angka = strval($angka);
	$tmp="";
	for ($i=1; $i <=($panjang-strlen($inisial)-strlen($angka)) ; $i++) { 
		$tmp=$tmp."0";
	}
	return $inisial.$tmp.$angka;
}

$dataKode	= buatKode("kota", "KT");*/
?>

<!-- modal input -->
<!-- <div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Data Kota
				</div>
				<div class="modal-body">
					<form action="kota.php" method="POST">
						<div class="form-group">
							<label>Kode Kota</label>
							<input name="id_kota" type="text" class="form-control" autocomplete="off" readonly>
						</div>
						<div class="form-group">
							<label>Nama Kota</label>
							<input name="nama_kota" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Provinsi</label>
							<input name="id_provinsi" type="text" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_anggota">
					</div>
				</form>
			</div>
		</div>
	</div>
 -->
	<?php include 'footer.php'; ?>