<?php 
	include "../header/header_anggota.php";
		include('../koneksi.php');
?>
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
		<a href="edit_cincin.php?id_cincin=<?php echo $b['id_cincin']; ?>" class="btn-warning" >Edit</a>
		<a onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { location.href='delete_cincin.php?id_cincin=<?php echo $b['id_cincin']; ?>' }" class="btn-danger" >Hapus</a>
<?php } ?>
<?php
include 'footer.php';
?>