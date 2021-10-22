<div class="content-wrapper">
    <div class="container-pills">
        <div id="list" class="w3-container pills">
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Data Produk</h1>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Edit Data Produk</h3>
                    </div>
                    <div class="card-body">
                    <?php foreach ($edit as $p) : ?>
                        <form class="user" method="POST" action="<?= base_url('dataproduk/update'); ?>" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ID Vendor</label>
                                <div class="col-sm-2">
                                    <input type="text" name="vend_id" class="form-control form-control-user" placeholder="Vendor" value="<?= $p['vend_id']; ?>">
                                    <input type="text" name="prod_id" class="form-control form-control-user" placeholder="ID" value="<?= $p['prod_id']; ?>" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-sm-5">
                                    <input type="text" name="prod_name" class="form-control form-control-user" placeholder="Nama Produk" value="<?= $p['prod_name']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Harga Produk</label>
                                <div class="col-sm-3">
                                    <input type="text" name="prod_price" class="form-control form-control-user" placeholder="Harga Jual" value="<?= $p['prod_price']; ?>">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" name="harga_beli" class="form-control form-control-user" placeholder="Harga Beli" value="<?= $p['harga_beli']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Stok</label>
                                <div class="col-sm-3">
                                    <input type="text" name="quantity" class="form-control form-control-user" placeholder="Jumlah" value="<?= $p['quantity']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Berat</label>
                                <div class="col-sm-3">
                                    <input type="text" name="weight" class="form-control form-control-user" placeholder="Berat" value="<?= $p['weight']; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-3">
                                    <select name="cat_id" class="form-control form-control-user">
                                        <?php 
                                        foreach($kategori as $k):
                                            if ($k['cat_id'] == $p['cat_id']){
                                            echo "<option value='".$k['cat_id']."' selected>".$k['cat_name']."</option>";
                                            } else {
                                            echo "<option value='".$k['cat_id']."'>".$k['cat_name']."</option>";
                                            }
                                        endforeach; 
                                        ?>        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-7">
                                    <textarea class="form-control" rows="5" id="prod_desc" name="prod_desc"><?php echo $p['prod_desc']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row mb-5">
                                <label class="col-sm-2 col-form-label">Foto Produk</label>
                                <div class="col-sm-3">
                                    <?php if($p['prod_img'] != null){ ?>
                                            <div>
                                                <img class="brand-image rounded" width="100px" src="<?= base_url()?>gambar/<?php echo $p['prod_img'];?>" alt="foto"><br>
                                                <?php echo $p['prod_img'];?>
                                            </div>
                                        <?php
                                        
                                    }?>
                                    <input type="file" id="userfile" name="userfile" class="form-control"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <input class="btn btn-info btn-md" type="submit" name="btnSubmit" value="Edit Produk" />
                                    <a href="<?php echo base_url('dataproduk'); ?>" class="btn bg-danger btn-md">Batal</a>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                    </div>
                    <div class="card-footer text-right">Minor Coffee © 2020 - by Nuno Akbar</div>
                </div>
            </section>
        </div>
    </div>
</div>