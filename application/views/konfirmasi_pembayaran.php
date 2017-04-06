<?php 
 foreach ($totalPembayaran as $row) {
     $totalPembayaran = $row->totalPembayaran;
 }
 foreach ($idTransaksi as $row) {
     $idTransaksi = $row->idTransaksi;
 }?>
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
    			 	 	<h2>Konfirmasi Pembayaran</h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <br>
    			 	</div>
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form action="<?php echo site_url('transaksi/konfBayar')?>" method="post">
                            <div style="border: 1px solid #dedede;">
                                <h3 style="margin-left: 2.5%; margin-bottom: 3%;">Data Pembayaran</h3>
                                <section style="margin-left: 5%; margin-right: 5%;">
                                    <div class="form-group">
                                        <h4>Bank Rekening Asal</h4>
                                        <select class="form-control selectpicker" name="bank" title="Tidak Ada yang Dipilih">
                                            <option value="BNI">Bank BNI</option>
                                            <option value="Mandiri">Bank Mandiri</option>
                                            <option value="BCA">Bank BCA</option>
                                            <option value="BTN">Bank BTN</option>
                                            <option value="BRI">Bank BRI</option>
                                            <option value="Danamon">Bank Danamon</option>
                                            <option value="Mega">Bank Mega</option>
                                            <option value="CIMB Niaga">Bank CIMB Niaga</option>
                                            <option value="Permata">Bank Permata</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h4>Nomor Rekening</h4>
                                        <input type="text" class="form-control" name="norek" required>
                                        <small>Isi nomor rekening yang dipakai untuk pembayaran</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Nama Pemegang Rekening</h4>
                                        <input type="text" class="form-control" name="namarek" required>
                                        <small>Nama sesuai dengan pemilik rekening</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Sebesar</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp</span>
                                            <input type="number" min="0" max="<?php echo $totalPembayaran;?>" class="form-control" name="totalBayar" required>
                                        </div>
                                        <small>Total yang harus dibayar <b>Rp<?php echo number_format($totalPembayaran)?></b></small>
                                    </div>
                                </section>
                            </div>
                            <br>
                            <input type="hidden" name="idTransaksi" value="<?php echo $idTransaksi?>"></input>
                            <button type="submit" class="btn btn-lg btn-dark" style="float: right; margin-right: -0.05%">Konfirmasi</button>
                        </form>
                    </div>
    			</div>
    		</div>
    	</aside>
	</body>
</html>