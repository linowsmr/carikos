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

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <h1>CariKos</h1>
            <h3>Cari Kos Menjadi Lebih Mudah</h3>
            <br>
            <a href="#contact" class="btn btn-dark btn-lg">Cari Kos</a>
            <a href="#daftar" class="btn btn-dark btn-lg">Daftar Kos</a>
        </div>
    </header>

    <section id="tentang" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Cari Kos yang Anda Inginkan</h2>
                    <hr class="small" style="border-color: black;">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
	                    <form action="<?php echo site_url('pencarian/index') ?>" method="get">
	                		<div class="form-group">
	                            <h4>Kota</h4>
	                            <select class="form-control" name="kota">
	                            	<option></option>
	                            	<option value="Surabaya">Surabaya</option>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Harga</h4>
	                            <select class="form-control" name="harga">
	                            	<option></option>
	                            	<option value="4">> Rp1.500.000,00</option>
	                            	<option value="3">Rp1.000.001,00 - Rp1.500.000,00</option>
	                            	<option value="2">Rp500.001,00 - Rp1.000.000,00</option>
	                            	<option value="1">Rp0 - Rp500.000,00</option>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Tipe Kos</h4>
	                            <select class="form-control" name="tipe">
	                            	<option></option>
	                                <?php
	                                    foreach($tipe as $row){ ?>
	                                        <option value="<?php echo $row->idTipeKos ?>"><?php echo $row->tipeKos ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Fasilitas Kos</h4>
	                            <select id="multiple-select-fasilitas" multiple="multiple" name="fasilitaskos[]">
	                                <?php
	                                    foreach($fasilitas as $row){ ?>
	                                        <option value="<?php echo $row->idFasilitasKos ?>"><?php echo $row->namaFasilitasKos ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
	                		<div class="form-group">
	                            <h4>Fasilitas Kamar</h4>
	                            <select id="multiple-select-tipe" multiple="multiple" name="fasilitaskamar[]">
	                                <?php
	                                    foreach($fasilitaskamar as $row){ ?>
	                                        <option value="<?php echo $row->idFasilitasKamar ?>"><?php echo $row->namaFasilitasKamar ?></option>
	                                    <?php }
	                                ?>
	                            </select>
	                        </div>
	                    	<button type="submit" class="btn btn-lg btn-dark">Cari</button>
	                    </form>
	                </div>
	                <div class="col-lg-4"></div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Map -->
    <!-- <section id="cari" class="map">
        <script type="text/javascript">
            function initMap() {
                var myLatlng = new google.maps.LatLng(-7.279790, 112.797522);
                var mapOptions = {
                  zoom: 18,
                  center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById("cari"), mapOptions);

                var contentString = '<div id="content">'+
                                    '<div id="siteNotice">'+
                                    '</div>'+
                                    '<h1 id="firstHeading" class="firstHeading">Nama Kos</h1>'+
                                    '<div id="bodyContent">'+
                                    '<p>Deskripsi dan Informasi Mengenai Kos</p>'+
                                    '</div>'+
                                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var location1 = new google.maps.LatLng(-7.282042, 112.799655);
                var marker1 = new google.maps.Marker({
                    position: location1
                });
                marker1.addListener('click', function() {
                    infowindow.open(map, marker1);
                });
                marker1.setMap(map);


                var location2 = new google.maps.LatLng(-7.282242, 112.799652);
                var marker2 = new google.maps.Marker({
                    position: location2
                });
                marker2.addListener('click', function() {
                    infowindow.open(map, marker2);
                });
                marker2.setMap(map);


                var location3 = new google.maps.LatLng(-7.281840, 112.799829);
                var marker3 = new google.maps.Marker({
                    position: location3
                });
                marker3.addListener('click', function() {
                    infowindow.open(map, marker3);
                });
                marker3.setMap(map);

                var location4 = new google.maps.LatLng(-7.281875, 112.799641);
                var marker4 = new google.maps.Marker({
                    position: location4
                });
                marker4.addListener('click', function() {
                    infowindow.open(map, marker4);
                });
                marker4.setMap(map);

                var location5 = new google.maps.LatLng(-7.282040, 112.800000);
                var marker5 = new google.maps.Marker({
                    position: location5
                });
                marker5.addListener('click', function() {
                    infowindow.open(map, marker5);
                });
                marker5.setMap(map);

                var location6 = new google.maps.LatLng(-7.281859, 112.799997);
                var marker6 = new google.maps.Marker({
                    position: location6
                });
                marker6.addListener('click', function() {
                    infowindow.open(map, marker6);
                });
                marker6.setMap(map);
            }

        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap">
        </script>
    </section> -->

    <aside id="daftar" class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Kos</h2>
                    <hr class="small">
                    <h4>Anda Harus Masuk Terlebih Dahulu Untuk Melakukan Pendaftaran Kos</h4>
                    <br>
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <form action="<?php echo site_url('pemilik/login')?>" method="post">
                                <div class="form-group">
                                    <h4>Nama Akun</h4>
                                    <input type="name" class="form-control" name="akun" required>
                                </div>
                                <div class="form-group">
                                    <h4>Kata Sandi</h4>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-light">Masuk</button>
                            </form>
                            <h5>Belum punya akun ? <a href="<?php echo site_url('pemilik/daftar')?>" style="color: #66ccff">Daftar</a></h5>
                        </div>
                        <div class="col-lg-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Custom Theme JavaScript -->
    <script>
    // Disable Google Maps scrolling
    // See http://stackoverflow.com/a/25904582/1607849
    // Disable scroll zooming and bind back the click event
    var onMapMouseleaveHandler = function(event) {
        var that = $(this);
        that.on('click', onMapClickHandler);
        that.off('mouseleave', onMapMouseleaveHandler);
        that.find('iframe').css("pointer-events", "none");
    }
    var onMapClickHandler = function(event) {
            var that = $(this);
            // Disable the click handler until the user leaves the map area
            that.off('click', onMapClickHandler);
            // Enable scrolling zoom
            that.find('iframe').css("pointer-events", "auto");
            // Handle the mouse leave event
            that.on('mouseleave', onMapMouseleaveHandler);
        }
        // Enable map zooming with mouse scroll when the user clicks the map
    $('.map').on('click', onMapClickHandler);
    </script>

</body>

</html>
