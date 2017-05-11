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
                                                        <td><p><?php echo $row->idTransaksi ?></p></td>
                                                        <td><p><?php echo $row->namaKos ?></p></td>
                                                        <td><p><?php echo $row->jenisKamar ?></p></td>
                                                        <td><p><?php echo substr($row->tanggalTransaksi, 0, 10) ?></p></td>
                                                        <td><p><?php echo $row->durasiPemesanan ?> bulan</p></td>
                                                        <td><p>Rp<?php echo number_format($row->totalPembayaran) ?></p></td>
                                                        <td><p><?php 
                                                                if($status=="Lunas"){?>
                                                                    <form action="<?php echo site_url('transaksi/eticket')?>" method="POST">
                                                                        <input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
                                                                        <button type="submit" class="btn btn-success btn-sm">E-ticket</button>
                                                                    </form>
                                                                <?php }
                                                                else{
                                                                    echo $status;
                                                                }?></p></td>
                                                        <?php
                                                            if($row->status == 0){ ?>
                                                                <td>
                                                                    <form action="<?php echo site_url('transaksi/pembatalan')?>" method="POST">
                                                                        <input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
                                                                        <button type="submit" class="btn btn-danger btn-sm">Pembatalan</button>
                                                                    </form>
                                                                </td>
                                                            <?php }
                                                            else{ ?>
                                                                <td>
                                                                    <form action="<?php echo site_url('transaksi/pembatalan')?>" method="POST">
                                                                        <input type="hidden" name="transaksi" value="<?php echo $row->idTransaksi?>"></input>
                                                                        <button type="submit" class="btn btn-danger btn-sm" disabled>Pembatalan</button>
                                                                    </form>
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
</body>

</html>
