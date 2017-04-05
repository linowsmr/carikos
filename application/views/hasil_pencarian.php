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

                            if(isset($jurusan)){
                                foreach($jurusan as $row){
                                    $latJurusan = $row->latJurusan;
                                    $lngJurusan = $row->lngJurusan;
                                }
                            }
                            

                            foreach($hasil as $row){ 
                                $skor = $row->nilaiDestinasiCluster + $row->nilaiParkiranPenjagaKos + $row->nilaiFasilitasKamar;
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

                                if($skor >= 0 && $skor < 25){
                                    $nilaiSkor = 1;
                                }
                                if($skor >= 25 && $skor < 50){
                                    $nilaiSkor = 2;
                                }
                                if($skor >= 50 && $skor < 76){
                                    $nilaiSkor = 3;
                                }
                                if($skor >= 76 && $skor <= 100){
                                    $nilaiSkor = 4;
                                }
                                //echo $nilaiSkor;

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
                                if($nilaiBulan == 3){
                                    $hargaBaru = $hargaLama + $hargaLama * ($ok/10);
                                }
                                ?>
                                <!-- <a href="<?php echo site_url('pencarian/kamar?kamar='.$row->idKamar.'&harga='.round($hargaBaru).'')?>"> -->
                                <div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: #337ab7; color: white">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%">
                                        <h4><?php echo $row->namaKos ?></h4>
                                        <h4>Rp<?php echo number_format(round($hargaBaru))?>/bulan</h4>
                                        <h4>Tersedia <?php echo $row->jumlahKamar ?> Kamar</h4>
                                        <form action="<?php echo site_url('pencarian/lihatKamar')?>" method="post">
                                            <input type="hidden" name="idKamar" class="form-control" value="<?php echo $row->idKamar?>">
                                            <input type="hidden" name="idKos" class="form-control" value="<?php echo $row->idKos?>">
                                            <input type="hidden" name="hargaKamar" class="form-control" value="<?php echo round($hargaBaru)?>">
                                            <button type="submit" class="btn btn-light">Lihat Kamar</button>
                                        </form>
                                    </div>                                    
                                </div>
                                <!-- </a> -->
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
                                $skor = $row->nilaiDestinasiCluster + $row->nilaiParkiranPenjagaKos + $row->nilaiFasilitasKamar;
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

                                if($skor >= 0 && $skor < 25){
                                    $nilaiSkor = 1;
                                }
                                if($skor >= 25 && $skor < 50){
                                    $nilaiSkor = 2;
                                }
                                if($skor >= 50 && $skor < 76){
                                    $nilaiSkor = 3;
                                }
                                if($skor >= 76 && $skor <= 100){
                                    $nilaiSkor = 4;
                                }
                                //echo $nilaiSkor;

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
                                if($nilaiBulan == 3){
                                    $hargaBaru = $hargaLama + $hargaLama * ($ok/10);
                                }
                                ?>
                                <div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: white; color: black">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%; border-color: black;">
                                        <h4><?php echo $row->namaKos ?></h4>
                                        <h4>Rp.<?php echo number_format(round($hargaBaru))?></h4>
                                        <h4>Tersedia <?php echo $row->jumlahKamar ?> Kamar</h4>
                                        <form action="<?php echo site_url('pencarian/lihatKamar')?>" method="post">
                                            <input type="hidden" name="idKamar" class="form-control" value="<?php echo $row->idKamar?>">
                                            <input type="hidden" name="idKos" class="form-control" value="<?php echo $row->idKos?>">
                                            <input type="hidden" name="hargaKamar" class="form-control" value="<?php echo round($hargaBaru)?>">
                                            <button type="submit" class="btn btn-dark">Lihat Kamar</button>
                                        </form>
                                    </div>                                    
                                </div>
                                <!-- </a> -->
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

