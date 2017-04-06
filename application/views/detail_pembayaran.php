<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
       #map {
        height: 50%;
        width: 50%;
       }
    </style>
    </head>
	<body>
        <aside class="call-to-action">
    		<div class="container">
    			<div class="row">
    			 	<div class="col-lg-12 text-center">
    			 	 	<h2>Pembayaran</h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <br>
    			 	</div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" style="border: 1px solid #dedede;">
                        <h3 style="margin-bottom: 3%;">Rincian Pembayaran</h3>
                        <div class="col-lg-6">
                            <h4>ID Pemesanan</h4>
                            <h3>Total Pembayaran</h3>
                        </div>
                        <div class="col-lg-6">
                            <h4><?php echo $idPemesanan?></h4>
                            <h3>Rp<?php echo number_format($totalPembayaran) ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6" style="border: 1px solid #dedede;">
                        <h3 style="margin-bottom: 3%;">Transfer Ke</h3>
                        <div class="col-lg-12">
                            <img src="<?php echo base_url();?>assets/images/BNI.png" style="width: 60px;height: 20px;"> 
                        </div>
                        <div class="col-lg-6">
                            <h3>Bank BNI</h3>
                            <h4>Atas Nama</h4>
                        </div>
                        <div class="col-lg-6">
                            <h3>3456982131</h3>
                            <h4>PT. CariKos Coorperate</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse1">Cara Transfer melalui ATM BANK BNI</a>
                              </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h5>1. Pilih menu <b>Transfer</b> </h5>
                                <h5>2. Pilih menu <b>Transfer ke BANK BNI</b></h5>
                                <h5>3. Masukan nomor rekening yang dituju <b>3456982131</b></h5>
                                <h5>4. Masukan jumlah uang yang akan di transfer sebesar <b>Rp<?php echo number_format($totalPembayaran);?></b></h5>
                                <h5>5. Tekan oke</h5>
                                <h5>6. Transaksi selesai</h5>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-12"></div>
                    <br>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="panel-group">
                          <div class="panel panel-default">
                            <div class="panel-heading">
                              <h4 class="panel-title">
                                <a data-toggle="collapse" href="#collapse2">Cara Transfer melalui ATM BERSAMA</a>
                              </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                              <div class="panel-body">
                                <h5>1. Pilih menu <b>Transfer</b> </h5>
                                <h5>2. Pilih menu <b>Transfer ke BANK LAIN</b></h5>
                                <h5>3. Masukan kode bank BNI beserta nomor rekening yang dituju <b>0093456982131</b></h5>
                                <h5>4. Masukan jumlah uang yang akan di transfer sebesar <b>Rp<?php echo number_format($totalPembayaran);?></b></h5>
                                <h5>5. Tekan oke</h5>
                                <h5>6. Transaksi selesai</h5>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-12"></div>
                    <br>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form action="<?php echo site_url('transaksi/Konfirmasi')?>" method="POST">
                            <input type="hidden" name="pemesanan" value="<?php echo $idPemesanan ?>"></input>
                            <input type="hidden" name="totalPembayaran" value="<?php echo $totalPembayaran ?>"></input>
                            <button type="submit" class="btn btn-lg btn-dark" style="float: right; margin-right: -2.5%;">Konfirmasi Pembayaran</button>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
    			</div>
    		</div>
    	</aside>
	</body>
</html>