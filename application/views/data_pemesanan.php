<?php
    foreach ($akun as $row) {
        $usernameAkun = $row->username;
        $namaAkun = $row->namaAkun;
        $emailAkun = $row->emailAkun;
        $teleponAkun = $row->teleponAkun;
    }
    foreach($detailKos as $row){
        $idKos = $row->idKos;
        $namaKos = $row->namaKos;
        $alamatKos = $row->alamatKos;
        $teleponKos = $row->teleponKos;
    }

    foreach($tipeKos as $row){
        $tipeKos = $row->tipeKos;
    }

    foreach($detailKamar as $row){
        $idKamar = $row->idKamar;
        $jenisKamar = $row->jenisKamar;
    }

    $hargaKamar = number_format($harga);
?>
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
    			 	 	<h2>Pemesanan Kamar</h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <br>
    			 	</div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-7">
                        <form action="<?php echo site_url('pemesanan/pesan')?>" method="post">
                            <div style="border: 1px solid #dedede;">
                                <h3 style="margin-left: 2.5%; margin-bottom: 3%;">Data Pemesan</h3>
                                <section style="margin-left: 5%; margin-right: 5%;">
                                    <div class="form-group">
                                        <h4>Nama Pemesan</h4>
                                        <input type="text" class="form-control" name="nama" value="<?php echo $namaAkun ?>" required>
                                        <small>Isi nama pemesan sesuai KTP/Paspor/SIM (tanpa tanda baca/gelar)</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Nomor Telepon Pemesan</h4>
                                        <!-- <div class="input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input type="text" class="form-control" name="telepon" value="<?php echo $teleponAkun ?>" required>
                                        </div> -->
                                        <input type="text" class="form-control" name="telepon" value="<?php echo $teleponAkun ?>" required>
                                        <small>Contoh: 0812345678</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Email Pemesan</h4>
                                        <input type="email" class="form-control" name="email" value="<?php echo $emailAkun ?>" required>
                                        <small>Contoh: email@example.com</small>
                                    </div>

                                    <div class="form-group" style="width: 50%;">
                                        <h4>Tanggal Masuk</h4>
                                        <input type="date" class="form-control" name="masuk" required>
                                    </div>
                                    <div class="form-group" style="width: 50%;">
                                        <h4>Tanggal Keluar</h4>
                                        <input type="date" class="form-control" name="keluar" required>
                                    </div>
                                </section>
                            </div>
                            <br>
                            <input type="hidden" name="username" value="linowsmr"></input>
                            <input type="hidden" name="kamar" value="<?php echo $idKamar ?>"></input>
                            <input type="hidden" name="kos" value="<?php echo $idKos ?>"></input>
                            <input type="hidden" name="harga" value="<?php echo $harga ?>"></input>
                            <button type="submit" class="btn btn-lg btn-dark" style="float: right; margin-right: -0.05%">Lanjutkan Pemesanan</button>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <h3 style="margin-bottom: 3%; margin-left: 4%;">Rincian Kamar</h3>
                        <div class="col-lg-5" style="text-align: left;">
                            <h4>Nama Kos</h4>
                            <h4>Jenis Kamar</h4>
                            <h4>Harga Kamar</h4>
                            <h4>Tipe Kos</h4>
                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <h4><?php echo $namaKos ?></h4>
                            <h4><?php echo $jenisKamar ?></h4>
                            <h4>Rp<?php echo $hargaKamar ?>/bulan</h4>
                            <h4><?php echo $tipeKos ?></h4>
                        </div>
                    </div>
    			</div>
    		</div>
    	</aside>
	</body>
</html>