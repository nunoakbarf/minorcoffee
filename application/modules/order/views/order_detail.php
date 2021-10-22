<div class="content-wrapper">
    <div class="container-pills">
        <div id="list-kat" class="w3-container pills">
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Detail Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                            <a class="btn btn-warning btn-sm" href="<?php echo base_url('order')?>"><i class="fas fa-undo"></i> Kembali</a>
                            </li>
                        </ol>
                    </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Detail Order</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead class="bg-warning">
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th class="text-center">
                                        Tanggal
                                    </th>
                                    <th class="text-center">
                                        Nama
                                    </th>
                                    <th class="text-center">
                                        Nama Produk
                                    </th>
                                    <th class="text-center">
                                        Jumlah
                                    </th>
                                    <th style="width: 10%;" class="text-center">
                                        Harga
                                    </th>
                                    <th class="text-center">
                                        Bukti Tranfer
                                    </th>
                                    <!-- <th class="text-center">
                                        Jasa Kirim
                                    </th> -->
                                    <th class="text-center">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                $total_bayar = 0;
                                    foreach ($Order as $o){
                                ?>
                                    <tr>
                                        <td class="text-center" width="1px"><?php echo $o['order_num']; ?></td>
                                        <td class="text-center"><?php echo $o['order_date']; ?></td>

                                        <td><?php echo $o['nama']; ?><br>
                                            <b class="text-dark">Status : </b><?php echo $o['status']; ?>
                                        </td>

                                        <td><?php echo $o['prod_name']; ?></td>

                                        <td class="text-center"><?php echo $o['quantity']; ?></td>

                                        <td class="text-right">Rp. <?php echo number_format($o['prod_price']) ?><br>
                                        </td>

                                        <td class="text-center">
                                        <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal<?php echo $o['order_num']; ?>">
                                            <img width="50px" src="<?= base_url('bukti/'.$o['bukti_img']);?>" alt="foto">
                                        </button>
                                        <!-- modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $o['order_num']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bukti Tranfer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img width="100%" src="<?= base_url('bukti/'.$o['bukti_img']);?>" alt="Bukti">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <!-- modal -->
                                        </td>
                                        <!-- <td>
                                            <?php echo $o['kurir']; ?><br>
                                            <b class="text-dark">No Resi : </b><?php echo $o['no_resi']; ?>
                                        </td> -->
                                        <td>
                                        <center>
                                                <a class="btn btn-info btn-sm" href="<?php echo base_url('order/edit/'), $o['order_id'] ?>" >Update <i class="fas fa-edit"></i> </a>
                                                <a class="btn btn-danger btn-sm" href="<?php echo base_url('order/deleteitems/'.$o['order_num'])?>" onclick="return confirm('Yakin untuk menghapus kategori produk ini?')"><i class="fas fa-trash"></i> </a>
                                        </center>
                            
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-right">Kategori Produk Minor Coffee</div>
                </div>
            </section>
        </div>

        <div id="add-kat" class="w3-container pills" style="display:none;"> 
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah Kategori</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                            <button class="btn bg-warning btn-sm" onclick="openPills('list-kat')"><i class="fas fa-book"></i> Kategori Produk</button>
                            </li>
                        </ol>
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <h3 class="card-title">Tambah Kategori</h3>
                    </div>
                    <div class="card-body">
                        <form class="user" method="POST" action="<?php echo base_url(). 'category/tambah_aksi'; ?>" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-5">
                                    <input type="text" name="cat_name" class="form-control" placeholder="Nama" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <input class="btn btn-danger" type="submit" name="btnSubmit" value="Tambah Kategori">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-right">Minor Coffee © 2020 - by Nuno Akbar</div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit-kategori" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title">Edit Kategori Produk</h4>
                <button aria-hidden="true" data-dismiss="modal" class="text-white close" type="button">×</button>
            </div>
            
            <form class="form-horizontal" action="<?php echo base_url('category/update')?>" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-lg-12 col-sm-12 control-label">Nama Kategori</label>
                        <div class="col-lg-12">
                            <input type="hidden" id="cat_id" name="cat_id">
                            <input type="text" class="form-control" id="cat_name" name="cat_name">
                        </div>
                    </div>
                </div>
                     
                <div class="modal-footer">
                    <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"> Batal</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>