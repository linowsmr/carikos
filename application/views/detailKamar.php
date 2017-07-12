<?php
    foreach($detailKos as $row){
        $idKos = $row->idKos;
        $namaKos = $row->namaKos;
        $alamatKos = $row->alamatKos;
        $teleponKos = $row->teleponKos;
        $luasParkiran = $row->luasParkiran;
        $latlong = substr($row->latLngKos, 1, -1);
        $coord = explode(", ", $latlong);
        $latKos = $coord[0];
        $lngKos = $coord[1];
    }

    foreach($tipeKos as $row){
        $tipeKos = $row->tipeKos;
    }

    foreach($detailKamar as $row){
        $idKamar = $row->idKamar;
        $jenisKamar = $row->jenisKamar;
        $jumlahKamar = $row->jumlahKamar;
        $luasKamar = $row->luasKamar;
        $hargaAwalKamar = $row->hargaKamar;
    }

    foreach($minimarket as $row){
        $jarakMinimarket = round($row->jarakDestinasi, 2);
    }

    foreach($supermarket as $row){
        $jarakSupermarket = round($row->jarakDestinasi, 2);
    }

    foreach($masjid as $row){
        $jarakMasjid = round($row->jarakDestinasi, 2);
    }

    $hargaKamar = number_format($harga);

    if(isset($jurusan)){
        foreach($jurusan as $row){
            $idJurusan = $row->idJurusan;
            $namaJurusan = $row->namaJurusan;
            $koma = ', ';
            $latLngJurusan = $row->latJurusan.$koma.$row->lngJurusan;
            $jarakJurusan = round($row->jarakClusterJurusan, 2);
        }
    }
    else
        $idJurusan = 0;             
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
    			<div class="row mobile-none">
    			 	<div class="col-lg-12 text-center">
    			 	 	<h2><?php echo "$jenisKamar - $namaKos"; ?></h2>
    			 	 	<hr class="small" style="border-color: black;">
                        <form action="<?php echo site_url('pemesanan/index') ?>" method="POST">
                            <input type="hidden" name="kamar" value="<?php echo $idKamar ?>"></input>
                            <input type="hidden" name="kos" value="<?php echo $idKos ?>"></input>
                            <input type="hidden" name="harga" value="<?php echo $harga ?>"></input>
                            <?php
                                if($jmlKamar > 0){ ?>
                                    <button type="submit" class="btn btn-lg btn-dark">Pesan Kamar</button>
                                <?php }
                                else{ ?>
                                    <button type="submit" class="btn btn-lg btn-dark" disabled>Pesan Kamar</button>
                                <?php }
                            ?>
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
                            <h4><b>Luas Kamar (Dalam m)</b></h4>
                            <br>
                            <h4><b>Fasilitas Kamar</b></h4>
                        </div>
                        <div class="col-lg-6" style="text-align: left;">
                            <h4>Rp<?php echo $hargaKamar ?>/bulan</h4>
                            <br>
                            <h4><?php echo $jmlKamar ?> Kamar</h4>
                            <br><br>
                            <h4><?php echo $luasKamar ?></h4>
                            <br><br>
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
                            <br><br><br>
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
            <div class="row desktop-none">
                    <div class="col-lg-12 text-center">
                        <h2><?php echo "$jenisKamar - $namaKos"; ?></h2>
                        <hr class="small" style="border-color: black;">
                        <form action="<?php echo site_url('pemesanan/index') ?>" method="POST">
                            <input type="hidden" name="kamar" value="<?php echo $idKamar ?>"></input>
                            <input type="hidden" name="kos" value="<?php echo $idKos ?>"></input>
                            <input type="hidden" name="harga" value="<?php echo $harga ?>"></input>
                            <?php
                                if($jmlKamar > 0){ ?>
                                    <button type="submit" class="btn btn-lg btn-dark">Pesan Kamar</button>
                                <?php }
                                else{ ?>
                                    <button type="submit" class="btn btn-lg btn-dark" disabled>Pesan Kamar</button>
                                <?php }
                            ?>
                        </form>
                    </div>
                    <div class="col-lg-12 text-center">
                        <h3>Detail Kamar</h3>
                        <hr class="small" style="border-color: black;">
                            <h4><b>Harga Kamar</b></h4>
                            <h4>Rp<?php echo $hargaKamar ?>/bulan</h4>
                            <br>
                            <h4><b>Jumlah Kamar yang Tersedia</b></h4>
                            <h4><?php echo $jmlKamar ?> Kamar</h4>
                            <br>
                            <h4><b>Luas Kamar (Dalam m)</b></h4>
                            <h4><?php echo $luasKamar ?></h4>
                            <br>
                            <h4><b>Fasilitas Kamar</b></h4>
                            <?php foreach($fasilitasKamar as $row){ ?>
                                <h4><?php echo $row->namaFasilitasKamar ?></h4>
                            <?php } ?>
                    </div>
                    <br>
                    <hr style="border-color: #b3b3b3">
                    <div class="col-lg-6 text-center">
                        <h3>Detail Kos</h3>
                        <hr class="small" style="border-color: black;">
                        <h4><b>Alamat Kos</b></h4>
                        <h4><?php echo $alamatKos ?></h4>
                        <br>
                        <h4><b>Telepon Kos</b></h4>
                        <h4><?php echo $teleponKos ?></h4>
                        <br>
                        <h4><b>Tipe Kos</b></h4>
                        <h4><?php echo $tipeKos ?></h4>
                        <br>
                        <h4><b>Penjaga Kos</b></h4>
                        <h4><?php echo $penjagaKos ?></h4>
                        <br>
                        <h4><b>Luas Parkiran (dalam m<sup>2</sup>)</b></h4>
                        <h4><?php echo $luasParkiran ?></h4>
                        <br>
                        <h4><b>Fasilitas Kos</b></h4>
                        <?php foreach($fasilitasKos as $row){ ?>
                                <h4><?php echo $row->namaFasilitasKos ?></h4>
                            <?php } ?>
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
                        <div class="col-lg-4 mobile-none" style="text-align: right;">
                            <?php
                                if($idJurusan != "0"){ ?>
                                    <h4>Jarak ke Jurusan <b><?php echo $namaJurusan ?></b></h4><br>
                                <?php }
                            ?>        
                            <h4>Minimarket Terdekat</h4>
                            <h4>Supermarket Terdekat</h4>
                            <h4>Masjid Terdekat</h4>
                        </div>
                        <div class="col-lg-2 mobile-none" style="text-align: left;">
                            <?php
                                if($idJurusan != "0"){ ?>
                                    <h4>&plusmn;<?php echo $jarakJurusan ?> KM</h4><br>
                                <?php }
                            ?>
                            <h4>&plusmn;<?php echo $jarakMinimarket ?> KM</h4>
                            <h4>&plusmn;<?php echo $jarakSupermarket ?> KM</h4>
                            <h4>&plusmn;<?php echo $jarakMasjid ?> KM</h4>
                        </div>
                        <div class="desktop-none">
                            <?php
                                if($idJurusan != "0"){ ?>
                                    <h4>Jarak ke Jurusan <b><?php echo $namaJurusan ?></b></h4>
                                    <h4>&plusmn;<?php echo $jarakJurusan ?> KM</h4><br>
                                <?php }
                            ?>        
                            <h4>Minimarket Terdekat</h4>
                            <h4>&plusmn;<?php echo $jarakMinimarket ?> KM</h4><br>
                            <h4>Supermarket Terdekat</h4>
                            <h4>&plusmn;<?php echo $jarakSupermarket ?> KM</h4><br>
                            <h4>Masjid Terdekat</h4>
                            <h4>&plusmn;<?php echo $jarakMasjid ?> KM</h4><br>
                        </div>
                        <?php
                            if($idJurusan == 0){ ?>
                                <div class="col-lg-6" id="map">
                                    <script type="text/javascript">
                                        function initMap() {
                                            var myLatlng = new google.maps.LatLng(<?php Print($latlong); ?>);
                                            var mapOptions = {
                                              zoom: 15,
                                              center: myLatlng
                                            }
                                            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                                            var location = new google.maps.LatLng(<?php Print($latlong); ?>);
                                            var markerKos = new google.maps.Marker({
                                                position: location
                                            });
                                            markerKos.addListener('click', function() {
                                                infowindow.open(map, markerKos);
                                            });
                                            markerKos.setMap(map);

                                            downloadUrl("<?php echo site_url('Portal/index') ?>", function(data) {
                                                var xml = data.responseXML;
                                                var markers = xml.documentElement.getElementsByTagName('marker');
                                                Array.prototype.forEach.call(markers, function(markerElem) {
                                                    var jenisKendaraanPortal = markerElem.getAttribute('jenisKendaraanPortal');
                                                    var aksesPortal = markerElem.getAttribute('aksesPortal');
                                                    var waktuBukaPortal = markerElem.getAttribute('waktuBukaPortal');
                                                    var waktuTutupportal = markerElem.getAttribute('waktuTutupportal');
                                                    var point = new google.maps.LatLng(
                                                        parseFloat(markerElem.getAttribute('latPortal')),
                                                        parseFloat(markerElem.getAttribute('lngPortal')));

                                                    var contentString = '<p><b>Jenis Kendaraan: ' + jenisKendaraanPortal + '<br><b>Akses Portal: ' + aksesPortal + '<br><b>Waktu Buka Portal: ' + waktuBukaPortal + '<br><b>Waktu Tutup Portal: ' + waktuTutupportal; 
                                                    var infoWindow = new google.maps.InfoWindow({
                                                        content: contentString
                                                    });

                                                    var image = 'http://maps.google.com/mapfiles/kml/pal4/icon53.png';
                                                    var marker = new google.maps.Marker({
                                                        map: map,
                                                        position: point,
                                                        icon : image
                                                        //label: icon.label
                                                    });
                                                    marker.addListener('click', function() {
                                                        infoWindow.open(map, marker);
                                                    });
                                                });
                                            });
                                        }
                                        function downloadUrl(url, callback) {
                                            var request = window.ActiveXObject ?
                                                new ActiveXObject('Microsoft.XMLHTTP') :
                                                new XMLHttpRequest;

                                            request.onreadystatechange = function() {
                                              if (request.readyState == 4) {
                                                request.onreadystatechange = doNothing;
                                                callback(request, request.status);
                                              }
                                            };

                                            request.open('GET', url, true);
                                            request.send(null);
                                        }

                                        function doNothing() {}
                                    </script>
                                </div>

                            <?php }
                            else { ?>
                                <div class="col-lg-6" id="map">
                                    <script type="text/javascript">
                                        function initMap() {
                                            var kos = new google.maps.LatLng(<?php Print($latlong); ?>),
                                                jurusan = new google.maps.LatLng(<?php Print($latLngJurusan); ?>),
                                                myOptions = {
                                                    zoom: 15,
                                                    center: kos
                                                },
                                                map = new google.maps.Map(document.getElementById('map'), myOptions),
                                                // Instantiate a directions service.
                                                directionsService = new google.maps.DirectionsService,
                                                directionsDisplay = new google.maps.DirectionsRenderer({
                                                    map: map
                                                });

                                            // get route from A to B
                                            calculateAndDisplayRoute(directionsService, directionsDisplay, kos, jurusan);

                                            downloadUrl("<?php echo site_url('Portal/index') ?>", function(data) {
                                                var xml = data.responseXML;
                                                var markers = xml.documentElement.getElementsByTagName('marker');
                                                Array.prototype.forEach.call(markers, function(markerElem) {
                                                    var jenisKendaraanPortal = markerElem.getAttribute('jenisKendaraanPortal');
                                                    var aksesPortal = markerElem.getAttribute('aksesPortal');
                                                    var waktuBukaPortal = markerElem.getAttribute('waktuBukaPortal');
                                                    var waktuTutupportal = markerElem.getAttribute('waktuTutupportal');
                                                    var point = new google.maps.LatLng(
                                                        parseFloat(markerElem.getAttribute('latPortal')),
                                                        parseFloat(markerElem.getAttribute('lngPortal')));

                                                    var contentString = '<p><b>Jenis Kendaraan: ' + jenisKendaraanPortal + '<br><b>Akses Portal: ' + aksesPortal + '<br><b>Waktu Buka Portal: ' + waktuBukaPortal + '<br><b>Waktu Tutup Portal: ' + waktuTutupportal; 
                                                    var infoWindow = new google.maps.InfoWindow({
                                                        content: contentString
                                                    });

                                                    var image = 'http://maps.google.com/mapfiles/kml/pal4/icon53.png';
                                                    var marker = new google.maps.Marker({
                                                        map: map,
                                                        position: point,
                                                        icon : image
                                                        //label: icon.label
                                                    });
                                                    marker.addListener('click', function() {
                                                        infoWindow.open(map, marker);
                                                    });
                                                });
                                            });
                                        }

                                        function calculateAndDisplayRoute(directionsService, directionsDisplay, kos, jurusan) {
                                            directionsService.route({
                                                origin: kos,
                                                destination: jurusan,
                                                avoidTolls: true,
                                                avoidHighways: false,
                                                travelMode: google.maps.TravelMode.WALKING
                                            }, function (response, status) {
                                                if (status == google.maps.DirectionsStatus.OK) {
                                                    directionsDisplay.setDirections(response);
                                                } else {
                                                    window.alert('Directions request failed due to ' + status);
                                                }
                                            });
                                        }

                                        function downloadUrl(url, callback) {
                                            var request = window.ActiveXObject ?
                                                new ActiveXObject('Microsoft.XMLHTTP') :
                                                new XMLHttpRequest;

                                            request.onreadystatechange = function() {
                                              if (request.readyState == 4) {
                                                request.onreadystatechange = doNothing;
                                                callback(request, request.status);
                                              }
                                            };

                                            request.open('GET', url, true);
                                            request.send(null);
                                        }

                                        function doNothing() {}
                                    </script>
                                </div>
                            <?php }
                        ?>
                        <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap">
                        </script>
                    </div>
                </div>
            </div>
        </aside>
	</body>
</html>