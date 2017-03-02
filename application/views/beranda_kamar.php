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
                            <h2>Jenis Kamar "<?php echo $row->jenisKamar ?>"</h2>
                            <hr class="small" style="border-color: black;">
                            <h3>Harga</h3>
                            <p><?php echo $row->hargaKamar ?></p>
                            <h3>Jumlah</h3>
                            <p><?php echo $row->jumlahKamar ?></p>
                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <form action="<?php echo site_url('kamar/update') ?>" method="get">
                                <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <form action="<?php echo site_url('kamar/delete') ?>" method="post">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                        <div class="col-lg-12 text-center">
                            <form action="<?php echo site_url('kamar/tambah_fasilitas') ?>" method="get">
                                <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                <button type="submit" class="btn btn-primary">Tambah Fasilitas Kamar</button>
                            </form>
                        </div>
                    <?php } ?>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Fasilitas Kamar</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($fasilitas as $row) { ?>
                                            <tr>
                                                <td><p><?php echo $row->namaFasilitasKamar ?></p></td>
                                                <td>
                                                    <form action="<?php echo site_url('kamar/delete_fasilitas') ?>" method="post">
                                                        <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                                        <input type="hidden" name="fasilitas" value="<?php echo $row->idKamarFasilitasKamar ?>"></input>
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-4"></div>
            </div>
        </div>
    </aside>

    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h2>Foto Kamar</h2>
                    <hr class="small">
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach($foto as $row){ ?>
                                    <div class="col-lg-3">
                                        <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>">
                                            <img class="img-responsive" alt="" src="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>" />
                                        </a>
                                        <form action="<?php echo site_url('kamar/hapus_foto') ?>" method="post">
                                            <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                            <input type="hidden" name="foto" value="<?php echo $row->idFotoKamar ?>"></input>
                                            <input type="hidden" name="nama" value="<?php echo $row->namaFileKamar ?>"></input>
                                            <button type="submit" class="btn btn-danger btn-xs">Hapus Foto</button>
                                        </form>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                    <form action="<?php echo site_url('kamar/tambah_foto') ?>" method="get">
                        <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                        <button type="submit" class="btn btn-default">Tambah Foto Kamar</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
