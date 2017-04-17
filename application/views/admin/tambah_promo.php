<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tambah Promo</h1>
            <form action="<?php echo site_url('admin/tambah_promo_data') ?>" method="post" enctype="multipart/form-data">
            	<div class="form-group">
                    <h4>Nama Promo</h4>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="form-group">
                    <h4>Deskripsi Promo</h4>
                    <textarea class="form-control" rows="3" name="deskripsi" required></textarea>
                </div>
                <div class="form-group">
                    <h4>Potongan Harga</h4>
                    <div class="input-group">
                    	<span class="input-group-addon">Rp</span>
                    	<input type="name" class="form-control" name="harga" required>
                    	<span class="input-group-addon">,00</span>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Kode Promo</h4>
                    <input type="text" class="form-control" name="kode" style="text-transform:uppercase" required>
                </div>
                <div class="form-group">
                    <h4>Mulai Promo</h4>
                    <input type="date" class="form-control" name="mulaiPromo" required>
                </div>
                <div class="form-group">
                    <h4>Selesai Promo</h4>
                    <input type="date" class="form-control" name="selesaiPromo" required>
                </div>
                <div class="form-group">
                    <h4>Mulai Sewa</h4>
                    <div class="col-lg-6">
                        <input type="date" class="form-control" name="mulaiSewa">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="mulaiSewa2">
                        <small>Isi "-" pada kolom di atas apabila tidak ada batas waktu</small>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Akhir Sewa</h4>
                    <div class="col-lg-6">
                        <input type="date" class="form-control" name="akhirSewa">
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="akhirSewa2">
                        <small>Isi "-" pada kolom di atas apabila tidak ada batas waktu</small>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Minimum Transaksi</h4>
                    <div class="input-group">
                    	<span class="input-group-addon">Rp</span>
                    	<input type="name" class="form-control" name="transaksi" required>
                    	<span class="input-group-addon">,00</span>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Minimum Durasi Pemesanan</h4>
                    <div class="input-group">
                    	<input type="number" min="1" class="form-control" name="durasi" required>
                    	<span class="input-group-addon">bulan</span>
                    </div>
                </div>
                <div class="form-group">
                    <h4>Foto Promo</h4>
                    <input type="file" name="foto[]">
                </div>
                <button type="submit" class="btn btn-primary" style="float: right">Tambah</button>
            </form>
        </div>
    </div>
</div>