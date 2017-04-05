<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Laporan Keuangan</h1>
        </div>
    </div>
    	<div class="form-group">
	    	<div class="col-lg-3">
	            <h4>Bulan:</h4>
		                <select class="form-control selectpicker" name="bulan" title="Tidak Ada yang Dipilih">
		                    <option value="1">Januari</option>
		                    <option value="2">Februari</option>
		                    <option value="3">Maret</option>
		                    <option value="4">April</option>
		                    <option value="5">Mei</option>
		                    <option value="6">Juni</option>
		                    <option value="7">Juli</option>
		                    <option value="8">Agustus</option>
		                    <option value="9">September</option>
		                    <option value="10">Oktober</option>
		                    <option value="11">November</option>
		                    <option value="12">Desember</option>
		                </select>
		    </div>
		    <div class="col-lg-3">
		    	<h4>Tahun:</h4>
		    	    <select class="form-control selectpicker" name="tahun" title="Tidak Ada yang Dipilih">
		                <option value="<?php echo date("Y")?>"><?php echo date("Y")?></option>
		            </select>
		    </div>
		    <div class="col-lg-3">
		    	<form action="">
		    		<br>
		    		<br>
		    		<button type="submit" class="btn btn-default">Pilih</button>
		    	</form>
		    </div>
        </div>
    	<table class="table table-hover">
		    <thead>
		      <tr>
		        <th width="50px">ID Transaksi</th>
		        <th width="100px">Tanggal</th>
		        <th width="100px">Harga Asli (Rp)</th>
		        <th width="100px">Harga Baru (Rp)</th>
		        <th width="100px">Total (Rp)</th>
		      </tr>
		    </thead>
		    <tbody>
		      <tr>
		        <th>01</th>
		        <th>12 Maret 2017</th>
		        <th>5500000</th>
		        <th>6000000</th>
		        <th>500000</th>
		      </tr>
		      <tr>
		        <th>02</th>
		        <th>14 Maret 2017</th>
		        <th>1550000</th>
		        <th>1500000</th>
		        <th>-50000</th>
		      </tr>
		      <tr>
		        <th colspan="4">Total</th>
		        <th>450000</th>
		      </tr>
		    </tbody>
		</table>
</div>