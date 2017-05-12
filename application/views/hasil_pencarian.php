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
							$data = sizeof($hasil);
							if($data == 0){ ?>
								<h4>Tidak Menemukan Hasil Pencarian</h4>
								<a href="<?php echo site_url('home/index') ?>"><button class="btn btn-dark btn-lg">Kembali</button></a>
							<?php }
						?>
                        <?php
                            // foreach ($bp as $row) {
                            //     $a = $row->a;
                            //     $b = $row->b;
                            //     $c = $row->c;
                            //     $d = $row->d;
                            //     $e = $row->e;
                            //     $f = $row->f;
                            //     $g = $row->g;
                            //     $h = $row->h;
                            //     $i = $row->i;
                            // }

                            if(isset($jurusan)){
                                foreach($jurusan as $row){
                                    $latJurusan = $row->latJurusan;
                                    $lngJurusan = $row->lngJurusan;
                                }
                            }
                            

                            foreach($hasil as $row){ 
                                $idKamar = $row->idKamar;
                                $jmlKamar = $row->jumlahKamar;

                                if(isset($row->nilaiClusterJurusan)){
                                    $skor = $row->nilaiDestinasiCluster + $row->nilaiParkiranPenjagaKos + $row->nilaiBanjir + $row->nilaiRamai + $row->nilaiFasilitasKamar + $row->nilaiClusterJurusan;
                                }
                                else{
                                    $skor = $row->nilaiDestinasiCluster + $row->nilaiParkiranPenjagaKos + $row->nilaiBanjir + $row->nilaiRamai + $row->nilaiFasilitasKamar;
                                    $skor = $skor*0.83;
                                }

                                foreach($kamarTerpakai as $row2){
                                    if($idKamar == $row2->idKamar)
                                        $jmlKamar = $jmlKamar - $row2->jmlKamar;
                                }

                                
                                $bulan = date("m");

                                //$lr = 0.7;
                                $a = 0.27561841435694;
                                $b = -1.0991004393801;
                                $c = -2.1804039337464;
                                $d = -1.9634680187429;
                                $e = -0.19928174968044;
                                $f = 2.554269942058;
                                $g = -1.4855817680429;
                                $h = -1.5459370526401;
                                $i = 3.9808489206053;

                                if($bulan == 1 || $bulan == 2 || $bulan == 3 || $bulan == 4 || $bulan == 11 || $bulan == 12){
                                    $nilaiBulan = 0;
                                }
                                if($bulan == 5 || $bulan == 10){
                                    $nilaiBulan = 1;
                                }
                                if($bulan == 6 || $bulan == 7 || $bulan == 8 || $bulan == 9){
                                    $nilaiBulan = 2;
                                }

                                if($skor >= 0 && $skor < 25){
                                    $nilaiSkor = 0;
                                }
                                if($skor >= 25 && $skor < 50){
                                    $nilaiSkor = 1;
                                }
                                if($skor >= 50 && $skor < 76){
                                    $nilaiSkor = 2;
                                }
                                if($skor >= 76 && $skor <= 100){
                                    $nilaiSkor = 3;
                                }
                                //ECHO $skor;
                                for($i=0;$i<100;$i++) {
                                    $nh1 = $a + $nilaiSkor*$b + $nilaiBulan*$c;
                                    $nh2 = $d + $nilaiSkor*$d + $nilaiBulan*$f;

                                    $oh1 = 1 / (1+exp($nh1*(-1)));
                                    $oh2 = 1 / (1+exp($nh2*(-1)));

                                    $no = $g + $oh1*$h + $oh2*$i;
                                    $out = 1 / (1+exp($no*(-1)));

                                }
                                //echo $out;
                                $hargaLama = $row->hargaKamar;
                                $max = $hargaLama + (0.05*$hargaLama);
                                //echo $max;
                                $min = $hargaLama - (0.025*$hargaLama);
                                //echo $min;

                                $hargaBaru = ((($max-$min)*($out-0.1))/0.8)+$min;


                                // if($nilaiBulan == 1){
                                //     $hargaBaru = $hargaLama - $hargaLama * ($y/20);
                                // }
                                // if($nilaiBulan == 2){
                                //     $hargaBaru = $hargaLama + $hargaLama * ($y/20);
                                // }
                                // if($nilaiBulan == 3){
                                //     $hargaBaru = $hargaLama + $hargaLama * ($y/10);
                                // }
                                ?>
                                <!-- <a href="<?php echo site_url('pencarian/kamar?kamar='.$row->idKamar.'&harga='.round($hargaBaru).'')?>"> -->
                                <div class="col-lg-3">
                                    <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>); background-size: cover; background-position: center; height: 25%"></div>
                                    <div class="col-lg-12" style="background-color: #337ab7; color: white">
                                        <h4><?php echo $row->jenisKamar ?></h4>
                                        <hr style="margin-top: 0%; margin-bottom: 0%">
                                        <h4><?php echo $row->namaKos ?></h4>
                                        <h4>Rp<?php echo number_format(round($hargaBaru))?>/bulan</h4>
                                        <h4>Tersedia <?php echo $jmlKamar ?> Kamar</h4>
                                        <form action="<?php echo site_url('pencarian/lihatKamar')?>" method="post">
                                            <input type="hidden" name="idKamar" class="form-control" value="<?php echo $row->idKamar?>">
                                            <input type="hidden" name="idKos" class="form-control" value="<?php echo $row->idKos?>">
                                            <input type="hidden" name="idJurusan" class="form-control" value="<?php echo $idJurusan?>">
                                            <input type="hidden" name="hargaKamar" class="form-control" value="<?php echo round($hargaBaru)?>">
                                            <input type="hidden" name="jmlKamar" value="<?php echo $jmlKamar ?>"></input>
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

</body>

</html>

