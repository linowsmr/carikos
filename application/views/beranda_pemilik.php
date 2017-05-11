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
                                                            <a href="<?php echo site_url('kos/beranda?kos='.$row->idKos.'')?>"><?php echo $row->namaKos ?></a>
                                                        </td>
                                                        <td><?php echo $row->alamatKos ?></td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm" data-href="<?php echo site_url('kos/delete?kos='.$row->idKos.'') ?>" data-toggle="modal" data-target="#confirm-delete-kos">
                                                                Hapus
                                                            </button>
                                                            <div class="modal fade" id="confirm-delete-kos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body" style="font-size: 20px;">
                                                                            Anda akan menghapus kos</b>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a type="button" class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                                            <a class="btn btn-danger btn-ok" style="margin-top: 0%">Ya</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
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
                                    <h4>Kota Kos</h4>
                                    <input type="name" class="form-control" name="kota" required>
                                </div>
                                <div class="form-group">
                                    <h4>Alamat Kos</h4>
                                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                                </div>
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
                                    <input type="hidden" class="form-control" id="lat" name="lat">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="lng" name="lng">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="pemilik" value="<?php echo $username ?>">
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
    <script type="text/javascript">
        $('#confirm-delete-kos').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>
