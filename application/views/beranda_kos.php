<!DOCTYPE html>
<html lang="en">

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
                <a href="index.html#top" onclick=$("#menu-close").click();>Beranda</a>
            </li>
            <li>
                <a href="index.html#tentang" onclick=$("#menu-close").click();>Tentang</a>
            </li>
            <li>
                <a href="index.html#cari" onclick=$("#menu-close").click();>Cari Kos</a>
            </li>
            <li>
                <a href="index.html#daftar" onclick=$("#menu-close").click();>Daftar Kos</a>
            </li>
        </ul>
    </nav>

    <div id="top"></div>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <?php
                    foreach($detail as $row){ ?>
                        <div class="col-lg-12 text-center">
                            <h2><?php echo $row->namaKos ?></h2>
                            <hr class="small" style="border-color: black;">
                            <h3>Alamat</h3>
                            <p><?php echo $row->alamatKos ?></p>
                            <h3>Telepon</h3>
                            <p><?php echo $row->teleponKos ?></p>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-success">Ubah</button>
                            <a href="<?php echo site_url('kos/delete?kos='.$row->idKos.'')?>"><button class="btn btn-danger">Hapus</button></a>
                        </div>
                        <div class="col-lg-12 text-center">
                            <a href="<?php echo site_url('kos/tambah_tipe?kos='.$row->idKos.'')?>"><button class="btn btn-primary">Tambah Tipe Kos</button></a>
                            <a href="<?php echo site_url('kos/tambah_fasilitas?kos='.$row->idKos.'')?>"><button class="btn btn-primary">Tambah Fasilitas Kos</button></a>
                        </div>
                    <?php } ?>
    
                        <div class="col-lg-6">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Tipe Kos</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($tipe as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->tipeKos ?></td>
                                                <td><a href="<?php echo site_url('kos/delete_tipe?kos='.$row->idKos.'&tipe='.$row->idKosTipeKos.'')?>"><button class="btn btn-danger btn-sm">Hapus</button></a></td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Fasilitas Kos</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($fasilitas as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->namaFasilitasKos ?></td>
                                                <td><a href="<?php echo site_url('kos/delete_fasilitas?kos='.$row->idKos.'&fasilitas='.$row->idKosFasilitasKos.'')?>"><button class="btn btn-danger btn-sm">Hapus</button></a></td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </aside>

    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h2>Foto Kos</h2>
                    <hr class="small">
                </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <?php
                	foreach($detail as $row) { ?>
	                	<h2>Daftar Kamar <?php echo $row->namaKos ?></h2>
		                    <hr class="small" style="border-color: black;">
		                </div>
                	<?php }
                    if($jumlah < 1) { ?>
                        <h4 class="text-center">Kos Belum Memiliki Kamar</h4>
                    <?php
                        }
                    else { ?>
                        <div class="row">
                            <div class="col-lg-1">
                            </div>
                            <div class="col-lg-10">
                                <table class="table table-stripped">
                                    <thead>
                                      <tr>
                                        <th>Jenis Kamar</th>
                                        <th>Harga Kamar</th>
                                        <th>Jumlah Kamar</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($kamar as $row) { ?>
                                                <tr>
                                                    <td><a href="<?php echo site_url('kamar/beranda?kamar='.$row->idKamar.'')?>"><?php echo $row->jenisKamar ?></a></td>
                                                    <td><?php echo $row->hargaKamar ?></td>
                                                    <td><?php echo $row->jumlahKamar ?></td>
                                                    <td>
                                                        <a href="<?php echo site_url('kamar/delete?kamar='.$row->idKamar.'')?>"><button class="btn btn-danger btn-sm">Hapus</button></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-1">
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </aside>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                	<h2>Daftar Kamar</h2>
                    <hr class="small">
	                <div class="row">
	                    <form action="<?php echo site_url('kamar/daftar')?>" method="post">
	                        <div class="col-lg-4"></div>
	                        <div class="col-lg-4">
	                            <div class="form-group">
	                                <h4>Jenis Kamar</h4>
	                                <input type="name" class="form-control" name="jenis">
	                            </div>
	                            <div class="form-group">
	                                <h4>Harga Kamar</h4>
	                                <div class="input-group">
	                                	<span class="input-group-addon">Rp</span>
	                                	<input type="name" class="form-control" name="harga">
	                                	<span class="input-group-addon">,00</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <h4>Jumlah Kamar</h4>
	                                <div class="input-group">
	                                	<input type="name" class="form-control" name="jumlah">
	                                	<span class="input-group-addon">Kamar</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <h4>Fasilitas Kamar</h4>
	                                <select id="multiple-select-fasilitas" multiple="multiple" name="fasilitas[]">
	                                    <?php
	                                        foreach($fasilitaskamar as $row){ ?>
	                                            <option value="<?php echo $row->idFasilitasKamar ?>"><?php echo $row->namaFasilitasKamar ?></option>
	                                        <?php }
	                                    ?>
	                                </select>
	                            </div>
	                            <div class="form-group">
	                                <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
	                            </div>
	                        </div>
	                        <div class="col-lg-4"></div>
	                        <div class="col-lg-12">
	                            <button type="submit" class="btn btn-lg btn-light">Daftar</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
            </div>
        </div>
    </aside>
</body>

</html>