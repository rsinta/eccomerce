<?php 	$pelanggan='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting();
		//session_start();

	/*	if (isset($_POST['btn_simpan_anggota'])) {
			
			$id 	=$_POST['id_anggota'];
			$nama	=$_POST['nama_anggota'];
			$idkota	=$_POST['id_kota'];
			$tgllahir=$_POST['tgl_lahir'];
			$jenkel	=$_POST['jenkel'];

			if ($id=="" or $idkota=="" or $nama=="" or $tgllahir=="" or $jenkel=="") {
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
				$mySqlin	="CALL anggota('$id','$idkota','$nama','$tgllahir','$jenkel')";
				$myQry		=mysql_query($mySqlin, $db) or die ("Query Gagal".mysql_error());
				if ($myQry) {
					echo "<metahttp-equiv='refresh' content='0; url=anggota.php?page=1'>";
				}
			}
		}*/
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Anggota</h3>


<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) FROM anggota");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page	= (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start	= ($page - 1) * $per_hal;
?>
<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">Nomor Anggota</th>
		<th class="col-md-2">Nama</th>
		<th class="col-md-2">Jenis Kelamin</th>
		<th class="col-md-5">Alamat</th>
		<th class="col-md-5">Opsi</th>
	</tr>
	<?php $ang=mysql_query("SELECT * FROM anggota");
	$no=1;
	while ( $b=mysql_fetch_array($ang)) {
		?>
		<tr>
			<td><?php echo $no++ ?>;</td>
			<td><?php echo $b['id_anggota'] ?> </td>
			<td><?php echo $b['nama_anggota'] ?> </td>
			<td><?php echo $b['jenkel'] ?> </td>
			<td><?php echo $b['alamat'] ?> </td>
			<td>
				<a href="edit_anggota.php?id_anggota=<?php echo $b['id_anggota']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_anggota.php?id_anggota=<?php echo $b['id_anggota']; ?>'}" class="btn btn-danger">Hapus</a>
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

$dataKode	= buatKode("anggota", "A");
?>

<!-- modal input -->

	<?php include 'footer.php'; ?>