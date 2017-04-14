<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Promo</h2>
                    <hr class="small" style="border-color: black;">
                    <?php
                        foreach($promo as $row){ ?>
                            <div class="col-lg-4">
                                <div class="col-lg-12" style="background: url(<?php echo base_url();?>assets/images/promo/<?php echo $row->fotoPromo ?>); background-size: cover; background-position: center; height: 25%"></div>
                                <div class="col-lg-12" style="background-color: #337ab7; color: white">
                                    <h4><?php echo $row->namaPromo ?></h4>
                                    <hr style="margin-top: 0%; margin-bottom: 0%">
                                    <h4>Periode Booking: <?php echo $row->periodeBookingMulai ?> - <?php echo $row->periodeBookingSelesai ?></h4>
                                    <h4>
                                        Periode Sewa: 
                                        <?php
                                            if($row->periodeSewaMulai == "-" || $row->periodeSewaSelesai == "-"){ ?>
                                                Kapan Pun
                                            <?php }
                                        ?>
                                    </h4>
                                    <button class="btn btn-light">Lihat Promo</button>
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
