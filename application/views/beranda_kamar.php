<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <?php
                    foreach($detail as $row){ ?>
                        <div class="col-lg-12 text-center">
                            <ol class="breadcrumb">
                                <li><a href="<?php echo site_url('pemilik/beranda') ?>">Kos</a></li>
                                <li><a href="<?php echo site_url('kos/beranda?kos='.$row->idKos.'') ?>"><?php echo $row->namaKos ?></a></li> 
                                <li class="active"><?php echo $row->jenisKamar ?></li>     
                            </ol>
                            <h2>Jenis Kamar "<?php echo $row->jenisKamar ?>"</h2>
                            <hr class="small" style="border-color: black;">
                            <h3>Harga</h3>
                            <p><?php echo $row->hargaKamar ?></p>
                            <h3>Jumlah</h3>
                            <p><?php echo $row->jumlahKamar ?></p>
                            <h3>Luas Kamar</h3>
                            <p><?php echo $row->luasKamar ?></p>
                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <form action="<?php echo site_url('kamar/update') ?>" method="get">
                                <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                <button type="submit" class="btn btn-success">Ubah</button>
                            </form>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-danger" data-href="<?php echo site_url('kamar/delete?kos='.$row->idKos.'&kamar='.$row->idKamar.'') ?>" data-toggle="modal" data-target="#confirm-delete-kamar">
                                Hapus
                            </button>
                            <div class="modal fade" id="confirm-delete-kamar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body" style="text-align: center; font-size: 20px;">
                                            Anda akan menghapus kamar <b><?php echo $row->jenisKamar ?></b>
                                        </div>
                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                            <a class="btn btn-danger btn-ok" style="margin-top: 0%">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                            <form action="<?php echo site_url('kamar/tambah_fasilitas') ?>" method="get">
                                <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                                <button type="submit" class="btn btn-primary">Tambah Fasilitas Kamar</button>
                            </form>
                        </div>
                    <?php } ?>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <table class="table table-stripped">
                                <thead>
                                  <tr>
                                    <th>Fasilitas Kamar</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($fasilitas as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->namaFasilitasKamar ?></td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" data-href="<?php echo site_url('kamar/delete_fasilitas?kamar='.$row->idKamar.'&fasilitas='.$row->idKamarFasilitasKamar.'') ?>" data-toggle="modal" data-target="#confirm-delete-fasilitas">
                                                        Hapus
                                                    </button>
                                                    <div class="modal fade" id="confirm-delete-fasilitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-body" style="font-size: 20px;">
                                                                    Anda akan menghapus fasilitas kamar</b>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                    <a class="btn btn-danger btn-ok" style="margin-top: 0%">Hapus</a>
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
                        <div class="col-lg-4"></div>
            </div>
        </div>
    </aside>

    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                <h2>Foto Kamar</h2>
                    <hr class="small">
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach($foto as $row){ ?>
                                    <div class="col-lg-3">
                                        <a class="thumbnail fancybox" rel="ligthbox" href="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>">
                                            <img class="img-responsive" alt="" src="<?php echo base_url();?>assets/images/kamar/<?php echo $row->namaFileKamar ?>" />
                                        </a>
                                        <button class="btn btn-danger btn-xs" data-href="<?php echo site_url('kamar/hapus_foto?kamar='.$row->idKamar.'&foto='.$row->idFotoKamar.'$nama='.$row->namaFileKamar.'') ?>" data-toggle="modal" data-target="#confirm-delete-foto">
                                            Hapus
                                        </button>
                                        <div class="modal fade" id="confirm-delete-foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body" style="text-align: center; font-size: 20px; color: black;">
                                                        Anda akan menghapus foto kamar</b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                        <a class="btn btn-danger btn-ok" style="margin-top: 0%">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            ?>
                        </div>
                    </div>
                    <form action="<?php echo site_url('kamar/tambah_foto') ?>" method="get">
                        <input type="hidden" name="kamar" value="<?php echo $row->idKamar ?>"></input>
                        <button type="submit" class="btn btn-default">Tambah Foto Kamar</button>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <script type="text/javascript">
        $('#confirm-delete-fasilitas').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#confirm-delete-foto').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
        $('#confirm-delete-kamar').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>
