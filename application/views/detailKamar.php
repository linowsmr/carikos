<?php
    foreach($detailKos as $row){
        $idKos = $row->idKos;
        $namaKos = $row->namaKos;
        $alamatKos = $row->alamatKos;
        $teleponKos = $row->teleponKos;
        $luasParkiran = $row->luasParkiran;
        $latlong = substr($row->latLngKos, 1, -1);
    }

    foreach($tipeKos as $row){
        $tipeKos = $row->tipeKos;
    }

    foreach($detailKamar as $row){
        $idKamar = $row->idKamar;
        $jenisKamar = $row->jenisKamar;
        $jumlahKamar = $row->jumlahKamar;
    }

    foreach($minimarket as $row){
        $jarakMinimarket = round($row->jarakDestinasi, 1);
    }

    foreach($supermarket as $row){
        $jarakSupermarket = round($row->jarakDestinasi, 1);
    }

    foreach($masjid as $row){
        $jarakMasjid = round($row->jarakDestinasi, 1);
    }

    $hargaKamar = number_format($harga);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
       #map {
        height: 50%;
        width: 50%;
       }
    </style>
    </head>
	<body>
        <aside class="call-to-action">
    		<div class="container">
    			<div class="row">
    			 	<div class="col-lg-12 text-center">
    			 	 	<h2><?php echo "$jenisKamar - $namaKos"; ?></h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <form action="<?php echo site_url('pemesanan/index') ?>" method="POST">
                            <input type="hidden" name="kamar" value="<?php echo $idKamar ?>"></input>
                            <input type="hidden" name="kos" value="<?php echo $idKos ?>"></input>
                            <input type="hidden" name="harga" value="<?php echo $harga ?>"></input>
                            <button type="submit" class="btn btn-lg btn-dark">Pesan Kamar</button>
                        </form>
    			 	</div>
                    <div class="col-lg-6 text-center">
                        <h3>Detail Kamar</h3>
                        <hr class="small" style="border-color: black;">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4" style="text-align: right;">
                            <h4><b>Harga Kamar</b></h4>
                            <br>
                            <h4><b>Jumlah Kamar yang Tersedia</b></h4>
                            <br>
                            <h4><b>Luas Kamar</b></h4>
                            <br>
                            <h4><b>Fasilitas Kamar</b></h4>
                        </div>
                        <div class="col-lg-6" style="text-align: left;">
                            <h4>Rp<?php echo $hargaKamar ?>/bulan</h4>
                            <br>
                            <h4><?php echo $jmlKamar ?> Kamar</h4>
                            <br><br>
                            <h4>Nanti akan Ditambahkan</h4>
                            <br>
                            <?php foreach($fasilitasKamar as $row){ ?>
                                <h4><?php echo $row->namaFasilitasKamar ?></h4>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center">
                        <h3>Detail Kos</h3>
                        <hr class="small" style="border-color: black;">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-4" style="text-align: right;">
                            <h4><b>Alamat Kos</b></h4>
                            <br>
                            <h4><b>Telepon Kos</b></h4>
                            <br>
                            <h4><b>Tipe Kos</b></h4>
                            <br>
                            <h4><b>Penjaga Kos</b></h4>
                            <br>
                            <h4><b>Luas Parkiran (dalam m<sup>2</sup>)</b></h4>
                            <br>
                            <h4><b>Fasilitas Kos</b></h4>
                        </div>
                        <div class="col-lg-6" style="text-align: left;">
                            <h4><?php echo $alamatKos ?></h4>
                            <br>
                            <h4><?php echo $teleponKos ?></h4>
                            <br>
                            <h4><?php echo $tipeKos ?></h4>
                            <br>
                            <h4><?php echo $penjagaKos ?></h4>
                            <br>
                            <h4><?php echo $luasParkiran ?></h4>
                            <br><br>
                            <?php foreach($fasilitasKos as $row){ ?>
                                <h4><?php echo $row->namaFasilitasKos ?></h4>
                            <?php } ?>
                        </div>
                    </div>
    			</div>
    		</div>
    	</aside>
    	<aside class="call-to-action bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                    <h2>Foto Kamar dan Kos</h2>
                        <hr class="small">
                        <div class="container">
                            <div class="row">
                                <?php
                                    foreach($fotoKamar as $row){ ?>
                                        <div class="col-lg-3">
                                            <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>">
                                                <img class="img-responsive" alt="" src="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>" />
                                            </a>
                                        </div>
                                    <?php }
                                ?>
                                <?php
                                    foreach($fotoKos as $row){ ?>
                                        <div class="col-lg-3">
                                            <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url();?>assets/images/kos/<?php echo $row->namaFile ?>">
                                                <img class="img-responsive" alt="" src="<?php echo base_url();?>assets/images/kos/<?php echo $row->namaFile ?>" />
                                            </a>
                                        </div>
                                    <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <aside class="call-to-action">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Lokasi Kos</h2>
                        <hr class="small" style="border-color: black;">
                        <br>
                        <div class="col-lg-3" style="text-align: right;">
                            <h4>Minimarket Terdekat</h4>
                            <h4>Supermarket Terdekat</h4>
                            <h4>Masjid Terdekat</h4>
                        </div>
                        <div class="col-lg-3" style="text-align: left;">
                            <h4>&plusmn;<?php echo $jarakMinimarket ?> KM</h4>
                            <h4>&plusmn;<?php echo $jarakSupermarket ?> KM</h4>
                            <h4>&plusmn;<?php echo $jarakMasjid ?> KM</h4>
                        </div>
                        <div class="col-lg-6" id="map">
                            <script type="text/javascript">
                                function initMap() {
                                    var myLatlng = new google.maps.LatLng(<?php Print($latlong); ?>);
                                    var mapOptions = {
                                      zoom: 18,
                                      center: myLatlng
                                    }
                                    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                                    // var contentString = '<div id="content">'+
                                    //                     '<div id="siteNotice">'+
                                    //                     '</div>'+
                                    //                     '<h1 id="firstHeading" class="firstHeading">Nama Kos</h1>'+
                                    //                     '<div id="bodyContent">'+
                                    //                     '<p>Deskripsi dan Informasi Mengenai Kos</p>'+
                                    //                     '</div>'+
                                    //                     '</div>';

                                    // var infowindow = new google.maps.InfoWindow({
                                    //     content: contentString
                                    // });

                                    var location = new google.maps.LatLng(<?php Print($latlong); ?>);
                                    var marker = new google.maps.Marker({
                                        position: location
                                    });
                                    marker.addListener('click', function() {
                                        infowindow.open(map, marker);
                                    });
                                    marker.setMap(map);
                                }
                            </script>
                            <script async defer
                                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap">
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
	</body>
</html>