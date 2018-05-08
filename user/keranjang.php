<?php 
session_start();    
$sid = $_SESSION['id_anggota'];
$total = 0;
include "../koneksi.php";
echo"<h1>Keranjang Belanja</h1>
          <table border=1>
          <tr>
                <th>Nama Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Sub Total</th>
          </tr>
          <br><br>";//jalankan perintah inner join dari tabel keranjang dan produk
$result = mysql_query("SELECT * FROM keranjang, barang WHERE id_anggota='$sid' AND keranjang.id_barang=barang.id_barang") or die(mysql_error());      
while($d=mysql_fetch_array($result)){
        $subtotal    = $d['harga_barang']* $d['jumlah'];
        $total       = $total + $subtotal;
        echo"<tr><td>$d[nama_barang]</td>
            <td>$d[jumlah]</td>
            <td>$d[harga_barang]</td>
            <td>$subtotal</td></tr>";
}
echo"</table>
<h2>Total Belanja : <b>$total</b></h2>
<ul>
<li><a href='index.php'>Tambah Barang</a></li>
<li><a href='selesai.php'>Selesai belanja</a></li>
</ul>";
?>
