<?php 
	$p_pembelian='active';
	include "../header/header.php";
	include('../koneksi.php');


if(isset($_POST['simpanproses'])){

	$kode 		=$_POST['id_barang'];
	$barang 	=$_POST['cmbBarang'];
	$harga 		=$_POST['harga_barang'];
	$hargajul 	=$_POST['hargajul'];
	$supplier	=$_POST['cmbsupplier'];
	$jumlah 	=$_POST['jumlah'];

	if($supplier=="" or $harga=="" or $jumlah=="")
	{
		echo "<table class='table table-hover'>
					<div class='container'>
	  					<tr calss='col-md-12'>
	  						<div class='alert alert-warning' id='myAlert'>
	    						<a href='#'' class='close'>&times;</a>
	    						<strong>Data Belum Disimpan!</strong> Masih ada Form yang kosong
	  						</div>
	  					</tr>
					</div>
				</table>";
	}else{

		$Sql = "SELECT * FROM barang WHERE id_barang='$barang'";
		$Qry = mysql_query($Sql, $db) or die ("Gagal Query".mysql_error());
		$cek=mysql_fetch_array($Qry);
		if($cek['kd_supp']==$supplier)
		{
			if($harga>=$hargajul)
			{
				echo "<table class='table table-hover'>
					<div class='container'>
	  					<tr calss='col-md-12'>
	  						<div class='alert alert-danger' id='myAlert'>
	    						<a href='#'' class='close'>&times;</a>
	    						<strong>Gagal Disimpan</strong> Harga Beli lebih besar dari dari Harga Jual
	  						</div>
	  					</tr>
					</div>
				</table>";

			}else{
					$a = "SELECT * FROM detail_pembelian WHERE id_pembelian='$kode' AND id_barang='$barang'";
					$b = mysql_query($a, $db) or die ("Gagal Query".mysql_error());
					$c =mysql_fetch_array($b);

					if($c['id_barang']==$barang)
					{
						echo "<table class='table table-hover'>
								<div class='container'>
	  								<tr calss='col-md-12'>
	  									<div class='alert alert-warning' id='myAlert'>
	    									<a href='#'' class='close'>&times;</a>
	    									<strong>Peringatan!</strong> Barang Ini sudah dibeli jika ada perubahan silahkan hapus dan inputkan lagi
	  									</div>
	  								</tr>
								</div>
							 </table>";
					}else{
					//procedure mengimput data pembelian item
					$memotong1 = substr($harga, 0,-3);
					$memotong2 = substr($hargajul, 0,-3);

					$mySql	= "CALL  pem_p_input('$kode','$barang','$supplier',$memotong1,$jumlah)";

					//procedure mengaupdate harga jual di table barang
					$sqlhargajul = "CALL pem_input_hrgjulbrg($memotong2,'$barang','$supplier')";

					$myQry=mysql_query($mySql, $db) or die ("Gagal query".mysql_error());
					$myQryjul=mysql_query($sqlhargajul, $db) or die ("Gagal query".mysql_error());

					if($myQry && $myQryjul){
						echo "<meta http-equiv='refresh' content='0; url=p_pembelian.php?kd_pem=$kode'>";
					}
					}
			}
		}else{

			echo "<table class='table table-hover'>
					<div class='container'>
	  					<tr calss='col-md-12'>
	  						<div class='alert alert-danger' id='myAlert'>
	    						<a href='#'' class='close'>&times;</a>
	    						<strong>Gagal Disimpan!</strong> Barang dan Supplier yang dipilih tidak cocok
	  						</div>
	  					</tr>
					</div>
				</table>";
		}
	}
}

?>


<script type="text/javascript">

	function coba()
	{
	   var val = pembelian.cmbBarang.value;
	   if(val!=""){
		var data = val.split('/', 2);
		pembelian.harga.value=data[0];
		}else{
		pembelian.harga.value='';
	}
}
$(document).ready(function(){
			$('#harga').maskMoney({prefix:'', thousands:'', decimal:'.', precision:2}).val('0');
			$('#hargajul').maskMoney({prefix:'', thousands:'', decimal:'.', precision:2}).val('0');
		});

</script>



<h3><span class="glyphicon glyphicon-briefcase"></span>  Proses Transaksi Pembelian</h3>
<a class="btn" href="pembelian.php?page=1"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$kd=mysql_real_escape_string($_GET['kd_pem']);

?>
<form action="" method="post" name="pembelian">
	<table class="table table-hover">
		<tr>
			<td class="col-md-2">Kode Pembelian</td>
			<td class="col-md-10"><input name="kode" type="text" class="form-control" value="<?php echo $kd; ?>" readonly></td>
		</tr>
		<tr>
			<td>Barang</td>
			<td><select name="cmbBarang" class="form-control">
			<?php
			$Sql = "SELECT * FROM barang ORDER BY nm_barang ASC";
			$Qry = mysql_query($Sql, $db) or die ("Gagal Query".mysql_error());
			while ($Data = mysql_fetch_array($Qry)) {
			echo "<option value='$Data[kd_barang]' $cek>[ $Data[kd_barang] ] $Data[nm_barang] </option>";
			}
		?></select>
		</td>
		</tr>
		<tr>
			<td>Supplier</td>
			<td><select name="cmbsupplier" class="form-control">
					          <option value="KOSONG">....</option>
			<?php
						$mySql = "SELECT * FROM supplier ORDER BY nm_supp";
						$myQry = mysql_query($mySql, $db) or die ("Gagal Query".mysql_error());
						while ($myData = mysql_fetch_array($myQry)) {
						echo "<option value='$myData[kd_supp]' $cek>[ $myData[kd_supp] ]  $myData[nm_supp] </option>";
						}
						?>
		?></select></td>
		</tr>

		<tr>
			<td>Harga Beli</td>
			<td><input id="harga" name="harga" type="text" class="form-control"></td>
		</tr>
		<tr>
			<td>Harga Jual</td>
			<td><input id="hargajul" name="hargajul" type="text" class="form-control" ></td>
		</tr>
		<tr>
			<td>Jumlah</td>
			<td><input name="jumlah" type="number" class="form-control" ></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" class="btn btn-primary" value="Simpan" name="simpanproses"></td>
		</tr>
	</table>
</form>


<table class="table table-hover">
	<tr>
		<th>No</th>
		<th class="col-md-2">Kode Pembelian</th>
		<th class="col-md-5">Barang</th>
		<th class="col-md-1">Kode Supplier</th>
		<th class="col-md-2">Harga Beli</th>
		<th>Jumlah</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php
	$brg=mysql_query("select * from pembelian_item where kd_pem='$kd'");
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['kd_pem']; ?></td>
			<td>
			<?php
			$tmbarang=mysql_query("SELECT * FROM barang",$db);
			while($nmbrg=mysql_fetch_array($tmbarang)){
			if ($b['id_barang']==$nmbrg['id_barang']){
				echo $nmbrg['nama_barang'];
			}
		}
			?>
			</td>
			<td><?php echo $b['kd_supp'] ?></td>
			<td>Rp. <?php echo number_format($b['harga_beli']) ?>.00-</td>
			<td><?php echo $b['jml'] ?></td>
			<td>
				<a href="info_pembelian.php?id=<?php echo $b['id'];?>&&kd_pem=<?php echo $b['kd_pem']; ?>" class="btn btn-info">Detail</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='delete_p_pembelian.php?kd_pem=<?php echo $b['kd_pem'];?>&&id=<?php echo $b['id'];?>&&kd_barang=<?php echo $b['kd_barang'];?>&&jumlah=<?php echo $b['jml'];?>'}" class="btn btn-danger">Hapus</a>
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td colspan="4"><b>Total Bayar</b></td>
		<td>
		<?php

			$x=mysql_query("SELECT sum(jml*harga_beli) AS total FROM pembelian_item WHERE kd_pem='$kd'");
			$xx=mysql_fetch_array($x);
			echo "<b> Rp.". number_format($xx['total']).",-</b>";
		?>
		</td>
	</tr>
</table>

<?php include 'footer.php'; ?>
