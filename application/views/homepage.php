<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Stylish Portfolio - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/stylish-portfolio.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/bootstrap/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <h3>Sekarang Cari Kos Menjadi Lebih Mudah</h3>
            <br>
            <a href="#contact" class="btn btn-dark btn-lg">Cari Kos</a>
            <a href="#daftar" class="btn btn-dark btn-lg">Daftar Kos</a>
        </div>
    </header>

    <!-- About -->
    <section id="tentang" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Cari Kos di Lokasi yang Anda Inginkan</h2>
                    <p class="lead">Geser Lokasi Anda untuk Menampilkan Kos</p>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>

    <!-- Map -->
    <section id="cari" class="map">
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
    </section>

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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1 text-center">
                    <h4><strong>Start Bootstrap</strong>
                    </h4>
                    <p>3481 Melrose Place
                        <br>Beverly Hills, CA 90210</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-phone fa-fw"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope-o fa-fw"></i> <a href="mailto:name@example.com">name@example.com</a>
                        </li>
                    </ul>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble fa-fw fa-3x"></i></a>
                        </li>
                    </ul>
                    <hr class="small">
                    <p class="text-muted">Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </div>
        <a id="to-top" href="#top" class="btn btn-dark btn-lg"><i class="fa fa-chevron-up fa-fw fa-1x"></i></a>
    </footer>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#],[data-toggle],[data-target],[data-slide])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });
    //#to-top button appears after scrolling
    var fixed = false;
    $(document).scroll(function() {
        if ($(this).scrollTop() > 250) {
            if (!fixed) {
                fixed = true;
                // $('#to-top').css({position:'fixed', display:'block'});
                $('#to-top').show("slow", function() {
                    $('#to-top').css({
                        position: 'fixed',
                        display: 'block'
                    });
                });
            }
        } else {
            if (fixed) {
                fixed = false;
                $('#to-top').hide("slow", function() {
                    $('#to-top').css({
                        display: 'none'
                    });
                });
            }
        }
    });
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
