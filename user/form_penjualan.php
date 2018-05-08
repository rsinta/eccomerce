<?php 
    include('../koneksi.php');
    include ('../header/header_anggota.php');

    if(isset($_POST['save'])){
        $kode   = $_POST['kode'];
        $jenis  = $_POST['barang'];
        $jumlah = $_POST['jumlah'];
        $bayar  = $_POST['hasil'];
        $id     = $_POST['id'];
        $cek    = mysql_query("select jumlah_beli from detail_penjualan where id_penjualan='$kode'");
        $data   = mysql_fetch_array($cek);
        $isi    = $data['jumlah'];
        if($isi==0){
        $query = mysql_query("update detail_penjualan set id_detail_penjualan='$id',id_penjualan='$kode',id_barang='$jenis',jumlah_beli='$jumlah',total_bayar='$bayar' where id_detail_penjualan='$id'") or die(mysql_error());
        
        }else{
        $query  = mysql_query('insert into detail_penjualan(id_detail_penjualan,id_penjualan,id_barang,jumlah_beli,total_bayar) value ("","'.$kode.'","'.$jenis.'","'.$jumlah.'","'.$bayar.'")') or die(mysql_error());
        }
        if ($query) {
            echo '<script language = "javascript">alert("Terima Kasih, anda telah melakukan transaksi pemesanan!");document.location="?mn=info_pesanbarang";</script>';
        }else{          
            echo '<script language = "javascript">alert("Transaksi anda belum dapat diproses, ulangi beberapa saat lagi!");document.location="index.php?mn=katalog_barang";</script>';
        }
    }
?>
<html>
<head>
    <title>Form Pembelian</title>
</head>

</style>
<body>
<?php 
    $id = $_SESSION['username_anggota'];
    $sql = mysql_query("SELECT * FROM anggota join penjualan on anggota.id_anggota=penjualan.id_anggota where anggota.username_anggota='$id'") or die(mysql_error());
    $data = mysql_fetch_array($sql);
    $Pesan = $data['id_penjualan'];
    $query=mysql_query("select * from pemesanan where id_penjualan='$Pesan'");
    $isi=mysql_fetch_array($query);

                             
 ?>


    <div id="myModal" class="modal fade">               
                </div>
                <div class="modal-body">
                <form name="input_penjualan" action="form_penjualan&id=<?php echo $id; ?>" method="post">
                
                <div class="col-md-6 col-md-offset-4 kotak">
                    <input type="text" name="id" value="<?php echo $isi['id_penjualan']; ?>" hidden>
                    <center><h4>Form Pemesanan</h4></center>
                    <div class="form-group">
                     <td width="30%">Kode Pemesanan</td>
                         <td colspan="3"><input type="text" name="kode" value="<?php echo $data['id_penjualan']; ?>"></input></td>
                        </div>
                        <div class="form-group">
                            <td width="30%">Kode Barang</td>
                             <?php 
                             $sql1   = mysql_query("select * from detail_penjualan join barang on detail_penjualan.id_barang=barang.id_barang where barang.id_barang") or die(mysql_error());
                                    $query1 = mysql_fetch_array($sql1);
                                    $idbar = $query1['id_barang'];
                                    $result = mysql_query("select * from barang WHERE id_barang= '$idbar'");
                                    $data1 = mysql_fetch_array($result);
                              ?>
                            <input class="masuk" readonly="" type="text" name="barang" value="<?php echo $data1['id_barang']; ?>">
                        </div>
                        <div class="form-group">
                            <td>Nama Barang</td>
                            <input class="masuk" readonly="" type="text" name="namabrg" value="<?php echo $data1['nama_barang']; ?>">
                        </div>
                        <div class="form-group">
                            <td>Harga Barang</td>
                            <input class="masuk" readonly="" type="text" name="harga" onKeyUp="sum();" value="<?php echo $data1['harga_barang']; ?>">
                        </div>
                    
                        <div class="form-group" >
                            <td>Jumlah Bayar</td>
                            <input id="hasil"  name="hasil"></input>
                        </div>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <input type="reset" class="btn btn-danger" value="Reset">
                        <input type="submit" class="btn btn-primary" value="Simpan" name="save">
                    </div>
                    </center>
                </form>
    </div>

<script type="text/javascript">
    function sum(){
        var txtFirstNumberValue = document.getElementById('harga').value;
        var txtSecondtNumberValue = document.getElementById('jumlah').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondtNumberValue);
        if (!isNaN(result)) {
            document.getElementById('hasil').value=result;
    }
};
</script>
</center>
</body>
</html>
 <?php include '../footer.php'; ?>