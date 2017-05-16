<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Transaksi</h2>
                    <hr class="small" style="border-color: black;">
                    <?php
                        if($cek < 0){ ?>
                            <h4>Tidak Ada Transaksi</h4>
                        <?php }
                        else { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-stripped">
                                        <thead>
                                          <tr>
                                            <th>ID Transaksi</th>
                                            <th>Nama Kos</th>
                                            <th>Jenis Kamar</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Durasi Sewa</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Pembatalan</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($transaksi as $row) { 
                                                    if($row->status == 0)
                                                        $status = "Belum Bayar";
                                                    else if($row->status == 1)
                                                        $status = "Pembayaran Sedang Diverifikasi";
                                                    else if($row->status == 2)
                                                        $status = "Lunas";
                                                    else if($row->status == 3)
                                                        $status = "Batal";
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row->idTransaksi ?></td>
                                                        <td><?php echo $row->namaKos ?></td>
                                                        <td><?php echo $row->jenisKamar ?></td>
                                                        <td><?php echo substr($row->tanggalTransaksi, 0, 10) ?></td>
                                                        <td><?php echo $row->durasiPemesanan ?> bulan</td>
                                                        <td>Rp<?php echo number_format($row->totalPembayaran) ?></td>
                                                        <td><?php 
                                                                if($status=="Lunas"){?>
                                                                    <a href="<?php echo site_url('transaksi/eticket?transaksi='.$row->idTransaksi.'')?>" target="_blank"><button class="btn btn-success btn-sm">
                                                                        E-Ticket
                                                                    </button></a>
                                                                <?php }
                                                                else{
                                                                    echo $status;
                                                                }?></td>
                                                        <?php
                                                            if($row->status == 0){ ?>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" data-href="<?php echo site_url('transaksi/pembatalan?transaksi='.$row->idTransaksi.'') ?>" data-toggle="modal" data-target="#confirm-delete-transaksi">
                                                                        Batal
                                                                    </button>
                                                                    <div class="modal fade" id="confirm-delete-transaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body" style="text-align: center; font-size: 20px;">
                                                                                    Anda akan membatalkan pemesanan kamar
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a type="button" class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                                                    <a class="btn btn-danger btn-ok" style="margin-top: 0%">Ya</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            <?php }
                                                            else{ ?>
                                                                <td>
                                                                    <button class="btn btn-danger btn-sm" data-href="<?php echo site_url('transaksi/pembatalan?transaksi='.$row->idTransaksi.'') ?>" data-toggle="modal" data-target="#confirm-delete-transaksi" disabled>
                                                                        Batal
                                                                    </button>
                                                                    <div class="modal fade" id="confirm-delete-transaksi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body" style="text-align: center; font-size: 20px;">
                                                                                    Anda akan membatalkan pemesanan kamar
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a type="button" class="btn btn-default" data-dismiss="modal">Tidak</a>
                                                                                    <a class="btn btn-danger btn-ok" style="margin-top: 0%">Ya</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            <?php }
                                                        ?>
                                                    </tr>
                                                <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php }
                    ?>
                </div>
            </div>
        </div>
    </aside>
    <script type="text/javascript">
        $('#confirm-delete-transaksi').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
</body>

</html>
