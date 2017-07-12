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
                    <div class="row">
                        <h2>Rekomendasi Kami</h2>
                        <hr class="small" style="border-color: black;">
                    	<?php
							$data = sizeof($rekomendasi);
							if($data == 0){ ?>
								<h4>Tidak Menemukan Hasil Pencarian</h4>
								<a href="<?php echo site_url('home/index') ?>"><button class="btn btn-dark btn-lg">Kembali</button></a>
							    <?php 
                            }
						
                            if(isset($jurusan)){
                                foreach($jurusan as $row){
                                    $latJurusan = $row->latJurusan;
                                    $lngJurusan = $row->lngJurusan;
                                }
                            }
                            
                            $kolom = 0;
                            foreach($rekomendasi as $row){ 
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

                                
                                $bulan = 10;

                                //$lr = 0.7;
                                $a = 1.2817164322232;
                                $b = -2.0161081024844;
                                $c = -2.4820055708634;
                                $d = 0.39234709422736;
                                $e = -1.4500143409141;
                                $f = -1.8379153691184;
                                $g = 3.2170084420988;
                                $h = -3.7499228156667;
                                $i = -3.788658534876;
                                $j = 3.5249716409331;
                                $k = -3.2197327590555;
                                $l = -2.0392787777114;
                                $m = -5.9333871155382;

                                if($bulan==1){
                                    $nilaiBulan = 8;
                                }
                                if($bulan==11 || $bulan == 2){
                                    $nilaiBulan = 2;
                                }
                                if($bulan==3 || $bulan == 4){
                                    $nilaiBulan = 4;
                                }
                                if($bulan == 5){
                                    $nilaiBulan = 15;
                                }
                                if($bulan==6){
                                    $nilaiBulan = 25;
                                }
                                if($bulan==7){
                                    $nilaiBulan = 32;
                                }
                                if($bulan==8){
                                    $nilaiBulan = 35;
                                }
                                if($bulan==9){
                                    $nilaiBulan = 29;
                                }
                                if($bulan==10){
                                    $nilaiBulan = 26;
                                }
                                if($bulan==12){
                                    $nilaiBulan = 3;
                                }

                                $nilaiBln = (((0.8*$nilaiBulan)-(0.8*2))/(35-2))+0.1;
                                //echo $nilaiBln;
                                $nilaiSkor = (((0.8*$skor)-(0.8*0))/(100-0))+0.1;
                                $nh1 = $a + $nilaiSkor*$b + $nilaiBln*$c;
                                $nh2 = $d + $nilaiSkor*$d + $nilaiBln*$f;
                                $nh3 = $g + $h*$nilaiSkor + $i*$nilaiBln;

                                $oh1 = 1 / (1+exp($nh1*(-1)));
                                $oh2 = 1 / (1+exp($nh2*(-1)));
                                $oh3 = 1 / (1+exp($nh3*(-1)));

                                $no= $j + ($oh1*$k) + ($oh2*$l) + ($oh3*$m);
                                $out = 1 / (1+exp($no*(-1)));
                            
                                //echo $out;
                                $hargaLama = $row->hargaKamar;
                                $max = $hargaLama + (0.05*$hargaLama);
                                //echo $max;
                                $min = $hargaLama - (0.025*$hargaLama);
                                //echo $min;

                                $hargaBaru = ((($max-$min)*($out-0.1))/0.8)+$min;
                                ?>
                                <div class="col-lg-3" style="margin-bottom: 50px;">
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
                                <?php 
                            }
                        ?>
                    </div>
                    <hr style="border-color: #b3b3b3;">
                    <div class="row">
                        <h2>Hasil Pencarian</h2>
                        <hr class="small" style="border-color: black;">
                        <?php
                            $data = sizeof($hasil);
                            if($data == 0){ ?>
                                <h4>Tidak Menemukan Hasil Pencarian</h4>
                                <a href="<?php echo site_url('home/index') ?>"><button class="btn btn-dark btn-lg">Kembali</button></a>
                                <?php 
                            }
                        
                            if(isset($jurusan)){
                                foreach($jurusan as $row){
                                    $latJurusan = $row->latJurusan;
                                    $lngJurusan = $row->lngJurusan;
                                }
                            }
                            
                            $kolom = 0;
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

                                
                                $bulan = 10;

                                //$lr = 0.7;
                                $a = 1.2817164322232;
                                $b = -2.0161081024844;
                                $c = -2.4820055708634;
                                $d = 0.39234709422736;
                                $e = -1.4500143409141;
                                $f = -1.8379153691184;
                                $g = 3.2170084420988;
                                $h = -3.7499228156667;
                                $i = -3.788658534876;
                                $j = 3.5249716409331;
                                $k = -3.2197327590555;
                                $l = -2.0392787777114;
                                $m = -5.9333871155382;

                                if($bulan==1){
                                    $nilaiBulan = 8;
                                }
                                if($bulan==11 || $bulan == 2){
                                    $nilaiBulan = 2;
                                }
                                if($bulan==3 || $bulan == 4){
                                    $nilaiBulan = 4;
                                }
                                if($bulan == 5){
                                    $nilaiBulan = 15;
                                }
                                if($bulan==6){
                                    $nilaiBulan = 25;
                                }
                                if($bulan==7){
                                    $nilaiBulan = 32;
                                }
                                if($bulan==8){
                                    $nilaiBulan = 35;
                                }
                                if($bulan==9){
                                    $nilaiBulan = 29;
                                }
                                if($bulan==10){
                                    $nilaiBulan = 26;
                                }
                                if($bulan==12){
                                    $nilaiBulan = 3;
                                }

                                $nilaiBln = (((0.8*$nilaiBulan)-(0.8*2))/(35-2))+0.1;
                                //echo $nilaiBln;
                                $nilaiSkor = (((0.8*$skor)-(0.8*0))/(100-0))+0.1;
                                $nh1 = $a + $nilaiSkor*$b + $nilaiBln*$c;
                                $nh2 = $d + $nilaiSkor*$d + $nilaiBln*$f;
                                $nh3 = $g + $h*$nilaiSkor + $i*$nilaiBln;

                                $oh1 = 1 / (1+exp($nh1*(-1)));
                                $oh2 = 1 / (1+exp($nh2*(-1)));
                                $oh3 = 1 / (1+exp($nh3*(-1)));

                                $no= $j + ($oh1*$k) + ($oh2*$l) + ($oh3*$m);
                                $out = 1 / (1+exp($no*(-1)));
                            
                                //echo $out;
                                $hargaLama = $row->hargaKamar;
                                $max = $hargaLama + (0.05*$hargaLama);
                                //echo $max;
                                $min = $hargaLama - (0.025*$hargaLama);
                                //echo $min;

                                $hargaBaru = ((($max-$min)*($out-0.1))/0.8)+$min;
                                ?>
                                <div class="col-lg-3" style="margin-bottom: 50px;">
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
                                <?php 
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </aside>

</body>

</html>

