<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Ubah Tipe Kos</h2>
                    <hr class="small">
                    <div class="row">
                        <form action="<?php echo site_url('kos/ubah_tipe_baru')?>" method="post">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <table class="table table-stripped" style="color: white;">
                                        <thead>
                                          <tr>
                                            <th style="font-weight: normal; font-size: 20px;">Tipe Kos Anda</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($tipe_kos as $row) { ?>
                                                    <tr>
                                                        <td><?php echo $row->tipeKos ?></td>
                                                    </tr>
                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                    <h4>Tipe Kos Baru</h4>
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
