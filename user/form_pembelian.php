<?php
error_reporting(0); 	
		$pembelian='active';
		include "../header/header_anggota.php";
		include('../koneksi.php');
		if (isset($_POST['btn_simpan_user'])) {
			
			$kode 		= $_POST['id_penjualan'];
			$anggota 	= $_GET['id_anggota'];
			$barang 	= $_POST['id_barang'];
			$banyak 	= $_POST['jumlah'];
			$berat 		= $_POST['berat'];

			if ($kode=="" or $barang=="" or $banyak=="" or $berat=="") {
				echo "<table class='table table-hover'>
								<div class='container'>
	  								<tr calss='col-md-12'>
	  									<div class='alert alert-warning' id='myAlert'>
	    									<a href='#' class='close'>&times;</a>
	    									<strong>Peringatan!</strong> Form masih ada yang kosong, silahkan lengkapi
	  									</div>
	  								</tr>
								</div>
							 </table>";
				$myQry		=mysql_query("insert into pemesanan (id_penjualan, id_anggota, id_barang, password_anggota) value ('$kode', '$nama', '$jenkel', '$uname', '$pass')") or die(mysql_error());
				if ($myQry) {
					echo "<metahttp-equiv='refresh' content='0; url=user/home.php'>";
				}
			}
		}
?>

<style type="text/css">
		.kotak{
		margin-top:1px;
	}
	.kotak ,input_grup{
		margin-bottom : 20px;
	}
	</style>

<?php
$query = mysql_query("SELECT max(id_penjualan) as maxKode from penjualan") or die(mysql_error());
$data1 = mysql_fetch_array($query);
$angg = $data1['maxKode'];
$noUrut = (int) substr($angg,3,3);
$noUrut++;
$char = "PEM";
$newID = $char. sprintf("%03s",$noUrut);
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
<!-- modal input -->
<div id="myModal" class="modal fade">				
				</div>
				<div class="modal-body">
				<form action="form_pembelian.php" method="post" enctype="multipart/form-data">
					<div class="col-md-6 col-md-offset-3 kotak">
					<center><h4>Form Pembelian Barang</h4></center>
					<div class="form-group">
							<td width="30%">No. Pembelian</td>
							<input name="id_penjualan" type="text" class="form-control" value="<?php echo $newID; ?>" readonly>
						</div>
						<div class="form-group">
							<td width="30%">Nama Barang</td>
							<?php
			                include('../koneksi.php');
			                    $id=mysql_real_escape_string($_GET['id']);
			                    $result = mysql_query("SELECT * FROM barang WHERE id_barang='$id'")or die(mysql_error());
			                    $brg = mysql_fetch_array($result);
			                ?>
							<input name="id_barang" type="text" class="form-control" value="<?php echo $brg['id_barang'] ?>" readonly="">
						</div>
						<div class="form-group">
							<td>Banyak</td>
							<input name="jumlah" type="text" class="form-control">
						</div>
							<div class="form-group">
							<td>Harga </td>
							<input name="harga" type="text" class="form-control" value="<?php echo $brg['harga_barang']?>" readonly="">
						</div>
						<div class="form-group">
							<td>Berat </td>
							<input name="berat" type="text" class="form-control" value="<?php echo $brg['berat_satuan'] ?>" readonly="">
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">
						<input type="submit" class="btn btn-primary" value="Simpan" name="btn_simpan_user">
						<a href="">
					</div>
					</center>
				</form>
	</div>


	<?php include 'footer.php'; ?>