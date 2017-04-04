<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tambah Fasilitas Kamar</h2>
                    <hr class="small">
                    <div class="row">
                        <form action="<?php echo site_url('kamar/tambah_fasilitas_baru')?>" method="post">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <table class="table table-stripped" style="color: white;">
                                        <thead>
                                          <tr>
                                            <th style="font-weight: normal; font-size: 20px;">Fasilitas Kamar "<?php echo $jenis ?>"</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($fasilitas_kamar as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->namaFasilitasKamar ?></td>
                                                    </tr>
                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <h4>Fasilitas Kamar Baru</h4>
                                    <select id="multiple-select-tipe" multiple="multiple" name="fasilitas[]">
                                        <?php
                                            foreach($fasilitas as $row){ ?>
                                                <option value="<?php echo $row->idFasilitasKamar ?>"><?php echo $row->namaFasilitasKamar ?></option>
                                            <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-lg btn-light">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
