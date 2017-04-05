<!DOCTYPE html>
<html lang="en">

<body>
    <aside id="daftar" class="call-to-action bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Masuk Akun</h2>
                    <hr class="small">
                    <div class="row">
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <form action="<?php echo site_url('pemilik/login')?>" method="post">
                                <div class="form-group">
                                    <h4>Nama Akun</h4>
                                    <input type="name" class="form-control" name="akun" required>
                                </div>
                                <div class="form-group">
                                    <h4>Kata Sandi</h4>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-light">Masuk</button>
                            </form>
                            <h5>Belum punya akun ? <a href="<?php echo site_url('pemilik/daftar')?>" style="color: #66ccff">Daftar</a></h5>
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
