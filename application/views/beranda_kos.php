<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
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
                            <ol class="breadcrumb">
                                <li><a href="<?php echo site_url('pemilik/beranda') ?>">Kos</a></li>
                                <li class="active"><?php echo $row->namaKos ?></li>      
                            </ol>
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
                            <button class="btn btn-danger" data-href="<?php echo site_url('kos/delete?kos='.$row->idKos.'') ?>" data-toggle="modal" data-target="#confirm-delete-kos">
							    Hapus
							</button>
							<div class="modal fade" id="confirm-delete-kos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							    <div class="modal-dialog">
							        <div class="modal-content">
							            <div class="modal-body" style="text-align: center; font-size: 20px;">
							                Anda akan menghapus kos <b><?php echo $row->namaKos ?></b>
							            </div>
							            <div class="modal-footer">
							                <a type="button" class="btn btn-default" data-dismiss="modal">Tidak</a>
							                <a class="btn btn-danger btn-ok" style="margin-top: 0%">Ya</a>
							            </div>
							        </div>
							    </div>
							</div>
                            <form action="<?php echo site_url('kos/tambah_fasilitas') ?>" method="get">
                                <input type="hidden" name="kos" value="<?php echo $row->idKos ?>"></input>
                                <button type="submit" class="btn btn-primary" style="margin-top: 4.5%">Tambah Fasilitas Kos</button>
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
                                                <td><?php echo $row->namaFasilitasKos ?></td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" data-href="<?php echo site_url('kos/delete_fasilitas?kos='.$row->idKos.'&fasilitas='.$row->idKosFasilitasKos.'') ?>" data-toggle="modal" data-target="#confirm-delete-fasilitas">
													    Hapus
													</button>
													<div class="modal fade" id="confirm-delete-fasilitas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
													    <div class="modal-dialog">
													        <div class="modal-content">
													            <div class="modal-body" style="font-size: 20px;">
													                Anda akan menghapus fasilitas kos</b>
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
                                        <button class="btn btn-danger btn-xs" data-href="<?php echo site_url('kos/hapus_foto?kos='.$row->idKos.'&foto='.$row->idFotoKos.'&nama='.$row->namaFile.'') ?>" data-toggle="modal" data-target="#confirm-delete-foto">
										    Hapus
										</button>
										<div class="modal fade" id="confirm-delete-foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										    <div class="modal-dialog">
										        <div class="modal-content">
										            <div class="modal-body" style="text-align: center; font-size: 20px; color: black;">
										                Anda akan menghapus foto kos</b>
										            </div>
										            <div class="modal-footer">
										                <a type="button" class="btn btn-default" data-dismiss="modal">Tidak</a>
										                <a class="btn btn-danger btn-ok" style="margin-top: 0%">Ya</a>
										            </div>
										        </div>
										    </div>
										</div>
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
                                        <th>Luas Kamar (Dalam m)</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($kamar as $row) { ?>
                                                <tr>
                                                    <td><a href="<?php echo site_url('kamar/beranda?kamar='.$row->idKamar.'')?>"><?php echo $row->jenisKamar ?></a></td>
                                                    <td><?php echo number_format($row->hargaKamar) ?></td>
                                                    <td><?php echo $row->jumlahKamar ?></td>
                                                    <td><?php echo $row->luasKamar ?></td>
                                                    <td>
                                                    	<button class="btn btn-danger btn-sm" data-href="<?php echo site_url('kamar/delete?kos='.$row->idKos.'&kamar='.$row->idKamar.'') ?>" data-toggle="modal" data-target="#confirm-delete-kamar">
														    Hapus
														</button>
														<div class="modal fade" id="confirm-delete-kamar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
														    <div class="modal-dialog">
														        <div class="modal-content">
														            <div class="modal-body" style="font-size: 20px;">
														                Anda akan menghapus kamar <b><?php echo $row->jenisKamar ?></b>
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
	                                	<input type="number" min="1" class="form-control" name="jumlah" required>
	                                	<span class="input-group-addon">Kamar</span>
	                                </div>
	                            </div>
                                <div class="form-group">
                                    <h4>Luas Kamar (Dalam m)</h4>
                                    <div class="input-group">
                                        <input type="name" class="form-control" name="panjang" style="width: 50%; float: right;" required>
                                        <span class="input-group-addon">X</span>
                                        <input type="name" class="form-control" name="lebar" style="width: 50%;" required>
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
                                    <input type="file" name="foto[]" multiple>
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
    <script type="text/javascript">
    	$('#confirm-delete-kos').on('show.bs.modal', function(e) {
		    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
		});
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