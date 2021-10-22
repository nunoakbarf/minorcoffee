<div class="content-wrapper p-3">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Konfirmasi Produk Mitra</h1>
                </div>
            </div>
        </div>
    </section>
    <div class="card">
        <div class="card-header bg-dark">
            <h3 class="card-title">Tambah Produk Baru</h3>
        </div>
        <div class="card-body">
            <?php 
            foreach ($edit_vend as $key => $value) { ?>
                <form action="<?php echo site_url('beliproduk/action_edit_prod_vend/' . $value['prod_id']) ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group row mb-5">
                        <div class="col-sm-5 mx-auto text-center">
                        <input type="hidden" name="img" class="form-control" placeholder="img" value="<?= './gambar/' .$value['prod_img'] ?>" readonly>
                            <img class="rounded shadow" src="<?php echo base_url('./gambar/' . $value['prod_img']) ?>" style="width:200px; border">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ID Vendor</label>
                        <div class="col-sm-2">
                            <input type="hidden" name="prod_id" class="form-control" placeholder="ID Vendor" value="<?= $value['prod_id'] ?>" readonly>
                            <input type="text" name="vend_id" class="form-control" placeholder="ID Vendor" value="<?= $value['vend_id'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-5">
                            <input type="text" name="prod_name" class="form-control" placeholder="Nama" value="<?= $value['prod_name'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Harga Produk</label>
                        <div class="col-sm-3">
                            <input type="text" name="prod_price" class="form-control" placeholder="Harga Jual" value="<?= $value['prod_price'] ?>" readonly>
                        </div>
                        <div class="col-sm-3">
                            <input type="text" name="harga_beli" class="form-control" placeholder="Harga Beli" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-3">
                            <input type="text" name="quantity" class="form-control" placeholder="Stok" value="<?= $value['quantity'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="cat_id" id="cat_id" readonly>
                                <option value="<?= $value['cat_id'] ?>">- <?= $value['join_cat_name'] ?> -</option>
                            </select>
                            <!-- <input type="text" name="cat_id" class="form-control" placeholder="Stok" value="" readonly> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea type="text" name="prod_desc" class="form-control" placeholder="<?= $value['prod_desc'] ?>" readonly></textarea>
                            <input type="hidden" name="prod_desc" class="form-control" placeholder="desc" value="<?= $value['prod_desc'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select class="form-control" name="status" id="status" required>
                                <option value="0">- Belum Konfirmasi -</option>
                                <option value="1">- Konfirmasi -</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <input class="btn btn-danger" type="submit" value="Tambah Produk">
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="card-footer text-right">Minor Coffee © 2020 - by Nuno Akbar</div>
    </div>
</div>