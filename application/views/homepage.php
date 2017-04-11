<!DOCTYPE html>
<html lang="en">

<body>
    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <img src="<?php echo base_url();?>assets/images/carikos-logo.png" style="width: 28%; height: 25%;">
            <br><br>
            <a href="#cari" class="btn btn-dark btn-lg">Cari Kos</a>
            <?php
                if($akun == 0){ ?>
                    <a href="#daftar" class="btn btn-dark btn-lg">Daftar Kos</a>
                <?php }
            ?>
        </div>
    </header>

    <section id="cari" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Cari Kos yang Anda Inginkan</h2>
                    <hr class="small" style="border-color: black;">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
	                    <form action="<?php echo site_url('pencarian/index') ?>" method="get">
	                		<div class="form-group">
	                            <h4>Kota</h4>
	                            <select class="form-control selectpicker" name="kota" title="Tidak Ada yang Dipilih">
	                            	<option value="Surabaya">Surabaya</option>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Harga</h4>
	                            <select class="form-control selectpicker" name="harga" title="Tidak Ada yang Dipilih">
	                            	<option value="4">> Rp1.500.000,00</option>
	                            	<option value="3">Rp1.000.001,00 - Rp1.500.000,00</option>
	                            	<option value="2">Rp500.001,00 - Rp1.000.000,00</option>
	                            	<option value="1">Rp0 - Rp500.000,00</option>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Tipe Kos</h4>
	                            <select class="form-control selectpicker" name="tipe" title="Tidak Ada yang Dipilih">
	                                <?php
	                                    foreach($tipe as $row){ ?>
	                                        <option value="<?php echo $row->idTipeKos ?>"><?php echo $row->tipeKos ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Fasilitas Kos</h4>
	                            <select id="multiple-select-fasilitas" multiple="multiple" name="fasilitaskos[]">
	                                <?php
	                                    foreach($fasilitas as $row){ ?>
	                                        <option value="<?php echo $row->idFasilitasKos ?>"><?php echo $row->namaFasilitasKos ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Fasilitas Kamar</h4>
	                            <select id="multiple-select-tipe" multiple="multiple" name="fasilitaskamar[]">
	                                <?php
	                                    foreach($fasilitaskamar as $row){ ?>
	                                        <option value="<?php echo $row->idFasilitasKamar ?>"><?php echo $row->namaFasilitasKamar ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
                            <div class="form-group">
                                <h4>Dekat dengan Jurusan</h4>
                                <select class="selectpicker" name="jurusan" data-live-search="true" title="Tidak Ada yang Dipilih">
                                    <optgroup label="Institut Teknologi Sepuluh Nopember">
                                        <?php
                                            foreach($jurusan as $row){ ?>
                                                <option value="<?php echo $row->idJurusan ?>"><?php echo $row->namaJurusan ?></option>
                                            <?php }
                                        ?>
                                    </optgroup>
                                </select>
                            </div>
	                    	<button type="submit" class="btn btn-lg btn-dark">Cari</button>
	                    </form>
	                </div>
	                <div class="col-lg-4"></div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <?php
        if($akun == 0){ ?>
            <aside id="daftar" class="call-to-action bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Daftar Kos</h2>
                            <hr class="small">
                            <h4>Anda Harus Masuk Sebagai Pemilik Kos Untuk Melakukan Pendaftaran Kos</h4>
                            <br>
                            <div class="row">
                                <div class="col-lg-4">
                                </div>
                                <div class="col-lg-4">
                                    <form action="<?php echo site_url('pemilik/login')?>" method="post">
                                        <div class="form-group">
                                            <h4>Nama Akun</h4>
                                            <input type="name" class="form-control" name="akun" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Kata Sandi</h4>
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                        <button type="submit" class="btn btn-lg btn-light">Masuk</button>
                                    </form>
                                    <h5>Belum punya akun ? <a href="<?php echo site_url('pemilik/daftar')?>" style="color: #66ccff">Daftar</a></h5>
                                </div>
                                <div class="col-lg-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        <?php }
    ?>

</body>

</html>
