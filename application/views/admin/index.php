<div id="page-wrapper">
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Ringkasan</h1>
        </div>
    </div>
	<div class="row">
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-home fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php
	    				foreach ($kos as $kos_item) {?>
                            <div class="huge"><?php echo $kos_item->total;}?></div>
                            <div>Indekos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-home fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php
                        foreach ($kamar as $kamar_item) {?>
                            <div class="huge"><?php echo $kamar_item->totalKamar;}?></div>
                            <div>Kamar</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php
                        foreach ($pemilik as $pemilik_item) {?>
                            <div class="huge"><?php echo $pemilik_item->total;}?></div>
                            <div>Pemilik</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-dollar fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <?php
                        $totalSemua = 0;
                        foreach ($transaksi as $row) {
                            $hargaAsli = $row->hargaKamar * $row->durasiPemesanan;
                            $hargaBaru = $row->totalPembayaran;
                            $total = $hargaBaru - $hargaAsli; 
                            $totalSemua += $total;
                        }?>
                            <div class="huge"><h5>Rp<?php echo number_format($totalSemua);?></h5></div>
                            <div>Keuntungan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>