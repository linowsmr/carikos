<!DOCTYPE html>
<html lang="en">

<body>

    <aside class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Daftar Akun</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <form action="<?php echo site_url('pemilik/pendaftaran')?>" method="post">
                                <div class="form-group">
                                    <h4>Nama Akun</h4>
                                    <input type="text" class="form-control" name="akun" required>
                                </div>
                                <div class="form-group">
                                    <h4>Kata Sandi</h4>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <div class="form-group">
                                    <h4>Nama Lengkap</h4>
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <h4>Alamat Email</h4>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <h4>Nomor Telepon</h4>
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                                <div class="form-group">
                                    <h4>Hak Akses</h4>
                                    <label class="radio-inline">
                                        <input type="radio" name="akses" value="pencari">Pencari Kos
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="akses" value="pemilik">Pemilik Kos
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-lg btn-light">Daftar</button>
                            </form>
                            <h5>Sudah punya akun ? <a href="<?php echo site_url('pemilik/masuk')?>" style="color: #66ccff">Masuk Akun</a></h5>
                        </div>
                        <div class="col-lg-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
