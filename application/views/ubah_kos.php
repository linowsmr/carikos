<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php
                        foreach($detail as $row) { 
                            $luasParkir = $row->idParkiranKos;
                            $idKos = $row->idKos; 
                            $latlong = substr($row->latLngKos, 1, -1);
                            $coord = explode(", ", $latlong);
                            $latKos = $coord[0];
                            $lngKos = $coord[1];
                            ?>
                            <h2>Ubah Kos "<?php echo $row->namaKos ?>"</h2>
                            <hr class="small">
                            <div class="row">
                                <form action="<?php echo site_url('kos/update_data')?>" method="post">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <h4>Nama Kos</h4>
                                            <input type="name" class="form-control" name="nama" value="<?php echo $row->namaKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Kota Kos</h4>
                                            <input type="name" class="form-control" name="kota" value="<?php echo $row->kotaKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Alamat Kos</h4>
                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row->alamatKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Telepon Kos</h4>
                                            <input type="name" class="form-control" name="telepon" value="<?php echo $row->teleponKos ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Luas Parkiran (Dalam m<sup>2</sup>)</h4>
                                            <select class="form-control" name="parkiran">
                                                <option></option>
                                                <?php
                                                    }
                                                    foreach($parkir as $row){ 
                                                        if($luasParkir == $row->idParkiranKos) { ?>
                                                            <option value="<?php echo $row->idParkiranKos ?>" selected><?php echo $row->luasParkiran ?></option>
                                                    <?php
                                                        } else { ?>
                                                            <option value="<?php echo $row->idParkiranKos ?>"><?php echo $row->luasParkiran ?></option>
                                                        <?php }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="lat" name="lat" value="<?php echo $latKos ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="lng" name="lng" value="<?php echo $lngKos ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" name="id" value="<?php echo $idKos ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-lg btn-light">Ubah</button>
                                    </div>
                                </form>
                            </div>
                </div>
            </div>
        </div>
    </aside>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo&libraries=places">
    </script>
    <script>
        function initialize(){
            var input = document.getElementById('alamat');
            var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lng').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</body>

</html>
