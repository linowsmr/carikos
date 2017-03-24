<!DOCTYPE html>
<html lang="en">

<head>
    <style>
       #cari {
        height: 100%;
        width: 100%;
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
                    <h2>Hasil Pencarian</h2>
                    <hr class="small" style="border-color: black;">
                    <br>
                    <div class="row">
                        <?php
                            foreach($hasil as $row){ ?>
                                <a href=""><div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: #337ab7; color: white">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%">
                                        <h4><?php echo $row->namaKos ?></h4>
                                    </div>                                    
                                </div></a>
                                <div class="col-lg-1"></div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Rekomendasi Kos</h2>
                    <hr class="small">
                    <br>
                    <div class="row">
                        <?php
                            foreach($hasil as $row){ ?>
                                <a href=""><div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: #fff; color: black">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%; border-color: black;">
                                        <h4><?php echo $row->namaKos ?></h4>
                                    </div>                                    
                                </div></a>
                                <div class="col-lg-1"></div>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>

</body>

</html>
