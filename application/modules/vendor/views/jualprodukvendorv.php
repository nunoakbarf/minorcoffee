<div class="row col-md-9 mt-3">
    <div class="container-pills">
        <div id="list" class="w3-container pills">
            <!-- Content Header (Page header) -->
            <section class="content-header ">
                <div class="container-fluid">
                    <div class="row mb-2 col-md-12">
                        <div class="col-sm-6">
                            <h1>Daftar Produk</h1>
                        </div>
                        <div class="col-sm-4">
                            <?= $this->session->flashdata('notif'); ?>
                        </div>
                        <div class="col-sm-2">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <button class="btn bg-warning btn-sm" onclick="openPills('add')"><i class="fas fa-plus"></i> Jual Produk</button>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content col-md-12">
                <!-- Default box -->
                <div class="card" style="width:115%">
                    <div class="card-header card-warning card-outline">
                        <div class="card-title col-md-9">
                            <div class="row col-md-9">
                                <!----------- TAMPIL DATA SEARCH ----------->
                                <?php if ($title = $this->input->post('caridata')) { ?>
                                    <h5 class="font-weight-light" style="font-size:15px;">Menampilkan produk untuk "<span class="font-weight-bold font-italic"><?= $title ?></span> "</h5>
                                <?php } else { ?>
                                    <h5 class="font-weight-bold">Produk </h5>
                                <?php } ?>
                            </div>
                            <!----------- TAMPIL JUMLAH RESULT DATA ----------->
                            <h5 class="font-weight-light font-italic text-gray" style="font-size:15px;">Jumlah result data : <?php echo $total_rows; ?> Produk</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-responsive">
                            <thead class="bg-warning">
                                <tr>
                                    <th class="text-center" style="width:1%">
                                        NO
                                    </th>
                                    <th class="text-center" style="width: 50%">
                                        Foto
                                    </th>
                                    <th class="text-center">
                                        Nama
                                    </th>
                                    <th style="width: 5%" class="text-center">
                                        Stok
                                    </th>
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <?php if (empty($products)) : ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-light" role="alert">
                                            <center><strong class="text-danger">Data produk kosong!</strong></center>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                            <?php
                            $no = 1;
                            foreach ($products as $p) { ?>
                                <tbody>

                                    <tr>
                                        <td class="text-center">
                                            <?php echo ++$start ?>
                                        </td>
                                        <td class="text-center">
                                            <img class="brand-image rounded" width="80%" src="<?= base_url('gambar/' . $p['prod_img']); ?>" alt="foto">
                                            <div class="col-md-auto bg-dark p-2">
                                                <h5 class="text-white font-weight-bold m-0"><?php echo $p['prod_name']; ?></h5>
                                            </div><br>
                                            <h6 class="text-left text-dark m-0" style="font-size:16px;">Harga jual : Rp. <?php echo number_format($p['prod_price']) ?></h6>
                                        </td>
                                        <td>
                                            <span class="badge badge-success"><?php echo $p['cat_name']; ?></span><br>
                                            <a href="#" style="font-size:20px;"><b><?php echo $p['prod_name']; ?></b></a>
                                            <br />
                                            <small>
                                                <?php echo $p['prod_desc']; ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $p['quantity']; ?>
                                        </td>
                                        <td class="project-actions text-center">
                                            <a href="<?php echo base_url('vendor/edit/'), $p['prod_id'] ?>" class="mb-2 btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <a class="mb-2 btn btn-danger btn-sm" href="<?php echo base_url('vendor/hapus/' . $p['prod_id']) ?>" onclick="return confirm('Yakin untuk menghapus data produk ini?')"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr><?php } ?>
                                </tbody>
                        </table>
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </section>
        </div>


        <div id="add" class="w3-container pills" style="display:none;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Jual Produk</h1>
                        </div>
                        <div class="col-sm-3">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <button class="btn bg-danger btn-sm" onclick="openPills('list')"><i class="fas fa-undo"></i> Kembali</button>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="">
                    <div class="card" style="width: 200%;">
                        <div class="card-header bg-light">
                            <h3 class="card-title">Jual Produk Baru</h3>
                        </div>
                        <div class="card-body" >
                            <?php //echo form_open_multipart('vendor/jualproduk_aksi');
                            ?>
                            <!-- <form action="<?php //echo base_url('Vendor/jualproduk_aksi'); 
                                                ?>" method="post"> -->
                            <form action="<?php echo site_url('Vendor/jualproduk_aksi') ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">ID Mitra</label>
                                    <div class="col-sm-2">
                                        <input type="text" name="vend_id" class="form-control align-center" value="<?= $users['id_user']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Nama Produk</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="prod_name" class="form-control" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Harga Produk</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="prod_price" class="form-control" placeholder="Harga Jual" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <!-- <input type="text" name="harga_beli" class="form-control" placeholder="Harga Beli"> -->
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Stok</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="quantity" class="form-control" placeholder="Stok" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Kategori</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="cat_id" id="cat_id">
                                            <option value="6">- Pilih -</option>
                                            <?php foreach ($category as $c) { ?>
                                                <option value="<?php echo $c['cat_id']; ?>"><?php echo $c['cat_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-5 col-form-label">Deskripsi</label>
                                    <div class="col-sm-12">
                                        <textarea type="text" name="prod_desc" class="form-control" placeholder="Deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row mb-5">
                                    <label class="col-sm-5 col-form-label">Gambar</label>
                                    <div class="col-sm-12">
                                        <input type="file" name="prod_img" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button class="btn btn-success" type="submit"> Jual Produk</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-right">Minor Coffee © 2020 - by Nuno Akbar</div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>