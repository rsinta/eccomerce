<?php
error_reporting(0); 	
		$profil='active';
		include "../header/header_anggota.php";
		include('../koneksi.php');
		$id = $_SESSION['username_anggota'];
?>

<h3></span>Profil Saya</h3>


<br/>
<table class="table">
	<tr>
		<th class="col-md-2">Nama</th>
		<th class="col-md-2">Jenis Kelamin</th>
		<th class="col-md-2">Username</th>
		<th class="col-md-2">Password</th>
		<th class="col-md-2">Alamat</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
		$data=mysql_query("SELECT * FROM anggota");
		
		while ($b=mysql_fetch_array($data)) {
		?>
		<tr>
			<td><?php echo $b['nama_anggota'] ?></td>
			<td><?php echo $b['jenkel'] ?></td>
			<td><?php echo $b['username_anggota'] ?></td>
			<td><?php echo md5($b['password_anggota']) ?></td>
			<td><?php echo $b['alamat'] ?></td>
			<td>
				
				<a href="edit_profil.php?id_anggota=<?php echo $b['id_anggota']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if (confirm('Apakah anda yakin ingin menghapus data ini?')) {location.href='delete_profil.php?id_anggota=<?php echo $b['id_anggota']; ?>'}" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
	<?php	
	}
	?>
</table>

	<?php include '../footer.php'; ?>