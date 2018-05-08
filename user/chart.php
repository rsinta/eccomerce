			<div class="BigContent">
				<div class="LeftContent">
					<div id="navigation">
						<ul class="top-level">
						<?php 
							/*$kat = mysql_query("SELECT category, category.id from category join product on product.id_category=category.id group by category");
							while($list=mysql_fetch_array($kat)){
								echo"<li><a href='product.php?cat=$list[id]'>$list[category]</a></li>";
							}*/
						?>
						</ul>
					</div>
				</div>
				<div class="RightContent">
					<h1 class="Judul">Shopping Cart</h1>
					<div class="KetProd">
						<table class="TableCart" width="100%" cellspacing="0" cellpadding="0" border="0" style="border-top: 1px dotted #0; border-bottom: 1px dotted #0;">
							<tr><th>No</th>
								<th>Foto Produk</th>
								<th>Nama Produk</th>
								<th>Jumlah</th>
								<th>Harga</th>
								<th>Delete</th>
							</th>
						<?php
							$id = session_id();
							$no = 1;
							$sql = mysql_query("SELECT * FROM pembelian, barang WHERE id_session='$id' AND pembelian.id_barang=barang.id_barang");
							$hitung = mysql_num_rows($sql);
							if ($hitung < 1){
								//echo"<script>window.alert('Keranjang Pembelian  Kosong....');
								//		window.location=('index.php')</script>";
								}
							else {
								while($tian=mysql_fetch_array($sql)){
									echo"<tr><td>$no</td>
										<td><img width=50 src=../img/barang/$tian[filename]></td>
										<td>$tian[jenis_cnderamata]</td>
										<td>$tian[qty]</td>
										<td>$tian[price]</td>
										<td><a href=input.php?input=delete&id=$tian[id_keranjang]>Hapus</a></td></tr>";
							$no++;
								}
							}
						?>
						</table>
						<a class="tombol" href="pesanan.php">Selesai</a>
						<a class="tombol" href="index.php">Belanja Lagi..</a>
						
					</div>

				</div>
<?php include "bottom.php"; ?>