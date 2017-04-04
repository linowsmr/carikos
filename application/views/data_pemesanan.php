<?php
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

	    <!-- Navigation -->
	    <a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
	    <nav id="sidebar-wrapper">
	        <ul class="sidebar-nav">
	            <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
	            <li class="sidebar-brand">
	                <a href="#top" onclick=$("#menu-close").click();>CariKos</a>
	            </li>
	            <li>
	                <a href="#top" onclick=$("#menu-close").click();>Beranda</a>
	            </li>
	            <li>
	                <a href="#tentang" onclick=$("#menu-close").click();>Tentang</a>
	            </li>
	            <li>
	                <a href="#cari" onclick=$("#menu-close").click();>Cari Kos</a>
	            </li>
	            <li>
	                <a href="#daftar" onclick=$("#menu-close").click();>Daftar Kos</a>
	            </li>
	        </ul>
	    </nav>

	    <div id="top"></div>
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
                                        <input type="text" class="form-control" name="nama" required>
                                        <small>Isi nama pemesan sesuai KTP/Paspor/SIM (tanpa tanda baca/gelar)</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Nomor Telepon Pemesan</h4>
                                        <div class="input-group">
                                            <span class="input-group-addon">+62</span>
                                            <input type="text" class="form-control" name="telepon" required>
                                        </div>
                                        <small>Contoh: +62812345678</small>
                                    </div>
                                    <div class="form-group">
                                        <h4>Email Pemesan</h4>
                                        <input type="email" class="form-control" name="email" required>
                                        <small>Contoh: email@example.com</small>
                                    </div>
                                    <div class="form-group" style="width: 50%;">
                                        <h4>Durasi Pemesanan</h4>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" name="durasi" required>
                                            <span class="input-group-addon">bulan</span>
                                        </div>
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