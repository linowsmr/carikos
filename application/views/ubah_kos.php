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
                        foreach($detail as $row) { 
                            $luasParkir = $row->idParkiranKos;
                            $idKos = $row->idKos; ?>
                            <h2>Ubah Kos "<?php echo $row->namaKos ?>"</h2>
                            <hr class="small">
                            <div class="row">
                                <form action="<?php echo site_url('kos/update_data')?>" method="post">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <h4>Nama Kos</h4>
                                            <input type="name" class="form-control" name="nama" value="<?php echo $row->namaKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Alamat Kos</h4>
                                            <textarea class="form-control" rows="3" name="alamat" required><?php echo $row->alamatKos ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <h4>Telepon Kos</h4>
                                            <input type="name" class="form-control" name="telepon" value="<?php echo $row->teleponKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Luas Parkiran (Dalam m<sup>2</sup>)</h4>
                                            <select class="form-control" name="parkiran">
                                                <option></option>
                                                <?php
                                                    }
                                                    foreach($parkir as $row){ 
                                                        if($luasParkir == $row->idParkiranKos) { ?>
                                                            <option value="<?php echo $row->idParkiranKos ?>" selected><?php echo $row->luasParkiran ?></option>
                                                    <?php
                                                        } else { ?>
                                                            <option value="<?php echo $row->idParkiranKos ?>"><?php echo $row->luasParkiran ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $idKos ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-lg btn-light">Ubah</button>
                                    </div>
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
