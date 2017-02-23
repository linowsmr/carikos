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
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-success">Ubah</button>
                            <a href="<?php echo site_url('kamar/delete?kamar='.$row->idKamar.'')?>"><button class="btn btn-danger">Hapus</button></a>
                        </div>
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-primary">Tambah Fasilitas Kamar</button>
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
                                                <td><?php echo $row->namaFasilitasKamar ?></td>
                                                <td><button class="btn btn-danger btn-sm">Hapus</button></td>
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
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
