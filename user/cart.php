<?php 
	include "../koneksi.php";
	include "../header/header_anggota.php";
	$sid = $_SESSION['id_anggota'];
$total = 0;
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
<body>
<div class="container">
<div id="gototop"> </div>

<!--
Navigation Bar Section 
-->
<div class="navbar">
	  <div class="navbar-inner">
		<div class="container">
		  <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  <div class="nav-collapse">
		  </div>
		</div>
	  </div>
	</div>
    </ul>
	<div class="well well-small">
		<h1>Check Out <small class="pull-right"> Items </small></h1>
	<hr class="soften"/>	

	<form action="cart.php" method="post" enctype="multipart/form-data">
	<table class="table table-bordered table-condensed">
              <thead>
                <tr>
                	<th>No</th>
                  <th>Nama Produk</th>
                  <th>QTY</th>
				  <th>Harga</th>
                  <th>Subtotal</th>
                  <th>Aksi</th>
				</tr>
              </thead>
              <tbody>
<?php
	$result = mysql_query("SELECT * FROM keranjang, barang WHERE id_anggota='$sid' AND keranjang.id_barang=barang.id_barang") or die(mysql_error());      
$no = 1;
while($d=mysql_fetch_array($result)){
        $subtotal    = $d['harga_barang']* $d['jumlah'];
        $total       = $total + $subtotal;

echo"<tr>
			<input type='hidden' name='id_keranjang' value='$d[id_keranjang]' class='btn btn-info btn-sm'>
			<td>$no</td>
			<td>$d[nama_barang]</td>
            <td><input type='number' name='jumlah' value='$d[jumlah]'></td>
            <td>Rp. $d[harga_barang]</td>
            <td>Rp. $subtotal</td>
            <td><input type='submit' name='btn_ubah_cart' value='Ubah'' class='btn btn-info btn-sm'>&nbsp;
            <a href='delete_cart.php?id_keranjang=$d[id_keranjang]' class='btn btn-danger btn-sm' onclick='return confirm()'>Hapus </a></td></td></tr>";
            $no++;
}
echo "<tr>
                  <td colspan='4' class='alignR'>Total products:	</td>
                  <td>Rp. ".number_format($total)."</td>
                </tr>
     "; ?>
			</tbody>
            </table>
            </form><br/>
			
	<a href="index.php" class="shopBtn btn-large"><span class="icon-arrow-left"></span> Continue Shopping </a>
	<a href="checkout.php" class="shopBtn btn-large pull-right">Check Out <span class="icon-arrow-right"></span></a>

</div>
</div>
</div>

</body>
</html>

<?php
	if(isset($_POST['btn_ubah_cart'])){
	$id 	= $_POST['id_keranjang'];
	$jumlah 	= $_POST['jumlah'];

		$myQry=mysql_query("UPDATE keranjang set jumlah='$jumlah' where id_keranjang='$id'") or die ("Gagal query".mysql_error());
		if($myQry){
			echo "<meta http-equiv='refresh' content='0; url=cart.php'>";
		}
	}
?>