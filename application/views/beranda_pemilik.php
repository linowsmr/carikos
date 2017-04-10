<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Kos Anda</h2>
                    <hr class="small" style="border-color: black;">
                    <?php
                        if($jumlah < 1) { ?>
                            <h4>Anda Tidak Memiliki Kos</h4>
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
                                            <th>Nama Kos</th>
                                            <th>Alamat Kos</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($kos as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo site_url('kos/beranda?kos='.$row->idKos.'')?>"><p><?php echo $row->namaKos ?></p></a>
                                                        </td>
                                                        <td><p><?php echo $row->alamatKos ?></p></td>
                                                        <td>
                                                            <form action="<?php echo site_url('kos/delete') ?>" method="post">
                                                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
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
        </div>
    </aside>

    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Kos</h2>
                    <hr class="small">
                    <div class="row">
                        <form id="kos" action="<?php echo site_url('kos/daftar')?>" method="post" enctype="multipart/form-data">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4>Nama Kos</h4>
                                    <input type="name" class="form-control" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <h4>Alamat Kos</h4>
                                    <textarea class="form-control" rows="3" id="alamat" name="alamat" required></textarea>
                                    <input id="submit" type="button" value="Verifikasi Alamat"  class="btn btn-lg btn-light" onclick="myFunction()">
                                </div>
                                <div id="form-2" style="display: none;">
                                    <br>
                                    <div class="form-group">
                                        <h4>Telepon Kos</h4>
                                        <input type="name" class="form-control" name="telepon" required>
                                    </div>
                                    <div class="form-group">
                                        <h4>Luas Parkiran (Dalam m<sup>2</sup>)</h4>
                                        <select class="form-control" name="parkiran">
                                        	<option></option>
                                            <?php
                                                foreach($parkir as $row){ ?>
                                                    <option value="<?php echo $row->idParkiranKos ?>"><?php echo $row->luasParkiran ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h4>Tipe Kos</h4>
                                        <select class="form-control" name="tipe" required>
                                            <?php
                                                foreach($tipe as $row){ ?>
                                                    <option value="<?php echo $row->idTipeKos ?>"><?php echo $row->tipeKos ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h4>Fasilitas Kos</h4>
                                        <select id="multiple-select-fasilitas" multiple="multiple" name="fasilitas[]">
                                            <?php
                                                foreach($fasilitas as $row){ ?>
                                                    <option value="<?php echo $row->idFasilitasKos ?>"><?php echo $row->namaFasilitasKos ?></option>
                                                <?php }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <h4>Foto Kos</h4>
                                        <input type="file" name="foto[]" multiple>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="latlng" name="latlng">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="pemilik" value="<?php echo $username ?>">
                                    </div>
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-lg btn-light">Daftar</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <script>
        function myFunction() {
            var geocoder = new google.maps.Geocoder();
            var address = document.getElementById('alamat').value;
            geocoder.geocode({'address': address}, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                  document.getElementById("latlng").value = results[0].geometry.location;
                  alert('Alamat Tersedia');
                  document.getElementById('form-2').style.display = "";
                } else {
                  alert('Alamat Tidak Terdaftar');
                }
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDota_CEvGFaIOddKRMzYjg487U1dL9qWo">
    </script>
</body>

</html>
