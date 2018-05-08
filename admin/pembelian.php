<?php 
	$pembelian='active';
	include "../header/header.php";
	include('../koneksi.php');	
	//error_reporting(0);
	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Transaksi Pembelian</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>Transaksi</button>
<br>
<br>
<?php
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from pembelian");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	
	<a style="margin-bottom:10px" href="lihat_laporanpembelian.php" class="btn btn-default pull-right"><span class='glyphicon glyphicon-book'></span>  Laporan</a>
</div>
<form action="cari_pembelian.php" method="get">
	<div class="input-group col-md-3 col-md-offset-9">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari Tanggal" aria-describedby="basic-addon1" name="cari">
	</div>
</form>

<br/>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-1">Kode Pembelian </th>
		<th class="col-md-1">Kode Pengrajin</th>
		<th class="col-md-2">Tanggal Pembelian</th>
		<th class="col-md-1">Harga Beli</th>
		<th class="col-md-1">Banyak</th>
		<th class="col-md-1">Jumlah Bayar</th>
		<th class="col-md-2">Keterangan</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from pembelian where tgl_masuk like '%$cari%'");
	}else{
		$brg=mysql_query("select *, DATE_FORMAT(tgl_masuk, '%d-%b-%Y') as tgl_masuk from pembelian order by id_pembelian DESC limit $start, $per_hal ");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_pembelian'] ?></td>
			<td><?php echo $b['id_pengrajin'] ?></td>
			<td><?php echo $b['tgl_masuk'] ?></td>
			<td><?php echo $b['harga_beli'] ?></td>
			<td><?php echo $b['jumlah'] ?></td>
			<td><?php echo $b['total_bayar'] ?></td>
			<td><?php echo $b['keterangan'] ?></td>
			<td>
				
				<a href="edit_pembelian.php?id_pembelian=<?php echo $b['id_pembelian']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='delete_pembelian.php?id_pembelian=<?php echo $b['id_pembelian']; ?>' }" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php }	?>
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

<?php
if(isset($_POST['btn_simpan_pem'])){
		$kd 	=$_POST['id_pembelian'];
		$br 	=$_POST['id_pengrajin'];
		$tgl 	=$_POST['tgl_masuk'];
		$harga 	= $_GET['harga_beli'];
		$jml	=$_POST['jumlah'];
		$byr	=$_POST['total_bayar'];
		$ket 	=$_POST['keterangan'];

		$query = mysql_query("insert into pembelian (id_pembelian, id_pengrajin,tgl_masuk, jumlah) value ('$kd','$peng','$br','$tgl','$jml')") or die(mysql_error());
		$sql=mysql_query("SELECT id_pembelian, id_pengrajin, id_barang FROM pembelian where id_pembelian='$kd'");
		$data=mysql_fetch_array($sql);
		$pengrajin=$data['id_pengrajin'];
		$barang=$data['id_barang'];
		$query1	= mysql_query('insert into pembelian (id_pembelian, id_barang) value ("'.$kd.'","'.$barang.'")') or die(mysql_error());
		if ($query==1&&$query1==1) {
			$query 	= mysql_query('insert into pembelian_pengrajin (id_pembelian,id_pengrajin) value ("'.$kd.'","'.$pengrajin.'")') or die(mysql_error());
			echo "<metahttp-equiv='refresh' content='0; url=pembelian.php?page=1'>";
		}
	}
 ?>
 <?php
$query = mysql_query("SELECT max(id_pembelian) as maxKode from pembelian") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$id_pembelian = $data1['maxKode'];
$noUrut = (int) substr($id_pembelian,3,3);
$noUrut++;
$char = "PBL";
$newID = $char. sprintf("%03s",$noUrut);
?>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Transaksi Pembelian
				</div>
				<div class="modal-body">
					<form action="pembelian.php" method="post">
						<div class="form-group">
							<label>Kode Pembelian</label>
							<input name="id_pembelian" type="text" class="form-control" autocomplete="off" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<label>Nama Pengrajin</label>
							<input name="id_pengrajin" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama Barang</label>
							<input name="id_barang" type="text" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Pembelian</label>
							<input name="tgl_masuk" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="form-group">
							<label>Banyak</label>
							<input name="jumlah" type="text" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_pem">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>