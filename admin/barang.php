<?php 
	$barang='active';
	include "../header/header.php";
	include'../koneksi.php';
	 error_reporting(0);

	if (isset($_POST['btn_simpan_bar'])) {
		# code...
		$kode		= $_POST['id_barang'];
		$namakategori	= $_POST['id_kategori'];
		$namabarang	= $_POST['nama_barang'];
		$hargabarang= $_POST['harga_barang'];
		$beratsatuan= $_POST['berat_satuan'];
		//$foto		= $_POST['foto'];
		$ktrg	= $_POST['keterangan'];
		$stokbarang	= $_POST['stok'];
		$cek 		= mysql_query("select * from barang where id_barang='$kode'");
		if(mysql_num_rows($cek)>0){
			echo '<div align="center"><script language = "javascript">alert("Kode barang yang anda inputkan telah terdaftar!");</script></div>';
		}else{
		$folder 	= '../img/barang/';
		//type file yang bsa di upload
		$file_type 	= array('jpg','jpeg','JPEG','JPG','png');
		//ukuran max yg dapat di upload
		$max_size 	= 1000000;//5MB
		//mulai memories data
		$file_name 		= $_FILES['foto']['name'];
		$tmp1			= $_FILES['foto']['tmp_name'];
				// echo $file_name."<br>";
		// echo $tmp1."<br>";		
  		if(move_uploaded_file(($tmp1), $folder.$file_name)){ 
			//catat nama file ke database
				//$catat = mysql_query('INSERT INTO barang (id_barang, nama_barang,harga_barang, berat_satuan, foto, keterangan, stok) value 
				//	("'.$kode.'","'.$namabarang.'","'.$hargabarang.'","'.$beratsatuan.'","'.$file_name.'","'.$keterangan.'","'.$stokbarang.'")') or die(mysql_error());
 
  			$query = mysql_query("insert into barang (id_barang, id_kategori, nama_barang,harga_barang, berat_satuan, foto, keterangan, stok) value
		 ('$kode','$namakategori','$namabarang','$hargabarang','$beratsatuan','$file_name','$ktrg','$stokbarang')") or die(mysql_error());
				if ($query) {
					echo '<div id="msg"> Berhasil Menambah Data '.$file_name.'</div>';
					echo "<meta http-equiv='refresh' content='0; url=barang.php?page1'";
				}

			}
		}

		}
	
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>Data Barang</h3>
<button style="margin-bottom: 20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</button>
<br/>
<br/>

<?php  
	$per_hal=10;
	$jumlah_record=mysql_query($koneksi, "SELECT COUNT(*) FROM barang");
	$jum=mysql_result($jumlah_record, 0);
	$halaman=ceil($jum/$per_hal);
	$page =(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1)* $per_hal;
?>


<form action="cari.php" method="get" align="left">
	<div class="input-group col-md-5 col-md-offset">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari nama barang disini" aria-describedly="basic-addon1" name="cari">
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th>NO</th>
		<th class="col-md-1">Kode Barang</th>
		<th class="col-md-2">Nama Barang</th>
		<th class="col-md-1">Kategori</th>
		<th class="col-md-2">Harga Barang</th>
		<th class="col-md-1">Berat Satuan</th>
		<th class="col-md-1">Foto</th>
		<th class="col-md-1">Stok</th>
		<th class="col-md-1">Keterangan</th>
		<th class="col-md-2">Opsi</th>
	</tr>
<?php  
	

	if (isset($_GET['cari'])) {
		# code...
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("SELECT * FROM barang WHERE nama_barang LIkE '%$cari%'");
	}else{
		$brg=mysql_query("SELECT * FROM kategori join barang on kategori.id_kategori=barang.id_kategori WHERE kategori.id_kategori=barang.id_kategori ORDER BY nama_barang ASC LIMIT $start, $per_hal");
	}
	$no=1;
	while ($b=mysql_fetch_array($brg)) {
		# code...
		//$sqlkate=mysql_query("SELECT nama_kategori FROM kategori inner join barang on barang.id_kategori=id_kategori WHERE id_kategori=");
		//$sqlkate=mysql_query("SELECT nama_kategori FROM kategori join barang on kategori.id_kategori=barang.id_kategori WHERE kategori.id_kategori=barang.id_kategori");
		//$kdkate=mysql_fetch_array($sqlkate);
	
?>
	<tr>
		<td><?php echo $no++ ?></td>
		<td><?php echo $b['id_barang']; ?></td>
		<td><?php echo $b['nama_barang']; ?></td>
		<td><?php echo $b['nama_kategori']; ?></td>
		<td>RP. <?php echo number_format($b['harga_barang']) ?>,-</td>
		<td><?php echo number_format($b['berat_satuan']) ?> gr</td>
		<td><img src="../img/barang/<?php echo $b['foto']; ?>" width="60" height="80p"></td>
		<td><?php echo $b['stok'] ?></td>
		<td><?php echo $b['keterangan'] ?></td>
		<td>
		<a href="info_barang.php?id_barang=<?php echo $b['id_barang']; ?>" class="btn-info" >Detail</a>
		<a href="edit_barang.php?id_barang=<?php echo $b['id_barang']; ?>" class="btn-warning" >Edit</a>
		<a onclick="if (confirm('Apakah Anda yakin ingin menghapus data ini?')) { location.href='delete_barang.php?id_barang=<?php echo $b['id_barang']; ?>' }" class="btn-danger" >Hapus</a>
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
$query = mysql_query("SELECT max(id_barang) as maxKode from barang") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$id_barang = $data1['maxKode'];
$noUrut = (int) substr($id_barang,3,3);
$noUrut++;

$char = "BRG";
$newID = $char. sprintf("%03s",$noUrut);

?>

<!--Modal Input-->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hiden="true" href="simpan_barang.php">&times;</button>
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
				<form action="barang.php" method="post" enctype="multipart/form-data"> 
					<div class="form-group">
						<label>Kode Barang</label>
						<input type="text" name="id_barang" class="form-control" value="<?php echo $newID; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang">
					</div>
					<div class="form-group">
						<label>Kategori Barang</label>
						<select name="id_kategori" class="form-control">
						<option value="KOSONG">-Pilih-</option>
						<?php
						$mySql ="SELECT * FROM kategori ORDER BY nama_kategori";
						$myQry = mysql_query($mySql) or die ("Query Gagal".mysql_error());
							while ($myData = mysql_fetch_assoc($myQry)) {
								echo "<option value='$myData[id_kategori]'> $myData[nama_kategori] </option>";
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Harga Barang</label>
						<input type="text" name="harga_barang" class="form-control" placeholder="Harga Barang">
					</div>
					<div class="form-group">
						<label>Berat Satuan</label>
						<input type="text" name="berat_satuan" class="form-control" placeholder="Berat Satuan">
					</div>
					<div class="form-group">
						<tr>
        					<td width="30%">Foto<p>*File Berupa Picture max size 1MB</p></td>
        					<td></td>
        					<td><input class="masuk" type="file" name="foto" required oninvalid="this.setCustomValidity('Ini Harus Diisi terlebih Dahulu')"></input></td>
    					</tr>
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input type="text" name="stok" class="form-control" placeholder="Stok">
					</div>
					<div class="form-group">
						<label>Keterangan</label>
						<textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="6" cols="70"></textarea>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<input type="reset" class="btn btn-danger" value="Reset">
							<input type="submit" name="btn_simpan_bar" value="Simpan" class="btn btn-priamary">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
</div>

<?php
include 'footer.php';
?>