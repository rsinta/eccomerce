<?php 
include('../koneksi.php');
include ('../header/header_anggota.php')
?>

<!doctype html>
<html>
<head>
<style type="text/css">
  body{
    padding-top: 54px;
}

@media (min-width: 992px) {
    body {
        padding-top: 56px;
    }
}
</style>
</head>
<body>
    <script src="../bootstrap/vendor-home-page/jquery/jquery.min.js"></script>
    <script src="../bootstrap/vendor-home-page/popper/popper.min.js"></script>
    <script src="../bootstrap/vendor-home-page/bootstrap/js/bootstrap.min.js"></script>
    <div class="container">

      <div class="row">

        <div class="col-lg-9">
          
          <!-- COba corousel-->
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

<div class="carousel-inner" align="center">
        
<?php 
            $query = mysql_query("select * from barang order by id_barang desc limit 3") or die ("Query gagal dengan error: ".mysql_error());
            $noact = 0;
            $active= '';
               while($row=mysql_fetch_array($query))
                  { 
                    if($noact==0){
                      $active = 'active';
                    }else{
                      $active='';
                    }
                    ?>
                    <div class="item <?php echo $active; ?>">  
                <img class="d-block img-fluid" src="../img/barang/<?php echo $row['foto']; ?>" width="350" height="150" data-thumb="<?php echo $row['foto']; ?>"  alt="" ></div>
                <?php
                $noact++;
                 }
                ?>
            </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

         
          <div class="row">
          <h3 class="Judul">Produk Kami</h3>
          <?php
            $sql = mysql_query("SELECT * FROM barang ORDER BY id_barang DESC") or die ("Query gagal dengan error: ".mysql_error());
            while($data=mysql_fetch_array($sql)){ ?>
            
            <div class="col-md-4">

          <div class="produk" align="center">
            <a href="product.php?id=<?php echo $data['id_barang']; ?>">
              <img title="<?php echo $data['nama_barang']; ?>" class="FotoProduk" src="../img/barang/<?php echo $data['foto']; ?>" height="150px" />
            </a>
            <br class="clearfloat" />
            <div class="KotakKet"><!-- 
            <a class="pesanprod" href="form_pembelian.php?&id=<?php // echo $data['id_barang']; ?>">Pesan</a> -->
            <a href="action_cart.php?id=<?php echo $data['id_barang']; ?>">Pesan</a>
            </p>
            </div>
          </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>


    </div>
    <!-- /.container -->
    <!-- Footer -->
  <?php include "../footer.php" ?>

  </body>
  