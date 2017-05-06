<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tambah Fasilitas Kos</h2>
                    <hr class="small" style="border-color: black;">
                    <div class="row">
                        <form action="<?php echo site_url('kos/tambah_fasilitas_baru')?>" method="post">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <table class="table table-stripped">
                                        <thead>
                                          <tr>
                                            <th style="font-weight: normal; font-size: 20px;">Fasilitas Kos Anda</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($fasilitas_kos as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->namaFasilitasKos ?></td>
                                                    </tr>
                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <h4>Fasilitas Kos Baru</h4>
                                    <select id="multiple-select-tipe" multiple="multiple" name="fasilitas[]">
                                        <?php
                                            foreach($fasilitas as $row){ ?>
                                                <option value="<?php echo $row->idFasilitasKos ?>"><?php echo $row->namaFasilitasKos ?></option>
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
                                <button type="submit" class="btn btn-lg btn-dark">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
