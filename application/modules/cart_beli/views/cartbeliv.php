<div class="content-wrapper">
    <div class="container-pills">
        <div id="list-kat" class="w3-container pills">
            <!-- Content Header (Page header) --> 
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Keranjang Belanja Beli Produk</h1>
                    </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header card-warning card-outline">
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered">
                      <thead class="bg-warning">
                        <tr>
                          <th class="text-center" width="1px">NO</th>
                          <th class="text-center">Nama</th>
                          <th class="text-center">Harga</th>
                          <th class="text-center" width="150px">Qty</th>
                          <th class="text-center">Sub-Total</th>
                          <th class="text-center" width="120px">Delete Item</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $total_bayar = 0;
                        foreach ($cart_beli->result() as $row){ ?>
                          <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td><?php echo $row->prod_name; ?></td>
                            <td align="right">Rp. <?php echo number_format($row->price, 0,',','.') ?>,-</td>
                            <td class="text-center">
                              <div ></div>
                              <?php echo anchor('cart_beli/min_qty/'.$row->prod_id,'<div class="btn btn-sm btn-warning mx-auto"><i class="fas fa-minus"></i></div>')?>
                              <div id="demo" class="btn btn-sm btn-light mx-auto"><?php echo $row->qty; ?></div>
                              <?php echo anchor('cart_beli/add_cart/'.$row->prod_id,'<div class="btn btn-sm btn-warning mx-auto"><i class="fas fa-plus"></i></div>')?>
                            </td>
                            <td align="right">Rp. <?php echo number_format($row->total_harga, 0,',','.') ?>,-</td>
                            <td align="center"><?php echo anchor('cart_beli/delete_cart_beli/'.$row->prod_id,'<div class="text-dark mx-auto" style="border-radius: 50%;"><i class="fas fa-trash"></i></div>')?></td>
                          </tr>
                        <?php $total_bayar+=$row->total_harga; }?>
                          <tr>
                              <td class="bg-light text-center font-weight-bold" colspan="3">TOTAL</td>
                              <td class="bg-light text-center font-weight-bold"><?php echo $sum_jumlah->jumlah; ?></td>
                              <td class="bg-light font-weight-bold" align="right">Rp. <?php echo number_format($total_bayar, 0,',','.') ?>,-</td>
                          </tr>
                      </tbody>
                    </table>
                    </div>
                    <div class="col-md-12 ml-3 mb-5">
                        <a href="<?php echo base_url('cart_beli/delete_all_cart')?>"><div class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Kosongkan Keranjang</div></a>
                        <a href="<?php echo base_url('beliproduk')?>"><div class="btn btn-warning btn-sm"><i class="fas fa-cart-plus"></i> Lanjutkan Belanja</div></a>
                        <a href="<?php echo base_url('cart_beli/transaction')?>"><div class="btn btn-sm btn-success"><i class="fas fa-sign-out-alt"></i> Transaksi</div></a>
                    </div>
                    <div class="card-footer text-right">MinorCoffee © 2020 - by Nuno Akbar</div>
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
                    <div class="card-footer text-right">Input Kategori Produk MInor Coffee</div>
                </div>
            </section>
        </div>
    </div>
</div>