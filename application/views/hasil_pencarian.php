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
                            foreach ($bp as $row) {
                                $a = $row->a;
                                $b = $row->b;
                                $c = $row->c;
                                $d = $row->d;
                                $e = $row->e;
                                $f = $row->f;
                                $g = $row->g;
                                $h = $row->h;
                                $i = $row->i;
                            }
                            foreach($hasil as $row){ 
                                $skor = $row->nilaiDestinasiCluster;
                                $bulan = date("m");

                                if($bulan == 1 || $bulan == 2 || $bulan == 3 || $bulan == 4 || $bulan == 10 || $bulan == 11 || $bulan == 12){
                                    $nilaiBulan = 1;
                                }
                                if($bulan == 5 || $bulan == 6){
                                    $nilaiBulan = 2;
                                }
                                if($bulan == 7 || $bulan == 8 || $bulan == 9){
                                    $nilaiBulan = 3;
                                }

                                if($skor >= 76 && $skor <= 100){
                                    $nilaiSkor == 4;
                                }
                                elseif($skor >= 50 && $skor < 76){
                                    $nilaiSkor == 3;
                                }
                                elseif($skor >= 25 && $skor < 50){
                                    $nilaiSkor == 2;
                                }
                                elseif($skor == 0 && $skor < 25){
                                    $nilaiSkor == 1;
                                }

                                $oh1 = $a + $nilaiSkor*$b + $nilaiBulan*$c;
                                $oh2 = $d + $nilaiSkor*$d + $nilaiBulan*$f;
                                
                                //$h1 = 1 / (1+exp($oh1*(-1)));
                                //$h2 = 1 / (1+exp($0h2*(-1)));

                                $ok = $g + $oh1*$h + $oh2*$i;

                                $hargaLama = $row->hargaKamar;

                                if($nilaiBulan == 1){
                                    $hargaBaru = $hargaLama - $hargaLama * ($ok/20);
                                }
                                if($nilaiBulan == 2){
                                    $hargaBaru = $hargaLama + $hargaLama * ($ok/20);
                                }
                                if($nilaiBaru == 3){
                                    $hargaBaru = $hargaLama + $hargaLama * ($ok/10);
                                }
                                ?>
                                <a href=""><div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: #337ab7; color: white">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%">
                                        <h4><?php echo $row->namaKos ?></h4>
                                        <h4><?php echo $nilaiBaru ?></h4>
                                        <h4><?php echo $row->nilaiDestinasiCluster?></h4>
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
                                        <h4><?php echo $row->hargaKamar ?></h4>
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
