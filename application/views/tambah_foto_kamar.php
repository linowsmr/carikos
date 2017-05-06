<!DOCTYPE html>
<html lang="en">

<body>
    <aside class="call-to-action">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Tambah Foto Kamar</h2>
                    <hr class="small" style="border-color: black;">
                    <div class="row">
                        <form action="<?php echo site_url('kamar/tambah_foto_baru')?>" method="post" enctype="multipart/form-data">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <h4>Foto Kamar Baru</h4>
                                    <input type="file" name="foto[]" multiple required>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?php echo $id ?>">
                                </div>
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-lg btn-dark">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</body>

</html>
