<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Pemesanan</h2>
                    <hr class="small" style="border-color: black;">
                    <?php
                        if($cek < 0){ ?>
                            <h4>Tidak Ada Pemesanan</h4>
                        <?php }
                        else { ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <table class="table table-stripped">
                                        <thead>
                                          <tr>
                                            <th>Nama Kos</th>
                                            <th>Jenis Kamar</th>
                                            <th>Pemesan</th>
                                            <th>Telepon Pemesan</th>
                                            <th>Email Pemesan</th>
                                            <th>Durasi Sewa</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($pemesanan as $row) { ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?php echo site_url('kos/beranda?kos='.$row->idKos.'')?>"><?php echo $row->namaKos ?></a>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo site_url('kamar/beranda?kamar='.$row->idKamar.'')?>"><?php echo $row->jenisKamar ?></a>
                                                        </td>
                                                        <td><?php echo $row->namaAkun ?></td>
                                                        <td><?php echo $row->teleponAkun ?></td>
                                                        <td><?php echo $row->emailAkun ?></td>
                                                        <td><?php echo $row->durasiPemesanan ?> bulan</td>
                                                        <td>Rp<?php echo number_format($row->durasiPemesanan*$row->hargaPemesanan) ?>,00</td>
                                                        <td>Belum Lunas</td>
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
