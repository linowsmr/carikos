<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <?php
                    foreach($promo as $row){ ?>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 text-center">
                            <h2><?php echo $row->namaPromo ?></h2>
                            <hr class="small" style="border-color: black;">
                            <h4><?php echo $row->deskripsiPromo ?></h4>
                            <br>
                            <h4><b>Periode Booking:</b> <?php echo $row->periodeBookingMulai ?> - <?php echo $row->periodeBookingSelesai ?></h4>
                            <h4>
                                <b>Periode Sewa:</b> 
                                <?php
                                    if($row->periodeSewaMulai == "-" || $row->periodeSewaAkhir == "-"){ ?>
                                        Kapan Pun
                                    <?php }
                                    else{ 
                                        echo "$row->periodeSewaMulai - $row->periodeSewaAkhir";        
                                    }
                                ?>
                            </h4>
                            <br><br>
                            <h4>Kode Promo</h4>
                            <h2><?php echo $row->kodePromo ?></h2>
                            <br><br>
                            <h4>Syarat & Ketentuan</h4>
                            <p>1. Potongan harga sebesar <b>Rp<?php echo number_format($row->potonganHarga) ?></b> dengan transaksi minimum <b>Rp<?php echo number_format($row->minimumTransaksi) ?></b> dan minimum durasi pemesanan selama <b><?php echo $row->minimumDurasiPemesanan ?> bulan</b> dalam satu No. Pemesanan.</p>
                            <p>2. Berlaku untuk pembayaran dari semua bank.</p>
                            <p>3. Hanya berlaku untuk 1 transaksi per hari selama periode promo.</p>
                            <p>4. Promo ini tidak dapat digabung dengan promo lainnya.</p>
                            <p>5. <b>Periode Booking:</b> <?php echo $row->periodeBookingMulai ?> - <?php echo $row->periodeBookingSelesai ?>
                            <?php
                                if($row->periodeSewaMulai == "-" || $row->periodeSewaAkhir == "-"){ ?>
                                    <p> 6. <b>Periode Sewa:</b> Kapan Pun</p>
                                <?php }
                                else{ ?>
                                    <p> 6. <b>Periode Sewa:</b> <?php echo "$row->periodeSewaMulai - $row->periodeSewaAkhir"; ?></p>        
                                <?php }
                            ?>
                        </div>
                        <div class="col-lg-3"></div>
                    <?php }
                ?>
            </div>
        </div>
    </aside>
</body>

</html>
