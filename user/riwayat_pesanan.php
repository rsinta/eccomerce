<?php
	include '../koneksi.php';
    include "../header/header_anggota.php";
    $sid = $_SESSION['id_anggota'];
?>

<div class="alert alert-success">
  <strong>Sukses!</strong> Belanjaan anda telah kami proses.
</div>
<br/>
<table class="table table-bordered table-condensed">
              <thead>
                <tr>
                    <th>No</th>
                  <th>Tanggal Beli</th>
                  <th>No Resi</th>
                  <th>Jasa Pengiriman</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
<?php
    $result = mysql_query("SELECT * FROM penjualan WHERE id_anggota='$sid'") or die(mysql_error());      
$no = 1;
while($d=mysql_fetch_array($result)){

echo"<tr>
            <td>$no</td>
            <td>$d[tgl_pembelian]</td>
            <td>$d[no_resi]</td>
            <td>$d[id_jasa_pengiriman]</td>
            <td>Rp. $d[total_bayar]</td></tr>";
            $no++;
} ?>
            </tbody>
            </table>
<a href="index.php" class="btn btn-info" role="button">Lanjutkan belanja</a>