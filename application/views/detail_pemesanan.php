<?php
    foreach($detailKos as $row){
        $namaKos = $row->namaKos;
        $alamatKos = $row->alamatKos;
        $teleponKos = $row->teleponKos;
        $luasParkiran = $row->luasParkiran;
        $latlong = substr($row->latLngKos, 1, -1);
    }

    foreach($tipeKos as $row){
        $tipeKos = $row->tipeKos;
    }

    foreach($detailKamar as $row){
        $jenisKamar = $row->jenisKamar;
        $jumlahKamar = $row->jumlahKamar;
    }

    $hargaKamar = number_format($harga);
?>
<!DOCTYPE html>
<html lang="en">
	<body>
        <aside class="call-to-action">
    		<div class="container">
    			<div class="row">
    			 	<div class="col-lg-12 text-center">
    			 	 	<h2>Pemesanan Kamar</h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <br>
    			 	</div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6" style="border: 1px solid #dedede;">
                        <h3 style="margin-bottom: 3%;">Detail Pemesanan</h3>
                        <div class="col-lg-12">
                            <h4>Nama Pemesan</h4>
                            <h5><?php echo $nama ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Nomor Telepon Pemesan</h4>
                            <h5><?php echo $telepon ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Email Pemesan</h4>
                            <h5><?php echo $email ?></h5>
                        </div>
                        <div class="col-lg-12">
                            <hr>
                        </div>
                        <div class="col-lg-6">
                            <h4>Nama Kos</h4>
                            <h5><?php echo $namaKos ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Tipe Kos</h4>
                            <h5><?php echo $tipeKos ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Jenis Kamar</h4>
                            <h5><?php echo $jenisKamar ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Harga Kamar</h4>
                            <h5>Rp<?php echo $hargaKamar ?>/bulan</h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Tanggal Masuk</h4>
                            <h5><?php echo $masuk ?></h5>
                        </div>
                        <div class="col-lg-6">
                            <h4>Tanggal Keluar</h4>
                            <h5><?php echo $keluar ?></h5>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6" style="border: 1px solid #dedede;">
                        <h3 style="margin-bottom: 3%;">Rincian Pembayaran</h3>
                        <div class="col-lg-12">
                        <h4><?php echo $namaKos ?></h4>
                        </div>
                        <div class="col-lg-6">
                            <h4><?php echo $jenisKamar ?></h4>
                            <h4>Durasi Sewa</h4>
                            <?php
                                if($idPromo > 0){?>
                                    <h4>Promo</h4>
                                <?php }
                            ?>
                            <h3>Total Pembayaran</h3>
                        </div>
                        <div class="col-lg-6">
                            <h4>Rp<?php echo $hargaKamar ?></h4>
                            <h4><?php echo $durasi ?> bulan</h4>
                            <?php
                                if($idPromo > 0){?>
                                    <h4>-Rp<?php echo number_format($potonganHarga) ?></h4>
                                <?php }
                            ?>
                            <h3>Rp<?php echo number_format($totalPembayaran) ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                    <div class="col-lg-12">
                        <br>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-6">
                        <form action="<?php echo site_url('transaksi/index')?>" method="POST">
                            <input type="hidden" name="pemesanan" value="<?php echo $idPemesanan ?>"></input>
                            <input type="hidden" name="totalPembayaran" value="<?php echo $totalPembayaran ?>"></input>
                            <input type="hidden" name="promo" value="<?php echo $idPromo ?>"></input>
                            <button type="submit" class="btn btn-lg btn-dark" style="float: right; margin-right: -2.5%;">Lanjut Ke Pembayaran</button>
                        </form>
                    </div>
                    <div class="col-lg-4"></div>
    			</div>
    		</div>
    	</aside>
	</body>
</html>