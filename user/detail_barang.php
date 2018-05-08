<?php
    include "../koneksi.php";
    include "../header/header_anggota.php";
        $query1 = mysql_query("SELECT * FROM penjualan") or die(mysql_error());
        $a = mysql_fetch_array($query1);
        $query2 = mysql_query("SELECT * FROM bahan") or die(mysql_error());
        $c = mysql_fetch_array($query2);
?>

<div class="navbar">
    <div class="navbar-inner">
    <div class="container">      
  <div class="row">
  <a class="totalInCart" href="cart.php"><strong>Total Amount  <span class="badge badge-warning pull-right" style="line-height:18px;"><?php echo $a['total_bayar'] ?></span></strong></a></li>
  </ul>
</div>
  <div class="well well-small">
  <div class="row-fluid">
      <div class="span5">
      <div id="myCarousel" class="carousel slide cntr">
                <div class="carousel-inner">
            
      <?php
        $query = mysql_query("SELECT * FROM barang") or die(mysql_error());
        $b = mysql_fetch_array($query);

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
      </div>
    </div>
      <div class="span7">
        <h3><?php echo $b['nama_barang'] ?></h3>
        <hr class="soft"/>
        
        <form class="form-horizontal qtyFrm">
          <div class="control-group">
          <label class="control-label"><span><?php echo $b['harga_barang'] ?></span></label>
          <div class="controls">
          <input type="number" class="span6" placeholder="Qty.">
          </div>
          </div>
          <div class="control-group">
          <label class="control-label"><span>Bahan</span></label>
          <div class="controls">
          <select>
          <option value="KOSONG">-Pilih-</option>
            <?php
            $mySql ="SELECT * FROM bahan ORDER BY id_bahan";
            $myQry = mysql_query($mySql) or die ("Query Gagal".mysql_error());
              while ($myData = mysql_fetch_assoc($myQry)) {
                echo "<option value='$myData[id_bahan]'> $myData[nama_bahan] </option>";
              }
              ?>
            </select>
          </div>
          </div>
          <h4><?php echo $b['stok'] ?></h4>
          <p><?php echo $b['keterangan'] ?>
          <p>
          <button type="submit" class="shopBtn"><span class=" icon-shopping-cart"></span> Tambah Kekeranjang Belanja</button>
        </form>
      </div>
      </div>
        <hr class="softn clr"/>

            <ul id="productDetail" class="nav nav-tabs">
              <li class="active"><a data-toggle="tab">Detail Barang </a></li>
              <li class=""><a href="#profile" data-toggle="tab">Barang Terkait </a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acceseries <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#cat1" data-toggle="tab">Category one</a></li>
                  <li><a href="#cat2" data-toggle="tab">Category two</a></li>
                </ul>
              </li>
            </ul>
            <div id="myTabContent" class="tab-content tabWrapper">
            <div class="tab-pane fade active in" id="home">
        <h4>Product Information</h4>
                <table class="table table-striped">
        <tbody>
        <tr class="techSpecRow"><td class="techSpecTD1">Nama:</td><td class="techSpecTD2"><?php echo $b['nama_barang'] ?></td></tr>
        <tr class="techSpecRow"><td class="techSpecTD1">Berat:</td><td class="techSpecTD2"><?php echo $b['berat_satuan'] ?></td></tr>
        <tr class="techSpecRow"><td class="techSpecTD1">Bahan:</td><td class="techSpecTD2"><?php echo $c['nama_bahan'] ?></td></tr>
        <tr class="techSpecRow"><td class="techSpecTD1">Harga:</td><td class="techSpecTD2"><?php echo $b['harga_barang'] ?></td></tr>
        <tr class="techSpecRow"><td class="techSpecTD1">Keterangan:</td><td class="techSpecTD2"><?php echo $b['keterangan'] ?></td></tr>
        </tbody>
        </table>
        
      </div>
      <div class="tab-pane fade" id="profile">
      <div class="row-fluid">   
      <div class="span2">
        <img src="../img/barang/<?php echo $b['foto'] ?>" width="350" height="400">
      </div>
      <div class="span6">
        <h5>Product Name </h5>
        <p>
        Nowadays the lingerie industry is one of the most successful business spheres.
        We always stay in touch with the latest fashion tendencies - 
        that is why our goods are so popular..
        </p>
      </div>
      <div class="span4 alignR">
      <form class="form-horizontal qtyFrm">
      <h3> $140.00</h3>
      <label class="checkbox">
        <input type="checkbox">  Adds product to compair
      </label><br>
      <div class="btn-group">
        <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
        <a href="detail_barang.php" class="shopBtn">VIEW</a>
       </div>
        </form>
      </div>
    </div>
      <hr class="soft">
      <div class="row-fluid">   
      <div class="span2">
        <img src="assets/img/d.jpg" alt="">
      </div>
      <div class="span6">
        <h5>Product Name </h5>
        <p>
        Nowadays the lingerie industry is one of the most successful business spheres.
        We always stay in touch with the latest fashion tendencies - 
        that is why our goods are so popular..
        </p>
      </div>
      <div class="span4 alignR">
      <form class="form-horizontal qtyFrm">
      <h3> $140.00</h3>
      <label class="checkbox">
        <input type="checkbox">  Adds product to compair
      </label><br>
      <div class="btn-group">
        <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
        <a href="detail_barang.php" class="shopBtn">VIEW</a>
       </div>
        </form>
      </div>
  </div>
      <hr class="soft"/>
      <div class="row-fluid">   
      <div class="span2">
        <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
      </div>
      <div class="span6">
        <h5>Product Name </h5>
        <p>
        Nowadays the lingerie industry is one of the most successful business spheres.
        We always stay in touch with the latest fashion tendencies - 
        that is why our goods are so popular..
        </p>
      </div>
      <div class="span4 alignR">
      <form class="form-horizontal qtyFrm">
      <h3> $140.00</h3>
      <label class="checkbox">
        <input type="checkbox">  Adds product to compair
      </label><br>
      <div class="btn-group">
        <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
        <a href="detail_barang.php" class="shopBtn">VIEW</a>
       </div>
        </form>
      </div>
  </div>
      <hr class="soft"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
            <h5>Product Name </h5>
            <p>
            Nowadays the lingerie industry is one of the most successful business spheres.
            We always stay in touch with the latest fashion tendencies - 
            that is why our goods are so popular..
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> $140.00</h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
            <h5>Product Name </h5>
            <p>
            Nowadays the lingerie industry is one of the most successful business spheres.
            We always stay in touch with the latest fashion tendencies - 
            that is why our goods are so popular..
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> $140.00</h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      </div>
              <div class="tab-pane fade" id="cat1">
                <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
              <br>
              <br>
        <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
             <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
              <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
        </div>
              <div class="tab-pane fade" id="cat2">
                
        <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
        <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
           <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
            <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      <div class="row-fluid">   
          <div class="span2">
            <img src="../img/barang/<?php echo $b['foto'] ?>" alt="">
          </div>
          <div class="span6">
            <h5><?php echo $b['nama_barang'] ?></h5>
            <p><?php echo $b['keterangan'] ?>
            </p>
          </div>
          <div class="span4 alignR">
          <form class="form-horizontal qtyFrm">
          <h3> <?php echo $b['harga_barang'] ?></h3>
          <label class="checkbox">
            <input type="checkbox">  Adds product to compair
          </label><br>
          <div class="btn-group">
            <a href="detail_barang.php" class="defaultBtn"><span class=" icon-shopping-cart"></span> Add to cart</a>
            <a href="detail_barang.php" class="shopBtn">VIEW</a>
           </div>
            </form>
          </div>
      </div>
      <hr class="soften"/>
      
        </div>
            </div>

</div>
</div>
</div> <!-- Body wrapper -->
  <span>Copyright &copy; 2017</span>
</div>
</div>
<a href="#" class="gotop"><i class="icon-double-angle-up"></i></a>
    <!-- Placed at the end of the document so the pages load faster -->
    
  </body>
</html>