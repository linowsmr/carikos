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
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        foreach($detail as $row) { ?>
                            <h2>Ubah Kamar "<?php echo $row->jenisKamar ?>"</h2>
                            <hr class="small">
                            <div class="row">
                                <form action="<?php echo site_url('kamar/update_data')?>" method="post">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <h4>Jenis Kamar</h4>
                                            <input type="name" class="form-control" name="jenis" value="<?php echo $row->jenisKamar ?>"  required>
                                        </div>
                                       <div class="form-group">
                                            <h4>Harga Kamar</h4>
                                            <div class="input-group">
                                                <span class="input-group-addon">Rp</span>
                                                <input type="name" class="form-control" name="harga" value="<?php echo $row->hargaKamar ?>" required>
                                                <span class="input-group-addon">,00</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h4>Jumlah Kamar</h4>
                                            <div class="input-group">
                                                <input type="name" class="form-control" name="jumlah" value="<?php echo $row->jumlahKamar ?>" required>
                                                <span class="input-group-addon">Kamar</span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $row->idKamar ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-lg btn-light">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
