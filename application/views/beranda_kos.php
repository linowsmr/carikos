<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      #map {
        height: 100%;
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
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <?php
                    foreach($detail as $row){ 
                        $latlong = substr($row->latLngCluster, 1, -1);
                        $coord = explode(", ", $latlong);
                        $lat = $coord[0];
                        $lng = $coord[1];
                        //$lat = -7.2798797;
                        //$lng = 112.7971214;
                        ?>
                        <div class="col-lg-12 text-center">
                            <h2><?php echo $row->namaKos ?></h2>
                            <hr class="small" style="border-color: black;">
                            <h3>Alamat</h3>
                            <p><?php echo $row->alamatKos ?></p>
                            <h3>Telepon</h3>
                            <p><?php echo $row->teleponKos ?></p>
                            <h3>Luas Parkiran (Dalam m<sup>2</sup>)</h3>
                            <p><?php echo $row->luasParkiran ?></p>
                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <form action="<?php echo site_url('kos/update') ?>" method="get">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </form>
                            <form action="<?php echo site_url('kos/ubah_tipe') ?>" method="get">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <button type="submit" class="btn btn-success">Ubah Tipe Kos</button>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <form action="<?php echo site_url('kos/delete') ?>" method="post">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                            <form action="<?php echo site_url('kos/tambah_fasilitas') ?>" method="get">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <button type="submit" class="btn btn-primary">Tambah Fasilitas Kos</button>
                            </form>
                        </div>
                    <?php } ?>
    
                        <div class="col-lg-6">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Tipe Kos</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($tipe as $row) { ?>
                                            <tr>
                                                <td><p><?php echo $row->tipeKos ?></p></td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-lg-6">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Fasilitas Kos</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($fasilitas as $row) { ?>
                                            <tr>
                                                <td><p><?php echo $row->namaFasilitasKos ?></p></td>
                                                <td>
                                                    <form action="<?php echo site_url('kos/delete_fasilitas') ?>" method="post">
                                                        <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                                        <input type="hidden" name="fasilitas" value="<?php echo $row->idKosFasilitasKos ?>"></input>
                                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Peta</h2>
                    <hr class="small">
                    <div class="container">
                        <div class="row">
                            <div id="map"></div>
                        </div>
                        <script>
                            var map;
                            var service;
                            var array = [];

                            function initMap() {
                              map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>},
                                zoom: 16,
                                styles: [{
                                  stylers: [{ visibility: 'simplified' }]
                                }, {
                                  elementType: 'labels',
                                  stylers: [{ visibility: 'off' }]
                                }]
                              });

                              service = new google.maps.places.PlacesService(map);

                              // The idle event is a debounced event, so we can query & listen without
                              // throwing too many requests at the server.
                              map.addListener('idle', performSearch);
                            }

                            function performSearch() {
                              var request = {
                                bounds: map.getBounds(),
                                keyword: 'Masjid'
                              };
                              service.radarSearch(request, callback);
                            }

                            function callback(results, status) {
                              if (status !== google.maps.places.PlacesServiceStatus.OK) {
                                console.error(status);
                                return;
                              }
                              for (var i = 0, result; result = results[i]; i++) {
                                var origin = {lat: <?php Print($lat); ?>, lng: <?php Print($lng); ?>};
                                var destination = result.geometry.location;

                                getDistance(origin, destination);
                              }
                            }

                            function getDistance(origin, destination){
                              var geocoder = new google.maps.Geocoder;
                              var service = new google.maps.DistanceMatrixService;
                              service.getDistanceMatrix({
                                origins: [origin],
                                destinations: [destination],
                                travelMode: google.maps.TravelMode.DRIVING,
                                unitSystem: google.maps.UnitSystem.METRIC
                              }, function(response, status) {
                                if (status !== google.maps.DistanceMatrixStatus.OK) {
                                  alert('Error was: ' + status);
                                } else {
                                  var originList = response.originAddresses;
                                  var destinationList = response.destinationAddresses;
                                  
                                  for (var i = 0; i < originList.length; i++) {
                                    var results = response.rows[i].elements;
                                    for (var j = 0; j < results.length; j++) {
                                      var element = results[j];
                                      var distance = element.distance.text.slice(0, -2).replace(",", ".");
                                      if(distance < 5){
                                        //alert("Destination: " + destination + "\nDistance: " + distance);
                                        //addMarker(destination, distance);
                                        if(array.length == 0)
                                            var newItem = array.push(distance);
                                        else if(array[0] > distance)
                                            array[0] = distance;
                                      }
                                    }
                                  }
                                }
                                console.log(array.sort());
                                //$('#form1').submit(chk);
                                form(array[0]);
                              });
                            }

                            function chk(num)
                            {
                                //var name = document.getElementById('name').value;
                                //var name = 'Lino';
                                //alert(num);
                                // var dataString = 'name=' + name;

                                // $.ajax({
                                //     type: "post",
                                //     //url: "hi.php",
                                //     url: "<?php echo site_url('kos/cluster')?>",
                                //     data: dataString,
                                //     cache: false,
                                //     success: function(html){
                                //         alert('Berhasil');
                                //     }
                                // });
                                // return false;
                            }

                            function form(num)
                            {
                                // Fetching HTML Elements in Variables by ID.
                                var x = document.getElementById("form");
                                var createform = document.createElement('form'); // Create New Element Form
                                createform.setAttribute("action", "<?php echo site_url('kos/cluster')?>"); // Setting Action Attribute on Form
                                createform.setAttribute("method", "post"); // Setting Method Attribute on Form
                                x.appendChild(createform);

                                var linebreak = document.createElement('br');
                                createform.appendChild(linebreak);

                                var namelabel = document.createElement('label'); // Create Label for Name Field
                                namelabel.innerHTML = "Your Name : "; // Set Field Labels
                                createform.appendChild(namelabel);

                                var inputelement = document.createElement('input'); // Create Input Field for Name
                                inputelement.setAttribute("type", "text");
                                inputelement.setAttribute("name", "name");
                                inputelement.setAttribute("value", num);
                                createform.appendChild(inputelement);

                                
                                var messagebreak = document.createElement('br');
                                createform.appendChild(messagebreak);

                                var submitelement = document.createElement('input'); // Append Submit Button
                                submitelement.setAttribute("type", "submit");
                                submitelement.setAttribute("value", "Submit");
                                createform.appendChild(submitelement);

                                createform.submit();
                            }
                        </script>
                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&callback=initMap&libraries=places,visualization" async defer></script>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <!-- <form id="form1">
                        <input type="submit" value="Kirim"></input>     
                    </form> -->
                    <div id="form" style="color: black;"></div>
                </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Foto Kos</h2>
                    <hr class="small">
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach($foto as $row){ ?>
                                    <div class="col-lg-3">
                                        <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url();?>assets/images/kos/<?php echo $row->namaFile ?>">
                                            <img class="img-responsive" alt="" src="<?php echo base_url();?>assets/images/kos/<?php echo $row->namaFile ?>" />
                                        </a>
                                        <form action="<?php echo site_url('kos/hapus_foto') ?>" method="post">
                                            <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                            <input type="hidden" name="foto" value="<?php echo $row->idFotoKos ?>"></input>
                                            <input type="hidden" name="nama" value="<?php echo $row->namaFile ?>"></input>
                                            <button type="submit" class="btn btn-danger btn-xs">Hapus Foto</button>
                                        </form>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                    <form action="<?php echo site_url('kos/tambah_foto') ?>" method="get">
                        <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                        <button type="submit" class="btn btn-default">Tambah Foto Kos</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <?php
                	foreach($detail as $row) { ?>
	                	<h2>Daftar Kamar <?php echo $row->namaKos ?></h2>
		                    <hr class="small" style="border-color: black;">
		                </div>
                	<?php }
                    if($jumlah < 1) { ?>
                        <h4 class="text-center">Kos Belum Memiliki Kamar</h4>
                    <?php
                        }
                    else { ?>
                        <div class="row">
                            <div class="col-lg-1">
                            </div>
                            <div class="col-lg-10">
                                <table class="table table-stripped">
                                    <thead>
                                      <tr>
                                        <th>Jenis Kamar</th>
                                        <th>Harga Kamar</th>
                                        <th>Jumlah Kamar</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($kamar as $row) { ?>
                                                <tr>
                                                    <td><a href="<?php echo site_url('kamar/beranda?kamar='.$row->idKamar.'')?>"><p><?php echo $row->jenisKamar ?></p></a></td>
                                                    <td><p><?php echo number_format($row->hargaKamar) ?></p></td>
                                                    <td><p><?php echo $row->jumlahKamar ?></p></td>
                                                    <td>
                                                        <form action="<?php echo site_url('kamar/delete') ?>" method="post">
                                                            <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                                            <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-1">
                            </div>
                        </div>
                    <?php }
                ?>
            </div>
        </div>
    </aside>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                	<h2>Daftar Kamar</h2>
                    <hr class="small">
	                <div class="row">
	                    <form action="<?php echo site_url('kamar/daftar')?>" method="post" enctype="multipart/form-data">
	                        <div class="col-lg-4"></div>
	                        <div class="col-lg-4">
	                            <div class="form-group">
	                                <h4>Jenis Kamar</h4>
	                                <input type="name" class="form-control" name="jenis" required>
	                            </div>
	                            <div class="form-group">
	                                <h4>Harga Kamar</h4>
	                                <div class="input-group">
	                                	<span class="input-group-addon">Rp</span>
	                                	<input type="name" class="form-control" name="harga" required>
	                                	<span class="input-group-addon">,00</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <h4>Jumlah Kamar</h4>
	                                <div class="input-group">
	                                	<input type="name" class="form-control" name="jumlah" required>
	                                	<span class="input-group-addon">Kamar</span>
	                                </div>
	                            </div>
	                            <div class="form-group">
	                                <h4>Fasilitas Kamar</h4>
	                                <select id="multiple-select-fasilitas" multiple="multiple" name="fasilitas[]">
	                                    <?php
	                                        foreach($fasilitaskamar as $row){ ?>
	                                            <option value="<?php echo $row->idFasilitasKamar ?>"><?php echo $row->namaFasilitasKamar ?></option>
	                                        <?php }
	                                    ?>
	                                </select>
	                            </div>
                                <div class="form-group">
                                    <h4>Foto Kamar</h4>
                                    <input type="file" name="foto[]" multiple required>
                                </div>
	                            <div class="form-group">
	                                <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
	                            </div>
	                        </div>
	                        <div class="col-lg-4"></div>
	                        <div class="col-lg-12">
	                            <button type="submit" class="btn btn-lg btn-light">Daftar</button>
	                        </div>
	                    </form>
	                </div>
	            </div>
            </div>
        </div>
    </aside>
</body>

</html>