<?php 
 	$penjualan='active';
		include "../header/header.php";
		include "../koneksi.php";
		error_reporting(0);
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from penjualan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<a style="margin-bottom:10px" href="lihat_laporanpen.php" class="btn btn-default pull-right"><span class='glyphicon glyphicon-book'></span>  Laporan</a>
</div>
<div class="row">
<div class="col-md-12">
<form action="cari_penjualan.php" method="get">
	<div class="input-group col-md-3 col-md-offset-9">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari Tanggal 2016-01-01" aria-describedby="basic-addon1" name="cari">
	</div>
</form>
</div>
</div>
<br/>
<table class="table table-hover">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode Penjualan</th>
		<th class="col-md-2">Pelanggan</th>
		<th class="col-md-2">Jasa Pengiriman</th>
		<th class="col-md-2">Tgl Penjualan</th>
		<th class="col-md-2">Uang Bayar</th>
		<th class="col-md-2">Total Berat</th>
		<th class="col-md-3">Opsi</th>
	</tr>
	<?php
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select *, DATE_FORMAT(tgl_penjualan, '%d-%b-%Y') as tgl_penjualan from penjualan where tgl_penjualan like '%$cari%'");
	}else
	{
		$brg=mysql_query("SELECT *, DATE_FORMAT(tgl_penjualan, '%d-%b-%Y') as tgl_penjualan FROM penjualan ORDER BY id_penjualan DESC LIMIT $start, $per_hal");

	}
	$no=1;
	while($b=mysql_fetch_array($brg)){
	$pen=mysql_query("SELECT * FROM anggota");
	$jas=mysql_query("SELECT * FROM jasa_layanan_kirim")
		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_penjualan']; ?></td>
			<td><?php while($c=mysql_fetch_array($pen)){if($b['id_anggota']==$c['id_anggota']){ echo $c['nama_anggota'];}}  ?></td>
			<td><?php while($d=mysql_fetch_array($jas)){if($b['id_jasa_layanan_kirim']==$d['id_jasa_layanan_kirim']){ echo $d['nama_jasa_layanan_kirim'];}}  ?></td>
			<td><?php echo $b['tgl_penjualan'] ?></td>
			<td><?php echo "Rp. "; echo number_format($b['total_bayar']); echo ",-"; ?></td>			
			<td><?php echo number_format($b['total_berat']); echo "kg"; ?></td>
			<td>
				<a href="edit_penjualan.php?kd_pen=<?php echo $b['kd_pen']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='delete_penjualan.php?kd_pen=<?php echo $b['kd_pen']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td colspan="5">Total Pembayaran</td>
		<td>
		<?php

			$x=mysql_query("select sum(total_bayar) as total from penjualan");
			$xx=mysql_fetch_array($x);
			echo "<b> Rp.". number_format($xx['total']).",-</b>";
		?>
		</td>
	</tr>
</table>
<ul class="pagination">
			<?php
			for($x=1;$x<=$halaman;$x++){
				?>
				<li <?php if($_GET['page']==$x){?> class="active"; <?php } ?> ><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>
		</ul>
